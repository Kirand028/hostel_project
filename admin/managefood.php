<?php
    //connection
    $con=new mysqli("localhost","root","","hostel");
    if($con->connect_error)
    {
        echo"<script>alert('Could Not Connect');</script>";
        // exit;
        echo"<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
    }

    $vqry="select * from foodmenu where week='MONDAY'";
    $mvr=$con->query($vqry);
    for($i=0;$i<$mvr->num_rows;$i++)
    {
        $v=$mvr->fetch_assoc();
        //every monday 
        $mb=$v['breakfast'];
        $ml=$v['lunch'];
        $ms=$v['snack'];
        $md=$v['dinner'];
    }

    $vqry="select * from foodmenu where week='TUESDAY'";
    $tvr=$con->query($vqry);
    for($i=0;$i<$tvr->num_rows;$i++)
    {
        $v=$tvr->fetch_assoc();
        $tb=$v['breakfast'];
        $tl=$v['lunch'];
        $ts=$v['snack'];
        $td=$v['dinner'];
    }

    $vqry="select * from foodmenu where week='WEDNESDAY'";
    $wvr=$con->query($vqry);
    for($i=0;$i<$wvr->num_rows;$i++)
    {
        $v=$wvr->fetch_assoc();
        $wb=$v['breakfast'];
        $wl=$v['lunch'];
        $ws=$v['snack'];
        $wd=$v['dinner'];
    }
    $vqry="select * from foodmenu where week='THURSDAY'";
    $thvr=$con->query($vqry);
    for($i=0;$i<$thvr->num_rows;$i++)
    {
        $v=$thvr->fetch_assoc();
        $thb=$v['breakfast'];
        $thl=$v['lunch'];
        $ths=$v['snack'];
        $thd=$v['dinner'];
    }
    $vqry="select * from foodmenu where week='FRIDAY'";
    $fvr=$con->query($vqry);
    for($i=0;$i<$fvr->num_rows;$i++)
    {
        $v=$fvr->fetch_assoc();
        $fb=$v['breakfast'];
        $fl=$v['lunch'];
        $fs=$v['snack'];
        $fd=$v['dinner'];
    }
    $vqry="select * from foodmenu where week='SATURDAY'";
    $svr=$con->query($vqry);
    for($i=0;$i<$svr->num_rows;$i++)
    {
        $v=$svr->fetch_assoc();
        $sb=$v['breakfast'];
        $sl=$v['lunch'];
        $ss=$v['snack'];
        $sd=$v['dinner'];
    }
    $vqry="select * from foodmenu where week='SUNDAY'";
    $suvr=$con->query($vqry);
    for($i=0;$i<$suvr->num_rows;$i++)
    {
        $v=$suvr->fetch_assoc();
        $sub=$v['breakfast'];       
        $sul=$v['lunch'];
        $sus=$v['snack'];
        $sud=$v['dinner'];
    }        
        
    if(isset($_POST['update']))
    {
        //beakfast
        $mb=$_POST['mb'];
        $tb=$_POST['tb'];
        $wb=$_POST['wb'];
        $thb=$_POST['thb'];
        $fb=$_POST['fb'];
        $sb=$_POST['sb'];
        $sub=$_POST['sub'];

        //lunch
        $ml=$_POST['ml'];
        $tl=$_POST['tl'];
        $wl=$_POST['wl'];
        $thl=$_POST['thl'];
        $fl=$_POST['fl'];
        $sl=$_POST['sl'];
        $sul=$_POST['sul'];


        //snack
        $ms=$_POST['ms'];
        $ts=$_POST['ts'];
        $ws=$_POST['ws'];
        $ths=$_POST['ths'];
        $fs=$_POST['fs'];
        $ss=$_POST['ss'];
        $sus=$_POST['sus'];


        //dinner
        $md=$_POST['md'];
        $td=$_POST['td'];
        $wd=$_POST['wd'];
        $thd=$_POST['thd'];
        $fd=$_POST['fd'];
        $sd=$_POST['sd'];
        $sud=$_POST['sud'];

        //cant insert if the textbox are empty
        if($mb==""||$tb==""||$wb==""||$thb==""||$fb==""||$sb==""||$sub==""||
            $ml==""||$tl==""||$wl==""||$thl==""||$fl==""||$sl==""||$sul==""||
            $ms==""||$ts==""||$ws==""||$ths==""||$fs==""||$ss==""||$sus==""||
            $md==""||$td==""||$wd==""||$thd==""||$fd==""||$sd==""||$sud=="")
        {
            echo'<script>alert("Fill all the field");</script>'; 
            $vqry="select * from foodmenu where week='MONDAY'";
            $mvr=$con->query($vqry);
            for($i=0;$i<$mvr->num_rows;$i++)
            {
                $v=$mvr->fetch_assoc();
                //every monday 
                $mb=$v['breakfast'];
                $ml=$v['lunch'];
                $ms=$v['snack'];
                $md=$v['dinner'];
            }
        
            $vqry="select * from foodmenu where week='TUESDAY'";
            $tvr=$con->query($vqry);
            for($i=0;$i<$tvr->num_rows;$i++)
            {
                $v=$tvr->fetch_assoc();
                $tb=$v['breakfast'];
                $tl=$v['lunch'];
                $ts=$v['snack'];
                $td=$v['dinner'];
            }
        
            $vqry="select * from foodmenu where week='WEDNESDAY'";
            $wvr=$con->query($vqry);
            for($i=0;$i<$wvr->num_rows;$i++)
            {
                $v=$wvr->fetch_assoc();
                $wb=$v['breakfast'];
                $wl=$v['lunch'];
                $ws=$v['snack'];
                $wd=$v['dinner'];
            }
            $vqry="select * from foodmenu where week='THURSDAY'";
            $thvr=$con->query($vqry);
            for($i=0;$i<$thvr->num_rows;$i++)
            {
                $v=$thvr->fetch_assoc();
                $thb=$v['breakfast'];
                $thl=$v['lunch'];
                $ths=$v['snack'];
                $thd=$v['dinner'];
            }
            $vqry="select * from foodmenu where week='FRIDAY'";
            $fvr=$con->query($vqry);
            for($i=0;$i<$fvr->num_rows;$i++)
            {
                $v=$fvr->fetch_assoc();
                $fb=$v['breakfast'];
                $fl=$v['lunch'];
                $fs=$v['snack'];
                $fd=$v['dinner'];
            }
            $vqry="select * from foodmenu where week='SATURDAY'";
            $svr=$con->query($vqry);
            for($i=0;$i<$svr->num_rows;$i++)
            {
                $v=$svr->fetch_assoc();
                $sb=$v['breakfast'];
                $sl=$v['lunch'];
                $ss=$v['snack'];
                $sd=$v['dinner'];
            }
            $vqry="select * from foodmenu where week='SUNDAY'";
            $suvr=$con->query($vqry);
            for($i=0;$i<$suvr->num_rows;$i++)
            {
                $v=$suvr->fetch_assoc();
                $sub=$v['breakfast'];       
                $sul=$v['lunch'];
                $sus=$v['snack'];
                $sud=$v['dinner'];
            }
        }
        else
        {
            $qry1="update foodmenu set breakfast='$mb',lunch='$ml',snack='$ms',dinner='$md' where week='MONDAY'";
            $qry2="update foodmenu set breakfast='$tb',lunch='$tl',snack='$ts',dinner='$td' where week='TUESDAY'";
            $qry3="update foodmenu set breakfast='$wb',lunch='$wl',snack='$ws',dinner='$wd' where week='WEDNESDAY'";
            $qry4="update foodmenu set breakfast='$thb',lunch='$thl',snack='$ths',dinner='$thd' where week='THURSDAY'";
            $qry5="update foodmenu set breakfast='$fb',lunch='$fl',snack='$ths',dinner='$fd' where week='FRIDAY'";
            $qry6="update foodmenu set breakfast='$sb',lunch='$sl',snack='$ss',dinner='$sd' where week='SATURDAY'";
            $qry7="update foodmenu set breakfast='$sub',lunch='$sul',snack='$sus',dinner='$sud' where week='SUNDAY'";

            $up1=$con->query($qry1);
            $up2=$con->query($qry2);
            $up3=$con->query($qry3);
            $up4=$con->query($qry4);
            $up5=$con->query($qry5);
            $up6=$con->query($qry6);
            $up7=$con->query($qry7);
            if($up1&&$up2&&$up3&&$up4&&$up5&&$up6&&$up7)
            {
                echo'<script>alert("Food Menu Updated");</script>';
            }
            else
            {
                echo'<script>alert("Some error occured during update");</script>';
            }
        }


        // echo'<script>windows.location.href="admindashboard.php";</script>';
    }
        // $t=time();
        // echo ($t."<br>");
        // echo date("h:i:sa")."<br>";
        // echo date("H:i:s")."<br><br>";
        // echo date("Y-m-d",strtotime('this Monday'));
        // @date_default_timezone_set('India/Kolkata');
        // echo date_default_timezone_get();
        // echo"<br> <br><br><br>";

        @date_default_timezone_set('Asia/Kolkata');
        $date=date("Y-m-d");
        $week=date('l',strtotime($date));
        
        if($week=='Monday')
        {
            $vqry="select * from foodmenu where week='MONDAY'";
            $mvr=$con->query($vqry);
            for($i=0;$i<$mvr->num_rows;$i++)
            {
                $v=$mvr->fetch_assoc();
                //every monday 
                $b=$v['breakfast'];
                $l=$v['lunch'];
                $s=$v['snack'];
                $d=$v['dinner'];
            }
        }
        elseif($week=='Tuesday')
        {
            $vqry="select * from foodmenu where week='TUESDAY'";
            $tvr=$con->query($vqry);
            for($i=0;$i<$tvr->num_rows;$i++)
            {
                $v=$tvr->fetch_assoc();
                $b=$v['breakfast'];
                $l=$v['lunch'];
                $s=$v['snack'];
                $d=$v['dinner'];
            }
        }
        elseif($week=='Wednesday')
        {
            $vqry="select * from foodmenu where week='WEDNESDAY'";
            $wvr=$con->query($vqry);
            for($i=0;$i<$wvr->num_rows;$i++)
            {
                $v=$wvr->fetch_assoc();
                $b=$v['breakfast'];
                $l=$v['lunch'];
                $s=$v['snack'];
                $d=$v['dinner'];
            }
        }
        elseif($week=='Thursday')
        {
            $vqry="select * from foodmenu where week='THURSDAY'";
            $thvr=$con->query($vqry);
            for($i=0;$i<$thvr->num_rows;$i++)
            {
                $v=$thvr->fetch_assoc();
                $b=$v['breakfast'];
                $l=$v['lunch'];
                $s=$v['snack'];
                $d=$v['dinner'];
            }
        }
        elseif($week=='Friday')
        {
            $vqry="select * from foodmenu where week='FRIDAY'";
            $fvr=$con->query($vqry);
            for($i=0;$i<$fvr->num_rows;$i++)
            {
                $v=$fvr->fetch_assoc();
                $b=$v['breakfast'];
                $l=$v['lunch'];
                $s=$v['snack'];
                $d=$v['dinner'];
            }
        }
        elseif($week=='Saturday')
        {
            $vqry="select * from foodmenu where week='SATURDAY'";
            $svr=$con->query($vqry);
            for($i=0;$i<$svr->num_rows;$i++)
            {
                $v=$svr->fetch_assoc();
                $b=$v['breakfast'];
                $l=$v['lunch'];
                $s=$v['snack'];
                $d=$v['dinner'];
            }
        }
        elseif($week=='Sunday')
        {
            $vqry="select * from foodmenu where week='SUNDAY'";
            $suvr=$con->query($vqry);
            for($i=0;$i<$suvr->num_rows;$i++)
            {
                $v=$suvr->fetch_assoc();
                $b=$v['breakfast'];
                $l=$v['lunch'];
                $s=$v['snack'];
                $d=$v['dinner'];
            }
        }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="managefoo.css">

    <script>
        
        // function update()
        // {
        //     var inputBoxes = document.querySelectorAll('input[type="text"]');
		// 	for (var i = 0; i < inputBoxes.length; i++)
        //     {
		// 		inputBoxes[i].readOnly = true;
		//     }
		// }
        // function edit()
        // {
        //     document.getElementById("tb28").readOnly=false;
        // }



        function makeEditable() {
		
			document.getElementById("edit").disabled = true;
			document.getElementById("update").disabled = false;
            var inputBoxes = document.querySelectorAll('input[type="text"]');
			for (var i = 0; i < inputBoxes.length; i++)
            {
				inputBoxes[i].readOnly = false;
                inputBoxes[i].style.border = "1px inset black";
                // inputBoxes[i].style.
		    }
		}
		
		function updateText() {
		
			document.getElementById("edit").disabled = false;
			document.getElementById("update").disabled = true;
            var inputBoxes = document.querySelectorAll('input[type="text"]');
			for (var i = 0; i < inputBoxes.length; i++)
            {
				inputBoxes[i].readOnly = true;
                inputBoxes[i].style.border = "none";
		    }
		}
        
        function vInput(event) {
        const input = event.target;
        const value = input.value;
        const sanitizedValue = value.replace(/[^a-zA-Z0-9 ]/g, '');
        input.value = sanitizedValue;
        }

  </script>

