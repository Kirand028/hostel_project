<?php
session_start();
@$us=$_SESSION['us'];

$message="";
$sroll="";
$ssroll="";
//variables
$fname="";
$lname="";
$fmname="";
$dob="";
$blood="";
$gender="GENDER";
$caste="";
$adhar="";

$clgname="";
$regno="";
$course="COURSE";
$rollno="";
$coursedur="";
$pymark="";
$joindate="";
$stay="";

$mobno="";
$pmobno="";
$regemail="";
$paddress="";
$country="";
$state="";
$district="";
$pincode="";
$old_room="";
$student_status="";

//connection
$con=new mysqli("localhost","root","","hostel");
if($con->connect_error)
{
    echo"<script>alert('Could Not Connect');</script>";
    // exit;
    echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
}


if(isset($_POST['search']))
{
    $sroll=$_POST['sroll'];
    $ssroll=strval($sroll);
    if($ssroll=="")//checking if search box is empty
    {
        $message='<b style="color:rgba(256,0,0,1);"><i class="fa fa-warning"> </i> Enter the Register number in search box to Update</b>';
    }
    else
    {
        $qry="select * from stregister where regno='".$sroll."' and student_status='ACTIVE'";
        $rslt=$con->query($qry);
        if($rslt->num_rows<=0)//finding the student
        {
            $message='<b style="color:rgba(256,0,0,1);"><i class="fa fa-warning"> </i> Student with that Register number not found</b>';
        }
        else
        {   
            $message='<b style="color:green;"><i class="fa fa-check-circle"> </i> Record Found</b>';
            $r=$rslt->fetch_assoc();

            $fname=$r['fname'];
            $lname=$r['lname'];
            $fmname=$r['fmname'];
            $dob=$r['dob'];
            $blood=$r['blood'];
            $gender=$r['gender'];
            $caste=$r['caste'];
            $adhar=$r['adhar'];

            $clgname=$r['clgname'];
            $regno=$r['regno'];
            $course=$r['course'];
            $rollno=$r['rollno'];
            $coursedur=$r['coursedur'];
            $pymark=$r['pymark'];
            $joindate=$r['joindate'];
            $stay=$r['stay'];

            $mobno=$r['mobno'];
            $pmobno=$r['pmobno'];
            $regemail=$r['email'];
            $paddress=$r['paddress'];
            $country=$r['country'];
            $state=$r['state'];
            $district=$r['district'];
            $pincode=$r['pincode'];
            $old_room=$r['roomno'];
            $student_status=$r['student_status'];
            
            $_SESSION['old_roomid']=$old_room;

            $avrmqry="select * from mroom where roomfor='".$gender."' and status='AVAILABLE'";
            $avrm=$con->query($avrmqry);
            $nor=$avrm->num_rows;

        }
    }

}
if(isset($_POST['update']))
{
    $fname=$_POST['fname'];
    $regemail=$_POST['regemail'];
    if($regemail=="")//cannot update directly
    {
        $message='<b style="color:rgba(256,0,0,1);"><i class="fa fa-warning"> </i> Please Search the Register number to Update</b>';
    }
    else
    {
        

        $lname=$_POST['lname'];
        $fmname=$_POST['fmname'];
        $dob=$_POST['dob'];
        $blood=$_POST['blood'];
        $gender=$_POST['gender'];
        $caste=$_POST['caste'];
        $adhar=$_POST['adhar'];

        $clgname=$_POST['clgname'];
        $regno=$_POST['regno'];
        $course=$_POST['course'];
        $rollno=$_POST['rollno'];
        $coursedur=$_POST['coursedur'];
        $pymark=$_POST['pymark'];
        $joindate=$_POST['joindate'];
        $stay=$_POST['stay'];


        $mobno=$_POST['mobno'];
        $pmobno=$_POST['pmobno'];
        // $regemail=$_POST['regemail'];
        $paddress=$_POST['paddress'];
        $country=$_POST['country'];
        $state=$_POST['state'];
        $district=$_POST['district'];
        $pincode=$_POST['pincode'];
        $room=$_POST['room'];


        //converting int to string
        $adh=strval($adhar);
        $reg=strval($regno);
        $roll=strval($rollno);
        $cd=strval($coursedur);
        $mark=strval($pymark);
        $st=strval($stay);
        $mb=strval($mobno);
        $pmb=strval($pmobno);
        $pin=strval($pincode);

        

        if($fname==""||$lname==""||$fmname==""||$dob==""||$blood==""||$gender==""||$caste==""||$adh==""||$clgname==""
        ||$reg==""||$course==""||$roll==""||$cd==""||$mark==""||$joindate==""||$st==""||$mb==""
        ||$pmb==""||$regemail==""||$paddress==""||$country==""||$state==""||$district==""||$pin=="")
        //can't update null values
        {
            $message='<b style="color:rgba(256,0,0,1);"><i class="fa fa-warning"> </i> Please fill out all the field</b>';
        }
        else
        {
            $sqry="select * from stregister where email='".$regemail."'";
            $srslt=$con->query($sqry);
            $sr=$srslt->fetch_assoc();
            $old_roomid=$sr['roomno'];

            // echo"<script>alert('".$old_roomid."')</script>";
            if($room!=$old_roomid)
            {

                $rqry="select * from mroom where roomno='".$old_roomid."'";
                $rrslt=$con->query($rqry);

                $s1=$rrslt->fetch_assoc();
                @$total_filled=$s1['filled'];
                @$tot_fill=$total_filled;
                @$room_status=$s1['status'];
                @$room_seater=$s1['seater'];
                $total_filled=$total_filled-1;

                $r2qry="select * from mroom where roomno='".$room."'";
                $rr2slt=$con->query($r2qry);

                $s2=$rr2slt->fetch_assoc();
                @$tot_fill= $s2['filled'];
                @$newroom_seater=$s2['seater'];

                $abc=$_SESSION['old_roomid'];
                // echo"<script>alert('".$room_id,$room_status,$total_filled."');</script>";
                if($abc=="Not Assigned")
                {
                    if($newroom_seater==4)
                    {
                        if($tot_fill==3)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill<=2||$tot_fill>=0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);
                        }
                    }
                    elseif($newroom_seater==3)
                    {
                        if($tot_fill==2)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill<2||$tot_fill>=0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);
                        }
                    }
                    elseif($newroom_seater==2)
                    {
                        if($tot_fill==1)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill==0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                    }
                    elseif($newroom_seater==1)
                    {
                        if($tot_fill==0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                    }
                    
                }
                elseif($room_status=='FULL')
                {
                    $urqry="update mroom set filled='$total_filled', status='AVAILABLE' where roomno='".$old_roomid."'";
                    $con->query($urqry);

                    if($newroom_seater==4)
                    {
                        if($tot_fill==3)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill<=2||$tot_fill>=0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);
                        }
                    }
                    elseif($newroom_seater==3)
                    {
                        if($tot_fill==2)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill<2||$tot_fill>=0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);
                        }
                    }
                    elseif($newroom_seater==2)
                    {
                        if($tot_fill==1)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill==0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                    }
                    elseif($newroom_seater==1)
                    {
                        if($tot_fill==0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                    }

                }
                else
                {
                    $urqry="update mroom set filled='$total_filled' where roomno='".$old_roomid."'";
                    $con->query($urqry);

                    if($newroom_seater==4)
                    {
                        if($tot_fill==3)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill<=2||$tot_fill>=0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);
                        }
                    }
                    elseif($newroom_seater==3)
                    {
                        if($tot_fill==2)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill<2||$tot_fill>=0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);
                        }
                    }
                    elseif($newroom_seater==2)
                    {
                        if($tot_fill==1)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                        elseif($tot_fill==0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                    }
                    elseif($newroom_seater==1)
                    {
                        if($tot_fill==0)
                        {
                            $tot_fill+=1;
                            $urqry="update mroom set filled='$tot_fill', status='FULL' where roomno='".$room."'";
                            $con->query($urqry);   
                        }
                    }

                }
                
            }

            $ruqry="update stregister set fname='".$fname."',lname='".$lname."',fmname='".$fmname."',dob='".$dob."',
            blood='".$blood."',gender='".$gender."',caste='".$caste."',adhar='".$adhar."',clgname='".$clgname."',
            regno='".$regno."',course='".$course."',rollno='".$rollno."',coursedur='".$coursedur."',pymark='".$pymark."',
            joindate='".$joindate."',stay='".$stay."',mobno='".$mobno."',pmobno='".$pmobno."',paddress='".$paddress."',
            country='".$country."',state='".$state."',district='".$district."',pincode='".$pincode."',roomno='".$room."' 
            where email='".$regemail."'";
            $rslt=$con->query($ruqry);
            if($rslt)
            {

                $logqry="update loginidtb set userid='$regno' where usermail='$regemail'";
                $con->query($logqry);

                $message='<b style="color:green;"><i class="fa fa-check-circle"> </i> Record Updated</b>';
                $fname="";
                $lname="";
                $fmname="";
                $dob="";
                $blood="";
                $gender="GENDER";
                $caste="";
                $adhar="";
                
                $clgname="";
                $regno="";
                $course="COURSE";
                $rollno="";
                $coursedur="";
                $pymark="";
                $joindate="";
                $stay="";
                
                $mobno="";
                $pmobno="";
                $regemail="";
                $paddress="";
                $country="";
                $state="";
                $district="";
                $pincode="";    
                
                

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
    <link rel="stylesheet" href="updatestudent.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>Document</title>

    <style>
    input{
        text-transform: uppercase;
    }
</style>
        <script>
            function vInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^a-zA-Z]/g, '');
        input.value = sanitizedValue;
        }
        function veInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^a-zA-Z0-9]/g, '');
        input.value = sanitizedValue;
        }
        function vbInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^a-zA-Z+-]/g, '');
        input.value = sanitizedValue;
        }
        
        function vsInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^a-zA-Z0-9 ]/g, '');
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
<h1 class="h1">Update Student</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<form method="post" action="" autocomplete="off">
<label style="margin-left:290px;"><?php echo $message; ?></label>
<div class="search">
   <input type="text" name="sroll" placeholder="SEARCH REGISTER NO" oninput="veInput(event)">
   <button name="search" ><i class="fas fa-search"></i></button>
