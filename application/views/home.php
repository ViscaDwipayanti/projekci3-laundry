<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Pendapatan</title>
    

</head> 

<style>
    .chart-area {
        position: relative;
        height: 100%; 
        width: 100%; 
    }
    .card-body {
        padding: 20px; 
    }
    .mychart {
        display: block; 
        height: 100%; 
        width: 100%; 
    }


    a {
    text-decoration: none !important;
    }

    .status-baru {
        background-color: #007bff;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }
    .status-diproses {
        background-color: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }
    .status-selesai {
        background-color: #ffc107;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }
    .status-diambil {
        background-color:rgb(246, 68, 68);
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }
</style>

<body>
<?php
		$role=$this->session->userdata('role');
		if($role=="admin")
		{
			
		}
		else
		{
				
		}
	?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
        </div>

        <!-- Content Row --> 
        <div class="row">
            <!-- Order Baru Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= base_url('transaksi')?>">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Order Baru (Harian)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_transaksi_baru?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div> 

             <!--  Tenggat Pengambilan Order Hari Ini Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= base_url('transaksi')?>">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tenggat Pengambilan Hari Ini
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_tenggat_pengambilan?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <!-- Jumlah member Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= base_url('member')?>">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Member Terdaftar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_member?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

           <?php
                if($role=="admin")
                {
           ?>

            <!-- Pendapatan perbulan  Card -->
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total Pendapatan Bulan Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp. <?= number_format(isset($total_pendapatan_perbulan) ? $total_pendapatan_perbulan : 0, 0, ',', '.') ?>
                                    </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
            

        <?php
                }
        ?>
        
        <?php
                if($role!="admin")
                {
           ?>
        <!-- Pendapatan perhari  Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Pendapatan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp. <?= number_format($total_pendapatan_perhari ?? 0, 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <?php
        }
    ?>

        
        <!-- Content Row --> 

            <!-- Area Chart -->
            <?php
		        if($role!="admin")
		        {
		    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-dark">List Tenggat Pengambilan Hari Ini</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id Transaksi</th>
                                        <th>Member</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Tanggal Ambil</th>
                                        <th>Total</th>
                                        <th>Status Transaksi</th>
                                        <th>Opsi</th> 
                                    </tr>
                                </thead>
                            
                                <tbody>
                                <?php
                                    $no = 1;
                                    foreach($data as $row) {?> 
                                        <tr>
                                            <td><?= $no++?></td>
                                            <td><?= $row->id_transaksi;?></td>
                                            <td><?= $row->nama;?></td>
                                            <td><?= $row->tanggal_transaksi;?></td>
                                            <td><?= $row->tanggal_ambil;?></td>
                                            <td><?= "Rp. ".number_format($row->total,0,'.','.');?></td>
                                            <td>
                                                <?php
                                                if ($row->status_transaksi === 'Baru') {
                                                    echo '<span class="status-baru">Baru</span>';
                                                } elseif ($row->status_transaksi === 'Diproses') {
                                                    echo '<span class="status-diproses">Diproses</span>';
                                                } elseif ($row->status_transaksi === 'Selesai') {
                                                    echo '<span class="status-selesai">Selesai</span>';
                                                } elseif ($row->status_transaksi === 'Diambil') {
                                                    echo '<span class="status-diambil">Diambil</span>';
                                                } else {
                                                    echo $row->status_transaksi;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('transaksi/detail/' . $row->id_transaksi)?>" class="btn btn-sm btn-warning">Detail</a>
                                            </td>
                                        </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>

            <?php
		        if($role=="admin")
		        {
		    ?>

            <!-- Menampilkan card pendapatan bulan tertentu diringkas setiap minggunya -->
             <!-- Masih terdapat error yaitu jumlah pendapatannya tidak terupdate -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myChart" class="mychart"></canvas>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script>
                            function get_pendapatan() {
                                $.ajax({
                                    type: 'GET',
                                    url: '<?= base_url('dashboard/get_pendapatan'); ?>', 
                                    dataType: 'json',  
                                    success: function(response) {
                                        var bulanArray = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                                        var currentDate = new Date();
                                        var currentMonth = currentDate.getMonth();

                                        var labels = [];
                                        var data = [];
                                        var datasetLabel = ''; 
                                    
                                        response.forEach((item, index) => {
                                            labels.push('Minggu ke ' + item.minggu);
                                        
                                            data.push(item.pendapatan);

                                            if (index === 0) {
                                                datasetLabel = 'Pendapatan ' + bulanArray[currentMonth]; 
                                            }
                                        });
                                    
                                        // Membuat chart menggunakan Chart.js
                                        var ctx = document.getElementById('myChart').getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    label: datasetLabel, // Menggunakan label dataset yang sudah ditentukan
                                                    data: data,
                                                    borderColor: '#3e6a8d',
                                                    fill: false,
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    tooltip: {
                                                        callbacks: {
                                                            label: function(tooltipItem) {
                                                                return 'Rp ' + tooltipItem.raw.toLocaleString();
                                                            }
                                                        }
                                                    }
                                                },
                                                scales: {
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Minggu'
                                                        }
                                                    },
                                                    y: {
                                                        title: {
                                                            display: true,
                                                            text: 'Pendapatan (Rp)'
                                                        },
                                                        ticks: {
                                                            callback: function(value) {
                                                                return 'Rp ' + value.toLocaleString();
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    },
                                    error: function(error) {
                                        console.error("Error fetching data", error);
                                    }
                                });
                            }
                        
                            // Panggil fungsi get_pendapatan() saat halaman dimuat
                            $(document).ready(function() {
                                get_pendapatan();
                            });
                        </script>



                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        

        
    </div>


    

</body>
</html>
