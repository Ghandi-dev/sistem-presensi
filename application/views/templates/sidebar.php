<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 <?php echo $this->session->userdata('sidebar_type') ?: "bg-white" ?>"
    id="sidenav-main" data-color="<?php echo $this->session->userdata('sidebar_color') ?: "primary" ?>">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html"
            target="_blank">
            <img src="<?php echo base_url() ?>assets/img/logo-desa-cigelam.png ?>">
            <span class="ms-1 font-weight-bold">Sistem Absensi</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo $title === 'Dashboard' ? 'active' : '' ?>"
                    href="<?php echo base_url('admin') ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chart-pie-35"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $title === 'Absensi' ? 'active' : '' ?>"
                    href="<?php echo base_url('admin/absensi') ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 "></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $title === 'Pegawai' ? 'active' : '' ?>"
                    href="<?php echo base_url('admin/pegawai') ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Pegawai</span>
                </a>
            </li>
        </ul>
    </div>
</aside>