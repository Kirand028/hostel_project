<?php
$message='<b><i class="fas fa-circle-info"> </i> Add Warden </b><span style="color:gray;opacity:50%;">  (WM1* for boys, WF1* for girls)</span>';
session_start();
@$us=$_SESSION['us'];
if(isset($_POST['add']))
{
        $wid=$_POST['wid'];
        $wname=$_POST['wname'];
        $wgender=$_POST['wgender'];
        $wage=$_POST['wage'];
        $wanumber=$_POST['wanumber'];
        $waddress=$_POST['wadrress'];
        $wphone=$_POST['wphone'];
        $wemail=$_POST['wemail'];
        $wstatus="ACTIVE";



        //setting connection and checking for existence of room
        $con=new mysqli("localhost","root","","hostel");
        if($con->connect_error)
        {
            echo"<script>alert('Could Not Connect');</script>";
            // exit;
            echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
        }
        $qry="select * from warden where wid='".$wid."'";
        $idrslt=$con->query($qry);
        if($idrslt->num_rows>0)
        {
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Warden with this ID already exists<b>';
            // echo"<script>alert('**Room with this number already exist**');</script>";
            // echo"<script>window.location.href='home.html';</script>";
        }
        else
        {
            //generating random password
            $pass_string="+?!@%&*0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $pstring="";
            while(strlen($pstring)<8)
            {
                @$pstring.=$pass_string[rand(0,68)];
            }

            //inserting to room to table
            $qry="insert into warden values('".$wid."','".$wname."','".$wgender."',
                            '".$wage."','".$wanumber."','".$waddress."','".$wphone."','".$wemail."','".$pstring."','".$wstatus."')";
            $ins=$con->query($qry);
            if($ins)
            {
                // echo"<script>alert('Room added successfully.');</script>";
                $message='<b style="color:green;"><i class="fas fa-check-circle"> </i> New Warden Added Successfully</b>';
                
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
    <link rel="stylesheet" href="addwarden.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>Document</title>

    <script>
            function validateInput(event) {
                const input = event.target;
                const value = input.value;
                const sanitizedValue = value.replace(/[^A-Za-z ]/g, '');
                input.value = sanitizedValue;
            }

            function vInput(event) {
            const input = event.target;
            const value = input.value;
            const sanitizedValue = value.replace(/[^a-zA-Z0-9]/g, '');
            input.value = sanitizedValue;
            }
            function veInput(event) {
            const input = event.target;
            const value = input.value;
            const sanitizedValue = value.replace(/[^@.a-zA-Z0-9]/g, '');
            input.value = sanitizedValue;
            }
            function vsInput(event) {
            const input = event.target;
            const value = input.value;
            const sanitizedValue = value.replace(/[^a-zA-Z0-9,/ ]/g, '');
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
<h1 class="h1">Add Warden</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<!-- <div class="search">
   <input type="number" placeholder="SEARCH" min="1001" max="2000">
   <button ><i class="fas fa-search"></i></button>
</div> -->




<div class="container">

    <form action="" method="POST" autocomplete="off">
        <!-- <div class="logo">
        <h1 class="hdng">REGISTER</h1>
        </div> -->

       
      
        
        <div class="eq">
            <div class="eqalign">
            <label class="lk" style="color:gray;"><?php echo $message; ?></label>
            <input name="wid"  type="text" placeholder="WARDEN ID" required oninput="vInput(event)">
            <input  name="wname" type="text" placeholder="WARDEN NAME" required oninput="validateInput(event)">
            <select name="wgender" id="">
                <option>MALE</option>
                <option>FEMALE</option>
                
            </select>
        <input type="number" name="wage" placeholder="AGE" min="25" max="60" required>
        <input type="number" name="wanumber" placeholder="ADHAR number"  min="100000000000" max="999999999999" required>
        <input type="text" name="wadrress" placeholder="address" required oninput="vsInput(event)">
        <input type="number" name="wphone" placeholder="phone no"  min="1000000000" max="9999999999" required>
        <input type="email" name="wemail" placeholder="email" required oninput="veInput(event)">
                
                </div>
                
        </div>
       
    

        <!-- <div class="balgn">
        <button class="signin">SIGN IN</button>
        <button class="back">BACK</button>
    </div> -->
        
</div>


          

            <div class="button"></div>
            <button class="btn1" name="add">ADD</button>
            </form>
            <a class="btn2" href="managewarden.html">BACK</a>
            


        </div>
    </div>
</div>

    


</div>


</div>
</body>
</html>