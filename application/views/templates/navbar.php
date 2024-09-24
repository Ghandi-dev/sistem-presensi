<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl
    blur shadow-blur mt-3 left-auto top-5 bg-white" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3 d-flex justify-content-between">
        <!-- Bagian kiri navbar -->
        <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0"><?php echo $title ?></h6>
        </nav>

        <!-- Bagian kanan navbar -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <img src="<?php echo base_url('assets/img/foto/') . $this->session->userdata('foto') ?>"
                                class="avatar fixed-plugin-button-nav cursor-pointer">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="fixed-plugin">
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 d-flex align-items-center">
            <img src="<?php echo base_url('assets/img/foto/') . $this->session->userdata('foto') ?>" class="avatar me-3"
                alt="">
            <div class="flex-grow-1">
                <h5 class="mb-0"><?php echo $this->session->userdata('username') ?></h5>
                <p class="mb-0"><?php echo $this->session->userdata('jabatan') ?></p>
            </div>
            <div>
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
        </div>

        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="change-colors badge filter bg-gradient-primary" data-color="primary"></span>
                    <span class="change-colors badge filter bg-gradient-dark" data-color="dark"></span>
                    <span class="change-colors badge filter bg-gradient-info" data-color="info"></span>
                    <span class="change-colors badge filter bg-gradient-success" data-color="success"></span>
                    <span class="change-colors badge filter bg-gradient-warning" data-color="warning"></span>
                    <span class="change-colors badge filter bg-gradient-danger" data-color="danger"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="d-none d-lg-block">
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn btn-color-sidenav bg-gradient-primary w-100 px-3 mb-2"
                        data-class="bg-transparent">Transparent</button>
                    <button class="btn btn-color-sidenav bg-gradient-primary w-100 px-3 mb-2 ms-2"
                        data-class="bg-white">White</button>
                </div>
            </div>
            <!-- Navbar Fixed -->
        </div>
    </div>
</div>