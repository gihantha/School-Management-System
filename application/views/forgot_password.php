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
                                        <h1 class="h4 text-gray-900 mb-4">Forgot password!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        
                                        
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Submit
                                        </a>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url(); ?>login">Back to Login?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url(); ?>login/reset_password">Reset Password?</a>
                                    </div>
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