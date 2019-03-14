<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Procoding</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo URLROOT;?>/css/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo URLROOT;?>/css/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo URLROOT;?>/css/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo URLROOT;?>/css/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Login</h3>
                    </div>
                    <br>
                    <div class="panel-body">
                        <form action="<?php echo URLROOT;?>/users/login" method="post" form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" value="<?php echo !empty($data['email'])?$data['email']:"";?>" type="email" autofocus>
                                    <span style="color:red;"><b><?php echo !empty($data['email_err'])?$data['email_err']:"";?></b></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" value="<?php echo !empty($data['password'])?$data['password']:"";?>" type="password" value="">
                                    <span style="color:red;"><b><?php echo !empty($data['password_err'])?$data['password_err']:"";?></b></span>
                                </div>
                                <br>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="click" value="Login" class="btn btn-success" style="width:100%">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo URLROOT;?>/css/admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo URLROOT;?>/css/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo URLROOT;?>/css/admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo URLROOT;?>/css/admin/dist/js/sb-admin-2.js"></script>

</body>

</html>
