<?php
    session_start();
    $con=new mysqli("localhost","root","","hostel");
        if($con->connect_error)
        {
            echo"<script>alert('Could Not Connect');</script>";
            // exit;
            echo"<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
        }

        // Set number of records to display per page
        $recordsPerPage = 10;

        // Get total number of records in database
        $totalRecordQuery = $con->query("SELECT COUNT(*) as count FROM payment");
        $totalRecord = $totalRecordQuery->fetch_assoc()['count'];

        // Calculate number of pages needed
        $totalPages = ceil($totalRecord / $recordsPerPage);

        

        // Get current page number
        if (isset($_GET['page'])) 
        {
            $currentPage = $_GET['page'];
        }
        else
        {
            $currentPage = 1;
        }

        // Calculate starting record index for current page
        $startingRecordIndex = ($currentPage - 1) * $recordsPerPage;

        // Fetch record for current page
        $recordQuery = $con->prepare("SELECT email, cardno, cardhname, exmonth, exyear, cvv, fees FROM payment ORDER BY cardhname DESC LIMIT ?, ?");
        $recordQuery->bind_param("ii", $startingRecordIndex, $recordsPerPage);
        $recordQuery->execute();
        $recordResult = $recordQuery->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pay.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <title>Document</title>
</head>
<body>
<label class="pay"><i class="fa fa-bank"></i> Payment</label>    
<div class="card">

<div class="c1">
    <i class="fa fa-inr"></i>
    <?php 
        $total=0;
        $fq="select * from payment";
        $rs=$con->query($fq);
        for($f=1;$f<=$rs->num_rows; $f++)
        {
            $z=$rs->fetch_assoc();
            @$fee=$z['fees'];
            
            $total=$total+$fee;
        }

        $btot=0;
        $fb="select * from stregister where gender='MALE'";
        $brs=$con->query($fb);
        while($b=$brs->fetch_assoc())
        {
            $emailid=$b["email"];
            $fb1="select * from payment where email='$emailid'";
            $brs1=$con->query($fb1);
            while($b1=$brs1->fetch_assoc())
            {
                $bfee=$b1['fees'];
                $btot+=$bfee;
            }
        }

        $gtot=0;
        $fg="select * from stregister where gender='FEMALE'";
        $grs=$con->query($fg);
        while($g=$grs->fetch_assoc())
        {
            $emailid=$g["email"];
            $fg1="select * from payment where email='$emailid'";
            $grs1=$con->query($fg1);
            while($g1=$grs1->fetch_assoc())
            {
                $gfee=$g1['fees'];
                $gtot+=$gfee;
            }
        }

        
    
    ?>
    <span class="total">Total</span><br>
    <span class="tf">Rs.<?php echo $total; ?></span>
</div>
<div class="c2">
    <i class="fa fa-male"></i>
    <span class="total">Boys</span><br>
    <span class="tf"><i class="fa fa-inr"></i><?php echo $btot; ?></span>
</div>
<div class="c3">
    <i class="fa fa-female"></i>
    <span class="total">Girls</span><br>
    <span class="tf"><i class="fa fa-inr"></i><?php echo $gtot; ?></span>
</div>

</div>

<input type="text" class="searchInput" id="searchInput" placeholder="Search...">

<div class="card1">

    <table id="myTable">
        <tbody>
        <?php while ($r = $recordResult->fetch_assoc()): ?>

            <?php


                        $emailid=$r['email'];
                        $qry="select * from stregister where email='".$emailid."'";
                        $rslt=$con->query($qry);
                        $s=$rslt->fetch_assoc();
                        echo'<tr class="tr">';
                        echo'<td>
                            <i class="fa fa-money-check-alt" title="Card Number"></i><br>
                            <span style="font-size:13px;font-weight:bold;" title="Card Number">'.$r["cardno"].'</span> 
                            </td>
                            <td>';
                        echo'<input type="text" readonly title="Student Name" value='.@$r["cardhname"].'><br>
                            <span style="font-size:13px;" class="reg" title="Student Register Number">'.@$s["regno"].'</span>
                            </td>
                            <td>';
                            echo '<h6 title="Join Date">'.@$s["joindate"].' <br>
                                    <span style="font-size:13px;" title="Join Date">Join Date</span></h6>
                            </td>
                            <td><h6 title="Checkout Date">'.@$s["stay"].'<br>
                                    <span style="font-size:13px;" title="Checkout Date">Checkout Date</span></h6>
                            </td>
                            <td><h6 title="Fees Paid By Student"><i class="fa fa-inr"></i>'.$r["fees"].'<br>
                                    <span style="font-size:13px;" title="Fees paid by student">Fees</span></h6>
                            </td>
                        </tr>';
                ?>
        <?php endwhile; ?>
        <?php 
                   

                //    $qry="select * from payment";
                //    $idrslt=$con->query($qry);
                //    $norow=$idrslt->num_rows;
                //    for($i=0;$i<$norow;$i++)
                //    {
                //        $r=$idrslt->fetch_assoc();
                //        $roll=$r['stid'];
                //        $qry="select * from stregister where rollno='".$roll."'";
                //        $rslt=$con->query($qry);
                //        $s=$rslt->fetch_assoc();

                //         echo'<tr class="tr">';
                //         echo'<td>
                //             <i class="fa fa-money-check-alt"></i><br>
                //             <span style="font-size:13px;">'.$r["cardno"].'</span> 
                //         </td>
                //         <td>';
                //         echo'<input type="text" readonly value='.@$s["fname"].'><br>
                //             <span style="font-size:13px;">'.$r["stid"].'</span>
                //         </td>
                //         <td>';
                //             echo '<h6>'.@$s["joindate"].'</h6>
                //         </td>
                //             <td><h6>'.@$s["stay"].'YEARs</h6></td>
                //             <td><h6>'.$r["fees"].'</h6></td>
                //         </tr>';
                //    }
            ?>
            



         
        </tbody>
    </table>

            
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
                  if($currentPage==$totalPages)
                  {
                      $c=$totalPages;
                  }        
          ?>
          <a href="?page=<?= $c ?>" name="next" class="next" >Next</a>
              </div>
              <div class="back1">
                <a href="admindashboard.php"><div class="back">BACK</div></a>
              </div>
              <div class="scroll-button down" title="Go Down"><i class="fas fa-angle-down" title="Go Down"></i></div>
            <div class="scroll-button up" title="Go Up"><i class="fas fa-angle-up" title="Go Up"></i></div>


            <script>
                const scrollUpButton = document.querySelector('.scroll-button.up');
    const scrollDownButton = document.querySelector('.scroll-button.down');

    scrollUpButton.style.display = 'none'; // Initially hide the scroll up button

    scrollUpButton.addEventListener('click', () => {
      window.scrollBy({
        top: -window.innerHeight,
        behavior: 'smooth'
      });
    });

    scrollDownButton.addEventListener('click', () => {
      window.scrollBy({
        top: window.innerHeight,
        behavior: 'smooth'
      });
    });

    window.addEventListener('scroll', () => {
      const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

      if (scrollPosition > 0) {
        scrollUpButton.style.display = 'flex';
        scrollDownButton.classList.add('fade-out');
      } else {
        scrollUpButton.style.display = 'none';
        scrollDownButton.classList.remove('fade-out');
      }
    });


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