<?php?>
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
            <div class="col-xl-4">
                <img src="../image/Logo-TPB.png" alt="" class="logo">
               
            </div>
           
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card" style="background-image: url(../image/card2.jpg); background-size: cover; 
                background-size: 625px;
                background-position: 797px 256px;
                background-repeat: no-repeat;">
                    <div class="card-body">
                        <h4 class="card-title">Mời nhập mã PIN</h4>
                        <div class="left">
                            <ul>
                                <li style="font-weight: 900;">Mã thẻ</li>
                                <li style="font-weight: 900;">Mã PIN</li>
                            </ul>
                        </div>
                        <form action="" method="post">
                            <input type="text" name="txtmathe"><br>
                            <input type="password" name="txtpass"><br>
                            <input type="submit" value="Đồng ý" name="ok" class="btn btn-primary">
                        </form>
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
            case 3:
            document.getElementById("noidungtb").innerHTML = "Mã thẻ sai";
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
        $mathe = $_POST['txtmathe'];
        $pass = $_POST['txtpass'];
        //truyền session
        session_start();
        $_SESSION['user']=$mathe;

        $sql = "select * from user where id='$mathe'";
        $run = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($run);
        $num = mysqli_fetch_array($run);
        if($mathe==''||$pass==''){
            echo "<script> thongbao(1); </script>";
        }

        elseif($row<1){
            echo "<script> thongbao(3); </script>";
        }
        elseif($mathe==$num['id'] && $pass!=$num['pin']){
            echo "<script> thongbao(2); </script>";
        }
        else if($mathe==$num['id'] && $pass==$num['pin']){
            header('location: atm.php');
        }
       
    }

    
?>