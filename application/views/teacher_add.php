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
                    <h1 class="h3 mb-2 text-gray-800">Add Teacher</h1>
                    <p class="mt-4">Please fill New Teacher Details.</p>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="user" id="formaddteacher">
                                <div class="form-group ">

                                    <label>Teacher Name</label>
                                    <input type="text" class="form-control form-control-user" id="name" placeholder="Please Enter Name" required>

                                    <!-- <div class="col-sm-6">
                                        <label>Last Name</label>

                                            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                                        </div> -->
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label> Teacher Phone</label>

                                        <input type="text" class="form-control form-control-user" id="phone" placeholder="Please Enter Phone Number" required>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Teacher Email</label>

                                    <input type="email" class="form-control form-control-user" id="email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <label>Teacher Address</label>

                                    <textarea class="form-control form-control-user" id="address" placeholder="Address" required>

                                        </textarea>

                                </div>

                                <button  class="btn btn-primary btn-user btn-block"> Add Teacher </button>
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
$('#formaddteacher').on('submit', function(e) {
            e.preventDefault();
 
            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var address = $('#address').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>add_new_teacher",
                data: 'name=' + name + '&phone='  + phone + '&email=' + email+ '&address=' + address,
                success: function(result) {
                    var resdata = $.parseJSON(result);

                    if (resdata.status=='success') {
                        Swal.fire({
                            title: 'New Teacher!',
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