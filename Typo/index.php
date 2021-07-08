<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Typo</title>
</head>
<body>
    <form action="PHP/login_act.php" method="post">
        <label>ID: <input type="text" name="user_loginid"></label><br>
        <label>PW: <input type="text" name="user_loginpw"></label><br>
        <input type="submit" value="ログイン">
    </form>
    <form action="PHP/user_setting.php" method="post">
    <input type="submit" value="新規ユーザー登録">
    </form>
</body>
</html>