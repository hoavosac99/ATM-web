<?php
    session_start();
    if(empty($_SESSION['user'])){
        header('location: dangnhap.php');
    } else{
        $user = $_SESSION['user'];
        include('../connect.php');
        $sql = "select * from user where id='$user'";
        $run = mysqli_query($conn,$sql);
        $num = mysqli_fetch_array($run);
        $sodu = $num['sodu'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy ATM</title>
    <?php require ('../component/headsite.php'); ?>
    <link rel="stylesheet" href="../css/atm.css">
    <script>
        function xemsodu(){
                document.getElementById('tb').style.visibility="visible";
                document.getElementById('hienthi').style.opacity="0";
              
        }
        function dong(){
            document.getElementById('tb').style.visibility="hidden";
            document.getElementById('hienthi').style.opacity="1";
              
        }
        
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <img src="../image/Logo-TPB.png" alt="" class="logo">

            </div>
            <div class="col-xl-9">
                <h3>Kính chào quý khách <?php echo $num['name']?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Mời bạn chọn hình thức giao dịch</h4>
                        <img src="../image/br1.jpg" alt="" class="ibr" name="myimage" id="hienthi"><!--đóng background-->
                        <div class="left">
                            <ul>
                                <li> <a href="ruttien.php" class="btn btn-primary">Rút tiền</a></li>
                                <li> <a href="chuyenkhoan.php"  class="btn btn-primary">Chuyển khoản</a></li>
                                <li> <a href="doipin.php"  class="btn btn-primary">Đổi mã PIN</a></li>
                                <li> <a href="#" onclick="xemsodu();" class="btn btn-primary">Xem số dư tài khoản</a></li>
                            </ul>
                        </div>
                        <div class="right">
                            <ul>
                                <li> <a href="hoadon.php"  class="btn btn-primary">Thanh toán hóa đơn</a></li>
                                <li> <a href="guitien.php"  class="btn btn-primary">Gửi tiền tiết kiệm</a></li>
                                <li> <a href="giaodich.php"  class="btn btn-primary">Xem giao dịch</a></li>
                                <li><a href="thoat.php"  class="btn btn-primary">Thoát</a></li>
                            </ul>

                        </div>
                        <div class="alert alert-success alert-dismissible" id="tb" style="visibility: hidden;">
                               
                            <strong>Số dư của bạn là</strong> 
                            <h4><?php echo $sodu?> vnđ</h4>
                            <button type="button" class="btn btn-primary ibdong"  id="dong" onclick="dong();" >Đóng</button>
                          </div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    window.onload = function(){
      setTimeout("switchImage()", 3000);
    }
    var current = 1;
    var numIMG = 4;
    function switchImage(){
      current++;
      // Thay thế hình
      document.images['myimage'].src ='../image/br' + current + '.jpg';
      // Gọi lại hàm nếu thõa đk
      if(current == numIMG)
      {current =0;}
    setTimeout("switchImage()", 3000);
    }
</script>