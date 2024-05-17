<?php
$con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));

$flight_id = $_GET["flight_id"];
$dep_airport = $_GET["dep_airport"];
$arr_airport = $_GET["arr_airport"];
$go_date = $_GET["go_date"];
$back_date = $_GET["back_date"];

// 가는 편 항공편 정보 가져오기
$sql_go = "SELECT dep_airport, arr_airport, dep_date, arr_date FROM flight WHERE flight_id = '$flight_id'";
$result_go = mysqli_query($con, $sql_go);
$row_go = mysqli_fetch_assoc($result_go);

echo "<h3>[전체 항공권 조회 결과 - 왕복]</h3>";
echo "<h4>오는 편 항공권을 선택해주세요 </h4>";

$sql = "SELECT airline.airline_name, flight.flight_id, flight.dep_date, flight.arr_date, flight.dep_airport, flight.arr_airport, flight.price 
            FROM flight 
            JOIN airline ON flight.airline_id = airline.airline_id
            WHERE dep_airport = '$arr_airport' 
            AND arr_airport = '$dep_airport' 
            AND DATE(dep_date) = DATE('$back_date')";

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
        echo "<td><a href='../reservation_info/reservation_main.php?flight_id_1=".$flight_id."&flight_id_2=".$row['flight_id']."'>예약</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "조회된 항공편이 없습니다.";
}

mysqli_close($con);
?>
