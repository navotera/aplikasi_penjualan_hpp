<?php
//initiate the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <div id="content" class="flex">
        <div class="">
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo ' <div class="alert alert-warning">' . $_SESSION['message'] . '</div>';
                                unset($_SESSION['message']);
                            }
                            ?>

                            <div class="card">
                                <div class="card-header"><strong>Login to your account</strong></div>
                                <div class="card-body">
                                    <form method="POST" action="login.php">
                                        <div class="form-group"><label class="text-muted" for="exampleInputEmail1">Email address</label><input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted">We don't share email with anyone</small></div>
                                        <div class="form-group"><label class="text-muted" for="exampleInputPassword1">Password</label><input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> <small id="passwordHelp" class="form-text text-muted">your password is saved in encrypted form</small></div>
                                        <div class="form-group">
                                            <div class="form-check">Not an user? <a href="form_register.php">Register Now!</a></div>
                                        </div> <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>