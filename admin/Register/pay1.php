<?php
    session_start();
    //setting connection
    $con=new mysqli("localhost","root","","hostel");
    if($con->connect_error)
    {
        echo"<script>alert('Could Not Connect');</script>";
        // exit;
        echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
    }

    $fill_count=0;
    $fee=0;
    @$name=$_SESSION['name'];
    @$gender=$_SESSION['gen'];

    @$stay=$_SESSION['staypay'];
    @$checkoutDate=$stay;
    @$joinDate=$_SESSION['jdate'];


    @$emailid=$_SESSION['emid'];
    @$rollno=$_SESSION['rollid']; 
    @$regid=$_SESSION['regid']; //users regno is their id

    
    // $joinDateTime = new DateTime($joinDate);
    // $checkoutDateTime = new DateTime($checkoutDate);
    
    // // Calculate the difference in years and months between the two dates
    // $interval = $joinDateTime->diff($checkoutDateTime);
    // $years = $interval->format('%y');
    // $months = $interval->format('%m');
    
    // // Calculate the total number of months
    // $totalMonths = ($years * 12) + $months;
        
    // Output the number of months
    // echo "<script>alert('".$months."');</script>";
    
        @$joinDate = $_SESSION['jdate']; // Joining date from session
        @$checkoutDate = $_SESSION['staypay']; // Checkout date from session

        $joinDateTime = new DateTime($joinDate);
        $checkoutDateTime = new DateTime($checkoutDate);

        // Calculate the difference in years and months between the two dates
        $interval = $joinDateTime->diff($checkoutDateTime);
        $years = $interval->format('%y');
        $months = $interval->format('%m');

        // Calculate the total number of months
        $totalMonths = ($years * 12) + $months;

    


    //calculating fees based on gender
    if($gender=="MALE")
    {
        $fee=5000*$totalMonths;
    }
    elseif($gender=="FEMALE")
    {
        $fee=4000*$totalMonths;
    }

    

    //selecting available rooms for boys
    $avrmqry="select * from mroom where roomfor='".$gender."' and status='AVAILABLE'";
    $avrm=$con->query($avrmqry);
    $nor=$avrm->num_rows;
  
