<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $res_id = $_POST["res_id"];
$user_id = $_POST["user_id"];
$flight_id_1 = $_POST["flight_id_1"];
$flight_id_2 = $_POST["flight_id_2"];
$res_date = $_POST["res_date"];

$sql = "UPDATE reservation_info SET res_id='".$res_id."', user_id='".$user_id."', flight_id_1='".$flight_id_1."', 
flight_id_2=".$flight_id_2.", res_date='".$res_date."' WHERE res_id='".$res_id."'";

 $result = mysqli_query($con,$sql);

 echo "<H3>[예약 정보 수정 결과]</H3>";
 if($result){
    echo "데이터가 성공적으로 수정되었습니다.";
 }else{
    echo "데이터 수정에 실패하였습니다.";
    echo "실패 원인 : ".mysqli_error($con);
 }
 mysqli_close($con);
 echo "<br><br> <A HREF='reservation_info_select.php'> 예약 정보 테이블로 </A>";
 echo "<br> <A HREF='../admin.html'> 관리자 모드로 </A>";
 echo "<br> <A HREF='../../main.html'> 메인화면으로 </A>";
?>

