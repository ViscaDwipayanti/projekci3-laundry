<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <?php
		$role=$this->session->userdata('role');
		if($role=="admin")
		{
			
		}
		else
		{
				
		}
	?>
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                <i class='bx bxs-washer'></i>
                </div>
                <div class="sidebar-brand-text mx-3">EZWash</div>
            </a>

            <!-- Divider --> 
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
             <!-- active button = class="nav-item active" -->
            <li class="nav-item nav-custom">
                <a class="nav-link" href="<?= base_url()?>dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php
			    if($role=="admin")
			    {
			?>
             <!-- Nav Item - Charts -->
             <li class="nav-item nav-custom">
                <a class="nav-link" href="<?= base_url();?>layanan">
                <i class="fa-solid fa-basket-shopping"></i>
                    <span>Layanan</span></a>
            </li>
            <?php
			    }
			?>

            <!-- Nav Item - Tables -->
            <li class="nav-item nav-custom">
                <a class="nav-link" href="<?= base_url();?>member">
                <i class="fa-solid fa-user-group"></i>
                    <span>Member</span></a>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item nav-custom">
                <a class="nav-link" href="<?= base_url('transaksi')?>">
                <i class="fa-solid fa-wallet"></i>
                    <span>Transaksi</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <?php
			    if($role=="admin")
			    {
			?>
            <li class="nav-item nav-custom">
                <a class="nav-link" href="<?= base_url('laporan')?>">
                <i class="fa-solid fa-chart-line"></i>
                    <span>Laporan</span></a>
            </li>
            <?php
                }
            ?>

            <!-- Nav Item - Tables -->
            <?php
			    if($role=="admin")
			    {
			?>
            <li class="nav-item nav-custom">
                <a class="nav-link" href="<?= base_url('user')?>">
                <i class="fa-solid fa-user-gear"></i>
                    <span>Data User</span></a>
            </li>
            <?php
                }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>