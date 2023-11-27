<?php
    $message="";
    session_start();
    @$us=$_SESSION['us'];

    $con=new mysqli("localhost","root","","hostel");
        if($con->connect_error)
        {
            // echo"could not connect";
            echo"<script>alert('Could Not Connect');</script>";
            // exit;
            echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
        }
        
        // Set number of images to display per page
        // $imagesPerPage = 6;

        // Get total number of images in database
        // $totalImagesQuery = $con->query("SELECT COUNT(*) as count FROM warden");
        // $totalImages = $totalImagesQuery->fetch_assoc()['count'];

        // Calculate number of pages needed
        // $totalPages = ceil($totalImages / $imagesPerPage);


        // Get current page number
        // if (isset($_GET['page'])) 
        // {
        //     $currentPage = $_GET['page'];
        // }
        // else
        // {
        //     $currentPage = 1;
        // }

        // // Calculate starting image index for current page
        // $startingImageIndex = ($currentPage-1) * $imagesPerPage;

        // // Fetch images for current page
        // $imagesQuery = $con->prepare("SELECT * FROM warden ORDER BY wid DESC LIMIT ?, ?");
        // $imagesQuery->bind_param("ii", $startingImageIndex, $imagesPerPage);
        // $imagesQuery->execute();
        // $imagesResult = $imagesQuery->get_result();        
            $qry="select * from warden";
            $rslt=$con->query($qry);


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewallW.css">
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
        <h1>ADMIN</h1>
    </div>

    <div class="sidebar">
        <div class="info" style="overflow:hidden;">
            <div class="img"></div>
            <labe class="hiadmin">Hi,<span>Admin</span></label>
            <label class="email3" for="">dkiran@gmail.com</label>
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
        <h1 class="h1">View All</h1>

        <form action="" method="post">

        <!-- <button class="view" name="male" style="top: 50px;left:510px;">MALE</button> -->
        <!-- <button class="vi" name="female" style="top: 50px;right:-163px;">FEMALE</button> -->

        <a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
    </div>

   
    <input type="text" id="searchInput" class="searchInput" placeholder="Search...">       
                  
            
            <div class="card" style="top: 150px;">
            <table style="text-transform:uppercase;" id="myTable">                
                    
            <div class="tableheading">
                <div class="heading">
                   <label class="l1" for="">ID</label>
                   <label class="l2" for="">NAME</label>
                   <label class="l3" for="">AGE</label>
                   
                   <label class="l4" for="">AADHAR </label>
                   <label class="l5" for="">ADDRESS</label>
                   <label class="l6" for="">PHONE</label>
                   <label class="l7" for="">EMAIL</label>
                   <label class="l8" for="">GENDER</label>
                   <label class="l9" for="">STATUS</label>
                </div>
            </div>
            
            
                        <div class="image-container">
                    <?php                
                        
                        while($r=$rslt->fetch_assoc())
                        {
                        $a1=$r["wid"];
                        $a2=$r["wname"];
                        // $a3=$r["wgender"];
                        $a4=$r["wage"];
                        $a5=$r["wadhar"];
                        $a6=$r["waddress"];
                        $a7=$r["phone"];
                        $a8=$r["email"];
                        $a9=$r['wgender'];
                        $a10=$r['warden_status'];

                        echo'<tr class="tr">';
                        echo'<td class="rollno" ><input type="text" readonly value="'.$a1.'"></td>';
                        echo'<td class="name" ><input type="text" readonly value="'.$a2.'"></td>';
                        // echo'<td class="course" ><input type="text" readonly value="'.$a3.'"></td>';
                        echo'<td class="phone" ><input type="text" readonly value="'.$a4.'"></td>';
                        echo'<td class="email" ><input type="text" readonly value="'.$a5.'"></td>'; 
                        echo'<td class="adress" ><input type="text" readonly value="'.$a6.'"></td>';
                        echo'<td class="mob" ><input type="text" readonly value="'.$a7.'"></td>';
                        echo'<td class="ema" ><input type="text" readonly value="'.$a8.'"></td>';
                        echo'<td class="gender" ><input type="text" readonly value="'.$a9.'"></td>';
                        echo'<td class="status" ><input type="text" readonly value="'.$a10.'"></td>';

                        // echo'<td class="name">'.$a2.'</td>';
                        // echo'<td class="course">'.$a3.'</td>';
                        // echo'<td class="phone">'.$a4.'</td>';
                            // echo'<td class="email1">'.$a5.'</td>';
                        // echo'<td class="adress">'.$a6.'</td>';
                        // echo'<td class="mob">'.$a7.'</td>';
                        // echo'<td class="ema">'.$a8.'</td>';
                        // echo'<style>.tr :hover{ color:green;}</style>';
                        echo"</tr>";
                        }
                    ?>
                    </div>
                    
                    
                            <?php
                                    if($rslt->num_rows<=0)
                                    {
                                        echo'<span class="ifno"><i class="fas fa-warning"></i></span>';
                                        echo'<span class="ifnot">No warden\'s records to Show</span>';
                                    }
                            ?>
           
            </table>



    
            </div>
           
            </form>
            
            <a class="btn2" href="managewarden.html">BACK</a>

<script>
            const searchInput = document.getElementById('searchInput');
const table = document.getElementById('myTable');
const tableRows = table.getElementsByClassName('tr');

searchInput.addEventListener('input', function() {
  const filter = searchInput.value.toLowerCase();

  for (let i = 0; i < tableRows.length; i++) {
    const row = tableRows[i];
    const rowData = row.getElementsByTagName('input');
    let shouldShowRow = false;

    for (let j = 0; j < rowData.length; j++) {
      const cell = rowData[j];
      if (cell.value.toLowerCase().indexOf(filter) > -1) {
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


