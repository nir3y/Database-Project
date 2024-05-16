<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flight_insert</title>
</head>
<body>
    <h2>[신규 항공편 등록]</h2>
    <form method="post" action="flight_insert_result.php">
        <ul>
            <li>flight_id: <input type="number" name="flight_id"></li>
            <li>
                airline_id: 
                <select name="airline_id"> <!--등록된 airline_id만 combobox에서 선택해서 사용할 수 있도록-->
                    <?php
                        $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                        $sql = "SELECT airline_id, airline_name FROM airline";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['airline_id']."'>".$row['airline_name']."(".$row['airline_id'].")</option>";
                            }
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </li>
            <li>dep_airport: <input type="text" name="dep_airport"></li>
            <li>arr_airport: <input type="text" name="arr_airport"></li>
            <li>dep_date: <input type="datetime-local" name="dep_date"></li>
            <li>arr_date: <input type="datetime-local" name="arr_date"></li>
            <li>price: <input type="number" name="price"></li>
            <li>avail_seat: <input type="number" name="avail_seat"></li>
        </ul>
        <input type="submit" value="등록">
    </form>
    <br>
    <a href="flight_select.php">이전으로</a>
</body>
</html>