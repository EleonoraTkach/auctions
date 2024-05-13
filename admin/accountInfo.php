<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="../style/menuAvtorization.css">
	<link rel="stylesheet" href="../style/sign.css">
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
		}?>
		<form action="updateInfo.php" method="post">
			<div class="form-field">
				<label for="login"><?php echo "Логин: " . $_SESSION['login_user']; ?></label>
			</div>
			<div class="form-field">
				<label for="name"><?php echo "Имя: " . $_SESSION['name_user']; ?></label>
			</div>
			<div class="form-field">
				<label for="phone"><?php echo "Номер телефона: " . $_SESSION['telephone_user']; ?></label>
			</div>
			<div class="form-field">
				<label for="phone">Роль в системе: администратор</label>
			</div>
			<button type="submit">Изменить данные</button>
		</form>
    </div>
</body>
</html>
