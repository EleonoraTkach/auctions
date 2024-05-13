<?php 
	$conn = require_once __DIR__ . '/conn.php';
	if ($conn == null) {
		header('Location: signUp.html?error=Ошибка при подключении');
	} else {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$login = $_POST["login"];
			$name = $_POST["name"];
			$password = $_POST["password"];
			$telephone = $_POST["telephone"];

			if ($login == null or $login == "" or $name == null or $name == "" or $password == null or $password == "" or $telephone == null or $telephone == "") {
				header('Location: signUp.html?error=Все поля должны быть заполнены');
			}
			$hash = hash('sha256', $_POST["password"]);
			
			$selectResultLogin = pg_query($conn, "SELECT login_user FROM users WHERE login_user='".$login."';");
			$selectResultTelephone = pg_query($conn, "SELECT telephone_user FROM users WHERE telephone_user='".$telephone."';");
			
			if (!$selectResultLogin) {
				echo "Ошибка при входе в систему\n";
				exit;
			} else {
				$row = pg_fetch_row($selectResultLogin);
				$new_login = $row[0];
				if ($new_login <> null and $new_login <> "") {
					header('Location: signUp.html?error=Данный логин занят другим пользователем');
					exit;
				} 
				$row = pg_fetch_row($selectResultTelephone);
				$new_telephone = $row[0];
				if ($new_telephone <> null and $new_telephone <> "") {
					header('Location: signUp.html?error=Данный номер телефона уже зарегистрирован в системе');
					exit;
				} else {
					$insertResult = pg_query($conn, "INSERT INTO users (role_user, login_user, password_user, name_user, telephone_user) 
			VALUES (2,'".$login."','".$hash."','".$name."','".$telephone."');");
					if (!$insertResult) {
						echo "Ошибка при добавлении пользователя\n";
						exit;
					}
					echo "пользователь зареган в системе";
				}	
			}
		} else {
			echo "Ошибка при подключении\n";
		}
	}
?>