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
                    <h1 class="h3 mb-2 text-gray-800">Add Student</h1>
                    <p class="mt-4">Please fill New Students Details.</p>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="student" id="student_form">
                                    <div class="form-group ">

                                        <label>Name</label>
                                        <input type="text" class="form-control form-control-student" id="name" placeholder="Please Enter Name">

                                        <!-- <div class="col-sm-6">
                                        <label>Last Name</label>

                                            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                                        </div> -->
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label>Phone</label>

                                            <input type="text" class="form-control form-control-student" id="phone" placeholder="Please Enter Phone Number">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>

                                        <input type="email" class="form-control form-control-student" id="email" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>

                                        <textarea class="form-control form-control-student" id="address" placeholder="Address">

                                        </textarea>

                                    </div>

                                    <button class="btn btn-primary btn-user btn-block">
                                        Add Student
                                    </button>
                                    <hr>

                                </form>
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
        $('#student_form').on('submit', function(e) {
            e.preventDefault();

            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var address = $('#address').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>add_new_student",
                data: 'name=' + name + '&phone=' + phone + '&email=' + email + '&address=' + address,
                success: function(result) {
                    var resdata = $.parseJSON(result);

                    if (resdata.status == 'success') {
                        Swal.fire({
                            title: 'New Student!',
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

        });
    </script>
</body>

</html>