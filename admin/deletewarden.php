<?php
    $message=" ";
    $wid="";
    $wname="";
    $wgender="";
    $wage="";
    $wadhar="";
    $waddress="";
    $phone="";
    $email="";
    $waid="";
    $widd="";
    session_start();
    @$us=$_SESSION['us'];

    $con=new mysqli("localhost","root","","hostel");
    if($con->connect_error)
    {
        echo"<script>alert('Could Not Connect');</script>";
        echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
    }

    if(isset($_POST['search']))
    {
        $waid="";
        $wid=$_POST['wid'];    

        $ro=strval($wid);
        if($ro=="")
        {
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Enter the Warden ID in the search box</b>';
        }
        else
        {
            // $_SESSION['dtrno']=$roomno;
            $qry="select * from warden where wid='".$wid."' and warden_status='ACTIVE'";
            $rslt=$con->query($qry);
        
            if($rslt->num_rows>0)
            {
                $r=$rslt->fetch_assoc();
                $wid=$r['wid'];
                $wname=$r['wname'];
                $wgender=$r['wgender'];
                $wage=$r['wage'];
                $wadhar=$r['wadhar'];
                $waddress=$r['waddress'];
                $phone=$r['phone'];
                $email=$r['email'];
                $message='<b style="color:green;"><i class="fas fa-circle-check"> </i> Record Found</b>';
            }
            else
            {
                $wid="";
                 $message='<b style="color:red;"><i class="fas fa-warning"> </i> Warden with that ID not found</b>';
            }
        }
    }
    if(isset($_POST['delete']))
    {
        
        $widd=$_POST['widd'];
        if($widd=="")
        {
            $widd="";
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Enter the Warden ID in the search box</b>';
        }
        else
        {
            $qry="update warden set warden_status='OLD_WARDEN' where wid='".$widd."'";                    
            if($con->query($qry))
            {
                // echo"<script>alert('Room Deleted Successfully');</script>";
                $message='<b style="color:green;"><i class="fas fa-circle-check"> </i> Warden record deleted successfully</b>';
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
    <link rel="stylesheet" href="deletewarden.css">
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
<h1 class="h1">Delete Warden</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<form method="post" action="">
<label class="lk" style="color:gray;"><?php echo $message; ?></label>
<div class="search">
   <input type="text" name="wid" placeholder="SEARCH" oninput="vInput(event)">
   <button name="search" ><i class="fas fa-search"></i></button>
</div>





<div class="container">

    
        <!-- <div class="logo">
        <h1 class="hdng">REGISTER</h1>
        </div> -->

       

        
        <div class="eq">
        
            <div class="eqalign">
            
            <input name="widd"  type="text" value="<?php echo $wid ;?>" placeholder="WARDEN ID" readonly>
            <input  name="wname" type="text" value="<?php echo $wname ;?>" placeholder="WARDEN NAME" readonly>
            <input  name="wgender" type="text" value="<?php echo $wgender ;?>" placeholder="GENDER" readonly>
            <!-- <select name="wgender" id="">
                <option value="">MALE</option>
                <option value="">FEMALE</option>
                
            </select> -->
        <input type="text" name="wage" value="<?php echo $wage ;?>" placeholder="AGE"  readonly>
        <input type="text" name="wadhar" value="<?php echo $wadhar ;?>" placeholder="ADHAR number" readonly>
        <input type="text" name="waddress" value="<?php echo $waddress ;?>" placeholder="ADDRESS" readonly>
        <input type="text" name="phone" value="<?php echo $phone ;?>" placeholder="phone no" readonly>
        <input type="text" name="email" value="<?php echo $email ;?>" placeholder="email" readonly>
                
                </div>
                
        </div>
       
    

        <!-- <div class="balgn">
        <button class="signin">SIGN IN</button>
        <button class="back">BACK</button>
    </div> -->
        
</div>


          

            <div class="button"></div>
            <button class="btn1" name="delete"> DELETE</button> 
        </form>
            <button class="btn2" onclick="funback();"> BACK</button>
            


        </div>
    </div>
</div>

    


</div>


</div>
</body>
<script>
    function funback()
    {
        window.location.href="managewarden.html";
    }
</script>
</html>