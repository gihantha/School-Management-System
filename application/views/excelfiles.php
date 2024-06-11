<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("includes/head") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <h1 class="h3 mb-2 text-gray-800">Working with Excel</h1>
                    <p class="mb-4">Excel</p>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" accept=".csv, xls" onchange="checkfile(this)" id="importfile" />
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

        function checkfile(){
            var fileextension = new Array(".csv",".xls");
            var fileext = $('#importfile').val();
            fileext = fileext.substring(fileext.lastIndexOf('.'));

            if(fileextension.indexOf(fileext)<0){
                alert('error');

            }else{

                 var file = $('#importfile').prop('files')[0];
                 var form =  new FormData();
                 form.append('excelinput', file);

                        $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>upload_excel",
                        cache:false,
                        contentType:false,
                        processData: false,
                        data: form,
                        success: function(result) {

                                var resdata = $.parseJSON(result);

                                    for(var i=0; i<resdata.length; i++){

                                        

                                        if(resdata[i].status == 'error'){

                                           
                                            toastr.error((i+1)+" - "+resdata[i].message);

                                        }else if(resdata[i].status == 'success'){

                                            toastr.success((i+1)+" - "+resdata[i].message);

                                        }else if(resdata[i].status == 'info'){

                                            toastr.info((i+1)+" - "+resdata[i].message);

                                        }else{
                                            toastr.warning((i+1)+" - "+resdata[i].message);
                                        }

                                    }

                                    },
                                    error: function(result) {
                                        alert(error);
                                    }


                        });

                   
            }

            
        }

    </script>
</body>





</html>