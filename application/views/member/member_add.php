
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800"><?= $title;?></h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form id="formaddmember" name="formaddmember" method="POST" action="<?= base_url();?>member/save">
                    <div class="form-group form-field">
                        <label for="id_member" class="label-custom">ID Member</label>
                        <input type="text" name="id_member" id="id_member" value="<?= $id_member;?>" class="form-control form-custom" readonly>
                    </div>
                    <div class="form-group form-field">
                        <label for="nama" class="label-custom">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control form-custom" placeholder="Nama" autocomplete="off" required>
                    </div>
                    <div class="form-group form-field">
                        <label for="alamat" class="label-custom">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" row="5" class="form-control form-custom" placeholder="Alamat" autocomplete="off" required></textarea>
                    </div>
                    <div class="form-group form-field">
                        <label for="no_telepon" class="label-custom">No Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control form-custom" placeholder="No Telepon" autocomplete="off" required>
                    </div>
                    <div class="form-group form-button">
                        <button type="button" class="btn btn-custom" onClick="save();">Simpan</button>
                        <a href="<?= base_url()?>member" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script language="javascript">
    function save() {
        var nama = $('#nama').val();
        if (nama == "") {
            alert("Nama masih kosong");
            $('#nama').focus();
            return false;    
        }   
        
        // Validasi nama hanya huruf
        if (!/^[a-zA-Z\s]+$/.test(nama)) { 
            alert("Nama tidak valid");
            $('#nama').focus();
            return false;
        }

        var alamat = $('#alamat').val();
        if (alamat == "") {
            alert("Alamat masih kosong");
            $('#alamat').focus();
            return false;    
        }    

        var no_telepon = $('#no_telepon').val();
        if (no_telepon == "") {
            alert("No telepon masih kosong");
            $('#no_telepon').focus();
            return false;    
        }    

        // Validasi no telepon hanya angka
        if (!/^\d+$/.test(no_telepon)) { 
            alert("No telepon tidak valid");
            $('#no_telepon').focus();
            return false;
        }

        $('#formaddmember').submit();
    }
    </script>

