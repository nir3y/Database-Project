<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservation_info_insert</title>
</head>
<body>
    <h2>[신규 예약 정보 등록]</h2>
    <I>(편도 항공권을 예약할 경우, flight_id_2는 NULL 값을 가짐)</I><BR>
    <form method="post" action="reservation_info_insert_result.php">
        <ul>
            <li>res_id: <input type="text" name="res_id"></li>
            <li>
                user_id: 
                <select name="user_id"> <!--등록된 user_id만 combobox에서 선택해서 사용할 수 있도록-->
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT user_id, user_name FROM users";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['user_id']."'>".$row['user_id']."(".$row['user_name'].")</option>";
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>
                flight_id_1: 
                <select name="flight_id_1"> <!--등록된 flight_id_1만 combobox에서 선택해서 사용할 수 있도록-->
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT flight_id,dep_airport,arr_airport FROM flight";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['flight_id']."'>".$row['flight_id']."(".$row['dep_airport'].">".$row['arr_airport'].")</option>";
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>
                flight_id_2: 
                <select name="flight_id_2"> <!--등록된 flight_id_2만 combobox에서 선택해서 사용할 수 있도록-->
                    <option value="NULL">NULL</option>
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT flight_id,dep_airport,arr_airport FROM flight";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['flight_id']."'>".$row['flight_id']."(".$row['dep_airport'].">".$row['arr_airport'].")</option>";
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>res_date: <input type="datetime-local" name="res_date"></li>
        </ul>
        <input type="submit" value="등록">
    </form>
    <br>
    <a href="reservation_info_select.php">이전으로</a>
</body>
</html>