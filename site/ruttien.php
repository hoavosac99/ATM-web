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
        $sotiencon = $num['sodu'];
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
       
        $(document).ready(function () {
            var socon = <?php echo $sotiencon?>;
            function chon(tb,huy){
                document.getElementById(tb).style.visibility="visible";
                hienmo();
                $(huy).click(function (e) { 
                    document.getElementById(tb).style.visibility="hidden";
                    tatmo();
                    e.preventDefault();
                    
                });
            }
            //hàm hiện tắt thông báo khi rút thành công
            function tatthongbao(tb){
            var action = setTimeout(function(){
                 document.getElementById(tb).style.visibility="visible";
                }, 100);
            var action2 = setTimeout(function(){
                document.getElementById(tb).style.visibility="hidden";
                 }, 1500);     
                
           }
            //futicon hiện lớp mờ chống click
            function hienmo(){
                document.getElementById('lop').style.visibility="visible";
            }
            function tatmo(){
                document.getElementById('lop').style.visibility="hidden";
            }
            //xu ly khi chon so tiền
            $('#chon1').click(function (e) { 
                chon('tb1','#huy1');
               
                e.preventDefault();
               
            });
            
            $('#chon2').click(function (e) { 
                chon('tb2','#huy2');
                
                e.preventDefault();
                
            });
            $('#chon3').click(function (e) { 
                chon('tb3','#huy3');
                e.preventDefault();
               
            });
            $('#chon4').click(function (e) { 
                chon('tb4','#huy4');
               
                e.preventDefault();
                
            });
            $('#chon5').click(function (e) { 
                chon('tb5','#huy5');
                
                e.preventDefault();
                
            });
            $('#chon6').click(function (e) { 
                chon('tb6','#huy6');
                
                e.preventDefault();
                
            });
            $('#chon7').click(function (e) { 
                chon('tb7','#huy7');
                
                e.preventDefault();
                
            });
            $('#huy8').click(function (e) { 
                    document.getElementById('tb8').style.visibility="hidden";
                    e.preventDefault();
                    
                });
            //xử lý khi đồng ý
           $('#1').click(function (e) {
               if(socon>100000){
                $.get('rut100.php',{rut:'100000'},function(data){
                document.getElementById('tb1').style.visibility="hidden";
                   $('#tien').html(data); 
                   tatthongbao('tb8');
                   tatmo();
                   
               })
               }else{
                   alert('số dư không đủ');
               }
              
                
           });
           
           $('#2').click(function (e) {
            if(socon>200000){
                $.get('rut100.php',{rut:'200000'},function(data){
                document.getElementById('tb2').style.visibility="hidden";
                      $('#tien').html(data); 
                      tatthongbao('tb8');
                      tatmo();
               })
            }else{
                   alert('số dư không đủ');
            }
               
                
           });
           $('#3').click(function (e) {
               if(socon>400000){
                    $.get('rut100.php',{rut:'400000'},function(data){
                    document.getElementById('tb3').style.visibility="hidden";
                    tatthongbao('tb8');
                    $('#tien').html(data);
                    tatmo();
                })
               }else{
                alert('số dư không đủ');
               }
               
               e.preventDefault();   
           });
           $('#4').click(function (e) {
            if(socon>500000){
               $.get('rut100.php',{rut:'500000'},function(data){
                document.getElementById('tb4').style.visibility="hidden";
                tatthongbao('tb8');
                   $('#tien').html(data);
                   tatmo();
               })
            }else{
                alert('số dư không đủ');
               }  
               e.preventDefault();   
           });
           $('#5').click(function (e) { 
            if(socon>1000000){
               $.get('rut100.php',{rut:'1000000'},function(data){
                document.getElementById('tb5').style.visibility="hidden";
                tatthongbao('tb8');
                   $('#tien').html(data);
                   tatmo();
               })
            }else{
                alert('số dư không đủ');
               }  
               e.preventDefault();   
           });
           $('#6').click(function (e) { 
            if(socon>2000000){
               $.get('rut100.php',{rut: '2000000' },function(data){
                document.getElementById('tb6').style.visibility="hidden";
                    tatthongbao('tb8');
                   $('#tien').html(data);
                   tatmo();
                  
               })
            }else{
                alert('số dư không đủ');
               }    
               e.preventDefault();   
           });
           $('#7').click(function (e) {
               
                var sotienrut = document.getElementById('sokhac').value;
                if(socon>0){
                    if(sotienrut<socon){
                        if(sotienrut%50000==0 && sotienrut!=''){
                        $.get('rut100.php',{rut: sotienrut },function(data){
                         document.getElementById('tb7').style.visibility="hidden";
                            tatthongbao('tb8');
                            tatmo();
                       $('#tien').html(data);
                   })
                        }else{
                        alert("số tiền không hợp lệ");
                        }
                    }else{
                        alert("số tiền trong thẻ không đủ để rút");
                    }
                    
                }
                else{
                    alert("số tiền trong tài khoản đã hết");
                }
                
              
               e.preventDefault();   
           });
           
        });
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
            
                <div class="card"   >
                    <div class="card-body">
                        <h4 class="card-title">Mời bạn chọn số tiền rút</h4>
                        <img src="../image/br1.jpg" alt="" class="ibr" name="myimage" style="opacity:0 ;"><!--đóng background-->
                        <div class="left l1">
                            <ul>
                                <li> <button  class="btn btn-primary" value="100000" id="chon1" >100.000</button></li>
                                <li> <button  class="btn btn-primary" value="200000" id="chon2" >200.000</button></li>
                                <li> <button class="btn btn-primary" value="400000" id="chon3">400.000</button></li>
                                <li> <button  class="btn btn-primary" value="500000" id="chon4">500.000</button></li>
                            </ul>
                            <a ></a>
                        </div>
                            <!--thông báo 1-->
                            <div class="alert alert-success alert-dismissible" id="tb1" >
                                
                                <strong>Bạn có muốn rút tiền ?</strong> 
                                <button type="button" class="btn btn-primary ibtnyes" id="1" >Đồng ý</button>
                                <button type="button" class="btn btn-primary ibtnno"   id="huy1">Hủy</button>
                              </div>
                              <!--thông báo 2-->

                              <div class="alert alert-success alert-dismissible" id="tb2">
                               
                                <strong>Bạn có muốn rút tiền ?</strong> 
                                <button type="button" class="btn btn-primary ibtnyes" id="2">Đồng ý</button>
                                <button type="button" class="btn btn-primary ibtnno"  id="huy2" >Hủy</button>
                              </div>  
                            <!--thông báo 3-->
                            <div class="alert alert-success alert-dismissible" id="tb3">
                                
                                <strong>Bạn có muốn rút tiền ?</strong> 
                                <button type="button" class="btn btn-primary ibtnyes" id="3">Đồng ý</button>
                                <button type="button" class="btn btn-primary ibtnno"  id="huy3" >Hủy</button>
                              </div>  
                            <!--thông báo 4-->
                            <div class="alert alert-success alert-dismissible" id="tb4">
                               
                                <strong>Bạn có muốn rút tiền ?</strong> 
                                <button type="button" class="btn btn-primary ibtnyes" id="4">Đồng ý</button>
                                <button type="button" class="btn btn-primary ibtnno"  id="huy4" >Hủy</button>
                              </div>  
                            <!--thông báo 5-->
                            <div class="alert alert-success alert-dismissible" id="tb5">
                               
                                <strong>Bạn có muốn rút tiền ?</strong> 
                                <button type="button" class="btn btn-primary ibtnyes" id="5">Đồng ý</button>
                                <button type="button" class="btn btn-primary ibtnno" id="huy5" >Hủy</button>
                              </div>  
                            <!--thông báo 6-->
                            <div class="alert alert-success alert-dismissible" id="tb6">
                               
                                <strong>Bạn có muốn rút tiền ?</strong> 
                                <button type="button" class="btn btn-primary ibtnyes" id="6">Đồng ý</button>
                                <button type="button" class="btn btn-primary ibtnno"  id="huy6" >Hủy</button>
                              </div>  
                           <!--số khác-->
                            <div class="alert alert-success alert-dismissible" id="tb7">
                               
                                <strong>Nhập số tiền(phải chia hết cho 50.000đ)</strong>
                                <input type="number" name="sokhac" id="sokhac">
                                <button type="button" class="btn btn-primary ibtnyes" id="7">Đồng ý</button>
                                <button type="button" class="btn btn-primary ibtnno" id="huy7">Hủy</button>
                            </div>  
                            <!--thông báo thành công tb8-->
                            <div class="alert alert-success alert-dismissible" id="tb8"> 
                                <strong>Rút tiền thành công</strong>
                                
                                <button type="button" class="btn btn-primary ibtnno" id="huy8">Xác nhận</button>
                            </div>  
                        <div class="right r1">
                            <ul>
                                <li> <button  class="btn btn-primary" id="chon5">1.000.000</button></li>
                                <li> <button  class="btn btn-primary" id="chon6">2.000.000</button></li>
                                <li> <button  class="btn btn-primary" id="chon7">Số khác</button></li>
                                
                                <li><a href="atm.php"  class="btn btn-primary">Thoát</a></li>
                            </ul>

                        </div>
                        <!--tạo lớp chống click-->
                        <div id="lop" style="visibility: hidden;">
                            
                        </div>
                    </div>
                    
                </div>
               
            </div>
        </div>
    </div><!--đóng màn hình máy atm-->
    <div class="container"> <!--hiển thị tiền-->
        <div class="row">
            <div class="col-xl-12">
                <div id="tien"></div>
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
<script>
    
</script>
