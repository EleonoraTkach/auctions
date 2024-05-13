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
        <a href="#">Мои аукционы</a>
        <a href="#">Текущие аукционы</a>
		<a href="signOut.php">Выход из системы</a>
    </div>
    <div class="content">
        <?php  
		session_start();
		if (!isset($_SESSION['id_user'])) {
			header('Location: ../signIn.html'); 
			exit;
		}?>
		<form action="updateUser.php" method="post">
			<div class="form-field">
					<label for="name">Имя пользователя:</label>
					<input type="text" id="name" name="name" value=<?php  
		session_start();
		if (!isset($_SESSION['id_user'])) {
			header('Location: ../signIn.html'); 
			exit;
		} else {
			echo $_SESSION['name_user'];
		}?>>
			</div>
			<div class="form-field">
					<label for="telephone">Номер телефона:</label>
					<input type="tel" id="telephone" name="telephone" placeholder="+7__________" pattern="\+\d{11}" value=<?php  
		session_start();
		if (!isset($_SESSION['id_user'])) {
			header('Location: ../signIn.html'); 
			exit;
		} else {
			echo $_SESSION['telephone_user'];
		}?>>
			</div>
			<div class="form-field">
				<label for="password">Новый пароль:</label>
				<input type="password" id="password" name="password">
			</div>
			<button type="submit">Сохранить изменения</button>
			<label class="error"><?php echo $_GET["error"]; ?><label>
		</form>
    </div>
</body>
</html>