<!DOCTYPE html>
<html lang="en" class="h-100">
<head>

     <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords" content="job, job search, job portal, job template, bootstrap, bootstrap 5, responsive, modern, user-friendly, web app, frontend">
    <meta name="description" content="Discover Master Of Jobs - the ultimate job searching portal and Bootstrap 5 template. Specially designed for job seekers and recruiters. Master Of Jobs provides advanced features and an easy-to-use interface for creating a top-quality job searching website with frontend">
    <meta property="og:title" content="Master Of Jobs : Job Portal & Dashboard Template + FrontEnd">
    <meta property="og:description" content="Discover Master Of Jobs - the ultimate job searching portal and Bootstrap 5 template. Specially designed for job seekers and recruiters. Master Of Jobs provides advanced features and an easy-to-use interface for creating a top-quality job searching website with frontend">
    <meta property="og:image" content="https://MasterOfJobs.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- PAGE TITLE HERE -->
    <title>Master Of Jobs</title>
    
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    
   <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    
</head>
<body class="h-100">
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
    <div class="login-account">
        <div class="row h-100">
            <div class="col-lg-6 align-self-start">
                <div class="account-info-area" style="background-image: url('<?= base_url('images/rainbow.gif') ?>')">
                    <div class="login-content">
                        <p class="sub-title">Log in to your Blog portal dashboard with your credentials</p>
                        <h1 class="title">VSC-OFFSHORE</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 mx-auto align-self-center">
                <div class="login-form">
                    <div class="login-head">
                        <h3 class="title">Welcome Back</h3>
                        <p>Login page allows users to enter login credentials for authentication and access to secure content.</p>
                    </div>
                    <h6 class="login-title"><span>Login</span></h6>
                    <form action="<?= base_url('admin/login') ?>" method="post">
                        <div class="mb-4">
                            <label class="mb-1 text-dark">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email" value="" placeholder="username">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 text-dark">Password</label>
                            <input type="password" class="form-control form-control-lg" name="pass" value="" placeholder="password">
                        </div>
                       
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?= base_url('vendor/global/global.min.js') ?>"></script>
    <script src="<?= base_url('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') ?>"></script>
    <script src="<?= base_url('js/custom.min.js') ?>"></script>
    <script src="<?= base_url('js/deznav-init.js') ?>"></script>

</body>

</html>
