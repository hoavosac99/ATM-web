<?php
    session_start();
    if(empty($_SESSION['user'])){
        header('location: dangnhap.php');
    }
    else {
        $user = $_SESSION['user'];
        include('../connect.php');
        $sql5 = "select * from user where id='$user'";
        $run5 = mysqli_query($conn,$sql5);
        $num5 = mysqli_fetch_array($run5);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy ATM</title>
    <?php require ('../component/headsite.php'); ?>
    <link rel="stylesheet" href="../css/dangnhap.css">
</head>

<body>
    <div class="container">
    <div class="row">
            <div class="col-xl-3">
                <img src="../image/Logo-TPB.png" alt="" class="logo">
                
            </div>
            <div class="col-xl-9">
                <h3>Kính chào quý khách <?php echo $num5['name']?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card icard" style="background-image: url(../image/br.jpg); ">
                    <div class="card-body">
                        <h4 class="card-title">Mời nhập thông tin chuyển khoản</h4>
                        <div class="left" style="padding-left: 22%;">
                            <ul>
                                <li style="font-weight: 900;">Tài khoản nhận</li>
                                <li style="font-weight: 900;">Số tiền chuyển</li>
                            </ul>
                        </div>
                        <form action="" method="post">
                            <input type="text" name="txtnhan"><br>
                            <input type="text" name="txtsotien"><br>
                            <input type="submit" value="Đồng ý" name="ok" class="btn btn-primary">
                        </form>
                            <a name="" id="" class="btn btn-primary" href="atm.php" role="button">Thoát</a>
                    </div>
                        <!--thông báo-->
                        <div class="alert alert-success alert-dismissible" id="alert" style="visibility: hidden;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="noidungtb">Đây là mã của bạn,nhập mã khác</strong> 
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<script>
   function thongbao(n){
       switch (n) {
           case 1:
            document.getElementById("alert").style.visibility = 'visible';
               break;
            case 2:
            document.getElementById("noidungtb").innerHTML = 'Nhập thiếu thông tin,vui lòng nhập lại';
            document.getElementById("alert").style.visibility = 'visible';
               break;
            case 3:
            document.getElementById("noidungtb").innerHTML = 'Số tiền của bạn không đủ để giao dịch';
            document.getElementById("alert").style.visibility = 'visible';
               break;
            case 4:
            document.getElementById("noidungtb").innerHTML = 'Mã số nhận không tồn tại';
            document.getElementById("alert").style.visibility = 'visible';
               break;
             case 5:
            document.getElementById("noidungtb").innerHTML = 'Chuyển tiền thành công';
            document.getElementById("alert").style.visibility = 'visible';
               break;
           default:
               break;
       }
     
    }
</script>
<?php
    include('../connect.php');
    
       
    if(isset($_POST['ok'])){
        $ngnhan = $_POST['txtnhan'];
        $tienchuyen = $_POST['txtsotien'];
       
        $sql1 = "select * from user where id='$ngnhan'";
        $run1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_num_rows($run1);
        //nguoi nhan duoc cong tien
        $num1 =mysqli_fetch_array($run1);
       
        //nguoi gui bi tru tien
        $sql = "select * from user where id='$user'";
        $run = mysqli_query($conn,$sql);
        $num = mysqli_fetch_array($run);
        $sotiencon = $num['sodu'];
      
        if(empty($ngnhan)||empty($tienchuyen)){
            echo "<script> thongbao(2) </script>";
        }else{
            if($row1<1){
                echo "<script> thongbao(4) </script>";
              }elseif( $ngnhan==$num['id']){
                echo "<script> thongbao(1) </script>";
              }
              else{
                  if($sotiencon>$tienchuyen){
                     $tiencong = $tienchuyen +$num1['sodu'];
                     $tientru = $num['sodu'] - $tienchuyen;
                      $sql2 ="UPDATE user SET sodu = '$tiencong' WHERE id ='$ngnhan'";
                      $run2 = mysqli_query($conn,$sql2);
                      $sql3 ="UPDATE user SET sodu = '$tientru' WHERE id ='$user'";
                      $run3 = mysqli_query($conn,$sql3);
                      //them giao dich trong sql
                      $sql4= "insert into chuyenkhoan(id_gui,id_nhan,sotien) values ('$user','$ngnhan','$tienchuyen')";
                      $run4 = mysqli_query($conn,$sql4);
                      if($run2 && $run3){
                         echo "<script> thongbao(5);</script>";
                      }
                 }else{
                    echo "<script> thongbao(3); </script>";
                 }
              }
        }
       
        
      
    }

    
?>