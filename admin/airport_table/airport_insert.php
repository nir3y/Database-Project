<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>airport_insert</title>
</head>
<body>
    <h2>[신규 공항 등록]</h2>
    <form method="post" action="airport_insert_result.php">
        <ul>
            <li>airport_id: <input type="text" name="airport_id"></li>
            <li>airport_name: <input type="text" name="airport_name"></li>
            <li>country: <input type="text" name="country"></li>
        </ul>
        <input type="submit" value="등록">
    </form>
    <br>
    <a href="airport_select.php">이전으로</a>
</body>
</html>