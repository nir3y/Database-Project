<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $airport_id = $_POST["airport_id"];
 $airport_name = $_POST["airport_name"];
 $country = $_POST["country"];

 $sql = "INSERT INTO airport VALUES('".$airport_id."','".$airport_name."','".$country."')";
 $result = mysqli_query($con,$sql);

 echo "<H3>[신규 공항 등록 결과]</H3>";
 if($result){
    echo "데이터가 성공적으로 입력되었습니다.";
 }else{
    echo "데이터 입력에 실패하였습니다.";
    echo "실패 원인 : ".mysqli_error($con);
 }
 mysqli_close($con);
 echo "<br><br> <A HREF='airport_select.php'> 공항 테이블로 </A>";
 echo "<br> <A HREF='../admin.html'> 관리자 모드로 </A>";
 echo "<br> <A HREF='../../main.html'> 메인화면으로 </A>";
?>