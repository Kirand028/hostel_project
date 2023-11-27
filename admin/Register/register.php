<?php
    session_start();
    if(isset($_POST['register']))
    { 

      echo"<script>document.getElementByName('register').style.visibility=hidden;</script>";

      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $fmname=$_POST['fmname'];
      $dob=$_POST['dob'];
      $blood=$_POST['blood'];
      $gender=$_POST['gender'];
      $caste=$_POST['caste'];
      $adhar=$_POST['adhar'];
      
      $_SESSION['name']=$fname;
      $_SESSION['gen']=$gender;

      $clgname=$_POST['clgname'];
      $regno=$_POST['regno'];
      $course=$_POST['course'];
      $rollno=$_POST['rollno'];
      $coursedur=$_POST['coursedur'];
      $pymark=$_POST['pymark'];
      $joindate=$_POST['joindate'];
      $stay=$_POST['stay'];
      
      $_SESSION['rollid']=$rollno;
      $_SESSION['regid']=$regno;
      $_SESSION['staypay']=$stay;
      $_SESSION['jdate']=$joindate;

      $mobno=$_POST['mobno'];
      $pmobno=$_POST['pmobno'];
      $regemail=$_POST['regemail'];
      $paddress=$_POST['paddress'];
      $country=$_POST['country'];
      $state=$_POST['state'];
      $district=$_POST['district'];
      $pincode=$_POST['pincode'];
   
      $student_status="ACTIVE";
      


      $_SESSION['emid']=$regemail;

      
      //setting connection and checking for existence of email
      $con=new mysqli("localhost","root","","hostel");
      if($con->connect_error)
      {
        echo"<script>alert('Could Not Connect');</script>";
        //exit;
        echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
      }

      $roomqry="select * from mroom where status='AVAILABLE' and roomfor='$gender'";
      $room=$con->query($roomqry);
      if($room->num_rows>0)
      {
            while($ro=$room->fetch_assoc())
            {
              $roomid=$ro['roomno'];
            }
      }
      else
      {
        echo"<script>alert('Rooms are not available for ".$gender." now');</script>";
        echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
      }
        

      $qry="select * from stregister where email='".$regemail."' or regno='".$regno."'";
      $idrslt=$con->query($qry);
      if($idrslt->num_rows==1)
      {
        echo"<script>alert('Already applied with this Email/Register number');</script>";
        echo"<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
      }
      elseif($mobno==$pmobno)
      {
        echo"<script>alert('Personal Number and Parent Number should be different');</script>";
        echo"<script>window.location.href='register.html';</script>";
        
      }
      else
      {
        //inserting the emailid to login table
        // $logqry="insert into loginidtb(usermail) values('".$regemail."')";
        // $logins=$con->query($logqry);
        
        // fname,lname,fmname,dob,blood,gender,caste,adhar,clgname,regno,course,rollno,coursedur,pymark,joindate,stay,mobno,pmobno,email,paddress,country,state,district,pincode
        $iqry="insert into stregister values('".$fname."','".$lname."','".$fmname."','".$dob."','".$blood."','".$gender."','".$caste."','".$adhar."','".$clgname."','".$regno."','".$course."','".$rollno."','".$coursedur."','".$pymark."','".$joindate."','".$stay."','".$mobno."','".$pmobno."','".$regemail."','".$paddress."','".$country."','".$state."','".$district."','".$pincode."','".$roomid."','".$student_status."')";
        $ins=$con->query($iqry);

        //if inserted successfully 
        if($ins)
        {
          
          //sending email with mail function, message:successfull registration
          $receiver = "$regemail";
          $subject = "Applied for Hostel Room";
          $body = "Dear $fname,\nWelcome to our Hostel.\nYou have Successfully submitted the Application to the Hostel.\nComplete the Payment procedure to book a room.\nThank You";
          $sender = "From:dkiran4661@gmail.com";
          if(mail($receiver, $subject, $body, $sender))
          {
            echo"<script>alert('Applied successfully, Goto the Payment section to complete registration');</script>";
            echo"<script>window.location.href='pay1.php';</script>";
          }
          else
          {
            echo"<script>alert('Your offline to recieve Email, But successfully submitted Application. Goto the Payment section to complete registration');</script>";
            echo"<script>window.location.href='pay1.php';</script>";
          }
        }
        else
        {
          echo'<script>alert("Some Error Occured During The Submission");</script>';
          echo"<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
        }
        
      }
    }
?>