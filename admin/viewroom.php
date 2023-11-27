<?php
    $message="";
    session_start();
    @$us=$_SESSION['us'];

    $con=new mysqli("localhost","root","","hostel");
        if($con->connect_error)
        {
            echo"<script>alert('Could Not Connect');</script>";
            // exit;
            echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
        }
        
        


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewroom.css">
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
<h1 class="h1">View Rooms</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<input type="text" id="searchInput" class="searchInput" placeholder="Search...">

<!-- <div class="cardcontainer">

<div class="card"> -->

    
     
            
        <div class="tableheading">
         <div class="heading">
                <label class="l1" for="">ROOM NUMBER</label>
                <label class="l2" for="">TOTAL SEATS</label>
                <label class="l3" for="">STATUS</label>
                <label class="l4" for="">GENDER</label>

                </div>
                </div>
                <div class="card">
                <table style="text-transform:uppercase;" id="myTable">
        <?php 
                   
                    $qry="select * from mroom WHERE roomno <> 'Not assigned'";
                    $idrslt=$con->query($qry);
                    $norow=$idrslt->num_rows;
                    
                    for($i=0;$i<$norow;$i++)
                    {
                        $r=$idrslt->fetch_assoc();
  
                        echo '<tr class="tr">';
                        echo '<td class="rn1">' . $r["roomno"] . '</td>';
                        echo '<td class="ts1">' . $r["filled"] . '/' . $r["seater"] . '</td>';
                        echo '<td class="st1">' . $r["status"] . '</td>';
                        echo '<td class="gn1">' . $r['roomfor'] . '</td>';
                        echo '<style>tr:hover{ color:green;}</style>';
                        echo '</tr>';
                        
                       
                    }

           ?>
        
        </table>
        </div>
    </div>
    
</div>
<a class="btn2" href="manageroom.html">BACK</a>
    





</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('myTable');
    const tableRows = table.getElementsByTagName('tr');

searchInput.addEventListener('input', function() {
  const filter = searchInput.value.toLowerCase();

  for (let i = 0; i < tableRows.length; i++) {
    const row = tableRows[i];
    const rowData = row.getElementsByTagName('td');
    let shouldShowRow = false;

    for (let j = 0; j < rowData.length; j++) {
      const cell = rowData[j];
      if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
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