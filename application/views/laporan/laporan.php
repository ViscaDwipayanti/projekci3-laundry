<div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800">Laporan</h1>

    <!-- Memfilter Laporan -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="tampillaporan" name="tampillaporan" method="POST" action="<?= base_url('laporan/cari') ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal_awal" class="label-custom">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control form-custom" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_akhir" class="label-custom">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control form-custom" required>
                    </div>
                </div>
                <div class="form-group form-button">
                    <button type="submit" class="btn btn-custom">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Menampilkan laporan berdasarkan filter -->
    <div class="tampil-laporan">
        <div class="card">
            <div class="card-header">
                <h4>Hasil Laporan</h4>
            </div>
            <div class="card-body">
            <?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)) : ?>
                <div class="row">
                    <div class="col-md-6">
                        <p>
                        <strong>Laporan dari tanggal:</strong> <?= date('d-m-Y', strtotime($tanggal_awal)); ?> 
                        <strong>sampai</strong> <?= date('d-m-Y', strtotime($tanggal_akhir)); ?>
                        </p> 
                    </div>
                    <div class="col-md-6">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="<?= base_url('laporan/cetaklaporan?tanggal_awal=' . $this->input->post('tanggal_awal') . '&tanggal_akhir=' . $this->input->post('tanggal_akhir')); ?>"  class="btn btn-custom">Cetak PDF</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

                <?php if (!empty($laporan)) : ?>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($laporan as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['id_transaksi']; ?></td>
                                    <td><?= $row['tanggal_transaksi']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= number_format($row['total'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p class="text-center">Tidak ada data ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.css">

<script src="<?= base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/js/demo/datatables-demo.js"></script>
    