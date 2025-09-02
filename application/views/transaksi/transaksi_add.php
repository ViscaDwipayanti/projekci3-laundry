<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= base_url();?>assets/css/custom.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root{
            --primary: #689ebe;
            --secondary: #3e6a8d;
            --tertiary: #2c3c4c;
            --lighblue: #4da3ff;
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

        .total{
            font-weight: bold;
            font-size: 30px;
        }

        .label-total{
            font-weight: bold;
            font-size: 20px;
            /* border: 1px solid black; */
            padding-top: 17px;
        }

        
    </style>
</head>
<body>
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800"><?= $title;?></h1>
        <div class="card-group">
        <div class="card shadow mb-4 col-md-8">
            <div class="card-header text-left">
            <h5 class="mb-0">Form Transaksi</h5>
            </div>
            <div class="card-body">
                <form name="formaddtransaksi" id="formaddtransaksi" method="POST" action="<?= base_url('transaksi/save')?>">
                    <div class="form-section"> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="id_transaksi" class="label-custom">ID Transaksi</label>
                                <input type="text" name="id_transaksi" id="id_transaksi" class="form-control form-custom" value="<?= $id_transaksi;?>" readonly>
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="tanggal" class="label-custom">Tanggal Transaksi</label> 
                                <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control form-custom" required> 
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <label for="id_member" class="label-custom">Pilih Member</label>
                                <?php echo $this->mcari->combomember('id_member'); ?>
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="diskon" class="label-custom">Diskon</label> 
                                <input type="text" name="diskon" id="diskon" class="form-control form-custom" value="<?= isset($diskon)? $diskon : 0;?>"  autocomplete="off" readonly> 
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                                <label for="layanan" class="label-custom">Pilih Layanan</label>
                                <?php echo $this->mcari->combolayanan('id_layanan'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="berat" class="label-custom">Berat</label>
                            <input type="text" class="form-control form-custom" id="berat" name="berat" autocomplete="off" value="<?= isset($berat) ? $berat : 0; ?>">
                        </div>
                        </div> 
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metode_pembayaran" class="label-custom">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control form-custom" required>
                                <option value="">--Pilih Metode Pembayaran--</option>
                                <option value="Cash">Cash</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jumlah_item" class="label-custom">Jumlah Pakaian</label>
                            <input type="number" name="jumlah_item" id="jumlah_item" class="form-control form-custom" autocomplete="off">
                        </div>
                        </div>
                        
                           
            </div>
            </div>
            </div>
            <div class="card shadow mb-4 col-md-4 ml-2">
            <div class="card-header text-left">
                <h5 class="mb-0">Informasi Pembayaran</h5>
            </div>
            <div class="card-body">
                <!-- Total -->
                <div class="mb-4 row">
                    <label for="total" class="col-sm-5 col-form-label font-weight-bold label-total">Total</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext font-weight-bold text-right total" 
                        name="total" id="total" required>
                    </div>
                </div>
                <hr>
                <!-- Tunai -->
                <div class="mb-4 row">
                    <label for="tunai" class="col-sm-5 col-form-label">Tunai</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control text-right" name="tunai" id="tunai" placeholder="Masukkan jumlah tunai" required>
                    </div>
                </div>
                <!-- Kembali -->
                <div class="mb-3 row">
                    <label for="kembali" class="col-sm-5 col-form-label">Kembali</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control text-right" name="kembali" id="kembali" readonly placeholder="Jumlah kembali">
                    </div>
                </div>
                <br> <br>
                <!-- Tombol -->
                <div class="form-group text-right form-button">
                        <button type="submit" class="btn btn-custom" onClick="save();">Simpan</button>
                        <a href="<?= base_url('transaksi');?>" class="btn btn-danger">Batal</a>
                </div>
            </div>
            </div>
    </form>
    </div>
</body>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const today = new Date();
        const formattedDate = today.getFullYear() + '-' + 
                              String(today.getMonth() + 1).padStart(2, '0') + '-' + 
                              String(today.getDate()).padStart(2, '0') + 'T' + 
                              String(today.getHours()).padStart(2, '0') + ':' + 
                              String(today.getMinutes()).padStart(2, '0');
        
        document.getElementById('tanggal_transaksi').value = formattedDate;

        document.getElementById('tanggal_transaksi').addEventListener('change', (event) => {
            const selectedDate = new Date(event.target.value);
            const formattedSelectedDate = selectedDate.getFullYear() + '-' +
                                          String(selectedDate.getMonth() + 1).padStart(2, '0') + '-' +
                                          String(selectedDate.getDate()).padStart(2, '0') + 'T' +
                                          String(selectedDate.getHours()).padStart(2, '0') + ':' +
                                          String(selectedDate.getMinutes()).padStart(2, '0');
            event.target.value = formattedSelectedDate;
        });
    });
