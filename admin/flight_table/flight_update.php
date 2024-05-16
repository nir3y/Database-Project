<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $sql="SELECT * FROM flight WHERE flight_id='".$_GET['flight_id']."'";

 $result=mysqli_query($con,$sql);
 if($result){
    $count=mysqli_num_rows($result);
    if($count==0){
        echo $_GET['flight_id']." 아이디의 항공편이 존재하지 않습니다"."<BR>";
        echo "<BR> <A HREF='flight_select.php'> 항공편 테이블로 돌아가기 </A>";
        exit(); 
    }
 }
 else{
    echo "데이터 검색에 실패했습니다.<br>";
    echo "실패 원인:".mysqli_error($con);
    echo "<BR> <A HREF='flight_select.php'> 항공편 테이블로 돌아가기 </A>";
    exit();
 }

 $row = mysqli_fetch_array($result);

 $flight_id = $row["flight_id"];
 $airline_id = $row["airline_id"];
 $dep_airport = $row["dep_airport"];
 $arr_airport = $row["arr_airport"];
 $dep_date = $row["dep_date"];
 $arr_date = $row["arr_date"];
 $price = $row["price"];
 $avail_seat = $row["avail_seat"];

?>

<HTML>
    <HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8"> 
    </HEAD>

<BODY>
    <H2>[항공편 정보 수정]</H2>

    <form method="post" action="flight_update_result.php">
        <ul>
            <li>flight_id: <input type="number" name="flight_id" value=<?php echo $flight_id ?> READONLY></li>
            <li>
                airline_id: 
                <select name="airline_id" value=<?php echo $airline_id ?> READONLY> <!--등록된 airline_id만 combobox에서 선택해서 사용할 수 있도록-->
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT airline_id, airline_name FROM airline";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $selected = ($row['airline_id'] == $airline_id) ? "selected" : ""; // 선택된 값인지 확인
            echo "<option value='".$row['airline_id']."' ".$selected.">".$row['airline_name']."(".$row['airline_id'].")</option>";
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>dep_airport: <input type="text" name="dep_airport" value=<?php echo $dep_airport ?> ></li>
            <li>arr_airport: <input type="text" name="arr_airport" value=<?php echo $arr_airport ?> ></li>
            <li>dep_date: <input type="datetime-local" name="dep_date" value=<?php echo date('Y-m-d\TH:i', strtotime($dep_date)) ?> ></li>
            <li>arr_date: <input type="datetime-local" name="arr_date" value=<?php echo date('Y-m-d\TH:i', strtotime($arr_date)) ?> ></li>
            <li>price: <input type="number" name="price" value=<?php echo $price ?> ></li>
            <li>avail_seat: <input type="number" name="avail_seat" value=<?php echo $avail_seat ?> ></li>
        </ul>
        위 항공편 정보를 수정하시겠습니까?
        <input type="submit" value="수정">
    </form>
    <a href="flight_select.php">이전으로</a>
</BODY>
</HTML>