</div>





<div class="container">

        <!-- <div class="logo">
        <h1 class="hdng">REGISTER</h1>
        </div> -->

        <div class="pd">

            <div class="pdalign">


                    <input class="name" type="text" value="<?php echo $fname; ?>" name="fname" placeholder="FIRST NAME" oninput="vInput(event)">
                    <input class="fname" type="text" value="<?php echo $lname; ?>" name="lname" placeholder="LAST NAME" oninput="vInput(event)">
                    <input class="fname" type="text" value="<?php echo $fmname; ?>" name="fmname" placeholder="FATHER/MOTHER NAME" oninput="vInput(event)">
                    <input class="dob" type="date" value="<?php echo $dob; ?>" name="dob" title="BIRTH DATE" placeholder="DATE OF BIRTH" >
                    <input class="name" type="text" value="<?php echo $blood; ?>" name="blood" placeholder="BLOOD GROUP" oninput="vbInput(event)">
                    <select class="selalgn" name="gender"  title="Select Gender">
                    <!-- <input class="fname" type="text" placeholder="GENDER"> -->
                    <option><?php echo $gender; ?></option>
                    <?php 
                        if($gender=="MALE")
                        {
                            echo"<option >FEMALE</option>";
                        }
                        else
                        {
                            echo"<option >MALE</option>";
                        }

                    ?>
                </select>
                    <input class="fname" type="text" placeholder="CASTE" value="<?php echo $caste; ?>" name="caste" oninput="vInput(event)">
                
                <input class="fname" type="number"  value="<?php echo $adhar; ?>" min="100000000000" max="999999999999" placeholder="AADHAR NUMBER" name="adhar" >

            
            </div>
            
            
        </div>

        </div>
        <div class="eq">
            <div class="eqalign">
            <input class="name" type="text" value="<?php echo $clgname; ?>" placeholder="COLLEGE NAME" name="clgname" oninput="vsInput(event)">
            <input class="fname" type="text" value="<?php echo $regno; ?>" placeholder="REGISTER NUMBER" name="regno" oninput="veInput(event)">
            
            <select id="" name="course" title="Select Course">
                <option><?php echo $course; ?></option>
                    <?php 
                        if($course=="BCA")
                        {
                            echo"<option >BBA</option>";
                            echo"<option >BCOM</option>";
                            echo"<option >BSC</option>";
                            echo"<option >BA</option>";
                        }
                        elseif($course=="BBA")
                        {
                            echo"<option >BCA</option>";
                            echo"<option >BCOM</option>";
                            echo"<option >BSC</option>";
                            echo"<option >BA</option>";
                        }
                        elseif($course=="BCOM")
                        {
                            echo"<option >BBA</option>";
                            echo"<option >BCA</option>";
                            echo"<option >BSC</option>";
                            echo"<option >BA</option>";
                        }
                        elseif($course=="BSC")
                        {
                            echo"<option >BBA</option>";
                            echo"<option >BCA</option>";
                            echo"<option >BCOM</option>";
                            echo"<option >BA</option>";
                        }
                        elseif($course=="BA")
                        {
                            echo"<option >BBA</option>";
                            echo"<option >BCA</option>";
                            echo"<option >BCOM</option>";
                            echo"<option >BSC</option>";
                        }
                    ?>
                </select>
            
                <input class="fname" type="text" value="<?php echo $rollno; ?>" placeholder="ROLL NUMBER" name="rollno" oninput="veInput(event)">
                <input class="name" type="number" value="<?php echo $coursedur; ?>" min="1" max="4" placeholder="  COURSE DURATION" name="coursedur" >
                <input class="fname" type="number" value="<?php echo $pymark; ?>" min="35" max="100" placeholder="LAST YEAR MARKS(%)" name="pymark" >
                <input class="join" type="text" value="<?php echo $joindate; ?>" title="JOINING DATE" placeholder="JOINING DATE" name="joindate" readonly>
                <input class="fname" type="text" value="<?php echo $stay; ?>"  placeholder="CHECKOUT DATE" name="stay" readonly>
                <select name="room" id="sroom" style="text-transform:uppercase;">
                <option value="<?php echo $old_room; ?>">Room-><?php echo $old_room; ?></option>
                    <?php
                              for($i=0;$i<$nor;$i++)
                              {
                                  $r=$avrm->fetch_assoc();
                                  $av[$i]=$r['roomno'];
                                  echo'<option style="text-transform:uppercase;">'.$av[$i].'</option>';
                              }
                    ?>
                </select>

                </div>
                
        </div>
        <div class="ad">
            <div class="adalign">
                
                    <input class="name" type="number" value="<?php echo $mobno; ?>" min="1000000000" max="9999999999" placeholder="MOBILE NUMBER" name="mobno" >
                    <input class="fname" type="number" value="<?php echo $pmobno; ?>" min="1000000000" max="9999999999" placeholder="PARENT'S MOB NO" name="pmobno" >
                    <input class="dob" type="email" value="<?php echo $regemail; ?>" placeholder="EMAIL" name="regemail" readonly>
                    <input class="fname" type="text" value="<?php echo $paddress; ?>" placeholder="PERMANENT ADDREESS" name="paddress" oninput="vsInput(event)">
                    <input class="name" type="text" value="<?php echo $country; ?>" placeholder="COUNTRY" name="country" oninput="vInput(event)">
                    <input class="fname" type="text" value="<?php echo $state; ?>" placeholder="STATE" name="state" oninput="vInput(event)">
                    <input class="dob" type="text" value="<?php echo $district; ?>" placeholder="DISTRICT" name="district" oninput="vInput(event)">
                    <input class="fname" type="number" value="<?php echo $pincode; ?>" min="100000" max="999999" placeholder="PINCODE" name="pincode" >
                </div>
                
        </div>
    

        <!-- <div class="balgn">
        <button class="signin">SIGN IN</button>
        <button class="back">BACK</button>
    </div> -->
        
</div>


          

            <div class="button" name="button"></div>
            <button class="btn1" name="update">UPDATE</button>
            </form>
            <a class="btn2" href="managestudent.html">BACK</a>
            


        </div>
    </div>
</div>

    


</div>


</div>
</body>
</html>