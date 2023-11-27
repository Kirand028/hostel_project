<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "hostel");
if($conn->connect_error)
{
    echo"<script>alert('Could Not Connect');</script>";
    // exit;
    echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
}
session_start();
@$us=$_SESSION['us'];

		if(isset($_POST["submit"]))
        {
			
            $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
            
            $image_name = $_FILES["image"]["name"];
            $image_type=$_FILES["image"]["type"];
            $ed=$_POST['ed'];

            $size=$_FILES["image"]["size"]/1024;
            $size=$size/1024;

            if($image_type=="image/png"||$image_type=="image/jpg"||$image_type=="image/jpeg")
            {

                if($size>=2)
                {
                    $size=number_format($size,2);
                    echo"<script>alert('Uploaded Image Size = ".$size.", Should be less than 2MB');</script>";
                }
                else
                {
                $qry="select * from event where iname='".$image_name."'";
                $rslt=$conn->query($qry);
                if($rslt->num_rows>0)
                {
				    echo"<script>alert('Image with that name already Exist');</script>";
                }
                else
                {
                    $que="insert into event(eventdisc, image, iname) values('$ed','$image','$image_name')";
                    if($qr=$conn->query($que))
                    {
				        echo"<script>alert('Event Uploaded Successfully');</script>";

                        $image="";
                        $image_name="";
                        $ed="";
                        // $id=0;
			        }
			        else
                    {
                        // echo $image_type;
				        echo"<script>alert('Uploading Error');</script>";
			        }
                }
                }
            }
            else
            {
                echo"<script>alert('Invalid image File');</script>";
            }
         
        }
        
        // Set number of images to display per page
        $imagesPerPage = 1;

        // Get total number of images in database
        $totalImagesQuery = $conn->query("SELECT COUNT(*) as count FROM event");
        $totalImages = $totalImagesQuery->fetch_assoc()['count'];

        // Calculate number of pages needed
        $totalPages = ceil($totalImages / $imagesPerPage);

        if (isset($_GET['ei'])) 
        {
            $eid = $_GET['ei'];
        }
        else
        {
            $eid=0;
        }

        // Get current page number
        if (isset($_GET['page'])) 
        {
            $currentPage = $_GET['page'];
        }
        else
        {
            $currentPage = 1;
        }

        // Calculate starting image index for current page
        $startingImageIndex = ($currentPage - 1) * $imagesPerPage;

        // Fetch images for current page
        $imagesQuery = $conn->prepare("SELECT eventid, eventdisc, image, iname FROM event ORDER BY eventid DESC LIMIT ?, ?");
        $imagesQuery->bind_param("ii", $startingImageIndex, $imagesPerPage);
        $imagesQuery->execute();
        $imagesResult = $imagesQuery->get_result();

     
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manageevent.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <title>Document</title>
    <script>


        function vInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^(),-_=+&a-zA-Z0-9 ]/g, '');
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
            <a href="manageevent.php" class="active"><i class="fas fa-calendar"></i>  MANAGE EVENT</a>
            <a href="spayment.php"><i class="fas fa-bank"></i>  PAYMENT</a>
            
    </div>
</div>

<div class="navbar">
<!-- <h1 class="h1">Manage Events</h1> -->
<!-- <a  class="logout" href="http://localhost/hostel/home/home.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a> -->

</div>



<form action="" method="post" enctype="multipart/form-data">

<div class="eventshower">


    <div class="card">
    <div class="image-gallery">
        
        

        <?php while ($image = $imagesResult->fetch_assoc()): ?>
            <div class="image-container">
                <img src="data:image/jpeg;base64,<?= base64_encode($image['image']) ?>" alt="<?= $image['iname'] ?>">
                <div class="edisc"><?= $image['eventdisc'] ?></div>
            </div>
        <?php endwhile; ?>

                <?php
                        if($totalImages<=0)
                        {
                            echo'<span class="ifno"><i class="fas fa-warning"></i></span>';
                            echo'<span class="ifnot">No Events / Alerts to Show</span>';
                        }
                ?>    

    </div>

    </div>
    
    
    <div class="pagination" style="text-align:center;">
          
            <?php 
                    $c=$currentPage-1;
                    if($currentPage==1)
                    {
                        $c=1;
                    }
            ?>
            <a href="?page=<?= $c ?>" name="pre" class="pre" >Previous</a>
        

            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>
            


            <?php 
                    $c=$currentPage+1;
                    if($currentPage==$totalImages)
                    {
                        $c=$totalImages;
                    }        
            ?>
            <a href="?page=<?= $c ?>" name="next" class="next" >Next</a>
            
        </table>

                
        
                        
    </div>
</div>

<div class="evenwtriter">
    
        <div class="textbox">
            <textarea name="ed" id=""  style="resize:none;" placeholder="Type Event Description" required oninput="vInput(event)"></textarea>
        </div>

        <div class="uploadpic">
            <input type="file" name="image" id="image"  required>
        </div>

        <div class="ubuton">
            <button name="submit" id="insert">UPLOAD</button>
        </div>

    </form>
    
</body>
</html>
