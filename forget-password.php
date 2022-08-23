<?php 

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


include('google-config.php');
include('admin/config.php');



    if(isset($_SESSION['user_info'])){
        header('location:index.php');
    }


?>


<!doctype html>
<html lang="en">

<head>
    <meta>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/b690895109.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time();?>">
    <title>TOKEN FINDER</title>
</head>

<body>


    <div class="container-fluid login-parent">
        <a href="index.php"><i class="fas fa-angle-left arrow"></i></a>
        <div class="row mx-0">
            <div class="col-5 d-lg-flex d-none  login-left">

                <h3 class="text-center">Find the next <br> token gem</h3>
                <img src="assets/images/robot-1.png" alt="">
                <span class="bottom-text">Sign up to claim your welcome gift</span>
            </div>
            <div class="col-lg-7 col-12 login-right">
                <div class="right-top">
                    <span class="pe-lg-4 pe-2">Haven’t registered? <a href="register.php" class="gradient-text">Sign up
                            now</a></span>
                    <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            English
                        </button>
                        <ul class="dropdown-menu">
                            <li class="ps-2"><a href="">English</a> </li>
                            <li class="ps-2"><a href="">French</a> </li>
                            <li class="ps-2"><a href="">Arabic</a> </li>
                        </ul>
                    </div>
                </div>
                <span class="login-head py-5 ">Forgot Password ?</span>


                <ul class="nav  form-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php  if(!isset($_GET['tab'])){ echo 'active';}?> " id="home-tab"
                            data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Phone</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link <?php  if(isset($_GET['tab'])){ if($_GET['tab']=='email'){echo 'active';}}?>"
                            id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">Email</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade  <?php  if(!isset($_GET['tab'])){ echo 'show active';}?> " id="home"
                        role="tabpanel" aria-labelledby="home-tab">
                        <form action="login-phone.php" method="POST">

                            <label for="exampleInputEmail1" class="form-label ">Phone </label>
                            <div class="d-flex justify-content-between mb-4 ">
                                <div class="input-group   number-inp " style="flex: 1;">
                                    <span class="input-group-text"> + 1 </span>
                                    <input type="number" name="number" class="form-control cs-inp-1" required>
                                </div>
                                <button class="submit-btn ms-2 px-4" style="font-size: 13px;">Send Code</button>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label ">Phone vérification code</label>
                                <div class="">
                                    <input type="number" name="code" class="form-control cs-inp-1" required>
                                </div>
                            </div>
                            <input name="submit" type="submit" class="submit-btn w-100 mt-3" value="Submit">
                        </form>

                    </div>
                    <div class="tab-pane fade <?php  if(isset($_GET['tab'])){ if($_GET['tab']=='email'){echo 'show active';}}?>"
                        id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="forget-password-db.php" method="POST">
                            <label for="exampleInputEmail1" class="form-label ">Email </label>
                            <div class="d-flex justify-content-between  mb-4">
                                <input type="email" name="email" style="flex:1;" placeholder="Email" value=""
                                    id="forget-email-input" class="form-control cs-inp-1" required>
                                <span class="submit-btn ms-2 px-4 d-flex align-items-center " id="forget-email-btn"
                                    style="font-size: 13px; cursor: pointer;">Send Code</span>
                            </div>
                            <div class="pb-3" id="forget-password-email-error">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label ">Email vérification code</label>
                                <div class="">
                                    <input type="number" name="code-2" class="form-control cs-inp-1" required>
                                    </span>
                                </div>
                            </div>
                            <input name="submit" type="submit" class="submit-btn w-100 mt-3" value="Submit">
                        </form>

                        <?php
                            if(isset($_SESSION['error'])){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="assets/js/search.js?v=<?php echo time();?>"></script>
<script src="assets/js/number-formator.js?v=<?php echo time();?>"></script>

<script>
    hidecoun = 0
    const passwordvis = (ele) => {
        if (hidecoun == 1) {
            ele.innerHTML = "<i class='fa fa-eye-slash' ></i>"
            ele.parentElement.querySelector('input').type = "password"
            hidecoun = 0
        }
        else {
            ele.innerHTML = "<i class='fas fa-eye'></i>"
            ele.parentElement.querySelector('input').type = "text"
            hidecoun = 1
        }
    }
</script>

<script>

    // ajax
    let forget_mail_btn = document.querySelector('#forget-email-btn')
    let forget_mail_input = document.querySelector('#forget-email-input')

    forget_mail_btn.onclick = () => {
        if (forget_mail_input.value != '' && forget_mail_input.value != ' ' && forget_mail_input.value.indexOf('@') > -1) {
            console.log(forget_mail_input.value);
            document.querySelector('#forget-password-email-error').innerHTML = ``

            // AJAX

            var objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status === 200) {
                        if (objXMLHttpRequest.responseText != '') {
                            document.querySelector('#forget-password-email-error').innerHTML = objXMLHttpRequest.responseText
                        }
                    } else {
                        alert('Error Code: ' + objXMLHttpRequest.status);
                        alert('Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }
            let request = 'mailer.php?email='+forget_mail_input.value;
            objXMLHttpRequest.open('GET', request, true);
            objXMLHttpRequest.send();
            document.querySelector('#forget-password-email-error').innerHTML = `<small class="text-primary">Processing <i class="fas fa-spinner fa-spin"></i></small>`
        }

        else {
            document.querySelector('#forget-password-email-error').innerHTML = `<small class="text-danger">Please Enter Valid Email Address <i class="fas fa-info-circle"></i></small>`
        }
    }

</script>

</html>