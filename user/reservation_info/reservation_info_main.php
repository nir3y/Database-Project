<?php
$con = mysqli_connect("localhost", "202101516user", "202101516pw", "flight_reservationdb") or die(mysqli_error($con));

$user_id = $_GET["user_id"]; 

//flight1은 가는 편, flight2는 오는 편
$sql = "SELECT reservation_info.*, users.user_name,
 flight1.airline_id, flight1.dep_airport, flight1.arr_airport,
 flight2.airline_id AS airline_id2, flight2.dep_airport AS dep_airport2, flight2.arr_airport AS arr_airport2
 FROM reservation_info
 INNER JOIN users ON reservation_info.user_id = users.user_id
 LEFT JOIN flight AS flight1 ON reservation_info.flight_id_1 = flight1.flight_id 
 LEFT JOIN flight AS flight2 ON reservation_info.flight_id_2 = flight2.flight_id
 WHERE reservation_info.user_id = '$user_id'
 ";

$result = mysqli_query($con, $sql);

echo "<h2>[나의 예약 정보]</h2>";
echo "<strong>사용자 아이디 " . $user_id."님의 예약 정보 입니다.</strong>";

if (mysqli_num_rows($result) == 0) {
   echo "<br><br>예약 기록이 없습니다.<br>";
} else {
   echo "<I><br><br>(편도 항공권을 예약한 경우, 오는 편은 NULL 값을 가짐)</I><BR><BR> ";
   echo mysqli_num_rows($result), "건의 결과가 검색되었습니다. ";
   echo "<TABLE BORDER=1>";
   echo "<TR>";
   echo "<TH>예약 번호</TH> <TH>사용자</TH> <TH>가는 편</TH> <TH>오는 편</TH> <TH>예약일자</TH> <TH>상세정보</TH>  <TH>예약취소</TH>";
   echo "</TR>";

   while ($row = mysqli_fetch_array($result)) {
      echo "<TR>";
      echo "<TD>".$row["res_id"]."</TD>";
      echo "<TD>", $row["user_id"]."(".$row["user_name"].")". "</TD>";
      echo "<TD>".$row["airline_id"]. $row["flight_id_1"]."(".$row["dep_airport"].">".$row["arr_airport"].")"."</TD>";
      if(!empty($row["flight_id_2"])){ 
         echo "<TD>".$row["airline_id2"]. $row["flight_id_2"]."(".$row["dep_airport2"].">".$row["arr_airport2"].")"."</TD>";
      }else{
         echo"<TD></TD>";
      }
      echo "<TD>", $row["res_date"], "</TD>";
      echo "<TD>", "<A HREF='reservation_info_detail.php?user_id=" . $user_id . "&res_id=" . $row['res_id'] . "'>보기</A></TD>";
      echo "<TD>", "<A HREF='reservation_info_delete.php?user_id=" . $user_id . "&res_id=" . $row['res_id'] . "'>취소</A></TD>";
      echo "</TR>";
   }

}

mysqli_close($con);
echo "</TABLE>";
echo "<br> <A HREF='../user.php?user_id=" . $user_id . "'> 이전으로 </A>";

?>