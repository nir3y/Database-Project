<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>고객/사용자 모드</title>
</head>
<body>
    <h1>[고객/사용자 모드]</h1>
    <?php
     $user_id = $_GET['user_id'];
     echo "<p>사용자 아이디: ".$user_id."</p>";
    ?>

    <ul>
        <li><a href="search_reservation/search_main.php?user_id=<?php echo $user_id; ?>">항공권 조회/예약</a></li>
        <li><a href="reservation_info/reservation_info_main.php?user_id=<?php echo $user_id; ?>">예약 정보 확인</a></li>
    </ul>
    <a href="login.php">로그인 화면으로</a>
    <br>
    <a href="../main.html">모드 선택 화면으로</a>
    

    
</body>
</html>
