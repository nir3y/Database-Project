<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>항공권 조회/예약</title>
</head>
<body>
    <h2>[항공권 조회/예약]</h2>

    <form method="post" id="flight_form">
        출발지
        <select name="dep_airport">
            <option value="" disabled selected>출발지</option> 
            <?php
                $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                $sql = "SELECT DISTINCT airport_id, airport_name, dep_airport, country FROM airport, flight 
                WHERE airport.airport_id=flight.dep_airport";
                $result = mysqli_query($con,$sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['dep_airport']."'>".$row['dep_airport']."(".$row['airport_name'].",".$row['country'].")</option>";
                    }
                }
                mysqli_close($con);
            ?>
        </select>

        도착지
        <select name="arr_airport">
            <option value="" disabled selected>도착지</option> 
            <?php
                $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
                $sql = "SELECT DISTINCT airport_id, airport_name, arr_airport, country FROM airport, flight 
                WHERE airport.airport_id=flight.arr_airport";
                $result = mysqli_query($con,$sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['arr_airport']."'>".$row['arr_airport']."(".$row['airport_name'].",".$row['country'].")</option>";
                    }
                }
                mysqli_close($con);
            ?>
        </select>
        
        가는 편 <input type="date" name="go_date" >
        오는 편 <input type="date" name="back_date" id="back_date">
        <!-- user_id를 숨겨진 필드로 전달 -->
        <input type="hidden" name="user_id" value="<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : ''; ?>"> 
     <input type="submit" value="검색하기">
    </form>
    
    <input type="checkbox" name="one_way" id="checkbox_id" onclick="disableBackDate()"> 편도 항공편
    <br><br>
    <a href="../user.php">이전으로</a>
</body>

<script>
    // 폼의 action 속성 설정
    function setFormAction(){
        let form =document.getElementById("flight_form");
        let checkbox = document.getElementById("checkbox_id");
        if (checkbox.checked) {
            form.action = "search_result.php";
        } else {
            form.action = "search_round_result.php";
        }
    }

     // 체크박스 클릭 시 가는 편 날짜만 선택할 수 있도록
    function disableBackDate() {
        let checkbox = document.getElementById("checkbox_id");
        let backdate = document.getElementById("back_date");
        if (checkbox.checked) {
            backdate.disabled = true;
        } else {
            backdate.disabled = false;
        }
        setFormAction();
    }
    setFormAction();
</script>
</html>