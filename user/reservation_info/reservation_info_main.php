<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $user_id = $_GET["user_id"]; // 사용자 아이디를 받아옴
 $sql="SELECT * FROM reservation_info WHERE user_id = '$user_id' ";

 $result=mysqli_query($con,$sql);

 echo "<h2>[나의 예약 정보]</h2>";
 echo "사용자 아이디: ".$user_id;
 echo "<I><br><br>(편도 항공권을 예약한 경우, 오는 편은 NULL 값을 가짐)</I><BR><BR> ";

 if($result){
    echo mysqli_num_rows($result), "건의 결과가 검색되었습니다. ";
 }
 else{
    echo "실패 원인:".mysqli_error($con);
    exit();
 }

 echo "<TABLE BORDER=1>";
 echo "<TR>";
 echo "<TH>예약 번호</TH> <TH>사용자 아이디</TH> <TH>가는 편</TH> <TH>오는 편</TH> <TH>예약일자</TH>";

 echo "</TR>";

 while($row=mysqli_fetch_array($result)){
    echo "<TR>";
    echo "<TD>", $row["res_id"],"</TD>";
    echo "<TD>", $row["user_id"],"</TD>";
    echo "<TD>", $row["flight_id_1"],"</TD>";
    echo "<TD>", $row["flight_id_2"],"</TD>";
    echo "<TD>", $row["res_date"],"</TD>";
    echo "</TR>";
 }

 mysqli_close($con);
 echo "</TABLE>";
 echo "<br> <A HREF='../user.php?user_id=".$user_id."'> 이전으로 </A>";

?>