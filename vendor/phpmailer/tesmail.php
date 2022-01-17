<?php
require('sendmail.php');

$email = 'johanericka@gmail.com';
$nama = 'Johan Ericka';

//kirim email user
$subject = "Tes Email";
$pesan = "Yth. " . $nama . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Ini adalah tes email
        <br/>
        <br/>
        Wassalamualaiakum Wr. Wb.
        ";
sendmail($email, $nama, $subject, $pesan);
