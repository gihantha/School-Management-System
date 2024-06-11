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
                        <h1 class="h3 mb-2 text-gray-800">Teacher</h1>
                        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Teacher Details</h6>
                                <a href="<?php echo base_url(); ?>teachers/teacher_add" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-user-plus"></i>
                                    </span>
                                    <span class="text">Add Teacher</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="teachertable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($teachers as $row) {

                                                $name = $row->name;
                                                $phone = $row->phone;
                                                $email = $row->email;
                                                $address = $row->address;
                                            ?>
                                                <tr>
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $phone; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $address; ?></td>
                                                    

                                                </tr>
                                            <?php } ?>

                                        </tbody>
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

    <!-- <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.jqueryui.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.print.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.semanticui.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.semanticui.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.bulma.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.foundation.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.jqueryui.js"></script> -->

                                                
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


<script>
$(document).ready(function() {
    $('#teachertable').DataTable({
        "paging": true,
        "responsive": true,
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ]
        // layout: {
        //     topStart: {
        //         buttons: [
        //             'copy', 'excel', 'pdf'
        //         ]
        //     }
        // }
    });
});
</script>

</body>



</html>