</head>
<body onload="updateText()">
<form action="" method="post" autocomplete="off" oninput="vInput(event)">
    <div class="card1container">
        <h1>manage food<i class="fa fa-pepper-hot"></i></h1>
    <div class="card1">
        
        <div class="cr1">
            <input type="text " value="<?php echo $b; ?>" readonly>
        </div>
        <div class="cr2">

            
            <input type="text " value="<?php echo $l; ?>" readonly>
            
        </div>
        <div class="cr3">
            <input type="text " value="<?php echo $s; ?>" readonly>
        </div>
        <div class="cr4">
            <input type="text " value="<?php echo $d; ?>" readonly>
        </div>
        <div class="cr5">
            <h2 class="today"><?php echo $week;?></h2>
        </div> 
       
    </div>

    <div class="card2">
        <div class="c1">
            <div class="week">WEEK</div>
            <div class="days">
              
                <h2>MONDAY</h2>
                <h2>TUESDAY</h2>
                <h2>WEDNESDAY</h2>
                <h2>THURSDAY</h2>
                <h2>FRIDAY</h2>
                <h2>SATURDAY</h2>
                <h2>SUNDAY</h2>
               
            </div>
        </div>
        <div class="c2">
            <div class="breakfasttime">7.30 - 9.30</div>
            <div class="breakfast">
                <input type="text" name="mb" value="<?php echo $mb ;?>" id="tb1">
                <input type="text" name="tb" value="<?php echo $tb ;?>" id="tb2">
                <input type="text" name="wb" value="<?php echo $wb ;?>" id="tb3">
                <input type="text" name="thb" value="<?php echo $thb ;?>" id="tb4">
                <input type="text" name="fb" value="<?php echo $fb ;?>" id="tb5">
                <input type="text" name="sb" value="<?php echo $sb ;?>" id="tb6">
                <input type="text" name="sub" value="<?php echo $sub ;?>" id="tb7">
            </div>
        </div>
        <div class="c3">
            <div class="lunchtime">12.30 - 14.30</div>
            <div class="lunch">
                <input type="text" name="ml" value="<?php echo $ml ;?>" id="tb8">
                <input type="text" name="tl" value="<?php echo $tl ;?>" id="tb9">
                <input type="text" name="wl" value="<?php echo $wl ;?>" id="tb10">
                <input type="text" name="thl" value="<?php echo $thl ;?>" id="tb11">
                <input type="text" name="fl" value="<?php echo $fl ;?>" id="tb12">
                <input type="text" name="sl" value="<?php echo $sl ;?>" id="tb13">
                <input type="text" name="sul" value="<?php echo $sul ;?>" id="tb14">
            </div>
        </div>
        <div class="c4"> 
            <div class="snacktime">14.30 - 18.30</div>
            <div class="snack">
                <input type="text" name="ms" value="<?php echo $ms ;?>" id="tb15">
                <input type="text" name="ts" value="<?php echo $ts ;?>" id="tb16">
                <input type="text" name="ws" value="<?php echo $ws ;?>" id="tb17">
                <input type="text" name="ths" value="<?php echo $ths ;?>" id="tb18">
                <input type="text" name="fs" value="<?php echo $fs ;?>" id="tb19">
                <input type="text" name="ss" value="<?php echo $ss ;?>" id="tb20">
                <input type="text" name="sus" value="<?php echo $sus ;?>" id="tb21">
            </div>
        </div>
    
        <div class="c5">
            <div class="dinnertime">20.30 -  23.30</div>
            <div class="dinner">
                <input type="text" name="md" value="<?php echo $md ;?>" id="tb22">
                <input type="text" name="td" value="<?php echo $td ;?>" id="tb23">
                <input type="text" name="wd" value="<?php echo $wd ;?>" id="tb24">
                <input type="text" name="thd" value="<?php echo $thd ;?>" id="tb25">
                <input type="text" name="fd" value="<?php echo $fd ;?>" id="tb26">
                <input type="text" name="sd" value="<?php echo $sd ;?>" id="tb27">
                <input type="text" name="sud" value="<?php echo $sud ;?>" id="tb28">
            </div>
       
        </div>
    </div>

    <div class="ualn">
        <button class="btn" name="update" id="update"  disabled>SUBMIT</button>
    
    </div>
    </form>
    <div class="baln">
        <button class="btn" id="edit" onclick="makeEditable();" disabled >EDIT</button>
        
        <div class="bac" >

        <a class="btn" href="admindashboard.php" >BACK</a>
        </div>
    </div>

    </div>
    
</body>
</html>