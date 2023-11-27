<?php
        
   if(isset($_POST['verify']))     
   {   
             $ootp=strval($_POST['ootp']);
             $sotp=strval($_POST['sotp']);
             $totp=strval($_POST['totp']);
             $fotp=strval($_POST['fotp']);

             $final_otp=$ootp.$sotp.$totp.$fotp;

             session_start();
             $otp=$_SESSION['genotp'];
        
             //checking the entered otp and sent email 
             if($otp==$final_otp)
             {
               echo"<script>window.location.href='newconfirmpassword.php';</script>";
             }
             else
             {
                echo"<script>alert('OTP Doesnot Match,Please Enter the OTP That We Sent To Your Email');</script>";
                echo"<script>window.location.href='verify.html';</script>";
             }
   }

?>