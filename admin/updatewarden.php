<?php
    $message="";
    $wid="";
    $wname="";
    $wgender="GENDER";
    $wage="";
    $wadhar="";
    $waddress="";
    $phone="";
    $email="";
    $waid="";
    $widd="";
    // $wno="";
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
        $waid="";
        $wid=$_POST['wid'];    
        // $_SESSION['wno']=$wid;
        $ro=strval($wid);
        if($ro=="")
        {
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Enter the Warden Id in the search box</b>';
        }
        else
        {
            // $_SESSION['dtrno']=$roomno;
            $qry="select * from warden where wid='".$wid."'";
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
                $message='<b style="color:green;"><i class="fas fa-circle-check"> </i> Record found</b>';
            }
            else
            {
                $wid="";
                $message='<b style="color:red;"><i class="fas fa-warning"> </i> Warden with that id not found</b>';
            }
        }
    }
    if(isset($_POST['update']))
    {
        $widd=$_POST['widd'];
        $wname=$_POST['wname'];
        $wgender=$_POST['wgender'];
        $wage=$_POST['wage'];
        $wadhar=$_POST['wadhar'];
        $waddress=$_POST['waddress'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        // $wno=$_SESSION['wno'];
        if($widd=="")
        {
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Enter the Warden ID in the search box to update</b>';
        }
        else
        {
                if($widd==""||$wname==""||$wgender==""||$wage==""||$wadhar==""||$waddress==""||$phone==""||$email=="")
                {
                     $message='<b style="color:red;"><i class="fas fa-warning"> </i> Enter all the field</b>';
                }
                else
                {
                    $qry="update warden set wname='$wname',wgender='$wgender',wage='$wage',wadhar='$wadhar',
                                            waddress='$waddress',phone='$phone',email='$email' where wid='$widd'";
                    $uq=$con->query($qry);
                    if($uq)
                    {
                        $message='<b style="color:green;"><i class="fas fa-circle-check"> </i> Warden profile updated successfully</b>';
                        $wid="";
                        $wname="";
                        $wgender="GENDER";
                        $wage="";
                        $wadhar="";
                        $waddress="";
                        $phone="";
                        $email="";
                        $waid="";
                        $widd="";
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
    <link rel="stylesheet" href="updatewarden.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>Document</title>
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
<h1 class="h1">Update Warden</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<form method="post" action="" autocomplete="off">
<label class="lk" style="color:gray;"><?php echo $message; ?></label>

<div class="search">
   <input type="text" placeholder="SEARCH" name="wid" oninput="veInput(event)">
   <button name="search"><i class="fas fa-search"></i></button>
</div>





<div class="container">

    
        <!-- <div class="logo">
        <h1 class="hdng">REGISTER</h1>
        </div> -->

       

        
        <div class="eq">
            <div class="eqalign">
                <input name="widd" value="<?php echo $wid; ?>" type="text" placeholder="WARDEN ID" readonly >
            <input  name="wname" type="text" value="<?php echo $wname; ?>" placeholder="WARDEN NAME" oninput="vInput(event)">
            <select name="wgender" id="">
            <option><?php echo $wgender; ?></option>
               <?php
                if($wgender=="FEMALE")
                {
                    echo"<option>MALE</option>";
                }
                elseif($wgender=="MALE")
                {
                    echo"<option>FEMALE</option>";
                }
                ?>
            </select>
        <input type="number" name="wage" value="<?php echo $wage; ?>" placeholder="AGE" min="25" max="60">
        <input type="number" name="wadhar" value="<?php echo $wadhar; ?>" min="100000000000" max="999999999999" placeholder="  AADHAR number">
        <input type="text" name="waddress" value="<?php echo $waddress; ?>" placeholder="address" oninput="veInput(event)">
        <input type="number" name="phone" value="<?php echo $phone; ?>" min="1000000000" max="9999999999" placeholder="phone no">
        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="email" oninput="vemInput(event)">
                
                </div>
                
        </div>
       
    

        <!-- <div class="balgn">
        <button class="signin">SIGN IN</button>
        <button class="back">BACK</button>
    </div> -->
        
</div>


          

            <div class="button"></div>
            <button class="btn1" name="update">UPDATE</button>
            </form>
            <button class="btn2" onclick="funback();">BACK</button>
            


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
    function vInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^a-zA-Z ]/g, '');
        input.value = sanitizedValue;
        }
        function veInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^a-zA-Z0-9 ]/g, '');
        input.value = sanitizedValue;
        }
        
        function vemInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^@.a-zA-Z0-9]/g, '');
        input.value = sanitizedValue;
        }

        </script>

</html>