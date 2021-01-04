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
                        <h4 class="card-title">Các giao dịch gần đây</h4>
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Mã khách hàng</th>
                                    <th>Mã giao dịch</th>
                                    <th>Số tiền rút</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sql6 = "select  * from ruttien where id_user='$user' ORDER BY id_giaodich DESC LIMIT 5";
                                    $run6 = mysqli_query($conn,$sql6);
                                    while($num6=mysqli_fetch_array($run6)){
                                        ?>
                                    
                                    <tr>
                                        <td><?php echo $num6['id_user']?></td>
                                        <td><?php echo $num6['id_giaodich']?></td>
                                        <td><?php echo $num6['sotien']?></td>
                                        <td><?php echo $num6['time']?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                       
                            <a name="" id="" class="btn btn-primary" href="atm.php" role="button">Thoát</a>
                    </div>
                        <!--thông báo-->
                        <div class="alert alert-success alert-dismissible" id="alert" style="visibility: hidden;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="noidungtb">Xin lỗi!Hãy nhập đầy đủ</strong> 
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
            document.getElementById("noidungtb").innerHTML = 'Xin lỗi!Mật khẩu sai';
            document.getElementById("alert").style.visibility = 'visible';
               break;
           default:
               break;
       }
     
    }
</script>
<?php
    include('../connect.php');
    
   

    
?>