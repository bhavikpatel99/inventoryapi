 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="#" class="brand-link">
         <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="hotellogo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">
             <?php
                 if (session('hotelId') == 0 || session('hotelId') == null) {
                     echo 'Hotel Management';
                 } else {
                     echo 'Hotel Management';
                 }
            ?>
         </span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <?php
                    if (session('profileImg') == null) {
                        echo '<img src="' . base_url('assets/dist/img/user2-160x160.jpg') . '" class="img-circle elevation-2" alt="User Image">';
                    } else {
                        echo '<img src="' . base_url('assets/uploads/') . session('profileImg') . '" class="img-circle elevation-2" alt="User Image">';
                    }
                    ?>
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?= session('userName'); ?></a>
             </div>
         </div>
         <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
             <a href="#" class="btn btn-outline-warning ml-2">
                 <i class="fa fa-user" style="color: white;"></i>
             </a>
             <a href="#" class="btn btn-outline-secondary ml-2">
                 <i class="fa fa-info-circle" style="color: white;"></i>
             </a>
             <a href="<?= base_url('/logout')?>" class="btn btn-outline-primary ml-2">
                 <i class="fa fa-power-off" style="color: white;"></i>
             </a>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <li class="nav-item">
                     <a href="<?= site_url('/') ?>" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">Master</li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>