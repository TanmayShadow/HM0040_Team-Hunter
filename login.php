<?session_start();?>
<?php
    include 'dbconnect.php'; 
    if(isset($_POST['doctor_id']) && isset($_POST['password']))
    {
        $id = $_POST['doctor_id'];
        $password = $_POST['password'];

        #Using sha256 hash for password 
        $password = hash("sha256",$password);

        #sanitizing the user input for preventing sql injection 
        $sanitized_userid = mysqli_real_escape_string($db, $id); 
        $sanitized_password = mysqli_real_escape_string($db, $password); 

        $query = "select * from doctortable where id = '".$sanitized_userid."' and password='".$sanitized_password."' and is_verified=1";
        $result = mysqli_query($db,$query) or die(mysqli_errno($db));
        if(mysqli_fetch_array($result) > 0){
            echo "<script>alert('login successul')</script>";
            $_SESSION['d_id']=$sanitized_userid;
            setcookie("d_id", $sanitized_userid, time() + (86400 * 30), "/");
            header("location:./patientdetail.php");
        }
        else{
            echo "<script>alert('invalid password or username')</script>";
        }

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>
<body style="background-image: url('./images/bgnew1.webp');background-size: cover;">
<section class="vh-100" >
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="./images/login2.svg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height: -webkit-fill-available;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="./login.php" method="post">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">EHR Doctor Login</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="text" id="form2Example17" class="form-control form-control-lg" name="doctor_id" required/>
                    <label class="form-label" for="form2Example17">Doctor ID</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" required/>
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="./signup.php"
                      style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>


