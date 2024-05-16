<?php
$con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));

$dep_airport = $_POST["dep_airport"];
$arr_airport = $_POST["arr_airport"];
$go_date = $_POST["go_date"];
$back_date = isset($_POST["back_date"]) ? $_POST["back_date"] : null; 

echo "<h3>[항공권 조회 결과]</h3>";
echo "<p>선택 정보: " . $dep_airport . " - " . $arr_airport . " (" . $go_date . " ".$back_date.")</p>";


if(isset($_POST['one_way'])) {
    // 편도 항공편만 조회할 경우
    $sql = "SELECT airline.airline_name,flight.flight_id, flight.dep_date, flight.arr_date, flight.dep_airport, flight.arr_airport, flight.price 
            FROM flight 
            JOIN airline ON flight.airline_id = airline.airline_id
            WHERE dep_airport = '$dep_airport' 
                AND arr_airport = '$arr_airport' 
                AND DATE(dep_date) = DATE('$go_date')";
} else {
    // 왕복 항공편 모두 조회할 경우
    $sql = "SELECT airline.airline_name, flight.flight_id,flight.dep_date, flight.arr_date, flight.dep_airport, flight.arr_airport, flight.price 
            FROM flight 
            JOIN airline ON flight.airline_id = airline.airline_id
            WHERE (dep_airport = '$dep_airport' AND arr_airport = '$arr_airport' AND DATE(dep_date) = DATE('$go_date'))
                OR (dep_airport = '$arr_airport' AND arr_airport = '$dep_airport' AND DATE(dep_date) = DATE('$back_date'))";
}

$result = mysqli_query($con,$sql);
echo mysqli_num_rows($result), "건의 항공편이 검색되었습니다. ";

if(mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
            <tr>
                <th>항공사</th>
                <th>출발공항</th>
                <th>출발시간</th>
                <th>도착공항</th>
                <th>도착시간</th>
                <th>비행시간</th>
                <th>가격</th>
                <th>예약</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)) {
        // 비행시간 계산
        $dep_time = strtotime($row['dep_date']);
        $arr_time = strtotime($row['arr_date']);
        $flight_hours = floor(abs($arr_time - $dep_time) / 3600); // 비행시간(시간 단위)
        $flight_minutes = floor((abs($arr_time - $dep_time) % 3600) / 60); // 비행시간(분 단위)
        
        // 시간만 표시 (날짜는 제외)
        $dep_time_display = date("H:i", $dep_time);
        $arr_time_display = date("H:i", $arr_time);
        
        echo "<tr>";
        echo "<td>" . $row['airline_name'] . "</td>";
        echo "<td>" . $row['dep_airport'] . "</td>";
        echo "<td>" . $dep_time_display . "</td>";
        echo "<td>" . $row['arr_airport'] . "</td>";
        echo "<td>" . $arr_time_display . "</td>";
        echo "<td>" . $flight_hours . "시간 " . $flight_minutes . "분</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>"."<a href='reservation_main.php?flight_id=".$row['flight_id']."'>예약</a></td>";        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "조회된 항공편이 없습니다.";
}

mysqli_close($con);
?>
