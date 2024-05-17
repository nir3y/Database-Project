<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h1>[고객/사용자 모드]</h1>
    <p>로그인 할 사용자를 선택해주세요</p>
    <form method="GET" action="user.php">
        아이디: 
        <select name="user_id"> <!--등록된 user_id만 combobox에서 선택해서 사용할 수 있도록-->
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT user_id, user_name FROM users";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['user_id']."'>".$row['user_id']."(".$row['user_name'].")</option>";
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
        <input type="submit" value="로그인">
    </form>
    <br>
    <a href="register.php">회원가입</a>
    <br>
    <a href="../main.html">모드 선택 화면으로</a>
</body>
</html>