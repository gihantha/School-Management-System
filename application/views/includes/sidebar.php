<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<?php    
$user_id = $this->session->userdata['loged_user']['user_id'];
$data['useraccess'] = $this->Usermodel->user_access($user_id);

$acc = $this->Usermodel->user_access($user_id);

  foreach($acc as $row){                                       
    
    $student = $row->student;
    $teacher = $row->teacher;
    $excel_file = $row->excel_file;
    $settings = $row->settings;

    ?>                                                  
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url()?>dashboard">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SMS </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url()?>dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<?php if($student == 1){         ?>

<!-- Nav Item - Students -->
<li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url()?>student">
        <i class="fas fa-fw fa-table"></i>
        <span>Student</span></a>
</li>

<?php } ?>

<?php if($teacher == 1){         ?>

<!-- Nav Item - Users -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url()?>teachers">
        <i class="fas fa-fw fa-table"></i>
        <span>Teacher</span></a>
</li>

<?php } ?>

<?php if($excel_file == 1){         ?>

<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url()?>excelfiles">
        <i class="fas fa-fw fa-table"></i>
        <span>Excel Files</span></a>
</li>

<?php } ?>
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url()?>Studentpdf">
        <i class="fas fa-fw fa-table"></i>
        <span>Student PDF </span></a>
</li>

<?php if($settings == 1){         ?>

 <!-- Nav Item - Settings Collapse Menu -->
 <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Settings</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admin:</h6>
                        <a class="collapse-item" href="<?php echo base_url()?>settings">User</a>
                        
                    </div>
                </div>
            </li>

            <?php } ?>
<?php }   ?>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="<?php echo base_url()?>assets/img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul>
<!-- End of Sidebar -->