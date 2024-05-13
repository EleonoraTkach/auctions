<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="../style/menuAvtorization.css">
	<link rel="stylesheet" href="../style/managementForForms.css">
</head>
<body>
    <div class="navbar">
		<a href="accountInfo.php">Информация о профиле</a>
        <a href="accountManagement.php">Управление аккаунтами</a>
        <a href="#">Подтверждение аукционов</a>
		<a href="signOut.php">Выход из системы</a>
    </div>
    <div class="content">
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
			$selectResultUsers = pg_query($conn, "SELECT id_user,name_user,role_user,login_user FROM users WHERE id_user<>".$_SESSION['id_user'].";");

			if (pg_num_rows($selectResultUsers) > 0) {
				$rows = pg_fetch_all($selectResultUsers);
				foreach ($rows as $row) {
					$notice = "";
					if ($row['role_user']==1){
						$notice="Сделать обычным пользователем";
						$role = "администратор";
					} else {
						$notice="Сделать пользователя администратором";
						$role = "обычный пользователь";
					}
					echo "<br />\n";
					echo "<div class='container'>
                        <form method=\"post\">
						<p>Имя: </p><input type=\"text\" name=\"name\" value=\"". $row['name_user'] . "\" readonly>
						<br/>
						<p>Логин: </p><input type=\"text\" name=\"login\" value=\"". $row['login_user'] . "\" readonly>
						<br/>
						<p>Роль: </p><input type=\"text\" name=\"role\" value=\"". $role . "\" readonly>
						<button type=\"submit\" formaction=\"updateRole.php\">".$notice."</button>
						<button type=\"submit\" formaction=\"deleteUser.php\">Удалить пользователя</button>
					    </form>
					    </div>";
				}
			} else {
				echo "<br />\nНичего не найдено";
			}
		}
		/*<a href='updateRole.php?id=" .$row['id_user'] . "'>".$notice."</a>
						<a href='deleteUser.php?id=" .$row['id_user'] . "'>Удалить пользователя</a>*/?>
		
	</div>
</body>
</html>
