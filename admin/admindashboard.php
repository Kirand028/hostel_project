<?php
    session_start();
    //$gend=$_SESSION['gen'];
    $con=new mysqli("localhost","root","","hostel");
    if($con->connect_error)
    {
      echo"<script>alert('Could Not Connect');</script>";
      echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
    }

    @$us=$_SESSION['usn'];
    // $pa=$_SESSION['pa']

    $roomqry1="INSERT IGNORE INTO mroom (roomno, seater, roomfor, status, filled)
            VALUES ('Not Assigned', 0, 'none', 'none', 0)";
    $con->query($roomqry1);
    
    //number of student
    $qry="select * from stregister";
    $stc=$con->query($qry);
    $stcount=$stc->num_rows;

    //number of Boys
    $qry="select * from stregister where gender='MALE'";
    $stb=$con->query($qry);
    $stboys=$stb->num_rows;

    //number of Boys
    $qry="select * from stregister where gender='FEMALE'";
    $stg=$con->query($qry);
    $stgirls=$stg->num_rows;

    //number of available rooms
    $qry="select * from mroom where status='AVAILABLE'";
    $availmroom=$con->query($qry);
    $availroomcount=$availmroom->num_rows;

    //number of rooms
    $qry="select * from mroom where roomno <> 'Not Assigned'";
    $mroom=$con->query($qry);
    $roomcount=$mroom->num_rows;

    //number of boys and girls rooms
    $qry="select * from mroom where roomfor='MALE'";
    $mroomb=$con->query($qry);
    $broomcount=$mroomb->num_rows;

    $qry="select * from mroom where roomfor='FEMALE'";
    $mroomg=$con->query($qry);
    $groomcount=$mroomg->num_rows;


    //NUMBER OF FILLED BOYS AND GIRLS ROOMS 
    $qry="select * from mroom where status='FULL' and roomfor='MALE'";
    $mroombf=$con->query($qry);
    $bfroomcount=$mroombf->num_rows;

    $qry="select * from mroom where status='FULL' and roomfor='FEMALE'";
    $mroomgf=$con->query($qry);
    $gfroomcount=$mroomgf->num_rows;


    //no of wardens
    $qry="select * from warden";
    $warden=$con->query($qry);
    $total_warden=$warden->num_rows;



    //number of male warden
    $qry="select * from warden where wgender='MALE'";
    $mwarden=$con->query($qry);
    $malewarden=$mwarden->num_rows;

    //number of female warden
    $qry="select * from warden where wgender='FEMALE'";
    $fwarden=$con->query($qry);
    $femalewarden=$fwarden->num_rows;

    // Updating student if their checkout date is over
    $todayDate = date('Y-m-d');
    
    // echo"<script>alert('".$todayDate."');</script>";

    $cod_check="select * from stregister where stay='$todayDate' and student_status='ACTIVE'";
    $cod_res=$con->query($cod_check);

    if($cod_res->num_rows>0)
    {
        for($i=0;$i<$cod_res->num_rows;$i++)
        {
            $up_res=$cod_res->fetch_assoc();
            $stemail=$up_res['email'];
            $stayin=$up_res['stay'];
            $roomnumber=$up_res['roomno'];
            // echo"<script>alert('".$stemail,$stayin."');</script>";
            $up_st="update stregister set student_status='OLD_STUDENT' where email='".$stemail."'";
            if($up_st_res=$con->query($up_st))
            {
                $abc="select * from mroom where roomno='$roomnumber'";
                $mrs=$con->query($abc);
                $mrrs=$mrs->fetch_assoc();
                $rm=$mrrs['filled'];
                $rm=$rm-1;
                $uroom="update mroom set filled='$rm' where roomno='$roomnumber'";
                $con->query($uroom);
            }
            
        }
    }

    //if student failed to pay
    
    $dqry="DELETE FROM stregister WHERE email NOT IN (SELECT email from payment)";
    $con->query($dqry)
                

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dash.css">
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
        <div class="info">
            <div class="img"></div>
            <labe class="hiadmin">Hi,<span>Admin</span></label>
            <div class="emma"><label class="email" for="">dkiran@gmail.com</label></div>
        </div>
        <div class="menu">
        

            <a href="admindashboard.php" class="active"><i class="fas fa-home"></i>  DASHBOARD</a>
            <a href="managestudent.html"><i class="fas fa-user"></i>  MANAGE STUDENT</a>
            <a href="managewarden.html"><i class="fas fa-user-tie"></i>  MANAGE WARDEN</a>
           
            <a href="manageroom.html" ><i class="fas fa-chair"></i>  MANAGE ROOM</a>
            <a href="managefood.php"><i class="fas fa-burger"></i>  MANAGE FOOD</a>
            <a href="manageevent.php"><i class="fas fa-calendar"></i>  MANAGE EVENT</a>
            <a href="spayment.php"><i class="fas fa-bank"></i>  PAYMENT</a>
        
            
    </div>
</div>

<div class="navbar">
<h1 class="h1">Dashboard</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<div class="cards">
    <div class="card1">
        <i class="fas fa-user-circle"></i>
        <h1><?php echo $stcount; ?></h1>
        <label>Total No Of Students</label>
    </div>
    <div class="card2">
        <i class="fas fa-user"></i>
        <h1><?php echo $total_warden; ?></h1>
        <label>Total No Of Wardens</label>
    </div>
    <div class="card3">
        <i class="fas fa-bed"></i>
        <h1><?php echo $roomcount; ?></h1>
        <label>Total No Of Rooms</label>
    </div>
    <div class="card4">
        <i class="fas fa-bed"></i>
        <h1><?php echo $availroomcount;?></h1>
        <label>Available Rooms</label>
    </div>
</div>

<div class="cd">
    <div class="cd1">
        <label class="student" for="">STUDENTS</label>
        <i class="fas fa-male"></i>
        <label class="boys" for=""><?php echo $stboys;?></label>
        <label class="bdata"for="">BOYS</label>
        <div class="div"></div>
        <i class="fas fa-female"></i>
        <label class="girls" for=""><?php echo $stgirls;?></label>
        <label class="gdata"for="">GIRLS</label>
    </div>
    <div class="cd2">
        <label class="student" for="">WARDENS</label>
        <i class="fas fa-male"></i>
        <label class="boys" for=""><?php echo $malewarden ; ?></label>
        <label class="bdata"for="">MALE</label>
        <div class="div"></div>
        <i class="fas fa-female"></i>
        <label class="girls" for=""><?php echo $femalewarden; ?></label>
        <label class="gdata"for="">FEMALE</label>
    </div>
    <div class="cd3">
        <label class="student" for="">ROOMS</label>
        <i class="fas fa-male"></i>
        <label class="boys" for=""><?php echo $broomcount; ?></label>
        <label class="bdata"for="">BOYS</label>
        <div class="div"></div>
        <i class="fas fa-female"></i>
        <label class="girls" for=""><?php echo $groomcount; ?></label>
        <label class="gdata"for="">GIRLS</label>
    </div>
    <div class="cd4">
        <label class="student" for="">ROOMS</label>
        <i class="fas fa-male"></i>
        <H1>FILLED</H1>
        <label class="boys" for=""><?php echo $bfroomcount;?></label>
        <label class="bdata"for="">BOYS</label>
        <div class="div"></div>
        <i class="fas fa-female"></i>
        <label class="girls" for=""><?php echo $gfroomcount;?></label>
        <label class="gdata"for="">GIRLS</label>
    </div>
</div>
</body>
</html>