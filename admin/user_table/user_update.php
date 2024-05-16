<?php
 $con=mysqli_connect("localhost","202101516user","202101516pw","flight_reservationdb") or die(mysqli_error($con));
 
 $sql="SELECT * FROM users WHERE user_id='".$_GET['user_id']."'";

 $result=mysqli_query($con,$sql);
 if($result){
    $count=mysqli_num_rows($result);
    if($count==0){
        echo $_GET['user_id']." 아이디의 사용자가 존재하지 않습니다"."<BR>";
        echo "<BR> <A HREF='user_select.html'> 사용자 테이블로 돌아가기 </A>";
        exit(); 
    }
 }
 else{
    echo "데이터 검색에 실패했습니다.<br>";
    echo "실패 원인:".mysqli_error($con);
    echo "<BR> <A HREF='user_select.html'> 사용자 테이블로 돌아가기 </A>";
    exit();
 }

 $row = mysqli_fetch_array($result);
 $user_id = $row["user_id"];
 $user_name = $row["user_name"];
 $email = $row["email"];

?>

<HTML>
    <HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8"> 
    </HEAD>

<BODY>
    <H2>[사용자 정보 수정]</H2>
    <form method="post" action="user_update_result.php">
        <ul>
            <li>user_id: <input type="number" name="user_id" value=<?php echo $user_id ?> READONLY></li>
            <li>user_name: <input type="text" name="user_name" value=<?php echo $user_name ?>></li>
            <li>email: <input type="text" name="email" value=<?php echo $email ?>></li>
        </ul>
        위 사용자 정보를 수정하시겠습니까?
        <input type="submit" value="수정">
    </form>
    <a href="user_select.php">이전으로</a>
</BODY>
</HTML>