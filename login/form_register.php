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
                                <div class="card-header"><strong>New Registration</strong></div>
                                <div class="card-body">
                                    <form method="POST" action="register.php">
                                        <div class="form-group"><label class="text-muted">Nama</label><input type="text" name="nama" class="form-control" placeholder="Your Name"> </div>
                                        <div class="form-group"><label class="text-muted">Email</label><input type="text" name="email" class="form-control" placeholder="Your email"> </div>
                                        <div class="form-group"><label class="text-muted">Password</label><input type="password" name="password" class="form-control" placeholder="Type your password and keep it save"> </div>
                                        <div class="form-group"><label class="text-muted">Retype Password</label><input type="password" name="password_confirm" class="form-control" placeholder="Retype your password "> </div>
                                        <div class="form-group">

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