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
                                        <h1 class="h4 text-gray-900 mb-4">Reset password!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <label>Email Code</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="" 
                                                placeholder="Code...">
                                                <label>New Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="" 
                                                placeholder="New Password...">
                                                <label>Confirm New Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="" 
                                                placeholder="Confirm New Password...">
                                        </div>
                                        
                                        
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Submit
                                        </a>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url(); ?>login">Back to Login?</a>
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