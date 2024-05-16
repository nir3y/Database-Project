<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $sql="SELECT * FROM airport WHERE airport_id='".$_GET['airport_id']."'";

 $result=mysqli_query($con,$sql);
 if($result){
    $count=mysqli_num_rows($result);
    if($count==0){
        echo $_GET['airport_id']." 아이디의 공항이 존재하지 않습니다"."<BR>";
        echo "<BR> <A HREF='airport_select.php'> 공항 테이블로 돌아가기 </A>";
        exit(); 
    }
 }
 else{
    echo "데이터 검색에 실패했습니다.<br>";
    echo "실패 원인:".mysqli_error($con);
    echo "<BR> <A HREF='airport_select.php'> 공항 테이블로 돌아가기 </A>";
    exit();
 }

 $row = mysqli_fetch_array($result);
 $airport_id = $row["airport_id"];
 $airport_name = $row["airport_name"];
 $country = $row["country"];

?>

<HTML>
    <HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8"> 
    </HEAD>

<BODY>
    <H2>[공항 정보 수정]</H2>
    <form method="post" action="airport_update_result.php">
        <ul>
            <li>airport_id: <input type="text" name="airport_id" value=<?php echo $airport_id ?> READONLY></li>
            <li>airport_name: <input type="text" name="airport_name" value=<?php echo $airport_name ?>></li>
            <li>country: <input type="text" name="country" value=<?php echo $country ?>></li>
        </ul>
        위 공항 정보를 수정하시겠습니까?
        <input type="submit" value="수정">
    </form>
    <a href="airport_select.php">이전으로</a>
</BODY>
</HTML>