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

                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Students</h1>
                        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Student Details</h6>
                                <a href="<?php echo base_url();?>student/student_add" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-user-plus"></i>
                                    </span>
                                    <span class="text">Add Student</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="studenttbl" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>

                                        </thead>
                                       
                                        
                                    </table>
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
    <!-- https://cdn.datatables.net/2.0.8/js/dataTables.js -->
    <script>
$(document).ready(function() {
    $('#studenttbl').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('Student/get_all_students') ?>",
            "dataType": "json",
            "type": "POST",
        },
        "columns": [
            {"data":"name"},
            {"data":"phone"},
            {"data":"email"},
            {"data":"address"}

        ]
        
    });
});
</script>

</body>

</html>