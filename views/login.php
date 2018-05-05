<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login page</title>
</head>

<body>
    <h1><?=$message?></h1>
    <h2>Пожалуйста, войдите в магазин:</h2>
    <form action="/user/login" method="post">
        <p><b>Логин:</b><br>
            <input type="text" name="login" size="25">
        </p>
        <p><b>Пароль:</b><br>
            <input type="text" name="password" size="25">
        </p>
        <button type="submit">Login</button>
    </form>
</body>

</html>
