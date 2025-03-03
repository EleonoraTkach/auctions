<?php 
	session_start();
	$conn = require_once __DIR__ . '/../conn.php';
	if ($conn == null) {
		header('Location: signIn.html?error=Ошибка при подключении');
	} else {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$login = pg_escape_string($conn, $_POST["login"]);
			$hash = hash('sha256', $_POST["password"]);
			$selectResult = pg_query($conn, "SELECT id_user,role_user,name_user,password_user,telephone_user FROM users WHERE login_user='".$login."';");

			if (!$selectResult) {
				echo "Ошибка при входе в систему\n";
				exit;
			} else {
				if (pg_num_rows($selectResult) > 0) {
					$row = pg_fetch_row($selectResult);
					$password = $row[3];
					if ($password == $hash) {
						$_SESSION["id_user"] = $row[0];
						$_SESSION["role_user"] = $row[1];
						$_SESSION["login_user"] = $login;
						$_SESSION["name_user"] = $row[2];
						$_SESSION["password_user"] = $hash;
						$_SESSION["telephone_user"] = $row[4];
						
						if ($row[1] == "1" or $row[1] == 1) {
							header('Location: ../admin/accountInfo.php');
						} else {
							header('Location: ../user/accountInfo.php');
						}
					} else {
						header('Location: ../signIn.html?error=Неверный логин или пароль');
					}
				} else {
					header('Location: ../signIn.html?error=Неверный логин или пароль');
				}
			}
		} else {
			echo "Ошибка при подключении\n";
		}
	}
?>