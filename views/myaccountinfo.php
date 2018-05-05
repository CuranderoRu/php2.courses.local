<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User info</title>
</head>
<body>
    <h1>Hello, <?=$user->getName()?></h1>
    <p>Login: <?=$user->getLogin()?></p>
    <p>Last login: <?=$user->getLastLogin()?></p>
    <p><a href="..">В магаз</a></p>
</body>
</html>