<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("includes/head") ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="loginForm">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter User Name..." id="inputusername">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Password" id="inputpassword">
                                        </div>
                                        <n/>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url(); ?>login/forgot_password">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            var uname = $('#inputusername').val();
            var upass = $('#inputpassword').val();


            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>user_login",
                data: 'username=' + uname + '&password=' + upass,
                success: function(result) {
                    var resdata = $.parseJSON(result);

                    if (resdata.status == 'success') {
                        
                        window.location.replace(resdata.message);
                    } else {
                        Swal.fire({
                              title: 'Login!',
                            text: resdata.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }

                },
                error: function(result) {
                    alert(error);
                }
            });


        });
    </script>


</body>


</html>