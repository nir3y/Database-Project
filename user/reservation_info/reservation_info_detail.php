<?php
$con = mysqli_connect("localhost", "202101516user", "202101516pw", "flight_reservationdb") or die(mysqli_error($con));

$user_id = $_GET["user_id"]; // 로그인 된 사용자 아이디 받아오기

// 이거 어떻게 할 지 결정해야함. 상세 정보 조회해야함.
$sql = "SELECT reservation_info.*, users.user_name,
 flight1.airline_id, flight1.dep_airport, flight1.arr_airport,
 flight2.airline_id AS airline_id2, flight2.dep_airport AS dep_airport2, flight2.arr_airport AS arr_airport2
 FROM reservation_info
 INNER JOIN users ON reservation_info.user_id = users.user_id
 LEFT JOIN flight AS flight1 ON reservation_info.flight_id_1 = flight1.flight_id 
 LEFT JOIN flight AS flight2 ON reservation_info.flight_id_2 = flight2.flight_id
 WHERE reservation_info.user_id = '$user_id'
 ";


// 가는 편 항공편 정보 가져오기
$sql_go = "
    SELECT flight.*, airline.airline_name, airline.airline_id
    FROM flight
    JOIN airline ON flight.airline_id = airline.airline_id
    WHERE flight.flight_id = '$flight_id_1'
";
$result_go = mysqli_query($con, $sql_go);
$row_go = mysqli_fetch_assoc($result_go);



if ($flight_id_2 !== null) {
   // 오는 편 항공편 정보 가져오기
   $sql_return = "
        SELECT flight.*, airline.airline_name, airline.airline_id
        FROM flight
        JOIN airline ON flight.airline_id = airline.airline_id
        WHERE flight.flight_id = '$flight_id_2'
    ";
   $result_return = mysqli_query($con, $sql_return);
   $row_return = mysqli_fetch_assoc($result_return);
} else {
   $row_return = null;
}

$res_id = mt_rand(100000, 999999); // 6자리 랜덤 숫자 생성 -> 예약 아이디


$sql = "INSERT INTO reservation_info (res_id, user_id, flight_id_1, flight_id_2, res_date) 
        VALUES ('$res_id', '$user_id', '$flight_id_1', " . ($flight_id_2 ? "'$flight_id_2'" : "NULL") . ",NOW())";
$result = mysqli_query($con, $sql);

echo "<h3>[예약 결과]</h3>";
if ($result) {
   echo "사용자 아이디 ".$user_id;
   echo "님의 예약이 완료되었습니다.<br>";
} else {
   echo "데이터 입력에 실패하였습니다.";
   echo "실패 원인: " . mysqli_error($con);
}

echo "<h3>[예약 정보]</h3>";
echo "<strong>예약번호: " . $res_id . "</strong>";

echo "<p><strong>가는 편:</strong></p>";
echo "<p>항공사: " . $row_go['airline_name'] . " </p>";
echo "<p>편명: " . $row_go['airline_id'] . $row_go['flight_id'] . "</p>";
echo "<p>출발: " . $row_go['dep_airport'] . " (" . $row_go['dep_date'] . ")</p>";
echo "<p>도착: " . $row_go['arr_airport'] . " (" . $row_go['arr_date'] . ")</p>";

if ($row_return) {
   echo "<p><strong>오는 편:</strong></p>";
   echo "<p>항공사: " . $row_return['airline_name'] . " </p>";
   echo "<p>편명: " . $row_return['airline_id'] . $row_return['flight_id'] . "</p>";
   echo "<p>출발: " . $row_return['dep_airport'] . " (" . $row_return['dep_date'] . ")</p>";
   echo "<p>도착: " . $row_return['arr_airport'] . " (" . $row_return['arr_date'] . ")</p>";
}

mysqli_close($con);

echo "<br> <a href='reservation_info_main.php?user_id=".$user_id."'> 나의 예약 조회 </a>";
echo "<br> <a href='../user.php?user_id=".$user_id."'> 메인화면으로 </a>";
?>