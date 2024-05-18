<?php
$con = mysqli_connect("localhost", "202101516user", "202101516pw", "flight_reservationdb") or die(mysqli_error($con));

$sql = "SELECT * FROM reservation_info WHERE res_id='" . $_GET['res_id'] . "'";

$user_id = $_GET["user_id"]; // 사용자 아이디를 받아옴

$result = mysqli_query($con, $sql);
if ($result) {
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo $_GET['res_id'] . " 아이디의 예약 정보가 존재하지 않습니다" . "<BR>";
        echo "<BR> <A HREF='reservation_info_main.php'> 예약 정보 테이블로 돌아가기 </A>";
        exit();
    }
} else {
    echo "데이터 검색에 실패했습니다.<br>";
    echo "실패 원인:" . mysqli_error($con);
    echo "<BR> <A HREF='reservation_info_select.php'> 예약 정보 테이블로 돌아가기 </A>";
    exit();
}

$row = mysqli_fetch_array($result);
$res_id = $row["res_id"];
$flight_id_1 = $row["flight_id_1"];
$flight_id_2 = $row["flight_id_2"];
$res_date = $row["res_date"];

?>

<HTML>
<HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8">
</HEAD>

<BODY>
    <H2>[예약 취소]</H2>

    <form method="post" action="reservation_info_delete_result.php">
        <ul>
            <li>예약 번호: <input type="text" name="res_id" value=<?php echo $res_id ?> READONLY></li>
            <li>사용자 아이디: <input type="text" name="user_id" value=<?php echo $user_id ?> READONLY></li>
            <li>가는 편: <input type="text" name="flight_id_1" value=<?php echo $flight_id_1 ?> READONLY></li>
            <li>오는 편: <input type="text" name="flight_id_2" value=<?php echo $flight_id_2 ?> ></li>
            <li>예약일자: <input type="datetime-local" name="res_date" value=<?php echo date('Y-m-d\TH:i', strtotime($res_date)) ?> READONLY></li>
        </ul>
        위 예약을 취소하시겠습니까?
        <input type="submit" value="취소">
    </form>
    <br>
    <a href="reservation_info_main.php?user_id=<?php echo $user_id; ?> ">이전으로</a>
</BODY>

</HTML>