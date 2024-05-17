<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $user_id = $_POST["user_id"];
 $user_name = $_POST["user_name"];
 $email = $_POST["email"];

 $sql = "INSERT INTO users VALUES('".$user_id."','".$user_name."','".$email."')";
 $result = mysqli_query($con,$sql);

 echo "<H3>[신규 사용자 등록 결과]</H3>";
 if($result){
    echo "데이터가 성공적으로 입력되었습니다.";
 }else{
    echo "데이터 입력에 실패하였습니다.";
    echo "실패 원인 : ".mysqli_error($con);
 }
 mysqli_close($con);
 echo "<br><br> <a href='login.php'>로그인 화면으로</a>";
 echo "<br> <a href='../main.html'>모드 선택 화면으로</a>";

?>