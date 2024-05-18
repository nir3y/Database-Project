<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 $sql="SELECT * FROM flight";

 $result=mysqli_query($con,$sql);

 echo "<h2>[항공편(flight) 테이블]</h2>";

 if($result){
    echo mysqli_num_rows($result), "건의 결과가 검색되었습니다. ";
 }
 else{
    echo "실패 원인:".mysqli_error($con);
    exit();
 }

 echo "<A HREF='flight_insert.php'>신규 항공편 등록</A>";
 echo "<TABLE BORDER=1>";
 echo "<TR>";
 echo "<TH>flight_id</TH> <TH>airline_id</TH> <TH>dep_airport</TH> <TH>arr_airport</TH> <TH>dep_date</TH> <TH>arr_date</TH> <TH>price</TH>";
 echo "<TH>수정</TH> <TH>삭제</TH>";
 echo "</TR>";

 while($row=mysqli_fetch_array($result)){
    echo "<TR>";
    echo "<TD>", $row["flight_id"],"</TD>";
    echo "<TD>", $row["airline_id"],"</TD>";
    echo "<TD>", $row["dep_airport"],"</TD>";
    echo "<TD>", $row["arr_airport"],"</TD>";
    echo "<TD>", $row["dep_date"],"</TD>";
    echo "<TD>", $row["arr_date"],"</TD>";
    echo "<TD>", $row["price"],"</TD>";
    echo "<TD>","<A HREF='flight_update.php?flight_id=", $row['flight_id'], "'>수정</A></TD>";
    echo "<TD>","<A HREF='flight_delete.php?flight_id=", $row['flight_id'], "'>삭제</A></TD>";
    echo "</TR>";
 }

 mysqli_close($con);
 echo "</TABLE>";
 echo "<br> <A HREF='../admin.html'> 이전으로 </A>";

?>