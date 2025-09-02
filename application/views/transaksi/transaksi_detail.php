<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-dark"><?= $title ?></h5>
        </div>
        <div class="card-body m-2">
            <form id="detailtransaksi<?= $data->id_transaksi ?>" name="detailtransaksi" method="POST" action="<?= base_url('transaksi/edit_status_transaksi/'.$data->id_transaksi);?>">
            <div class="form-group text-right">
                    <!-- <a href="<?= base_url('transaksi/cetak_detail/'.$data->id_transaksi);?>" class="btn btn-cetak text-right">Cetak Detail</a>  -->
                </div>
                <div class="row mb-2">
                    <label for="id_transaksi" class="col-sm-2 col-form-label label-custom">ID Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-custom" id="id_transaksi" value="<?= $data->id_transaksi ?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="no_invoice" class="col-sm-2 col-form-label label-custom">No Invoice</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-custom" id="no_invoice" value="<?= $data->no_invoice?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="tanggal_transaksi" class="col-sm-2 col-form-label label-custom">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-custom" id="tanggal_transaksi" value="<?= $data->tanggal_transaksi?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="nama" class="col-sm-2 col-form-label label-custom">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-custom" id="nama" value="<?= $data->nama ?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="alamat" class="col-sm-2 col-form-label label-custom">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-custom" id="alamat" value="<?= $data->alamat ?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="no_telepon" class="col-sm-2 col-form-label label-custom">No Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-custom" id="no_telepon" value="<?= $data->no_telepon ?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="status_transaksi" class="col-sm-2 col-form-label label-custom">Status Transaksi</label>
                    <div class="col-sm-10">
                        <select name="status_transaksi" id="status_transaksi" class="form-control form-custom opsi" required>
                            <option value="baru" <?= ($data->status_transaksi == 'Baru') ? 'selected' : ''; ?>>Baru</option>
                            <option value="diproses" <?= ($data->status_transaksi == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                            <option value="Selesai" <?= ($data->status_transaksi == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                            <option value="diambil" <?= ($data->status_transaksi == 'Diambil') ? 'selected' : ''; ?>>Diambil</option>
                        </select>
                    </div>
                </div>
                <br> 
                <div class="table mt-3">
                    <table class="table table-bordered table-detail">
                        <tr>
                            <th>Tanggal Ambil</th>
                            <th>Jenis Layanan</th>
                            <th>Jumlah Item</th>
                            <th>Harga/Kg</th>
                            <th>Berat</th>
                            
                        </tr>
                        <tr>
                            <td><?= date('Y-m-d H:i:s', strtotime($tanggal_ambil)); ?></td>
                            <td><?= $data->jenis_layanan." | ".$data->waktu_pengerjaan." ". $data->satuan_waktu;?></td>
                            <td><?= $data->jumlah_item ?></td>
                            <td>Rp. <?= $data->harga ?></td>
                            <td><?= $data->berat ?> Kg</td>
                            
                        </tr>
                        <tr>
                            <td colspan="4"><b>Diskon</b></td>
                            <td><?= $data->diskon?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Total</b></td>
                            <td>Rp. <?= $data->total?></td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="form-group text-left">
                    <button type="submit" class="btn btn-custom">Simpan</button>
                    <a href="<?= base_url('transaksi') ?>" class="btn btn-danger">Batal</a> 
                </div>
                
            </form>
        </div>
    </div>
</div>

<style>
    :root{
            --primary: #689ebe;
            --secondary: #3e6a8d;
            --tertiary: #2c3c4c;
            --lighblue: #486cfc; 
            --blue : #063970;
        

        }
    .table-detail th, td{
        font-size: 15px;
    }

    .table-detail th{
        background-color: #fff;
        color: black;
    }

    .form-custom{
        border: 1px solid lightgray;
    }

    .label-custom{
        margin: 0px;
        font-size: 15px;
        font-weight: 600;
    }

    .btn-cetak:hover{
        background-color: var(--tertiary);
        color: #fff;
    }

    .btn-cetak{
        background-color: var(--blue);
        color: #fff;
    }

</style>