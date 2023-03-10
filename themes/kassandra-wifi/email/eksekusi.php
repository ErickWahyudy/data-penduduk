<?php
require 'PHPMailer/src/PHPMailer.php' ;
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

include "../inc/koneksi.php"; //memulai koneksi ke database
// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
$result = mysqli_query($koneksi, "SELECT * From tb_pelanggan");
// Mengambil semua data email dalam bentuk array
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($result as $key => $value) { //mengirim email untuk setiap baris data
    $mail =  new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->SMTPAuth 	= true;
    $mail->Host 		= "smtp.gmail.com";
    $mail->Port 		= 465;
    $mail->SMTPSecure 	= "ssl";
    $mail->Username 	= "kassandramikrotik@gmail.com";   //username SMTP
    $mail->Password 	= "085erik@iwan";   			  //password SMTP
    $mail->From    		= "kassandramikrotik@gmail.com";   //email pengirim
    $mail->FromName 	= "kassandra";      			  //nama  pengirim
    $mail->AddAddress($value['email'], $value['nama']);//email dan nama penerima
    $mail->Subject  	=  $value['alamat']; //judul email
    $mail->Body     	=  "<b>alamat :</b>".$value['alamat']; //isi   email
    $mail->AddAttachment("cpanel.png", "filesaya.png");
    if ($mail->Send()) {
        echo "Email sent successfully<br>";
    } else {
        echo "Email failed to send";
    }
}
mysqli_close($koneksi);
