<?php
    $message="";
    $rno="";
    $seat="";
    $rf="GENDER";
    $sts="STATUS";
    session_start();
    @$us=$_SESSION['us'];

    $con=new mysqli("localhost","root","","hostel");
    if($con->connect_error)
    {
        echo"<script>alert('Could Not Connect');</script>";
        // exit;
        echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
    }

    if(isset($_POST['search']))
    {
        $roomno=$_POST['roomno'];
        $ro=strval($roomno);
        if($ro=="")
        {
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Enter the roomno in the search box</b>';
        }
        else
        {    
            // $_SESSION['uprno']=$roomno;
            $qry="select * from mroom where roomno='".$roomno."'";
            $rslt=$con->query($qry);
        
            if($rslt->num_rows>0)
            {
                $r=$rslt->fetch_assoc();
                $seat=$r['seater'];
                $sts=$r['status'];
                $rf=$r['roomfor'];
                $_SESSION['filled']=$r['filled'];
                $rno=$roomno;
                $message='<b style="color:green;"><i class="fas fa-check-circle"> </i> Room Number Found</b>';
            }
            else
            {
                $rno="";
                $message='<b style="color:red;"><i class="fas fa-warning"> </i> Room Number Not Found</b>';
            }
        }
    }
    if(isset($_POST['update']))
    {
        // $uprno=$_SESSION['uprno'];
        $rmno=$_POST['rmno'];
        $rmseat=$_POST['rmseat'];
        $rmst=$_POST['rmst'];
        $rmfor=$_POST['rmfor'];
        $rseat=strval($rmseat);
        $filled=$_SESSION['filled'];

        
                if($rmno=="")
                {
                    $message='<b style="color:rgb(256,0,0);"><i class="fas fa-warning"> </i> Search the Room Number to Update</b>';
                }
                else
                {
                    if($filled>$rmseat)
                    {
                        $message='<b style="color:rgb(256,0,0);"><i class="fas fa-warning"> </i> Seater Can\'t be less than already filled students</b>';
                    }
                    else
                    {
                        if($rseat=="")
                        {
                            $message='<b style="color:rgb(256,0,0);"><i class="fas fa-warning"> </i> Please Enter Seater</b>';
                        }
                        else
                        {
                            $qry="update mroom set seater='$rmseat',roomfor='$rmfor',status='$rmst' where roomno='$rmno'";
                            $uq=$con->query($qry);
                            if($uq)
                            {
                                $message='<b style="color:green;"><i class="fas fa-check-circle"> </i> Room Updated</b>';
                            }    
                        }       
                    }
                }
            }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="updateroom.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>Document</title>
            <script>
            function vInput(event) {
            const input = event.target;
            const value = input.value;
            const sanitizedValue = value.replace(/[^a-zA-Z0-9]/g, '');
            input.value = sanitizedValue;
            }
            </script>


</head>
<body>
<label style="margin-left:200px;margin-top:80px;margin-left:200px;"><?php echo $message; ?></label>
    <div class="admin">
        <i class="fa fa-wallet"></i>
        <h1>ADMIN</h1>
    </div>

    <div class="sidebar">
        <div class="info" style="overflow:hidden;">
            <div class="img"></div>
            <labe class="hiadmin">Hi,<span>Admin</span></label>
            <div class="emma" ><label class="email" for="">dkiran@gmail.com</label></div>
        </div>
    <div class="menu">
        

            <a href="admindashboard.php"><i class="fas fa-home"></i>  DASHBOARD</a>
            <a href="managestudent.html"><i class="fas fa-user"></i>  MANAGE STUDENT</a>
            <a href="managewarden.html"><i class="fas fa-user-tie"></i>  MANAGE WARDEN</a>
           
            <a href="manageroom.html" ><i class="fas fa-chair"></i>  MANAGE ROOM</a>
            <a href="managefood.php"><i class="fas fa-burger"></i>  MANAGE FOOD</a>
            <a href="manageevent.php"><i class="fas fa-calendar"></i>  MANAGE EVENT</a>
            <a href="spayment.php"><i class="fas fa-bank"></i>  PAYMENT</a>
            
    </div>
</div>

<div class="navbar">
<h1 class="h1">Update Rooms</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>
<form method="post" action="">
<div class="search">
   <input type="text" name="roomno" placeholder="SEARCH" style="text-transform:uppercase;" autocomplete="off" oninput="vInput(event)">
   <button name="search"><i class="fas fa-search" ></i></button>
</div>

<div class="cardcontainer">
    <div class="card">
        <div class="input">
            <input class="input1" type="text" style="text-transform:uppercase;" name="rmno" value="<?php echo $rno; ?>" readonly placeholder="ROOM NUMBER">
            <input class="input2" type="number" name="rmseat" value="<?php echo $seat; ?>" min="1" max="4" placeholder="TOTAL SEATER">

            <select class="select1"  name="rmst" id="" title="STATUS" >
                <option><?php echo $sts; ?></option>
                <?php 
                    if($sts=="AVAILABLE")
                    {
                        echo"<option>FULL</option>";
                    }
                    else
                    {
                        echo'<option>AVAILABLE</option>';
                    }
                ?>
            </select>

            <!-- <input class="select2" name="rmfor" type="text" style="text-transform:uppercase;"  readonly placeholder="GENDER"> -->
            <select class="select2" name="rmfor"  id=""  title="Room For">
            <option><?php echo $rf; ?></option>
                <?php 
                    if($rf=="MALE")
                    {
                        echo"<option>FEMALE</option>";
                    }
                    elseif($rf=="FEMALE")
                    {
                        echo'<option>MALE</option>';
                    }
                ?>
            </select>

          

            <div class="button"></div>
            <button name="update" class="btn1">UPDATE</button>
        </form>
           <a class="btn2" href="manageroom.html">BACK</a>
            


        </div>
    </div>
</div>

    


</div>


</div>
</body>
</html>