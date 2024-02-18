<?php
session_start();
include 'dbconnect.php';
$visibility="visible";
if(isset($_POST['pid']))
  $visibility="hidden";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" sizes="196x196" href="HireLight.png" />

  <meta name="viewport" content="width=, initial-scale=1.0">
  <!--including style.css-->
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="patientdetail.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Inter+Tight:wght@300&family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    #search-btn {
      width: 88px;
    }

    .card {
      box-shadow: 1px 3px 9px -1px rgb(108, 108, 108);
      width: 54rem;
      text-align: justify;
      border-radius: 23px;
    }

    .card:hover {
      box-shadow: 1px 3px 9px -1px black;
    }

    @media (max-width: 870px) {
      .card {
        width: 21rem;
      }
    }

    /*menubar starts*/
    .navbar-nav a {
      font-size: 18px;
      color: rgb(244, 236, 236);
      text-transform: uppercase;
      font-weight: 500;
      margin-left: 15px;
      padding-top: 20px;
      padding-bottom: 20px;

    }

    .navbar-dark {
      background-color: rgb(0, 0, 0);
    }

    .navbar-dark .navbar-brand {
      color: rgb(236, 236, 236);
      font-size: 33px;
      font-weight: 700px;
      padding-top: 3px;
      padding-left: 15px;
    }

    .navbar-dark .navbar-brand:focus,
    .navbar-dark .navbar-brand:hover {
      color: white;

    }

    .navbar-dark .navbar-nav .navbar-link {
      color: rgb(246, 238, 238);
    }

    .w-100 {
      height: 100vh;
    }
  </style>
</head>

