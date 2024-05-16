<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_insert</title>
</head>
<body>
    <h2>[신규 항공사 등록]</h2>
    <form method="post" action="airline_insert_result.php">
        <ul>
            <li>airline_id: <input type="text" name="airline_id"></li>
            <li>airline_name: <input type="text" name="airline_name"></li>
            <li>website: <input type="text" name="website"></li>
        </ul>
        <input type="submit" value="등록">
    </form>
    <br>
    <a href="airline_select.php">이전으로</a>
</body>
</html>