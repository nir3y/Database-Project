<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 $sql="SELECT * FROM reservation_info";

 $result=mysqli_query($con,$sql);

 echo "<h2>[예약 정보(reservation_info) 테이블]</h2>";
 echo "<I>(편도 항공권을 예약한 경우, flight_id_2는 NULL 값을 가짐)</I><BR><BR> ";

 if($result){
    echo mysqli_num_rows($result), "건의 결과가 검색되었습니다. ";
 }
 else{
    echo "실패 원인:".mysqli_error($con);
    exit();
 }

 echo "<A HREF='reservation_info_insert.php'>신규 예약 정보 등록</A>";
 echo "<TABLE BORDER=1>";
 echo "<TR>";
 echo "<TH>res_id</TH> <TH>user_id</TH> <TH>flight_id_1</TH> <TH>flight_id_2</TH> <TH>res_date</TH>";
 echo "<TH>수정</TH> <TH>삭제</TH>";
 echo "</TR>";

 while($row=mysqli_fetch_array($result)){
    echo "<TR>";
    echo "<TD>", $row["res_id"],"</TD>";
    echo "<TD>", $row["user_id"],"</TD>";
    echo "<TD>", $row["flight_id_1"],"</TD>";
    echo "<TD>", $row["flight_id_2"],"</TD>";
    echo "<TD>", $row["res_date"],"</TD>";
    echo "<TD>","<A HREF='reservation_info_update.php?res_id=", $row['res_id'], "'>수정</A></TD>";
    echo "<TD>","<A HREF='reservation_info_delete.php?res_id=", $row['res_id'], "'>삭제</A></TD>";
    echo "</TR>";
 }

 mysqli_close($con);
 echo "</TABLE>";
 echo "<br> <A HREF='../admin.html'> 이전으로 </A>";

?>