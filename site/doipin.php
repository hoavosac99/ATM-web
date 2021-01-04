<?php
    session_start();
    if(empty($_SESSION['user'])){
        header('location: dangnhap.php');
    }
    else {
        $user = $_SESSION['user'];
        include('../connect.php');
        $sql = "select * from user where id='$user'";
        $run = mysqli_query($conn,$sql);
        $num = mysqli_fetch_array($run);
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
                <h3>Kính chào quý khách <?php echo $num['name']?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card icard">
                    <div class="card-body">
                        <h4 class="card-title">Đổi PIN</h4>
                        <div class="left">
                            <ul>
                                <li style="font-weight: 900;">Mã PIN</li>
                                <li style="font-weight: 900;">Mã PIN mới</li>
                            </ul>
                        </div>
                        <form action="" method="post">
                            <input type="password" name="txtpass"><br>
                            <input type="password" name="txtnewpass"><br>
                            <input type="submit" value="Đồng ý" name="ok" class="btn btn-primary">
                        </form>
                            <a name="" id="" class="btn btn-primary" href="atm.php" role="button">Thoát</a>
                    </div>
                        <!--thông báo-->
                        <div class="alert alert-success alert-dismissible" id="alert" style="visibility: hidden;">
                        <button type="button" class="close" data-dismiss="alert" id="dong1" onclick="dong('alert')">&times;</button>
                        <strong id="noidungtb">Xin lỗi!Hãy nhập đầy đủ</strong> 
                        </div>

                        <div class="alert alert-success alert-dismissible" id="alert1" style="visibility: hidden;">
                            <button type="button" class="close" data-dismiss="alert1" id="dong2" onclick="dong('alert1')">&times;</button>
                            <strong id="noidungtb">Nhập PIN sai.Nhập lại</strong> 
                            </div>
                        <div class="alert alert-success alert-dismissible" id="alert2" style="visibility: hidden;">
                             <button type="button" class="close" data-dismiss="alert2" id="dong3" onclick="dong('alert2')">&times;</button>
                            <strong id="noidungtb">Đổi thành công</strong> 
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
    function dong(id){
        document.getElementById(id).style.visibility='hidden';
    }
</script>
<?php
    include('../connect.php');
    
       
    if(isset($_POST['ok'])){
        $pass = $_POST['txtpass'];
        $newpass = $_POST['txtnewpass'];
       
        $sql1 = "select * from user where id='$user'";
        $run1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_num_rows($run1);
        $num1 = mysqli_fetch_array($run1);
        if(empty($pass)||empty($newpass)){
          echo " <script>
                document.getElementById('alert').style.visibility='visible';
            </script>";
        }else{
            if($num1['pin']!=$pass){
                echo " <script>
                    document.getElementById('alert1').style.visibility='visible';
                </script>";
            }
            else{
                $sql2 = "update user set pin='$newpass' where id='$user'";
                $run2 = mysqli_query($conn,$sql2);
                if($run2){
                    echo " <script>
                        document.getElementById('alert2').style.visibility='visible';
                    </script>";
                }
            }
        }
      
    }

    
?>