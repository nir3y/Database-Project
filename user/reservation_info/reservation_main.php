<?php
$con = mysqli_connect("localhost", "202101516user", "202101516pw", "flight_reservationdb") or die(mysqli_error($con));

$flight_id_1 = $_GET["flight_id_1"] ;
$flight_id_2 = isset($_GET["flight_id_2"]) ? $_GET["flight_id_2"] : null;

// 가는 편 항공편 정보 가져오기
$sql_go = "SELECT * FROM flight WHERE flight_id = '$flight_id_1'";
$result_go = mysqli_query($con, $sql_go);
$row_go = mysqli_fetch_assoc($result_go);



if ($flight_id_2 !== null) {
    // 오는 편 항공편 정보 가져오기
    $sql_return = "SELECT * FROM flight WHERE flight_id = '$flight_id_2'";
    $result_return = mysqli_query($con, $sql_return);
    $row_return = mysqli_fetch_assoc($result_return);
} else {
    $row_return = null;
}

$res_id = mt_rand(100000, 999999); // 6자리 랜덤 숫자 생성 -> 예약 아이디
$user_id = 5;
$res_date = date('Y-m-d H:i:s');

$sql = "INSERT INTO reservation_info (res_id, user_id, flight_id_1, flight_id_2, res_date) 
        VALUES ('$res_id', '$user_id', '$flight_id_1', " . ($flight_id_2 ? "'$flight_id_2'" : "NULL") . ", '$res_date')";
$result = mysqli_query($con, $sql);

echo "<h3>[예약 결과]</h3>";
if ($result) {
    echo "예약이 완료되었습니다.<br>";
} else {
    echo "데이터 입력에 실패하였습니다.";
    echo "실패 원인: " . mysqli_error($con);
}

echo "<h3>[예약 정보]</h3>";
echo "<strong>예약번호: " . $res_id . "</strong>";
echo "<p><strong>가는 편 항공편:</strong></p>";
echo "<p>출발: " . $row_go['dep_airport'] . " (" . $row_go['dep_date'] . ")</p>";
echo "<p>도착: " . $row_go['arr_airport'] . " (" . $row_go['arr_date'] . ")</p>";

if ($row_return) {
    echo "<p><strong>오는 편 항공편:</strong></p>";
    echo "<p>출발: " . $row_return['dep_airport'] . " (" . $row_return['dep_date'] . ")</p>";
    echo "<p>도착: " . $row_return['arr_airport'] . " (" . $row_return['arr_date'] . ")</p>";
}

mysqli_close($con);

echo "<br> <a href='../../main.html'> 예약화면으로 </a>";
?>
