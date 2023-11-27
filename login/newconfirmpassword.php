<?php
session_start();
$message="";
@$cem=$_SESSION['eem'];
if(isset($_POST['submit']))
{
    //$email=$_POST['email'];
    $npass=$_POST['npass'];
    $cpass=$_POST['cpass'];   
    //checking if entered email is present on database or not
    $cn=new mysqli("localhost","root","","hostel");
    if($cn->connect_error)
    {
        echo"<script>alert('could not connect, Some error occured');</script>";
        exit;
    }

    if($cpass==$npass)
    {
        $ec=strlen($cpass);
        if($ec<8)
        {
          $message="*Password length must be 8 characters long*";
          echo'<style> .pass{ margin-left:32px; }</style> ';
        }
        else
        {
          $message="";
          $qry="update loginidtb set password='".$npass."' where usermail='".$cem."'";
          $up=$cn->query($qry);
          if($up)
          {
            echo"<script>alert('Password Set Successfully');</script>";
            echo"<script>window.location.href='index.html';</script>";
          }
        }
    }
    else
    {
      echo'<style> .pass{ margin-left:65px; }</style> ';
        $message="*Both Password Must Match*";

    }


}
?>
<style>

    body{
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);

  backdrop-filter: blur(10px);
    }

    .popup {
      position: relative;
      width: 320px;
      left:39%;
      top:10%;
      height: fit-content;
      align-items: center;
      justify-content: center;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
  box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
      border-radius: 13px;
    }
    
    .form {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 20px;
      gap: 20px;
    }
    
    .icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 60px;
      height: 60px;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
  box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      margin-left:110px;
    }
    
    .note {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .title {
      font-style: normal;
      font-weight: 700;
      font-size: 17px;
      line-height: 24px;
      color: #2B2B2F;
      margin-left:57px;
    }
      
    
    .input_field {
        text-align:center;
      width: 80%;
      margin-left: 28px;
      height: 42px;
      padding: 0 0 0 12px;
      border-radius: 15px;
      outline: none;
      border:none;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
  box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
      }
    
    .input_field:focus {
      border: 1px solid transparent;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
  box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
    }
    
    .form button.submit {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      padding: 10px 18px;
      gap: 10px;

      margin-left: 75px;
      font-style: normal;
      font-weight: 600;
      font-size: 12px;
      line-height: 15px;
      color: #333333;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
  box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
          border:none;
        width: 120px;
        height: 40px;
        border-radius: 15px;
        font-weight:600; 
        outline:none;
    }
    
    
    .form button.submit:active{
    
        border: 2px solid green;
        outline:none;
        background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
  box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
          color:green;
          font-weight: 900;
    
      }
      .pass {
          font-size:12px;     
        /* visibility:visible; */
             color:tomato;
             text-align:center;
           /* margin-left: 20% ; */
            }
            .pas{
              text-align:center;
            }
    
    </style>
    <body>
    <div class="popup">
        <form class="form" method="POST" action="" >
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 34 34" height="34" width="34">
              <path stroke-linejoin="round" stroke-width="2.5" stroke="#115DFC" d="M7.08385 9.91666L5.3572 11.0677C4.11945 11.8929 3.50056 12.3055 3.16517 12.9347C2.82977 13.564 2.83226 14.3035 2.83722 15.7825C2.84322 17.5631 2.85976 19.3774 2.90559 21.2133C3.01431 25.569 3.06868 27.7468 4.67008 29.3482C6.27148 30.9498 8.47873 31.0049 12.8932 31.1152C15.6396 31.1838 18.3616 31.1838 21.1078 31.1152C25.5224 31.0049 27.7296 30.9498 29.331 29.3482C30.9324 27.7468 30.9868 25.569 31.0954 21.2133C31.1413 19.3774 31.1578 17.5631 31.1639 15.7825C31.1688 14.3035 31.1712 13.564 30.8359 12.9347C30.5004 12.3055 29.8816 11.8929 28.6437 11.0677L26.9171 9.91666"></path>
              <path stroke-linejoin="round" stroke-width="2.5" stroke="#115DFC" d="M2.83331 14.1667L12.6268 20.0427C14.7574 21.3211 15.8227 21.9603 17 21.9603C18.1772 21.9603 19.2426 21.3211 21.3732 20.0427L31.1666 14.1667"></path>
              <path stroke-width="2.5" stroke="#115DFC" d="M7.08331 17V8.50001C7.08331 5.82872 7.08331 4.49307 7.91318 3.66321C8.74304 2.83334 10.0787 2.83334 12.75 2.83334H21.25C23.9212 2.83334 25.2569 2.83334 26.0868 3.66321C26.9166 4.49307 26.9166 5.82872 26.9166 8.50001V17"></path>
              <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#115DFC" d="M14.1667 14.1667H19.8334M14.1667 8.5H19.8334"></path>
            </svg>
          </div>
          <div class="pas"><label for="" class="pass"><?php echo $message; ?></label></div>
          <div class="note">
            <label class="title">Create New Password</label>

          </div>
          <input placeholder="Enter your E-mail" value="<?php echo $cem; ?>" readonly title="Enter your E-mail" name="email" type="email" class="input_field" required>
          <input placeholder="Set new Password" title="Set new Password" name="npass" type="password" class="input_field" required>
          <input placeholder="Confirm Password" title="Confirm Password" name="cpass" type="" class="input_field" required>
          <button class="submit" name="submit">UPDATE</button>
        </form>
      </div>
    </body>