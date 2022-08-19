<?php
    foreach($get_lembaga->getResult() as $rs) {
        $id_lembaga = $rs->id_lembaga;
        $nama_lembaga = $rs->nama_lembaga;
        $nama_lembaga = str_replace('_', ' ', $nama_lembaga);
        $tingkat_lembaga = $rs->tingkat_lembaga;
    }
    $id_user = session()->get('id_user');
    $db = \Config\Database::connect();
    $query = $db->query("SELECT foto FROM users WHERE id_user = '$id_user'");
    $row = $query->getRowArray();
    $img = $row['foto'];
    
    if ($img) {
        $foto = 'public/uploads/images/'.$img;
    } else {
        $foto = 'public/assets/images/avatar/avatar-13.png';
    }

    $admin = session()->get('status') == 0;
    $user = session()->get('status') == 1;
    $sub_admin = session()->get('status') == 2;
    $guest = session()->get('status') == 3 || session()->get('status') == 4;

    $rektorat = $tingkat_lembaga == 0;
    $univ = $tingkat_lembaga == 1;
    $ukm = $tingkat_lembaga == 2;
    $fakultas = $tingkat_lembaga == 3;
    $prodi = $tingkat_lembaga == 4;
?>
<section class="sidebar position-relative">
    <div class="user-profile px-20 py-15">
        <div class="d-flex align-items-center">
            <div class="image">
                <img src="<?= base_url($foto) ?>" class="avatar avatar-lg bg-primary-light" alt="User Image">
            </div>
            <div class="info">
                <a class="dropdown-toggle px-20" data-toggle="dropdown" href="#"><?= $nama_lembaga?></a>
                <div class="dropdown-menu">
					  <a class="dropdown-item" href="<?= base_url('/view_users') ?>"><i class="ti-user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('login/logout') ?>"><i class="ti-shift-right"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- MENU -->
    <div class="multinav">
        <div class="multinav-scroll" style="height: 100%;">
            <!-- sidebar menu-->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview-menu">
                    <li>
                        <a href="<?= base_url('Home') ?>"><i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
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
                        <?php if ($admin or $sub_admin or $guest) { ?>
                        <li><a href="<?= base_url('/approve_proposal') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Approve Proposal</a></li>
                        <?php } else if ($user) { ?>
                        <li><a href="<?= base_url('/submit_proposal') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Proposal</a></li>
                        <li><a href="<?= base_url('/list_proposal') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Proposal</a></li>
                        <?php } ?>
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
                        <li><a href="<?= base_url('/submit_surat') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Surat</a></li>
                        <li><a href="<?= base_url('/list_surat_masuk') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Surat Masuk</a></li>
                        <li><a href="<?= base_url('/list_surat_keluar') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Surat Keluar</a></li>
                    </ul>
                </li>

                <?php if ($admin) { ?>
                <li class="header">Pelaksanaan</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                            <span>Rekap Kegiatan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/realisasi_kegiatan') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                            <span>Universitas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/univ') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                            <span>UKM</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/ukm') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                            <span>Fakultas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/fak') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                            <span>Program Studi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/prodi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                        </ul>
                    </li>
                
                <li class="header">Kelembagaan Mahasiswa</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Credit-card"><span class="path1"></span><span class="path2"></span></i>
                            <span>Universitas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/submit_lembaga/univ') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Kelembagaan Mhs</a></li>
                            <li><a href="<?= base_url('/list_lembaga/univ') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Kelembagaan Mhs</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Credit-card"><span class="path1"></span><span class="path2"></span></i>
                            <span>UKM</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/submit_lembaga/ukm') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit UKM</a></li>
                            <li><a href="<?= base_url('/list_lembaga/ukm') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List UKM</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Credit-card"><span class="path1"></span><span class="path2"></span></i>
                            <span>Fakultas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/submit_lembaga/fak') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Kelembagaan Mhs</a></li>
                            <li><a href="<?= base_url('/list_lembaga/fak') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Kelembagaan Mhs</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Credit-card"><span class="path1"></span><span class="path2"></span></i>
                            <span>Program Studi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/submit_lembaga/prodi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Kelembagaan Mhs</a></li>
                            <li><a href="<?= base_url('/list_lembaga/prodi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Kelembagaan Mhs</a></li>
                        </ul>
                    </li>                
                <li class="header">Manajemen Pengguna</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                            <span>Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                        <li><a href="<?= base_url('/submit_users') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Users</a></li>
                        <li><a href="<?= base_url('/list_users') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Users</a></li>              
                        </ul>
                    </li>
                <?php }?>

                <?php if($user) { ?>
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
                <?php } ?>

                <li class="header">Dana Subsidi </li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-File"><span class="path1"></span><span class="path2"></span></i>
                        <span>Dana Subsidi</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($admin or $sub_admin or $guest) { ?>
                        <li><a href="<?= base_url('/approve_dana_subsidi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Approve Dana Subsidi</a></li>
                        <?php } else if ($user) { ?>
                        <li><a href="<?= base_url('/submit_dana_subsidi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Submit Dana Subsidi</a></li>
                        <li><a href="<?= base_url('/list_dana_subsidi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Dana Subsidi</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <?php if ($guest || $sub_admin) { ?>
                    <li class="header">Pelaksanaan</li>
                    <?php if ($rektorat) { ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                                <span>Universitas</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/univ') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                                <span>UKM</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/ukm') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                            </ul>
                        </li>
                    <?php } else if ($fakultas) { ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                                <span>Fakultas</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/fak') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                        <a href="#">
                            <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
                            <span>Program Studi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/realisasi_kegiatan_lembaga/prodi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Realisasi Kegiatan</a></li>
                        </ul>
                        </li>
                <?php } } ?>
            </ul>
        </div>
    </div>

</section>