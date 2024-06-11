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

                    <?php
                    $username = '';
                    $phone = '';
                    $email = '';
                    $address = '';
                    foreach ($profiledata as $rows) {
                        $username = $rows->user_name;
                        $phone = $rows->phone;
                        $email = $rows->email;
                        $address = $rows->address;
                    }

                    ?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Profile</h1>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        User Details
                                    </div>
                                    <div class="card-body">
                                        <!-- <form class="user"> -->
                                        <div class="form-group ">

                                            <label>User Name</label>
                                            <input type="text" class="form-control form-control-user" id="name" placeholder="Please Enter Name" value="<?= $username; ?>" disabled>


                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>User Phone</label>

                                                <input type="text" class="form-control form-control-user" id="phone" placeholder="Please Enter Phone Number" value="<?= $phone; ?>">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>User Email</label>

                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" value="<?= $email; ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>User Address</label>

                                            <textarea class="form-control form-control-user" placeholder="Address" id="address">
                                            <?= $address; ?>
                                        </textarea>

                                        </div>
                                        <!-- <div class="form-group">
                                        <label>User Password</label>

                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="User Password">
                                    </div> -->

                                        <button class="btn btn-primary btn-user btn-block" onclick="updateprofile()">
                                            Update Profile
                                        </button>
                                        <hr>

                                        <!-- </form> -->
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <center><img width="150px" class="img-profile rounded-circle" src="<?php echo base_url() ?>assets/img/undraw_profile.svg"></center>
                                    </div>
                                    <div class="card-body">
                                        <h4><b>Admin</b></h4>
                                        <p>Engineer</p>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3>Password Reset</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="user" id="changeps">
                                            <div class="form-group ">
                                                <label>Old Password</label>
                                                <input type="text" class="form-control form-control-user" placeholder="Please Enter Old Password" id="oldpass" required>
                                            </div>
                                            <div class="form-group ">
                                                <label>New Password</label>
                                                <input type="text" class="form-control form-control-user" placeholder="Please Enter New Password" id="newpass" required>
                                            </div>
                                            <div class="form-group ">
                                                <label>Confirm Password</label>
                                                <input type="text" class="form-control form-control-user" placeholder="Please Enter New Password" id="conpass" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block"> Change Password </button>
                                        </form>
                                    </div>
                                </div>


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

</body>

<script>
    function updateprofile() {

        var phone = $('#phone').val();
        var address = $('#address').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>updateprofile",
            data: 'phone=' + phone + '&address=' + $('#address').val(),
            success: function(result) {
                var resdata = $.parseJSON(result);

                if (resdata.status == 'success') {
                    Swal.fire({
                        title: 'Profile Updated!',
                        text: resdata.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
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

        readprofile();
    }
</script>

<script>
    function readprofile() {

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>readprofile",
            data: 'phone=' + phone + '&address=' + $('#address').val(),
            success: function(result) {
                var resdata = $.parseJSON(result);

                var phone = resdata.profile[0]['phone'];
                var address = resdata.profile[0]['address'];
                $('#phone').val(phone);
                $('#address').val(address);

                alert(name)

            },
            error: function(result) {
                alert(error);
            }


        });
    };

    
        $('#changeps').on('submit', function(e) {
            e.preventDefault();

            var oldpass = $('#oldpass').val();
            var newpass = $('#newpass').val();
            var conpass = $('#conpass').val();

            if(newpass==conpass){
            
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>changepass",
                data: 'oldpass='+oldpass+'&newpass='+newpass,
                success: function(result) {
                    var resdata = $.parseJSON(result);

                    if (resdata.status=='success') {
                        Swal.fire({
                            title: 'Changed Password!',
                            text: resdata.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Changed Password!',
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

        }else{
            Swal.fire({
                            title: 'Changed Password!',
                            text: 'New Password and Confirm Password mismatched',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
        }
            
            
        });
    
</script>

</html>