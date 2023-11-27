<?php
    session_start();
    //$gend=$_SESSION['gen'];
    $con=new mysqli("localhost","root","","hostel");
    if($con->connect_error)
    {
      echo"<script>alert('Could Not Connect');</script>";
    //   exit;
      echo"<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
    }
    // @$userid=$_SESSION['us'];
    if(isset($_GET['username']))
    {
        @$us=$_GET['username'];
    }

    $userid=$us;

    $bqry="select * from warden where email='".$userid."' or wid='".$userid."'"; 
    $srslt=$con->query($bqry);
    if($srslt)
    {
        $f=$srslt->fetch_assoc();
        @$uid=$f['email'];
        @$name=$f['wname'];
        @$wid=$f['wid'];
        @$aadhar=$f['wadhar'];
        @$wpass=$f['wpass'];
        @$wage=$f['wage'];
        @$address=$f['waddress'];
        @$phone=$f['phone'];
        @$wpass=$f['wpass'];
    }

    if(isset($_POST['up']))
    {
    
        $current=$_POST['old'];
        $new=$_POST['new'];
        $confirm=$_POST['confirm'];

        if($wpass==$current)
        {
            if($new==$confirm)
            {
                if(strlen($new)>=8&&strlen($confirm)>=8)
                {
                    // echo"<style> .i2, .i3{ border: 2px solid red;}<style>";
                    $upd=$con->query("update warden set wpass='$new' where wid='$us' or email='$us'");
                    if($upd)
                    {
                        echo'<script>alert("Successfully password set");</script>';                    
                    }
                }
                else
                {
                    // echo"<style> .i2, .i3{ border: 2px solid red;}</style>";
                    // echo'<script>document.getElementById("new").placeholder="Character should be a length of 8";
                    //              document.getElementById("con").placeholder="Character should be a length of 8";</script>';
                    echo "<script>alert('Minimum character should be 8');</script>";
                }
            }
            else
            {
                echo "<script>alert('New password and confirm password should match');</script>";
                // echo"<style> .i2, .i3{ border: 2px solid red;}</style>";
                // echo'<script>document.getElementById("new").placeholder="Both password must match";
                //              document.getElementById("con").placeholder="Both password must match ";</script>';
            }

        }
        else
        {
            // echo'<script>document.getElementById("old").placeholder="old password must match";</script>';
            // echo"<style> .i1{ border: 2px solid red;}</style>";
            echo "<script>alert('Current password must be correct');</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myprofile.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Document</title>
        <style>
            
.vi{
    position: relative;
    top: 580px;
    right: -40px;
    font-size: 20px;

   
    font-weight: 900;  
    letter-spacing: 5px;

}
        </style>
    

</head>
<body>
    <div class="admin">
        <i class="fa fa-wallet"></i>
        <h1 class="hey">WARDEN</h1>
    </div>

    <div class="sidebar">
        <div class="info"style="overflow:hidden;">
            <div class="img"></div>
            <labe class="hiadmin">Hi,<span><?php echo ucfirst($name); ?></span></label>
            <label class="email" for=""><?php echo $uid; ?></label>
        </div>
    <div class="menu">
        

            <a href="wardendashboard.php?username=<?= $us ?>" ><i class="fas fa-dashboard"></i>  DASHBOARD </a>
            <a href="viewall.php?username=<?= $us ?>" >  <i  class="fas fa-user-graduate"></i>  VIEW STUDENT </a>
            <a href="myprofile.php?username=<?= $us ?>" class="active"><i class="fas fa-user-tie"></i>  MY PROFILE</a>
           
            <!-- <a href="manageroom.html"><i class="fas fa-hotel"></i>  MANAGE ROOMS</a> -->
            <a href="managefood.php?username=<?= $us ?>"><i class="fas fa-pizza-slice"></i>  MANAGE FOODS</a>
            <a href="manageevent.php?username=<?= $us ?>"><i class="fas fa-calendar"></i>  MANAGE EVENTS</a>
            <a href="cal_mealfee.php?username=<?= $us ?>"><i class="fas fa-hamburger"></i>  MEAL FEES</a>
            <!-- <a href="spayment.php"><i class="fas fa-money-check-alt"></i>  PAYMENT</a> -->
            
    </div>
</div>

<div class="navbar">
<h1 class="h1">My Profile</h1>



<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>





<div class="container">

<div class="card">

<h1> NAME <span class=""><?php echo $name ; ?></span> </h1>
<h1> ID <span class=""><?php echo $wid; ?></span> </h1>
<h1> AGE <span class=""><?php echo $wage ; ?></span> </h1>
<h1> AADHAR <span class=""><?php echo $aadhar ; ?></span> </h1>
<h1> ADDRESS <span class=""><?php echo $address ; ?></span> </h1>
<h1> PHONE <span class=""><?php echo $phone ; ?></span> </h1>
<h1> EMAIL <span class=""><?php echo $uid; ?></span> </h1>
<!-- <h1> name <s
pan>radradixradixradixix</span></h1> -->
</div>
</div>



<div class="icontainer">
    <div class="iholder">

        <div class="iholder1">
    
    
    </div>
    
    </div>
<div>
    <form action="" method="post" autocomplete="off" oninput="vInput(event)">
    <div class="update">
        <div class="password">PASSWORD</div>
        <div class="input">
        <label for="old">CURRENT </label>
        <input type="text" class="i1" id="old" name="old" placeholder="Enter Current Password" required>
        <label for="new">NEW </label>
        <input type="text" name="new" id="new" class="i2" placeholder="Enter New Password" required>
        <label for="confirm">CONFIRM </label>
        <input type="text" name="confirm" id="con" class="i3" placeholder="Enter Confirm Password" required>
        </div>
        <div class="upd"><button class="up" name="up">UPDATE</button></div>
    </div>
    </form>

    <script>


        function vInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^+?!@%&*&a-zA-Z0-9]/g, '');
        input.value = sanitizedValue;
        }

</script>


</body>
</html>