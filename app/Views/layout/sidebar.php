<section class="sidebar position-relative">
    <div class="user-profile px-20 py-15">
        <div class="d-flex align-items-center">
            <div class="image">
                <img src="<?= base_url('public/assets/images/avatar/avatar-13.png') ?>" class="avatar avatar-lg bg-primary-light" alt="User Image">
            </div>
            <div class="info">
                <a class="dropdown-toggle px-20" data-toggle="dropdown" href="#">Himakom</a>
                <div class="dropdown-menu">
                    <!-- <a class="dropdown-item" href="#"><i class="ti-user"></i> Profile</a> -->
                    <!-- <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a> -->
                    <!-- <a class="dropdown-item" href="#"><i class="ti-link"></i> Connections</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="ti-shift-right"></i> Logout</a>
                </div>
            </div>
        </div>
        <!-- <ul class="list-inline profile-setting mt-30 mb-20 d-flex justify-content-between"> -->
        <!-- <li><a href="#" data-toggle="tooltip" data-placement="top" title="Search"><i data-feather="search"></i></a></li> -->
        <!-- <li><a href="#" data-toggle="tooltip" data-placement="top" title="Notification"><i data-feather="bell"></i></a></li> -->
        <!-- <li><a href="#" data-toggle="tooltip" data-placement="top" title="Chat"><i data-feather="message-square"></i></a></li> -->
        <!-- <li><a href="#" data-toggle="tooltip" data-placement="top" title="Logout"><i data-feather="log-out"></i></a></li> -->
        <!-- </ul> -->
    </div>
    <div class="multinav">
        <div class="multinav-scroll" style="height: 100%;">
            <!-- sidebar menu-->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview-menu">
                <li>
                    <a href="<?= base_url('/') ?>"><i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                        <span>Dashboard</span>
                </li>
                </li>
                <li class="header">Proposal </li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                        <span>Dokumen Proposal</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- USER -->
                        <li><a href="<?= base_url('/submit_proposal') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Proposal</a></li>
                        <li><a href="<?= base_url('/list_proposal') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Proposal</a></li>
                        <!-- ADMIN -->
                        <li><a href="<?= base_url('/approve_proposal') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Approve Proposal</a></li>
                    </ul>
                </li>
                <li class="header">Surat </li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-Mail"><span class="path1"></span><span class="path2"></span></i>
                        <span>Persuratan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- USER -->
                        <li><a href="<?= base_url('/submit_surat') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Surat</a></li>
                        <!-- ADMIN DAN USER -->
                        <li><a href="<?= base_url('/list_surat_masuk') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Surat Masuk</a></li>
                        <!-- USER -->
                        <li><a href="<?= base_url('/list_surat_keluar') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Surat Keluar</a></li>
                    </ul>
                </li>
                <!-- USER -->
                <li class="header">Laporan Kegiatan</li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-Book-open"><span class="path1"></span><span class="path2"></span></i>
                        <span>Laporan Kegiatan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url('/submit_laporan_hasil_kegiatan') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Laporan</a></li>
                        <li><a href="<?= base_url('/list_laporan_hasil_kegiatan') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Laporan</a></li>
                    </ul>
                </li>
                <!-- ADMIN -->
                <li class="header">Pelaksanaan</li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-Lock-circle"><span class="path1"></span><span class="path2"></span></i>
                        <span>Realisasi Kegiatan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url('/realisasi_kegiatan') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                        <li><a href="<?= base_url('/detail_realisasi_kegiatan') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Detail Kegiatan Lembaga</a></li>
                    </ul>
                </li>
                <!-- ADMIN -->
                <li class="header">Manajemen Pengguna</li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-Lock-circle"><span class="path1"></span><span class="path2"></span></i>
                        <span>Admin</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                    <li><a href="<?= base_url('/add_admin') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Admin</a></li>
                        <li><a href="<?= base_url('/list_admin') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Admin</a></li>            
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                        <span>User</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                    <li><a href="<?= base_url('/add_user') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add User</a></li>
                        <li><a href="<?= base_url('/list_user') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List User</a></li>              
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</section>