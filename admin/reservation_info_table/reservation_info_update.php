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
    <H2>[예약 정보 수정]</H2>
    <I>(편도 항공권을 예약할 경우, flight_id_2는 NULL 값을 가짐)</I><BR>
    <form method="post" action="reservation_info_update_result.php">
        <ul>
            <li>res_id: <input type="text" name="res_id" value=<?php echo $res_id ?> READONLY></li>
            <li>
                user_id: 
                <select name="user_id" value=<?php echo $user_id ?>> <!--등록된 user_id만 combobox에서 선택해서 사용할 수 있도록-->
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT user_id, user_name FROM users";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $selected = ($row['user_id'] == $user_id) ? "selected" : ""; // 선택된 값인지 확인
                                echo "<option value='".$row['user_id']."' ".$selected.">".$row['user_id']."(".$row['user_name'].")</option>";     
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>
                flight_id_1: 
                <select name="flight_id_1" value=<?php echo $flight_id_1 ?>> <!--등록된 flight_id_1만 combobox에서 선택해서 사용할 수 있도록-->
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT flight_id,dep_airport,arr_airport FROM flight";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $selected = ($row['flight_id'] == $flight_id_1) ? "selected" : ""; // 선택된 값인지 확인
                                echo "<option value='".$row['flight_id']."' ".$selected.">".$row['flight_id']."(".$row['dep_airport'].">".$row['arr_airport'].")</option>";
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>
                flight_id_2: 
                <select name="flight_id_2" value=<?php echo $flight_id_2 ?>> <!--등록된 flight_id_2만 combobox에서 선택해서 사용할 수 있도록-->
                    <option value="NULL">NULL</option>
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT flight_id,dep_airport,arr_airport FROM flight";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $selected = ($row['flight_id'] == $flight_id_2) ? "selected" : ""; // 선택된 값인지 확인
                                echo "<option value='".$row['flight_id']."' ".$selected.">".$row['flight_id']."(".$row['dep_airport']." > ".$row['arr_airport'].")</option>";                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>res_date: <input type="datetime-local" name="res_date" value=<?php echo date('Y-m-d\TH:i', strtotime($res_date)) ?>></li>
        </ul>
        위 예약 정보를 수정하시겠습니까?
        <input type="submit" value="수정">
    </form>
    <br>
    <a href="reservation_info_select.php">이전으로</a>

</BODY>
</HTML>