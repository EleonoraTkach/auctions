<?php 
	session_start();
	if (!isset($_SESSION['id_user'])) {
		header('Location: ../signIn.html'); 
		exit;
	}
	
	$conn = require_once __DIR__ . '/../conn.php';
	if ($conn == null) {
		header('Location: accountInfo.php?error=Ошибка при подключении');
	} else {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$name = $_POST["name"];
			$password = $_POST["password"];
			$telephone = $_POST["telephone"];
			
			if ($name == null or $name == "") {
				$name = $_SESSION['name_user'];
			}
			if ($telephone == null or $telephone == "") {
				$telephone = $_SESSION['telephone_user'];
			} else {
				if ($telephone<>$_SESSION['telephone_user']) {
					$selectResultTelephone = pg_query($conn, "SELECT telephone_user FROM users WHERE telephone_user='".$telephone."';");
					$row = pg_fetch_row($selectResultTelephone);
					$new_telephone = $row[0];
					if ($new_telephone <> null and $new_telephone <> "") {
					header('Location: updateInfo.php?error=Данный номер телефона уже зарегистрирован в системе');
					exit;
					}
				}
				
			}
			if ($password == null or $password == "") {
				$password = $_SESSION['password_user'];
			} else {
				$password = hash('sha256', $_POST["password"]);
			}
			
			$updateResult = pg_query($conn, "UPDATE users SET name_user='".$name."',telephone_user='".$telephone."',password_user='".$password."' WHERE id_user='".$_SESSION['id_user']."';");
			
			if (!$updateResult) {
				echo "Ошибка при входе в систему\n";
				exit;
			} else {
				$_SESSION["name_user"] = $name;
				$_SESSION["password_user"] = $hash;
				$_SESSION["telephone_user"] = $telephone;
				header('Location: accountInfo.php?error=Данные успешно изменены');					
			}
		} else {
			echo "Ошибка при подключении\n";
		}
	}
?>