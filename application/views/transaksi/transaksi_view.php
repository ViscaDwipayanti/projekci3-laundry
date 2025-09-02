
<style>
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

<div class="container-fluid">

<?php
    if(!empty($this->session->flashdata('message')))
    {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
         
    <?php }
    
?>

<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url('transaksi/add')?>" class="btn btn-custom">
            Transaksi Baru
        </a>
        <br><br>
    </div>
</div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-dark"><?= $title?></h5>
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
</div>








<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