<body style="background-color: #fafafa;">
  <script>
    let page = 1;
  </script>

  <!--bootstrap link n many more-->


  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <div class="container-fluid">
    <form method="post" action="./patientdetail.php">
    <div class="search-bar">
      <input type="text" placeholder="Enter Patient Id" id="skill" name="pid" class="inputs" required style="width: 500px;border:none;" />
      <button class="btn btn-primary" id="search-btn" type="submit" name="sendotp">Send OTP</button>
    </div>

    <!-- </form> -->
    <!-- <form style="visibility: hidden;" id="otp_form" method="post"> -->
    <div class="container height-75 d-flex justify-content-center align-items-center mb-5 mt-5" >
      <div class="position-relative">
          <div class="card p-2 text-center">
              <h6>Please enter the OTP <br> to verify your account</h6>
              <input type="hidden" value="" name="pid1" id="pid"/>
              <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> <input class="m-2 text-center form-control rounded" type="text" id="first" name="first" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" name="second"/> <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" name="third"/> <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" name="fourth"/> <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" name="fifth"/> <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" name="sixth"/> </div>
              <div class="mt-4"> <button class="btn btn-danger px-4 validate" type="submit">Validate</button> </div>
          </div>
      </div>
    </div>
    </form>
    <!-- <center>
      <div class="display-text" id="info">
        <h1 id="hint">Check patient for other medical conditions or medication allergies.</h1>
        <img src="./images/searchpatient.svg" />
      </div>
    </center> -->
    <div>
      <?php
        
        if(isset($_POST['pid']))
        {
          if(isset($_POST['sendotp']))
          {
            $query = "select phone from patienttable where pid='".$_POST['pid']."'";
            $result = mysqli_query($db,$query);
            $phone=0;
            while($row = mysqli_fetch_row($result))
            {
              $phone=$row[0];
            }
              $curl = curl_init();

              curl_setopt_array($curl, [
                CURLOPT_URL => "https://shadow01.pythonanywhere.com/sendotp",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "phone=$phone",
                CURLOPT_HTTPHEADER => [
                  "Accept: */*",
                  "Content-Type: application/x-www-form-urlencoded",
                  "User-Agent: Thunder Client (https://www.thunderclient.com)"
                ],
              ]);

              $response = curl_exec($curl);
              $err = curl_error($curl);

              curl_close($curl);
              $responseData = json_decode($response, true);
              $otp = $responseData['otp'];
              $query = "insert into otptable values('".$_POST['pid']."','".$otp."',3,'".$_COOKIE['d_id']."')";
              if(mysqli_query($db,$query))
                echo "<script>alert('OTP Send')</script>";
              
          }
          else
          {
            $d_id = $_COOKIE['d_id'];
            $userOtp = $_POST['first'].$_POST['second'].$_POST['third'].$_POST['fourth'].$_POST['fifth'].$_POST['sixth'];
            $sanitized_otp = mysqli_real_escape_string($db, $userOtp); 
        
            $query = "select count from otptable where p_id='".$_POST['pid']."' and d_id='".$d_id."'";
            $result = mysqli_query($db,$query);
            $count=0;
            while($row = mysqli_fetch_row($result))
            {
              $count = $row[0];
            }
            
            $query ="select * from otptable where p_id='".$_POST['pid']."' and otp = '".$sanitized_otp."' and count>0 and d_id='".$d_id."'";
        
            $result = mysqli_query($db,$query);
            if(mysqli_fetch_array($result) > 0)
            {
                $ipaddress = '';
                if (isset($_SERVER['HTTP_CLIENT_IP']))
                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_X_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED'];
                else if(isset($_SERVER['REMOTE_ADDR']))
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                else
                    $ipaddress = 'UNKNOWN';
                
                $q = "select d_hospital from doctortable where id='".$d_id."'";
                $result = mysqli_query($db,$q);
                $hospital="";
                while ($row = mysqli_fetch_row($result)) {
                  $hospital=$row[0];
                }
                $today = date("Y-m-d");
                $time = date("H:i:s");
                $q = "insert into data_check_log values('".$_POST['pid']."','".$d_id."','".$hospital."','".$today."','".$time."','".$ipaddress."')";
                mysqli_query($db,$q);
        
                $q = "select * from patientdata where p_id = '".$_POST['pid']."'";
                $result = mysqli_query($db,$q);
                echo "<table class='table'>
                <thead>
                  <tr>
                    <th scope='col'>Patient ID</th>
                    <th scope='col'>Doctor ID</th>
                    <th scope='col'>Hospital</th>
                    <th scope='col'>City</th>
                    <th scope='col'>Medical Condition</th>
                    <th scope='col'>Treatment or Document Link</th>
                    <th scope='col'>Date</th>

                  </tr>
                </thead>";
                while ($row = mysqli_fetch_row($result)) {
                  echo "
                  <tbody>
                  <tr>
                    <th scope='row'>$row[0]</th>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                    <td>$row[4]</td>
                    <td><a hreaf=$row[5]>$row[5]</a></td>
                    <td>$row[6]</td>
                  </tr>
                  ";
                }
                //Send a mail to patient also that his data is accessed by somepne else
            }
            else
            {
              $count--;
              echo "<script>alert($count)</script>";
              if($count>0)
              {
                $query = "update otptable set count=$count where p_id='".$_POST['pid']."' and d_id='".$d_id."'";
              }
              else
              {
                $query = "delete from otptable where p_id='".$_POST['pid']."' and d_id='".$d_id."'";
              }
              mysqli_query($db,$query);
            }
          }
      
        }
      ?>
    </div>

  </div>
  <script>

    function showOTPBox(){
      // if(document.getElementById("skill").value.length>0){
      // document.getElementById("otp_form").style.visibility="visible";
      // var pid = document.getElementById("input").value;
      // document.getElementById("pid").value=pid;
      // document.getElementById("info").style.visibility="invisible";
    // }
    // else{
    //   document.getElementById("otp_form").style.visibility="invisible";
    //   document.getElementById("info").style.visibility="invisible";
    // }
  }
    


    document.addEventListener("DOMContentLoaded", function(event) {

function OTPInput() {
const inputs = document.querySelectorAll('#otp > *[id]');
for (let i = 0; i < inputs.length; i++) 
{ 
  inputs[i].addEventListener('keydown', function(event) {
     if (event.key==="Backspace" ) { 
      inputs[i].value='' ; 
      if (i !==0) 
        inputs[i - 1].focus(); 
    } 
    else { 
      if (i===inputs.length - 1 && inputs[i].value !=='' ) 
      { return true; } 
      else if (event.keyCode> 47 && event.keyCode < 58) 
      { 
        inputs[i].value=event.key; 
        if (i !==inputs.length - 1) 
          inputs[i + 1].focus(); 
          event.preventDefault(); 
        } 
        else if (event.keyCode> 64 && event.keyCode < 91) 
        { 
          inputs[i].value=String.fromCharCode(event.keyCode); 
          if (i !==inputs.length - 1) 
          inputs[i + 1].focus(); 
        event.preventDefault(); 
      } 
    } 
  }); 
} } OTPInput(); });
  </script>
</body>
</html>