<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("includes/head") ?>
    <style>
        .customtbl {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .customtbl td,
        customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .customtbl tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .customtbl tr:hover {
            background-color: #ddd;
        }

        .customtbl th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        
    </style>
</head>

<body id="page-top" onload="get_all_users()">
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
                        <h1 class="h3 mb-2 text-gray-800">User</h1>
                        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                                <a href="<?php echo base_url(); ?>settings/user_add" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-user-plus"></i>
                                    </span>
                                    <span class="text">Add User</span>
                                    
                                </a>
                                <?php if($user_excel_download ==1){ ?>
                                <button onclick="download_excel()">Download</button>
                                <?php }?>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div>
                                        <input type="text" id="search" class="form-control" onkeydown="javascript: if( event.keyCode==13)(get_all_users())">
                                    </div>
                                    <div>
                                        <select class="form-control" id="opt_limit" onchange="get_all_users()">
                                            <option value="3">3</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div><br>
                                <div>
                                    <div class="table-responsive">
                                        <table class="customtbl" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th>Email</th>
                                                    <th>Username</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbody_data">
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        <ul class="pagination" id="pagination_ul">

                                        </ul>
                                    </nav>
                                    <input type="hidden" id="offset" value="0">
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

    <script>
        function get_all_users() {
            $('#tbody_data').empty(); // Clear previous results
            $('#pagination_ul').empty();
            var search = $('#search').val();
            var limit = parseInt($('#opt_limit').val());
            var offset = parseInt($('#offset').val());

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>get_all_users",
                data: 'search=' + search + '&limit=' + limit + '&offset=' + offset,

                success: function(result) {
                    var resdata = $.parseJSON(result);

                    if (resdata.rowcount == 0) { 
                        $('#tbody_data').append('<tr><td colspan="11">No Result</td></tr>')
                    } else {

                        for (var i = 0; i < resdata.all_users.length; i++) {
                            var html = '<tr>' +
                                '<td>' + resdata.all_users[i]['name'] + '</td>' +
                                '<td>' + resdata.all_users[i]['phone'] + '</td>' +
                                '<td>' + resdata.all_users[i]['address'] + '</td>' +
                                '<td>' + resdata.all_users[i]['email'] + '</td>' +
                                '<td>' + resdata.all_users[i]['user_name'] + '</td>' +
                                '</tr>';
                            $('#tbody_data').append(html);
                        }
                        
                        var pagination_html='';
                        var row_count = parseInt(resdata.rowcount);
                        var pages = Math.ceil(row_count/limit);
                        var j=1;
                        
                        if (pages>1){
                            pagination_html='<li class="paginate_button page-item previous disabled" id="dataTable_previous" ><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>';
                            var status = '';
                            for(var i=0; i<pages; i++){
                                if((limit*i)== offset){
                                    status = 'paginate_button page-item active'
                                }else{
                                    status = 'paginate_button page-item'
                                }
                                pagination_html+='<li class=" '+status+'"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link" onclick="offset_field('+(limit*i)+');">'+j+'</a></li>';
                                j++;
                            }
                            pagination_html+='<li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>'

                            
                        } else {
                            $('#pagination_ul').empty();
                            // alert(resdata.rowcount)
                        }

                        $('#pagination_ul').append(pagination_html);

                    }
                    

                },
                error: function(result) {
                    alert('error');
                }


            });
        }

        function offset_field(value){
            $('#offset').val(value);
            get_all_users() 
        }
    </script>
    <script>
        function download_excel(){
            var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('target', 'downloadFrame ');
            form.setAttribute('action', "<?=base_url()?>download_user_excel"); 
            document.body.appendChild(form);
            form.submit();
 
        }
    </script>
</body>

</html>