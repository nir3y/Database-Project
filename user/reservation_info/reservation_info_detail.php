<?php
$con = mysqli_connect("localhost", "202101516user", "202101516pw", "flight_reservationdb") or die(mysqli_error($con));
$flight_id_2 = $_GET["flight_id_2"];
$res_id = $_GET["res_id"];
$user_id = $_GET["user_id"]; // 로그인 된 사용자 아이디 받아오기

// 가는 편 항공권 정보 
$sql_go = "SELECT reservation_info.*, users.user_name, airline.airline_name, flight.*, dep_airport.airport_name AS dep_name , arr_airport.airport_name AS arr_name
FROM reservation_info
INNER JOIN users ON reservation_info.user_id = users.user_id
LEFT JOIN flight ON reservation_info.flight_id_1 = flight.flight_id
INNER JOIN airport AS dep_airport ON flight.dep_airport = dep_airport.airport_id
INNER JOIN airport AS arr_airport ON flight.arr_airport = arr_airport.airport_id
INNER JOIN airline ON flight.airline_id = airline.airline_id
WHERE reservation_info.res_id = '$res_id'
";
$result_go = mysqli_query($con, $sql_go);
$row_go = mysqli_fetch_assoc($result_go);

// 오는 편 항공권 정보 - flight_id_1을 flight_id_2로 변경한 것
// 오는 편(flight_id_2)가 있을 때만 검색하도록
if ($flight_id_2 !== null) {
    $sql_return = "SELECT reservation_info.*, users.user_name, airline.airline_name, flight.*, dep_airport.airport_name AS dep_name , arr_airport.airport_name AS arr_name
    FROM reservation_info
    INNER JOIN users ON reservation_info.user_id = users.user_id
    LEFT JOIN flight ON reservation_info.flight_id_2 = flight.flight_id
    INNER JOIN airport AS dep_airport ON flight.dep_airport = dep_airport.airport_id
    INNER JOIN airport AS arr_airport ON flight.arr_airport = arr_airport.airport_id
    INNER JOIN airline ON flight.airline_id = airline.airline_id
    WHERE reservation_info.res_id = '$res_id'
    ";
    $result_return = mysqli_query($con, $sql_return);
    $row_return = mysqli_fetch_assoc($result_return);
} else {
    $row_return = null;
}

echo "<h3>[예약 상세정보]</h3>";
echo "<ul>";
echo "<li><strong>승객 성명:</strong> " . $row_go["user_name"] . "</li>";
echo "<li><strong>승객 아이디:</strong> " . $row_go["user_id"] . "</li>";
echo "<li><strong>예약 번호: " . $res_id . "</strong></li>";
echo "<li><strong>예약 일시:</strong> " . $row_go["res_date"] . "</li>";
echo "</ul>";

echo "<h3>[여정]</h3>";
echo "<table border='1'>";
echo "<tr><th>항공사</th><th>출발</th><th>도착</th><th>편명</th><th>출발 일시</th><th>도착 일시</th><th>운임</th></tr>";

echo "<p><strong>가는 편</strong></p>";
echo "<tr>";
echo "<td>" . $row_go['airline_name'] . "</td>";
echo "<td>" . $row_go['dep_name'] . "(" . $row_go['dep_airport'] . ")</td>";
echo "<td>" . $row_go['arr_name'] . "(" . $row_go['arr_airport'] . ")</td>";
echo "<td>" . $row_go['airline_id'] . $row_go['flight_id'] . "</td>";
echo "<td>" . $row_go['dep_date'] . "</td>";
echo "<td>" . $row_go['arr_date'] . "</td>";
echo "<td>KRW " . $row_go['price'] . "</td>";
echo "</tr>";
echo "</table>";

if ($row_return !== null && $row_return["flight_id_2"] !== null) {
    echo "<p><strong>오는 편</strong></p>";
    echo "<table border='1'>";
    echo "<tr><th>항공사</th><th>출발</th><th>도착</th><th>편명</th><th>출발 일시</th><th>도착 일시</th><th>운임</th></tr>";
    echo "<tr>";
    echo "<td>" . $row_return['airline_name'] . "</td>";
    echo "<td>" . $row_return['dep_name'] . "(" . $row_return['dep_airport'] . ")</td>";
    echo "<td>" . $row_return['arr_name'] . "(" . $row_return['arr_airport'] . ")</td>";
    echo "<td>" . $row_return['airline_id'] . $row_return['flight_id'] . "</td>";
    echo "<td>" . $row_return['dep_date'] . "</td>";
    echo "<td>" . $row_return['arr_date'] . "</td>";
    echo "<td>KRW " . $row_return['price'] . "</td>";
    echo "</tr>";
    echo "</table>";
}
mysqli_close($con);

echo "<br> <A HREF='reservation_info_main.php?user_id=" . $user_id . "'> 이전으로 </A>";
?>