<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 $sql="SELECT * FROM airport";

 $result=mysqli_query($con,$sql);

 echo "<h2>[공항(airport) 테이블]</h2>";

 if($result){
    echo mysqli_num_rows($result), "건의 결과가 검색되었습니다. ";
 }
 else{
    echo "실패 원인:".mysqli_error($con);
    exit();
 }

 echo "<A HREF='airport_insert.php'>신규 공항 등록</A>";
 echo "<TABLE BORDER=1>";
 echo "<TR>";
 echo "<TH>airport_id</TH> <TH>airport_name</TH> <TH>country</TH>";
 echo "<TH>수정</TH> <TH>삭제</TH>";
 echo "</TR>";

 while($row=mysqli_fetch_array($result)){
    echo "<TR>";
    echo "<TD>", $row["airport_id"],"</TD>";
    echo "<TD>", $row["airport_name"],"</TD>";
    echo "<TD>", $row["country"],"</TD>";
    echo "<TD>","<A HREF='airport_update.php?airport_id=", $row['airport_id'], "'>수정</A></TD>";
    echo "<TD>","<A HREF='airport_delete.php?airport_id=", $row['airport_id'], "'>삭제</A></TD>";
    echo "</TR>";
 }

 mysqli_close($con);
 echo "</TABLE>";
 echo "<br> <A HREF='../admin.html'> 이전으로 </A>";

?>