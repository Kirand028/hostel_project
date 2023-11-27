<?php
        session_start();
        //$gend=$_SESSION['gen'];
        
        $con=new mysqli("localhost","root","","hostel");
        if($con->connect_error)
        {
          echo"<script>alert('Could Not Connect');</script>";
        //   exit;
          echo"<script>window.location.href='home.html';</script>";
        }
        // @$us=$_SESSION['us'];
        if(isset($_GET['username']))
        {
            @$us=$_GET['username'];
        }

        $qry="select * from warden where wid='".$us."' or email='".$us."'";
        $rslt=$con->query($qry);
        $r=$rslt->fetch_assoc();
    
        $nam=$r['wname'];
        $emid1=$r['email'];
    
        // $pa=$_SESSION['pa']
        if($us=="")
        {
            echo"<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
        }

        // @$userid=$_SESSION['us'];
        @$userid=$us;
        $bqry="select * from warden where email='".$userid."' or wid='".$userid."'"; 
        $srslt=$con->query($bqry);
        if($srslt)
        {
            $f=$srslt->fetch_assoc();
            @$uid=$f['email'];
            $gender=$f['wgender'];
        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewall.css">
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
        <h1>WARDEN</h1>
    </div>

    <div class="sidebar">
        <div class="info" style="overflow:hidden;">
            <div class="img"></div>
            <labe class="hiadmin">Hi,<span><?php echo ucfirst($nam); ?></span></label>
            <div class="emma"><label class="email" for=""><?php echo $emid1; ?></label></div>
        </div>
    <div class="menu">
        

            <a href="wardendashboard.php?username=<?= $us ?>" ><i class="fas fa-dashboard"></i>  DASHBOARD </a>
            <a href="viewall.php?username=<?= $us ?>" >  <i  class="fas fa-user-graduate"></i> <label > VIEW STUDENT </label> </a>
            <a href="myprofile.php?username=<?= $us ?>"><i class="fas fa-user-tie"></i> MY PROFILE</a>
           
            <!-- <a href="manageroom.html"><i class="fas fa-hotel"></i>  MANAGE ROOMS</a> -->
            <a href="managefood.php?username=<?= $us ?>"><i class="fas fa-pizza-slice"></i>  MANAGE FOODS</a>
            <a href="manageevent.php?username=<?= $us ?>"><i class="fas fa-calendar"></i>  MANAGE EVENTS</a>
            <!-- <a href="spayment.php"><i class="fas fa-money-check-alt"></i>  PAYMENT</a> -->
            <a href="cal_mealfee.php?username=<?= $us ?>"><i class="fas fa-hamburger"></i>  MEAL FEES</a>
            
    </div>
</div>

<div class="navbar">
<h1 class="h1">View All</h1>



<a  class="logout" href="http://localhost/hostel/home/home.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>
<form action="" method="post">

<button class="view" name="current" style="top: 50px;left:510px;width: 170px;">CURRENT</button>
<button class="vi" name="old" style="top: 50px;right:-80px;">OLD</button>


<!-- <div class="cardcontainer">

<div class="card"> -->

    
     
       

                <div class="card" style="top: 130px;">
                <table style="text-transform:uppercase;" id="myTable">


                         
        <div class="tableheading">
            <div class="heading">
                   <label class="l1" for="">REGISTER NO</label>
                   <label class="l2" for="">NAME</label>
                   <label class="l3" for="">COURSE</label>
                   <label class="l4" for="">PHONE NO</label>
                   <label class="l5" for="">EMAIL ID</label>
                   <label class="l6" for="">ROOM NO</label>

                   </div>
                   </div>
                   <!-- <p  style="margin-top:200px; margin-left:430px;font-size:20px;" class="" for="">Gombli Matti Gombli Matti</p> -->
                   <?php

                   if(isset($_POST['current']))
                   {
                   $qry="select * from stregister where gender='".$gender."' and student_status='ACTIVE'";
                    $idrslt=$con->query($qry);

                    // $rrqry="select * from mroom where roomfor='MALE'";
                    // $drslt=$con->query($rrqry);

                    $norow=$idrslt->num_rows;
                    for($i=0;$i<$norow;$i++)
                    {
                        $r=$idrslt->fetch_assoc();
                        // $sk=$drslt->fetch_assoc();
                  
                        echo'<tr class="tr">';
                        echo'<td class="rollno" >'.$r["regno"].'</td>';
                        echo'<td class="name">'.$r["fname"].'  '.$r["lname"].'</td>';
                        echo'<td class="course">'.$r['course'].'</td>';
                        echo'<td class="phone">'.$r['mobno'].'</td>';
                        echo'<td class="email1">'.$r['email'].'</td>';
                        echo'<td class="adress">'.$r['roomno'].'</td>';
                        echo'<style>tr:hover{ color:green;}</style>';
                        echo"</tr>";
                    }
                }
                elseif(isset($_POST['old']))
                {
                    $qry="select * from stregister where gender='".$gender."' and student_status='OLD_STUDENT'";
                    $idrslt=$con->query($qry);

                    // $rrqry="select * from mroom where roomfor='MALE'";
                    // $drslt=$con->query($rrqry);

                    $norow=$idrslt->num_rows;
                    for($i=0;$i<$norow;$i++)
                    {
                        $r=$idrslt->fetch_assoc();
                        // $sk=$drslt->fetch_assoc();
                  
                        echo'<tr class="tr">';
                        echo'<td class="rollno" >'.$r["regno"].'</td>';
                        echo'<td class="name">'.$r["fname"].'  '.$r["lname"].'</td>';
                        echo'<td class="course">'.$r['course'].'</td>';
                        echo'<td class="phone">'.$r['mobno'].'</td>';
                        echo'<td class="email1">'.$r['email'].'</td>';
                        echo'<td class="adress">'.$r['roomno'].'</td>';
                        echo'<style>tr:hover{ color:green;}</style>';
                        echo"</tr>";
                    }

                }   
                else
                {
                    $qry="select * from stregister where gender='".$gender."' and student_status='ACTIVE'";
                    $idrslt=$con->query($qry);

                    // $rrqry="select * from mroom where roomfor='MALE'";
                    // $drslt=$con->query($rrqry);

                    $norow=$idrslt->num_rows;
                    for($i=0;$i<$norow;$i++)
                    {
                        $r=$idrslt->fetch_assoc();
                        // $sk=$drslt->fetch_assoc();
                  
                        echo'<tr class="tr">';
                        echo'<td class="rollno" >'.$r["regno"].'</td>';
                        echo'<td class="name">'.$r["fname"].'  '.$r["lname"].'</td>';
                        echo'<td class="course">'.$r['course'].'</td>';
                        echo'<td class="phone">'.$r['mobno'].'</td>';
                        echo'<td class="email1">'.$r['email'].'</td>';
                        echo'<td class="adress">'.$r['roomno'].'</td>';
                        echo'<style>tr:hover{ color:green;}</style>';
                        echo"</tr>";
                    }
                }
                    ?>
        
        </table>
    </div>
                
    </form>


<a class="btn2" href="wardendashboard.php?username=<?= $us ?>">BACK</a>
    

</div>

<input type="text" id="searchInput" placeholder="Search..." class="searchInput">
<script>
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('myTable');
    const tableRows = table.getElementsByClassName('tr');

    searchInput.addEventListener('input', function() {
        const filter = searchInput.value.toLowerCase();

        for (let i = 0; i < tableRows.length; i++) {
            const row = tableRows[i];
            const rowData = row.getElementsByTagName('td');
            let shouldShowRow = false;

            for (let j = 0; j < rowData.length; j++) {
                const cell = rowData[j];
                if (cell.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    shouldShowRow = true;
                    break;
                }
            }

            if (shouldShowRow) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
</script>

</body>
</html>