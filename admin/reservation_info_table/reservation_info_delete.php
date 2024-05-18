<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $sql="SELECT * FROM reservation_info WHERE res_id='".$_GET['res_id']."'";

 $result=mysqli_query($con,$sql);
 if($result){
    $count=mysqli_num_rows($result);
    if($count==0){
        echo $_GET['res_id']." 아이디의 예약 정보가 존재하지 않습니다"."<BR>";
        echo "<BR> <A HREF='reservation_info_select.php'> 예약 정보 테이블로 돌아가기 </A>";
        exit(); 
    }
 }
 else{
    echo "데이터 검색에 실패했습니다.<br>";
    echo "실패 원인:".mysqli_error($con);
    echo "<BR> <A HREF='reservation_info_select.php'> 예약 정보 테이블로 돌아가기 </A>";
    exit();
 }

 $row = mysqli_fetch_array($result);
 $res_id = $row["res_id"];
 $user_id = $row["user_id"];
 $flight_id_1 = $row["flight_id_1"];
 $flight_id_2 = $row["flight_id_2"];
 $res_date = $row["res_date"];
 

?>

<HTML>
    <HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8"> 
    </HEAD>

<BODY>
    <H2>[예약 정보 삭제]</H2>
    <form method="post" action="reservation_info_delete_result.php">
        <ul>
            <li>res_id: <input type="text" name="res_id" value=<?php echo $res_id ?> READONLY></li>
            <li>user_id: <input type="text" name="user_id" value=<?php echo $user_id ?> READONLY></li>
            <li>flight_id_1: <input type="text" name="flight_id_1" value=<?php echo $flight_id_1 ?> READONLY></li>
            <li>flight_id_2: <input type="text" name="flight_id_2" value=<?php echo $flight_id_2 ?> ></li>
            <li>res_date: <input type="datetime-local" name="res_date" value=<?php echo date('Y-m-d\TH:i', strtotime($res_date)) ?> READONLY></li>
        </ul>
        위 예약 정보를 삭제하시겠습니까?
        <input type="submit" value="삭제">
    </form>
    <br>
    <a href="reservation_info_select.php">이전으로</a>
</BODY>
</HTML>