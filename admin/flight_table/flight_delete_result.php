<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $flight_id = $_POST["flight_id"];
 
 $sql = "DELETE FROM flight WHERE flight_id='".$flight_id."'";
 $result = mysqli_query($con,$sql);

 echo "<H3>[항공편 삭제 결과]</H3>";
 if($result){
    echo "데이터가 성공적으로 삭제되었습니다.";
 }else{
    echo "데이터 삭제에 실패하였습니다.";
    echo "실패 원인 : ".mysqli_error($con);
 }
 mysqli_close($con);
 echo "<br><br> <A HREF='flight_select.php'> 항공편 테이블로 </A>";
 echo "<br> <A HREF='../admin.html'> 관리자 모드로 </A>";
 echo "<br> <A HREF='../../main.html'> 메인화면으로 </A>";
?>