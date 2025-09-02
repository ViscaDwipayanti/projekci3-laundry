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


    </style>

</head>
<body>
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800"><?= $title;?></h1>
        <div class="card shadow mb-4">
            <div class="card-body">
            <form id="formaddlayanan" name="formaddlayanan" method="POST" action="<?= base_url();?>layanan/save">
                        <div class="form-group form-field">
                            <label for="id_layanan" class="label-custom">ID Layanan</label>
                            <input type="text" name="id_layanan" id="id_layanan" value="<?= $id_layanan;?>" class="form-control form-custom" readonly>
                        </div>
                        <div class="form-group form-field">
                            <label for="jenis_layanan" class="label-custom">Jenis Layanan</label>
                            <input type="text" name="jenis_layanan" id="jenis_layanan" class="form-control form-custom" placeholder="Jenis Layanan" autocomplete="off" required>
                        </div>
                        <div class="form-group form-field">
                            <label for="harga" class="label-custom">Harga/kg</label>
                            <input type="text" name="harga" id="harga" class="form-control form-custom" placeholder="Harga" autocomplete="off" required>
                        </div>
                        <div class="form-group form-field">
                            <label for="waktu_pengerjaan" class="label-custom">Waktu Pengerjaan</label>
                            <div class="input-group">
                                <input type="number" name="waktu_pengerjaan" id="waktu_pengerjaan" class="form-control form-custom" placeholder="Lama Waktu" autocomplete="off" required>
                                <select name="satuan_waktu" id="satuan_waktu" class="form-control form-custom opsi" required>
                                    <option value="">Pilih Satuan Waktu</option>
                                    <option value="hari">Hari</option>
                                    <option value="jam">Jam</option>
                                </select>
                        </div>
                        <div class="form-group form-button">
                            <button type="button" class="btn btn-custom" onClick="save();">Simpan</button>
                            <a href="<?= base_url()?>layanan" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>


    <!-- Validasi Add -->
<script language="javascript">
    function save() {
        var jenis_layanan = $('#jenis_layanan').val();
        if (jenis_layanan == "") {
            alert("Jenis Layanan masih kosong");
            $('#jenis_layanan').focus();
            return false;
        }

        var harga = $('#harga').val();
        if (harga == "") {
            alert("Harga/kg masih kosong");
            $('#harga').focus();
            return false;
        }

            if (!/^[0-9]+([.][0-9]{1,2})?$/.test(harga)) { 
            alert("Harga tidak valid");
            $('#harga').focus();
            return false;
        }

        var waktu_pengerjaan = $('#waktu_pengerjaan').val();
        if (waktu_pengerjaan == "") {
            alert("Waktu Pengerjaan masih kosong");
            $('#waktu_pengerjaan').focus();
            return false;
        }
        var satuan_waktu = $('#satuan_waktu').val();
        if (satuan_waktu == "") {
            alert("Satuan waktu belum dipilih");
            $('#satuan_waktu').focus();
            return false;
        }

        $('#formaddlayanan').submit();
    }
</script>
<!-- End Validasi Add --> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>