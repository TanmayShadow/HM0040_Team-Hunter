<?php
    include 'dbconnect.php'; 
    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['hname']) 
        && isset($_POST['city']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $hname = $_POST['hname'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        
        
        $gender="other";
        if(isset($_POST['male'])){
            $gender="male";
        }
        else if(isset($_POST['female'])){
            $gender="female";
        }


        #Using sha256 hash for password 
        $password = hash("sha256",$password);


        $sanitized_fname = mysqli_real_escape_string($db, $fname); 
        $sanitized_lname = mysqli_real_escape_string($db, $lname); 
        $sanitized_hname = mysqli_real_escape_string($db, $hname); 
        $sanitized_city = mysqli_real_escape_string($db, $city); 
        $sanitized_phone = mysqli_real_escape_string($db, $phone); 
        $sanitized_email = mysqli_real_escape_string($db, $email); 
        $sanitized_password = mysqli_real_escape_string($db, $password); 

        $query = "select * from doctortable where d_hospital='".$sanitized_hname."'";
        $result = mysqli_query($db,$query) or die(mysqli_errno($db));
        // if($result){
        if ($result = mysqli_query($db, $query)) {
            $rowcount = mysqli_num_rows( $result );
            $id=$sanitized_hname."".$rowcount;

            $q = "insert into doctortable values('".$id."','".$sanitized_fname."','".$sanitized_lname."','".$sanitized_hname."','".$sanitized_email."','".$sanitized_password."','".$sanitized_phone."',0,'".$gender."')";
            if(mysqli_query($db,$q)){
                echo "<script>alert('Registered Successfully')</script>";
                header("location:./login.php");
            }
            else
                echo "<script>alert('Unable to register')</script>";
        }

    }
?>  

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Signup</title>
</head>

<body style="background-image: url('./images/signup_bg.jpg');background-size:cover;">
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" arialabel="Close"></button>
        </div>
    </div>
    <section class="">
        <div class="container h-75">
            <div class="row d-flex justify-content-center align-items-center h-100" >
                <div class="col">
                    <div class="card card-registration my-4" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="./images/signup.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;margin-top:10px; margin-left:10px!important;" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase"><span class="h1 fw-bold mb-0">Registration form</span></h3>
                                    <form action="./signup.php" method="post" onsubmit="submitForm()">
                                        <div class="row">
                                            <div class="col-md-6 mb-7">
                                                <div class="form-outline">
                                                    <input type="text" id="firstname" class="form-control form-control-lg" name="fname" required />
                                                    <label class="form-label" for="firstname">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-6">
                                                <div class="form-outline">
                                                    <input type="text" id="lastname" class="form-control form-control-lg" name="lname"required />
                                                    <label class="form-label" for="lastname">Last name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-outline mb-6">
                                            <input type="text" id="address" class="form-control form-control-lg" name="hname"required />
                                            <label class="form-label" for="address">Hospital name</label>
                                        </div>

                                        <div class="form-outline mb-6">
                                            <input type="text" id="city" class="form-control form-control-lg" name="city"required />
                                            <label class="form-label" for="city">City of Hospital</label>
                                        </div>

                                        <div class="d-md-flex justify-content-start align-items-center mb-6 py-2">

                                            <h6 class="mb-0 me-4">Gender: </h6>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender" value="option1" name="female"/>
                                                <label class="form-check-label" for="femaleGender">Female</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender" value="option2" name="male"/>
                                                <label class="form-check-label" for="maleGender">Male</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender" value="option3" name="other"/>
                                                <label class="form-check-label" for="otherGender">Other</label>
                                            </div>

                                        </div>

                                        <!-- <div class="row">
                                            <div class="col-md-6 mb-6">

                                                <select class="select" style="margin-bottom: 20px;" id="state">
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                </select>

                                            </div>
                                        </div> -->

                                        <div class="form-outline mb-6">
                                            <input type="tel" id="phone" class="form-control form-control-lg" name="phone" required />
                                            <label class="form-label" for="phone">Phone</label>
                                        </div>

                                        <div class="form-outline mb-6">
                                            <input type="email" id="email" class="form-control form-control-lg" name="email" required />
                                            <label class="form-label" for="email">Email ID</label>
                                        </div>

                                        <div class="form-outline mb-6">
                                            <input type="password" id="password" class="form-control form-control-lg" name="password" required />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="col errorDiv">
                                            <span class="error row" id="eight-char" style="color: red;">Must be 8 character
                                                long</span>
                                            <span class="error row" id="one-upper" style="color: red;">Must contain 1 uppercase
                                                letter</span>
                                            <span class="error row" id="one-special" style="color: red;">Must contain 1 special
                                                character</span>
                                            <span class="error row" id="one-number" style="color: red;">Must contain 1
                                                number</span>
                                        </div>

                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="button" class="btn btn-light btn-lg">Reset all</button>
                                            <button type="submit" class="btn btn-warning btn-lg ms-2">Submit form</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./inputverify.js"></script>
</body>

</html>