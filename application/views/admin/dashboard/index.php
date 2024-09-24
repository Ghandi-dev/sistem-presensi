<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head')?>
</head>

<body class="g-sidenav-show bg-gray-200">
    <?php $this->load->view('templates/sidebar')?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid px-4">
            <?php $this->load->view('templates/navbar')?>
            <!-- Content -->
            <h1>Ini dashboard</h1>
        </div>
        <!-- Navbar -->
        <!-- Footer -->
        <?php $this->load->view('templates/footer')?>
    </main>
    <?php $this->load->view('templates/script')?>
</body>

</html>