<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="laptrinhatm";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);//phương thức kết nối database
if($conn){
    mysqli_query($conn,"SET NAME 'utf8'");
}
else{
    echo"ban da ket noi that bai".mysqli_connect_error();
}
?>