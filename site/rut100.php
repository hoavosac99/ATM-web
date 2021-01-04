<?php
    session_start();
    if(empty($_SESSION['user'])){
        header('location: dangnhap.php');
    }
    else {
        $user = $_SESSION['user'];
    }
   
    include('../connect.php');
    $sotien = $_GET["rut"];
    function ruttien($sotien,$us)
        {   
            date_default_timezone_set('Asia/Saigon'); //múi giờ
            $today = date("Y/m/d"); // lấy tháng nắm
            $today=date("Y-m-d h:i:s A"); //lấy cả tháng ngày giờ phút giây
            include('../connect.php'); 
            $sql1 = "select * from user where id='$us'";
            $run1 =mysqli_query($conn,$sql1);
            $num1 = mysqli_fetch_array($run1);
            $tiendu = $num1['sodu'] - $sotien;
            //update lại tiền cho khách
            $sql2 = "UPDATE user SET sodu = '$tiendu' WHERE id = '$us'";
            $run2 = mysqli_query($conn,$sql2);
            $sql3 = "insert into ruttien(id_user,sotien,time) values ('$us','$sotien','$today')";
            $run3 = mysqli_query($conn,$sql3);
            
        }
        ruttien($sotien,$user);
        
       if($sotien>=500000){
           $soto = floor($sotien/500000);
           $sotien = $sotien%500000;
          $to500 = $soto;
       }
       if($sotien>=200000){
        $soto = floor($sotien/200000);
        $sotien = $sotien%200000;
        $to200=$soto;

    }
    if($sotien>=100000){
        $soto = floor($sotien/100000);
        $sotien = $sotien%100000;
        $to100=$soto;
    }
    if($sotien>=50000){
        $soto = floor($sotien/50000);
        $sotien = $sotien%50000;
        $to50= $soto;
    }
        
?>
<html>
    <div class="card">
        
        <div class="card-body">
            <h4 class="card-title">Số tiền rút được</h4>
          <?php if(!empty($to500))
                echo '<p class="card-text">500k:'. $to500 .'tờ</p>';
          ?>  
         <?php if(!empty($to200))
                echo '<p class="card-text">200k:'. $to200 .'tờ</p>';
          ?>  
           <?php if(!empty($to100))
                echo '<p class="card-text">100k:'. $to100 .'tờ</p>';
          ?>  
           <?php if(!empty($to50))
                echo '<p class="card-text">50k:'. $to50 .'tờ</p>';
          ?>  
        </div>
    </div>
</html>