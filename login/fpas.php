<?php

if(isset($_POST['submit']))
{
    session_start();
    $fetchedemail=$_POST['email'];
    // $_SESSION['eem']=$fetchedemail;
    //checking if entered email is present on database or not
    $cn=new mysqli("localhost","root","","hostel");
    if($cn->connect_error)
    {
        echo"<script>alert('could not connect, Some error occured');</script>";
        exit;
    }
    $qry="select * from loginidtb where usermail='".$fetchedemail."'";
    $rs=$cn->query($qry);

    if($rs->num_rows==1)
    {

        $otp=rand(1000,9999);
        $otp=strval($otp);
        $_SESSION['genotp']=$otp;
        $_SESSION['eem']=$fetchedemail;
        //sending email with mail function
        $receiver = "$fetchedemail";
        $subject = "Email Verification";
        $body = "Hi, The OTP for Email verification is: $otp \nDo not share the OTP with anyone";
        $sender = "From:dkiran4661@gmail.com";

        if(mail($receiver, $subject, $body, $sender))
        {
            // echo'<body style="background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);backdrop-filter:blur(20%);">
            // <div style="margin-top:120px;">
            //     <h2 style="text-align:center;">One Time Password is Sent to your Email, Please Check.</h2> <br><br>
            //     <h2 style="width:200px;height: 90px;margin-left:45%;"><a href="verify.html" style="text-align:center;
            //         border: 20px solid transparent;background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
            //         box-shadow: -5px -5px 5px 2px #ffffff, 5px 5px 8px 0px rgba(0, 0, 0, 0.17), 1px 2px 2px 0px rgba(0, 0, 0, 0.1);
            //         transition: 0.1s;border-radius: 8px;text-decoration:none;">BACK</a></h3>
            //      </div>   </body>';   
            echo"<script>alert('One Time Password is Sent to Your Email');</script>";
            echo"<script>window.location.href='verify.html';</script>";
        }
        else
        {
            echo'<body align="center" style="background: linear-gradient(160deg, rgb(213, 234, 253), #ffe6eb 100%);">
                <div style="margin-top:120px;">
                <h2 style="text-align:center;">You need Internet to get the OTP, Please Connect to Internet.</h2> <br><br>
                <h2 style="width:200px;height: 90px;margin-left:45%;"><a href="index.html" style="text-align:center;
                    border: 20px solid transparent;background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
                    box-shadow: -5px -5px 5px 2px #f0f0f0, 5px 5px 8px 0px rgba(0, 0, 0, 0.17), 1px 2px 2px 0px rgba(0, 0, 0, 0.1);
                    transition: 0.1s;border-radius: 8px;text-decoration:none;">BACK</a></h3>
                    </div></body>';
            //echo"<script>alert('Can't Send OTP to your Email');</script>";
            //echo"<script>window.location.href='index.html';</script>";
        }
    }
    else
    {
        echo"<script>alert('This Email not registered yet');</script>";
        echo"<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
    }
    
$cn->close();
}
?>