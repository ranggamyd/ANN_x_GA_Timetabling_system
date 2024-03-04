<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.min.css">

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato: 400, 700, 900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                "urls": ["/assets/css/fonts.min.css"]
            },
            active: function() {
                sessionStorage.fonts = true
            }
        });
    </script>

    <title><?= $title ?> - GNA Scheduling System</title>
</head>

<body class="login">
    <div class="wrapper wrapper-login wrapper-login-full p-0" style="background: url('/assets/img/login-bg.jpg'); background-size: cover; background-position: center;">
        <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center">
            <img src="/assets/img/umc.png" alt="UMC Logo" style="width: 120px;">
            <h1 class="title fw-bold text-white mt-2 mb-0">GNA - Scheduling System</h1>
            <p class="subtitle text-white op-8">Penjadwalan Mata Kuliah Fakultas Teknik Universitas Muhammadiyah Cirebon</p>
        </div>
        <div class="login-aside w-50 d-flex align-items-center justify-content-center">
            <div class="container container-login container-transparent animated fadeIn bg-light ml-md-5">
                <h3 class="text-center">Login to Your Account</h3>
                <div class="login-form">
                    <form action="/auth/login" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="username" class="placeholder"><b>Username</b></label>
                            <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control" id="username" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="placeholder"><b>Password</b></label>
                            <!-- <a href="#" class="link float-right">Forget Password ?</a> -->
                            <div class="position-relative">
                                <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control" id="password" required>
                                <div class="show-password">
                                    <i class="icon-eye text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberme" checked>
                                <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign In<i class="fas fa-sign-in-alt ml-2"></i></button>
                        </div>
                        <!-- <div class="login-account">
                        <span class="msg">Don't have an account yet ?</span>
                        <a href="#" id="#" class="link">Sign Up</a>
                    </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

    <!-- Sweet Alert -->
    <script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="/assets/js/atlantis.min.js"></script>

    <script>
        $(document).ready(function() {
            <?php if (session()->getFlashdata('success')) : ?>
                Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: '<?= session()->getFlashdata('success') ?>',
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).fire();
            <?php endif ?>

            <?php if (session()->getFlashdata('error')) : ?>
                Swal.mixin({
                    toast: true,
                    icon: 'error',
                    title: '<?= session()->getFlashdata('error') ?>',
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).fire();
            <?php endif ?>
        });
    </script>
</body>

</html>