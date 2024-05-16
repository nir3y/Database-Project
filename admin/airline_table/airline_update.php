<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $sql="SELECT * FROM airline WHERE airline_id='".$_GET['airline_id']."'";

 $result=mysqli_query($con,$sql);
 if($result){
    $count=mysqli_num_rows($result);
    if($count==0){
        echo $_GET['airline_id']." 아이디의 항공사가 존재하지 않습니다"."<BR>";
        echo "<BR> <A HREF='airline_select.php'> 항공사 테이블로 돌아가기 </A>";
        exit(); 
    }
 }
 else{
    echo "데이터 검색에 실패했습니다.<br>";
    echo "실패 원인:".mysqli_error($con);
    echo "<BR> <A HREF='airline_select.html'> 항공사 테이블로 돌아가기 </A>";
    exit();
 }

 $row = mysqli_fetch_array($result);
 $airline_id = $row["airline_id"];
 $airline_name = $row["airline_name"];
 $website = $row["website"];

?>

<HTML>
    <HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8"> 
    </HEAD>

<BODY>
    <H2>[항공사 정보 수정]</H2>
    <form method="post" action="airline_update_result.php">
        <ul>
            <li>airline_id: <input type="text" name="airline_id" value=<?php echo $airline_id ?> READONLY></li>
            <li>airline_name: <input type="text" name="airline_name" value=<?php echo $airline_name ?>></li>
            <li>website: <input type="text" name="website" value=<?php echo $website ?>></li>
        </ul>
        위 항공사 정보를 수정하시겠습니까?
        <input type="submit" value="수정">
    </form>
    <a href="airline_select.php">이전으로</a>
</BODY>
</HTML>