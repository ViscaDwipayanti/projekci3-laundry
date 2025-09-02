<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ 'dark' if session['darkMode'] == 'true' else 'light' }}">
<head>
</head>
<style>
    @page {
        font-family: 'times';
        font-size: 14px;
        margin: 40px 20px 40px 20px;
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
}

.data-layanan .table-layanan {
        margin: 0; 
        border-collapse: collapse; 
    }
.data-layanan .th-layanan, .td-layanan {
        padding: 8px;
        /* border: 1px solid black;  */
        text-align: left;
    }
.data-bayar .td-bayar {
        text-align: right;
        /* border: 1px solid black; */
        padding-left: 100px;
    }

.garis-patah {
    border: 0;
    border-top: 1px dashed #333; /* Garis patah-patah */
    width: 100%;
}



</style>
<body>
    <div class="header" align="center">
      <h3>Laundry EZWash</h3>
      <p>Jalan Kampus Bukit Jimbaran<br>Kuta Selatan -  Badung, Bali<br>0361-8954309</p>
      <hr>
    </div>

    <div class="data-order">
      <table>
        <tr>
          <td>No Invoice </td>
          <td>:</td>
          <td><?=$no_invoice?></td>
        </tr>
        <tr>
          <td>Id Transaksi </td>
          <td>:</td>
          <td><?=$id_transaksi?></td>
        </tr>
        <tr>
          <td>Tgl. Order </td>
          <td>:</td>
          <td><?=$tanggal_transaksi?></td>
        </tr>
        <tr>
          <td>Tgl. Ambil</td>
          <td>:</td>
          <td><?=$tanggal_ambil?></td>
        </tr>
        <tr>
          <td>Member </td>
          <td>:</td>
          <td><?=$nama?></td>
        </tr>
        <tr>
          <td>Alamat </td>
          <td>:</td>
          <td><?=$alamat?></td>
        </tr>
        <tr>
          <td>No. Hp </td>
          <td>:</td>
          <td><?=$no_telepon?></td>
        </tr>
      </table>
      <hr>
    </div>

    <div class="data-layanan">
    <table class="table-layanan">
        <thead>
            <tr>
                <th class="th-layanan">Layanan</th>
                <th class="th-layanan">Harga/Kg</th>
                <th class="th-layanan">Berat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td class="td-layanan"><?=$jenis_layanan?></td>
              <td class="td-layanan"><?=number_format($harga,0,',','.')?></td>
              <td class="td-layanan"><?=$berat?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    </div>

    <div class="data-bayar">
    <table>
        <tr>
          <td>Jumlah Item </td>
          <td>:</td>
          <td class="td-bayar"><?=$jumlah_item?></td>
        </tr>
        <tr>
          <td>Diskon</td>
          <td>:</td>
          <td class="td-bayar"><?=$diskon?></td>
        </tr>
        <tr>
          <td>Total </td>
          <td>:</td>
          <td class="td-bayar"><?= number_format($total, 0, ',', '.') ?></td>
        </tr>
      </table>
      <hr>
    </div>
    
    <!-- <div class="Ketentuan">
    <table>
      <tr>
        <td>
          <b>Ketentuan :</b>
        </td>
      </tr>
      <tr>
        <td><font size="2"><i>1. Pengambilan Barang Harus Disertai Nota</i></font></td>
      </tr>
      <tr>
        <td><font size="2"><i>2. Pengaduan Komplain Dilayani 1x24 Jam Dari Tanggal Ambil</i></font></td>
      </tr>
      <tr>
        <td><font size="2"><i>3. Jika Telah Melewati Tanggal Ambil Barang Bukan Lagi Tanggung     Jawab Laundry</i></font></td>
      </tr>
    </table>
    <hr>
    </div> -->
    
    <p align="center">Terima kasih telah menggunakan layanan kami!</p>

    <br><br>
    <hr class="garis-patah">
    <br><br>

    <div class="header" align="center">
      <h3>Laundry EZWash</h3>
      <p>Jalan Kampus Bukit Jimbaran<br>Kuta Selatan -  Badung, Bali<br>0361-8954309</p>
      <hr>
    </div>

    <div class="data-order">
      <table>
        <tr>
          <td>No Invoice </td>
          <td>:</td>
          <td><?=$no_invoice?></td>
        </tr>
        <tr>
          <td>Id Transaksi </td>
          <td>:</td>
          <td><?=$id_transaksi?></td>
        </tr>
        <tr>
          <td>Tgl. Order </td>
          <td>:</td>
          <td><?=$tanggal_transaksi?></td>
        </tr>
        <tr>
          <td>Tgl. Ambil</td>
          <td>:</td>
          <td><?=$tanggal_ambil?></td>
        </tr>
        <tr>
          <td>Member </td>
          <td>:</td>
          <td><?=$nama?></td>
        </tr>
        <tr>
          <td>Alamat </td>
          <td>:</td>
          <td><?=$alamat?></td>
        </tr>
        <tr>
          <td>No. Hp </td>
          <td>:</td>
          <td><?=$no_telepon?></td>
        </tr>
      </table>
      <hr>
    </div>

    <div class="data-layanan">
    <table class="table-layanan">
        <thead>
            <tr>
                <th class="th-layanan">Layanan</th>
                <th class="th-layanan">Harga/Kg</th>
                <th class="th-layanan">Berat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td class="td-layanan"><?=$jenis_layanan?></td>
              <td class="td-layanan"><?=number_format($harga,0,',','.')?></td>
              <td class="td-layanan"><?=$berat?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    </div>

    <div class="data-bayar">
    <table>
        <tr>
          <td>Jumlah Item </td>
          <td>:</td>
          <td class="td-bayar"><?=$jumlah_item?></td>
        </tr>
        <tr>
          <td>Diskon</td>
          <td>:</td>
          <td class="td-bayar"><?=$diskon?></td>
        </tr>
        <tr>
          <td>Total </td>
          <td>:</td>
          <td class="td-bayar"><?= number_format($total, 0, ',', '.') ?></td>
        </tr>
      </table>
      <hr>
    </div>
    
    <!-- <div class="Ketentuan">
    <table>
      <tr>
        <td>
          <b>Ketentuan :</b>
        </td>
      </tr>
      <tr>
        <td><font size="2"><i>1. Pengambilan Barang Harus Disertai Nota</i></font></td>
      </tr>
      <tr>
        <td><font size="2"><i>2. Pengaduan Komplain Dilayani 1x24 Jam Dari Tanggal Ambil</i></font></td>
      </tr>
      <tr>
        <td><font size="2"><i>3. Jika Telah Melewati Tanggal Ambil Barang Bukan Lagi Tanggung     Jawab Laundry</i></font></td>
      </tr>
    </table>
    <hr>
    </div> -->
    
    <p align="center">Terima kasih telah menggunakan layanan kami!</p>

</body>
</html>
