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
			
			if ($login == null or $login == "") {
				header('Location: accountManagement.php?error=Все поля должны быть заполнены');
			}
			
			$deleteResult = pg_query($conn, "DELETE FROM users WHERE login_user='".$login."';");
			
			if (!$deleteResult) {
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