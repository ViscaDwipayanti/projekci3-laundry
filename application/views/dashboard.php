<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=""> 
    <meta name="author" content="">
 
    <title>EZWash_LaundyWeb</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="<?= base_url()?>assets/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.css">
    <!-- Icon -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <style>
        :root{
            --primary: #689ebe;
            --secondary: #3e6a8d;
            --tertiary: #2c3c4c;
            --lighblue: #486cfc; 
            --blue : #063970;
         

        }

        .sidebar{
            background-color:var(--secondary) ;
        }
        .btn-custom{
            background-color: var(--secondary);
            color: aliceblue;
        }
        .btn-custom:hover{
            background-color: var(--tertiary);
            color: aliceblue;
        }

        .label-custom{
            font-size: 15px;
            margin-bottom: 3px;
        }

        ::placeholder{
            font-size: 15px;
        }

        .opsi{
            font-size: 15px;
        }

        .form-custom{
            font-size: 15px;
            border: 1px solid gray;
        
        }

        .modal {
            z-index: 1050; 
        }

        th{
            background-color: var(--tertiary);
            color: white;
        }

        .nav-item span {
            font-weight: 600;
        }

        .nav-custom:hover{
            background-color: var(--tertiary);
        }

        .nav-custom:active{
            background-color: var(--tertiary);
        }

        .dropdown-item:hover{
            background-color: var(--tertiary);
            color: white;
        }

        .table td img {
            max-width: 50px;
            height: auto;
            border-radius: 5px; 
        }

        /* .profile-settings {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        } */
        .profile-settings .avatar {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-settings .avatar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-settings .avatar button {
            margin-right: 10px;
        }

 

    </style>



</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper"> 

        <!-- Sidebar -->
        <?php
            $this->load->view('menu');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= isset($user['username']) ? htmlspecialchars($user['username']) : 'Guest'; ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?= isset($user['image']) && !empty($user['image']) ? base_url('uploads/' . $user['image']) : base_url('assets/img/undraw_profile_1.svg'); ?>" 
                                    alt="User Profile Picture">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile')?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> 
                                    Profile
                                </a>
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="<?= base_url('auth/logout')?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php
                    $this->load->view($content);
                ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Proyek UAS 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url()?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url()?>assets/vendor/chart.js/Chart.min.js"></script>
    

    <script src="<?= base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url()?>assets/js/demo/datatables-demo.js"></script>
    
    <!-- Page level custom scripts -->
    <script src="<?= base_url()?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url()?>assets/js/demo/chart-pie-demo.js"></script>



</body>

</html>