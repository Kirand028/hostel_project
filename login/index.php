<?php

session_start();
if(isset($_POST['loginbut']))
{ 
  $inputadminuser=$_POST['user'];
  $inputadminpass=$_POST['pass'];
  
  $_SESSION['usn']=$inputadminuser;
  // $_SESSION['pa']=$inputadminpass;
  
  

  $con=new mysqli("localhost","root","","hostel");
  if($con->connect_error)
  {
    echo"<script>alert('Could Not Connect');</script>";
    exit;
    echo"<script>window.location.href='index.html';</script>";
  }

  if(isset($_GET['username']))
  {
    $username="";
  }
  else
  {
    $username=$inputadminuser;
  }

  $adminun="admin";
  $adminue="dkiran4661@gmail.com";
  $adminp="admin";
  //admin login
  if($inputadminuser==$adminun or $inputadminuser==$adminue)
  {
    if($inputadminpass==$adminp)
    {
      echo'<script>window.location.href="http://localhost/hostel/admin/admindashboard.php";</script>';
    }
    else
    {
      echo"<script>alert('Invalid Password');</script>";
      echo"<script>window.location.href='index.html';</script>";
    }
  }
  else
  {
    // $idqry="select * from loginidtb where usermail='".$inputadminuser."' or userid='".$inputadminuser."'"; 
    // $idrslt=$con->query($idqry);

    $abc = "SELECT *
    FROM stregister
    JOIN loginidtb ON stregister.email = loginidtb.usermail
    WHERE (loginidtb.usermail = '".$inputadminuser."' OR loginidtb.userid = '".$inputadminuser."')
    AND stregister.student_status = 'ACTIVE'";

 
    $idrslt=$con->query($abc);

    $bqry="select * from warden where email='".$inputadminuser."' or wid='".$inputadminuser."' and warden_status='ACTIVE'"; 
    $srslt=$con->query($bqry);


    if($idrslt->num_rows!=0)
    {
      $rr=$idrslt->fetch_assoc();
      $upass=$rr['password'];
      if($inputadminpass==$upass)
      {
        echo'<script>window.location.href="http://localhost/hostel/student/studentdashboard.php?username='.$username.'";</script>';
      }
      else
      {
        echo"<script>alert('Invalid Password');</script>";
        echo"<script>window.location.href='index.html';</script>";
      }
    }
    elseif($srslt->num_rows!=0)
    {
      $zz=$srslt->fetch_assoc();
      $upass=$zz['wpass'];
      if($inputadminpass==$upass)
      {
        echo'<script>window.location.href="http://localhost/hostel/warden/wardendashboard.php?username='.$username.'";</script>';
      }
      else
      {
        echo"<script>alert('Invalid Password');</script>";
        echo"<script>window.location.href='index.html';</script>";
      }
    }    
    else
    {
        echo"<script>alert('Invalid Username');</script>";        
        echo"<script>window.location.href='index.html';</script>";
    }

    

  }
}
/*//student login
    $idqry="select * from loginidtb where usermail='".$inputadminuser."' or userid='".$inputadminuser."'"; 
    $idrslt=$con->query($idqry);
    if($idrslt->num_rows!=0)
    {
      $psqry="select * from loginidtb where password='".$inputadminpass."'";
      $psrslt=$con->query($psqry);
      if($psrslt->num_rows!=0)
      {
        header('location:admindashboard.php');
      }
      else
      {
        echo"<script>alert('Invalid Password');</script>";
        echo"<script>window.location.href='index.html';</script>";
      }
    }
    else
    {
        echo"<script>alert('Invalid Username');</script>";
        echo"<script>window.location.href='index.html';</script>";
    }
  }*/

  

?>