//    echo'</select>';

    //selecting available rooms for boys
    // $avrmqry="select * from mroom where roomfor='GIRLS' and status='AVAILABLE'";
    // $avrm=$con->query($avrmqry);
    // $nor=$avrm->num_rows;
    // // echo'<select>';
    // for($i=0;$i<$nor;$i++)
    // {
    //     $r=$avrm->fetch_assoc();
    //     $av[$i]=$r['roomno'];
    //    echo'<option>'.$av[$i].'</option>';
    // }
    // echo'</select>';
    

    //generating random password
    $pass_string="+?!@%&*0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $pstring="";
    while(strlen($pstring)<8)
    {
        @$pstring.=$pass_string[rand(0,68)];
    }
    

    if(isset($_POST['pay']))
    {
        
        // echo '<script> document.getElementById("pay").disabled = true; </script>';

        $room=$_POST['room'];
        $_SESSION['glob_room']=$room;

        //updating the room available seat
        $qry="select * from mroom where roomno='".$room."'";
        $rs=$con->query($qry);
        $r=$rs->fetch_assoc();
        @$fill_count=$r['filled'];
        @$seat=$r['seater'];
        if($seat==4)
        {
            if($fill_count==3)
            {
                $fill_count=4;
                $qry="update mroom set filled='$fill_count' , status='FULL' where roomno='".$room."'";
                $rs=$con->query($qry);
            }
            elseif($fill_count>-1&&$fill_count<3)
            {
                $fill_count=$fill_count+1;
                $qry="update mroom set filled='$fill_count' where roomno='".$room."'";
                $rs=$con->query($qry);
            }
        }
        elseif($seat==3)
        {
            if($fill_count==2)
            {
                $fill_count=3;
                $qry="update mroom set filled='$fill_count' , status='FULL' where roomno='".$room."'";
                $rs=$con->query($qry);
            }
            elseif($fill_count>-1&&$fill_count<2)
            {
                $fill_count=$fill_count+1;
                $qry="update mroom set filled='$fill_count' where roomno='".$room."'";
                $rs=$con->query($qry);
            }
        }
        elseif($seat==2)
        {
            if($fill_count==1)
            {
                $fill_count=2;
                $qry="update mroom set filled='$fill_count' , status='FULL' where roomno='".$room."'";
                $rs=$con->query($qry);
            }
            elseif($fill_count>-1&&$fill_count<1)
            {
                $fill_count=$fill_count+1;
                $qry="update mroom set filled='$fill_count' where roomno='".$room."'";
                $rs=$con->query($qry);
            }
        }
        elseif($seat==1)
        {
            if($fill_count==0)
            {
                $fill_count=1;
                $qry="update mroom set filled='$fill_count' , status='FULL' where roomno='".$room."'";
                $rs=$con->query($qry);
            }
        }


        if($room=="")
        {
            echo"<script>alert('Select The Room');</script>";
        }
        else
        {
        


        //adding the student regno to room
        // $qry="select * from mroom where roomno='".$room."'";
        // $qry=$con->query($qry);

        // $rm=$avrm->fetch_assoc();
        // $st=$rm['studentsinroom'];
        // if($st=="")
        // {
        //     $allst=$regid;
        //     $qry="update mroom set studentsinroom='".$allst."' where roomno='".$room."'";
        //     $qry=$con->query($qry);
        // }
        // else
        // {
        //     $allst=$st.', '.$regid;
        //     $qry="update mroom set studentsinroom='".$allst."' where roomno='".$room."'";
        //     $qry=$con->query($qry);
        // }

        //inserting payment card details
        $cardnumber=$_POST['cardno'];
        $cardhname=$_POST['cardhname'];
        $exmonth=$_POST['exmonth'];
        $exyear=$_POST['exyear'];
        $cvv=$_POST['cvv'];
        $month_meal_price=0;
        
        

        $pry="insert into payment values('".$emailid."','".$cardnumber."','".$cardhname."',
                                        '".$exmonth."','".$exyear."','".$cvv."','".$fee."','".$month_meal_price."')";

        $con->query($pry);


        $rqry="update stregister set roomno='".$room."' where regno='".$regid."'";
        $con->query($rqry);


        //sending email with mail function, message:successfull registration
        $receiver = "$emailid";
        $subject = "Hostel Payment";
        $body = "Dear $name,\nYou have Successfully Registerd and paid the amount of Rupees $fee .\nYour Room Number is $room .\n\nDo not Share This Email With anybody.\nLogin Information\nYour Username:  $regid\nYour Password:  $pstring";
        $sender = "From:dkiran4661@gmail.com";

        if(mail($receiver, $subject, $body, $sender))
        {
            echo"<script>alert('Payment Done, Login details Sent to your Email');</script>";
            echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
            
        }
        else
        {
            echo"<script>alert('Payment Done, Login details Sent to your Email');</script>";
            echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
            
        }
            // inserting their username, userid and password to ligin table
            $logqry="insert into loginidtb values('".$regid."','".$emailid."','".$pstring."')";
            $logins=$con->query($logqry);
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pay1.css">
    <title>Document</title>

    <script>
        function selected()
        {
            document.getElementById('roomid').innerHTML=(froom.room[froom.room.selectedIndex].text);
        }

        function disableSubmitButton() {
    var submitButton = document.getElementById('pay');
    // submitButton.disabled = true;
    // submitButton.innerHTML = 'Submitting...'; // Optionally, update the button label

    // Optionally, you can add a delay to re-enable the button after a specific duration
    setTimeout(function() {
      submitButton.disabled = true;
    //   submitButton.innerHTML = 'Submit';
        }, 10); // 3000 milliseconds = 3 seconds
    }


    function validateInput(event) {
    const input = event.target;
    const value = input.value;
    const sanitizedValue = value.replace(/[^a-zA-Z]/g, '');
    input.value = sanitizedValue;
  }


  
    </script>

        

</head>
<body>
    <form action="" method="post" name="froom" onsubmit="disableSubmitButton()" autocomplete="off">
    <div class="main">
        
        <div class="container"></div>
        <div class="visa">
            <div class="chipalign">
                <img src="image/chip.png" width="80" height="80" alt="">
            </div>

            <div class="visalign">
                <img class="visaimg" src="image/visa.png" alt="">

            </div>

            <div class="text">
                <h1 class="h1" >PAY WITH YOUR CARD</h1>
            </div>
           </div>

           <div class="details">

            <div class="sr">
                <h1>SELECT YOUR ROOM </h1>
                <select name="room" id="sroom" style="text-transform:uppercase;" onchange="selected();">
                <option value="">Choose Room</option>
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
            <div class="cn">
           <input type="number" name="cardno"  placeholder="CARD NUMBER" required>
        </div>
        <div class="cname">
           <input type="text" name="cardhname"  placeholder="CARD HOLDER NAME" id="myInput" oninput="validateInput(event)" required>
        </div>
        <div class="em">
           <input type="number" name="exmonth" min="1" max="12" placeholder="EXPIRY MONTH" required>
        </div>
        <div class="ey">
           <input type="number" name="exyear" min="2023" max="2033"  placeholder="EXPIRY YEAR" required>
        </div>
        <div class="cvv">
           <input type="number" name="cvv"  placeholder="CVV" required>
        </div>
        </div>



        

        <div class="sinfo">
            <div class="paydata">
                <p class="type">Hello <span style="text-transform:uppercase;"> <?php echo $name;?>,</span></p>
                <p class="type">Welcome to payment portal</p>
                <p class="type">You have selected room no <span id="roomid" style="text-transform:uppercase;"></span>
                             for <span><?php echo $totalMonths; ?></span> Months</p>
                <!-- <p class="type">Amount for the room is <span>Rs.10000</span> And The Food Is <span>Rs.30000</span>
                                 Total <span>40000</span> per year</p> -->
                <p>The Total amount you need to pay is <span>Rs.<?php echo $fee;?></span></p>
                <div class="button">
                    <button name="pay" id="pay" >Pay  <span class="act" style="font-size: 16px; color: white;">Rs.<?php echo $fee;?></span></button>
                </div>

               
             </div>
        </div>
        
    </div>
    </form>
</body>
</html>