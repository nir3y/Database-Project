<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 $sql="SELECT * FROM users";

 $result=mysqli_query($con,$sql);

 echo "<h2>[사용자(users) 테이블]</h2>";

 if($result){
    echo mysqli_num_rows($result), "건의 결과가 검색되었습니다.&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
 }
 else{
    echo "실패 원인:".mysqli_error($con);
    exit();
 }

 echo "<A HREF='user_insert.html'>신규 사용자 등록</A>";
 echo "<TABLE BORDER=1>";
 echo "<TR>";
 echo "<TH>user_id</TH> <TH>user_name</TH> <TH>email</TH>";
 echo "<TH>수정</TH> <TH>삭제</TH>";
 echo "</TR>";

 while($row=mysqli_fetch_array($result)){
    echo "<TR>";
    echo "<TD>", $row["user_id"],"</TD>";
    echo "<TD>", $row["user_name"],"</TD>";
    echo "<TD>", $row["email"],"</TD>";
    echo "<TD>","<A HREF='user_update.php?user_id=", $row['user_id'], "'>수정</A></TD>";
    echo "<TD>","<A HREF='user_delete.php?user_id=", $row['user_id'], "'>삭제</A></TD>";
    echo "</TR>";
 }

 mysqli_close($con);
 echo "</TABLE>";
 echo "<br> <A HREF='../admin.html'> 이전으로 </A>";

?>