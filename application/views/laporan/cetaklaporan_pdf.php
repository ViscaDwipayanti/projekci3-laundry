<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @page {
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            margin: 40px 80px 40px 70px;
        }
        tr, td, h1, h2, h3, h4, h5 {
            margin: 0;
            padding: 0;
        }
        #customers {
            border-collapse: collapse;
            width: 100%;
        }
        #customers td, #customers th {
            border: 1px solid #333;
            padding: 8px;
        }
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #333;
            color: aliceblue;
        }

        .tanggal_laporan{
            text-align: right;
        }
    </style>
</head>
<body>
    <table width="85%" border="0" align="center">
        <tr>
            <td align="center">
                <font size="4">LAPORAN HASIL TRANSAKSI</font> <br/>
                <font size="4"><b>Laundry EZWash</b></font><br/>
                <font size="3">Jalan Kampus Bukit Jimbaran, Kuta Selatan - Badung, Bali</font><br>
                <font size="3">Telp.(0361)-8954309</font>    
            </td>
        </tr>
    </table>

    <hr/>
    <br>
        <div class="tanggal_laporan">
            <font size="3">Tanggal: </font>
            <font size="3"><?= date('d-m-Y', strtotime($tanggal_awal)); ?></font> s/d
            <font size="3"><?= date('d-m-Y', strtotime($tanggal_akhir)); ?></font>
        </div>
    <br>
    <table id="customers">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Tanggal Ambil</th>
                <th>Nama Pelanggan</th>
                <th>Jenis Layanan</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Status Transaksi</th>
                <th>Total</th>
                
            </tr>
        </thead>
        <tbody>
    <?php if (empty($data)) : ?>
        <tr>
            <td colspan="9" align="center">Tidak ada data.</td>
        </tr>
    <?php else : ?>
        <?php 
            $no = 1;
            $totalKeseluruhan = 0; // Variabel untuk total keseluruhan
            foreach ($data as $row) :
                $totalKeseluruhan += $row['total']; // Tambahkan nilai total per baris
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['id_transaksi']; ?></td>
                <td><?= $row['tanggal_transaksi']; ?></td>
                <td><?= $row['tanggal_ambil']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jenis_layanan']; ?></td>
                <td><?= $row['harga']; ?></td>
                <td><?= $row['berat']; ?></td>
                <td> <?=$row['status_transaksi'];?> </td>
                <td><?= $row['total']; ?></td>
                
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" align="right"><b>Total Akhir:</b></td>
            <td><b>Rp. <?= number_format($totalKeseluruhan, 0, ',', '.')?></b></td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
</body>
</html>

