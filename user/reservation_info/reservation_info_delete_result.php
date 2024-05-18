<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $res_id = $_POST["res_id"];
 $user_id = $_POST["user_id"];
 
 $sql = "DELETE FROM reservation_info WHERE res_id='".$res_id."'";
 $result = mysqli_query($con,$sql);

 echo "<H3>[예약 취소 결과]</H3>";
 if($result){
    echo "예약이 성공적으로 취소되었습니다.";
 }else{
    echo "데이터 삭제에 실패하였습니다.";
    echo "실패 원인 : ".mysqli_error($con);
 }
 mysqli_close($con);

 echo "<br> <a href='reservation_info_main.php?user_id=".$user_id."'> 나의 예약 조회 </a>";
 echo "<br> <a href='../user.php?user_id=".$user_id."'> 메인화면으로 </a>";
?>