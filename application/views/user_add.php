<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("includes/head") ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view("includes/sidebar") ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view("includes/topbar") ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add User</h1>
                    <p class="mt-4">Please fill New User Details.</p>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                
                                    <div class="form-group ">
                                        
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-user" id="name" placeholder="Please Enter Name">
                                        
                                    </div>
                                    <div class="form-group ">
                                        
                                            <label>User Name</label>
                                            <input type="text" class="form-control form-control-user" id="username" placeholder="Please Enter User Name">
                                        
                                    </div>

                                    <div class="form-group row">
                                   
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>User Phone</label>

                                            <input type="text" class="form-control form-control-user" id="phone" placeholder="Please Enter Phone Number">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                    <label>User Email</label>

                                        <input type="email" class="form-control form-control-user" id="emailid" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">    
                                    <label>User Address</label>

                                        <textarea class="form-control form-control-user"
                                        id="address" 
                                        placeholder="Address">

                                        </textarea>
                                        
                                    </div>
                                    
                                    
                                    <button  class="btn btn-primary btn-user btn-block" onclick="add_new_user()">
                                        Add User
                                    </button>
                                    <hr>

                                
                            </div>
                            

                        </div>






                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php $this->load->view("includes/footer") ?>
        </div>
        <!-- End of Content Wrapper -->



    </div>

    <?php $this->load->view("includes/js") ?>

    <script>
        function add_new_user(){

            var name = $('#name').val();
            var username = $('#username').val();
            var phone = $('#phone').val();
            var email = $('#emailid').val();
            var address = $('#address').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>add_new_user",
                data: 'name=' + name + '&username='  + username +'&phone='  + phone + '&email=' + email+ '&address=' + address,
                success: function(result) {
                    var resdata = $.parseJSON(result);

                    if (resdata.status=='success') {
                        Swal.fire({
                            title: 'New User!',
                            text: resdata.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
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
        }
    </script>

</body>

</html>