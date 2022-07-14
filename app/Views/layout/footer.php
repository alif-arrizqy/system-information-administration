<?php date_default_timezone_set("Asia/Jakarta");
$tahun = date("Y"); ?>
<div class="container">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
            <!-- <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">FAQ</a>
            </li> -->
            <li class="nav-item">
                <?=constant('FOOTER')?>
            </li>
        </ul>
    </div>
    ©<?= $tahun ?> All Rights Reserved.
    <!-- &copy; 2020 <a href="https://www.multipurposethemes.com/">Multipurpose Themes</a>. All Rights Reserved. -->
</div>