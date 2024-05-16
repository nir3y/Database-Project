<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 $sql="SELECT * FROM airline";

 $result=mysqli_query($con,$sql);

 echo "<h2>[항공사(airline) 테이블]</h2>";

 if($result){
    echo mysqli_num_rows($result), "건의 결과가 검색되었습니다. ";
 }
 else{
    echo "실패 원인:".mysqli_error($con);
    exit();
 }

 echo "<A HREF='airline_insert.php'>신규 항공사 등록</A>";
 echo "<TABLE BORDER=1>";
 echo "<TR>";
 echo "<TH>airline_id</TH> <TH>airline_name</TH> <TH>website</TH>";
 echo "<TH>수정</TH> <TH>삭제</TH>";
 echo "</TR>";

 while($row=mysqli_fetch_array($result)){
    echo "<TR>";
    echo "<TD>", $row["airline_id"],"</TD>";
    echo "<TD>", $row["airline_name"],"</TD>";
    echo "<TD>", $row["website"],"</TD>";
    echo "<TD>","<A HREF='airline_update.php?airline_id=", $row['airline_id'], "'>수정</A></TD>";
    echo "<TD>","<A HREF='airline_delete.php?airline_id=", $row['airline_id'], "'>삭제</A></TD>";
    echo "</TR>";
 }

 mysqli_close($con);
 echo "</TABLE>";
 echo "<br> <A HREF='../admin.html'> 이전으로 </A>";

?>