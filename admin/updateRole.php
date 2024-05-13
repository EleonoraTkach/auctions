<?php 
	session_start();
	if (!isset($_SESSION['id_user'])) {
		header('Location: ../signIn.html'); 
		exit;
	}
	
	$conn = require_once __DIR__ . '/../conn.php';
	if ($conn == null) {
		header('Location: accountManagement.php?error=Ошибка при подключении');
	} else {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$login = $_POST["login"];
			$role = $_POST["role"];
			
			if (($login == null or $login == "") or ($role == null or $role == "")) {
				header('Location: accountManagement.php?error=Все поля должны быть заполнены');
			}
			if ($role=="администратор") {
				$role=2;
			} else {
				$role=1;
			}
			
			$updateResult = pg_query($conn, "UPDATE users SET role_user='".$role."' WHERE login_user='".$login."';");
			
			if (!$updateResult) {
				header('Location: accountManagement.php?error=Пользователь не найден');
				exit;
			} else {
				header('Location: accountManagement.php');					
			}
		} else {
			echo "Ошибка при подключении";
		}
	}
?>