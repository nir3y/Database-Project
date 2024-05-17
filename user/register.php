<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_insert</title>
</head>
<body>
    <h2>[회원가입]</h2>
    <form method="post" action="register_result.php">
        <ul>
            <li>아이디: <input type="number" name="user_id"></li>
            <li>이름: <input type="text" name="user_name"></li>
            <li>이메일: <input type="text" name="email"></li>
        </ul>
        <input type="submit" value="회원가입">
    </form>

    <br>
    <a href="login.php">로그인 화면으로</a>
    <br>
    <a href="../main.html">모드 선택 화면으로</a>
    
</body>
</html>