</script>



<script>
    $(document).ready(function () {
    function formatRupiah(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
    }

    // Fungsi untuk menghitung total
    function calculateTotal() {
        const idLayanan = $('#id_layanan').val(); 
        const berat = parseFloat($('#berat').val().replace(/[^0-9.-]+/g, '')) || 0; 
        const diskon = parseFloat($('#diskon').val()) || 0; 

        if (idLayanan && berat > 0) {
            // Ambil harga layanan berdasarkan ID
            $.ajax({
                url: '<?= base_url("transaksi/getHargaLayanan"); ?>', 
                type: 'POST',
                data: { id_layanan: idLayanan },
                dataType: 'json',
                success: function (response) {
                    const hargaPerKg = response.harga || 0; 
                    const subtotal = hargaPerKg * berat; // Hitung subtotal
                    const total = subtotal - (subtotal * diskon); 
                    $('#total').val(formatRupiah(total.toFixed(0))); 
                },
                error: function () {
                    alert('Gagal mengambil data harga layanan.');
                }
            });
        }
    }

    // Fungsi untuk menghitung kembalian
    function calculateKembalian() {
        const total = parseFloat($('#total').val().replace(/\./g, '')) || 0; 
        const tunai = parseFloat($('#tunai').val().replace(/\./g, '')) || 0; 

        console.log('Tunai (sebelum format): ' + tunai);
        console.log('Total (sebelum format): ' + total);

        const kembali = tunai - total;

        console.log('Kembalian: ' + kembali);
        $('#kembali').val(formatRupiah(kembali >= 0 ? kembali.toFixed(0) : '0')); 
    }

    // Event listeners
    $('#id_layanan').change(calculateTotal); 
    $('#berat').on('input', calculateTotal); 
    $('#diskon').on('input', calculateTotal); 
    $('#tunai').on('input', calculateKembalian);
    $('#total').on('input', calculateKembalian);
});


// menampilkan diskon 
    $(document).ready(function() {
        $('#id_member').change(function() {
            let id_member = $(this).val();
            if (id_member) {
                $.ajax({
                    url: '<?= site_url("transaksi/get_diskon") ?>',
                    method: 'POST',
                    data: { id_member: id_member },
                    dataType: 'json',
                    success: function(response) {
                        if (response.diskon) {
                            $('#diskon').val(response.diskon); 
                        }
                    },
                    error: function() {
                        alert('Gagal memuat diskon');


                    }
                });
            }
        });
    });

    $(document).ready(function () {
    $('#berat').on('focus', function () {
        if ($(this).val() === "0") { 
            $(this).val(''); 
        }
    });

   
    $('#berat').on('blur', function () {
        if ($(this).val().trim() === '') { 
            $(this).val('0');
        }
    });
});

</script>

<script>
    function validateForm() {
        const tanggalTransaksi = document.getElementById('tanggal_transaksi').value.trim();
        const idMember = document.getElementById('id_member').value.trim();
        const idLayanan = document.getElementById('id_layanan').value.trim();
        const berat = document.getElementById('berat').value.trim();
        const metodePembayaran = document.getElementById('metode_pembayaran').value.trim();
        const tunai = document.getElementById('tunai').value.trim();

        let errorMessage = '';


        if (tanggalTransaksi === '') {
            errorMessage += '- Tanggal Transaksi harus diisi.\n';
        }

        if (idMember === '') {
            errorMessage += '- Member harus dipilih.\n';
        }

        if (idLayanan === '') {
            errorMessage += '- Layanan harus dipilih.\n';
        }

        if (berat === '' || parseFloat(berat) <= 0) {
            errorMessage += '- Berat harus diisi dan lebih besar dari 0.\n';
        }

        if (metodePembayaran === '') {
            errorMessage += '- Metode Pembayaran harus dipilih.\n';
        }

        if (tunai === '' || isNaN(parseFloat(tunai)) || parseFloat(tunai) <= 0) {
            errorMessage += '- Jumlah Tunai harus diisi dan lebih besar dari 0.\n';
        }

        if (errorMessage !== '') {
            alert('Periksa kembali form:\n' + errorMessage);
            return false; 
        }

        return true;
    }

    document.getElementById('formaddtransaksi').addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault(); 
        }
    });
</script>

<!-- reset field ketika data tersimpan -->
<script>
document.getElementById('formaddtransaksi').addEventListener('submit', function (event) {
    if (validateForm()) { 
        setTimeout(() => {
            
            document.getElementById('id_member').value = '';
            document.getElementById('id_layanan').value = '';
            document.getElementById('metode_pembayaran').value = '';
            document.getElementById('tunai').value = '';
            document.getElementById('formaddtransaksi').reset(); 
        }, 0); 
    } else {
        event.preventDefault(); 
    }
});
</script>
</body>












<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

