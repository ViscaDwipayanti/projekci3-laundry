<div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800"><?= $title;?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="formadduser" name="formadduser" method="POST" action="<?= base_url();?>user/save" enctype="multipart/form-data" onsubmit="return validateAdd()">
                <div class="form-group form-field">
                    <label for="id_user" class="label-custom">ID User</label>
                    <input type="text" name="id_user" id="id_user" value="<?= $id_user;?>" class="form-control form-custom" readonly>
                </div>
 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username" class="label-custom">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-custom" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="label-custom">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-custom" placeholder="Email" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group form-field">
                    <label for="password" class="label-custom">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-custom" placeholder="Password" minlength="6" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="image" class="label-custom">Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" id="image" class="custom-file-input" accept="image/*" required>
                            <label class="custom-file-label form-custom" for="image">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="role" class="label-custom">Role</label>
                    <select name="role" id="role" class="form-control form-custom" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                    </select>
                </div>

                <div class="form-group form-button">
                    <button type="submit" class="btn btn-custom btn-sm" onClick="validateAdd();">Simpan</button>
                    <a href="<?= base_url()?>user" class="btn btn-danger btn-sm">Batal</a>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- Validasi Add -->
<script language="javascript">
    function validateAdd() {
        // Validasi Username
        var username = $('#username').val();
        if (username == "") {
            alert("Username masih kosong");
            $('#username').focus();
            return false;
        }
        // Validasi Email
        var email = $('#email').val();
        if (email == "") {
            alert("Email masih kosong");
            $('#email').focus();
            return false;
        }

        // Validasi Password
        var password = $('#password').val();
        if (password == "") {
            alert("Password masih kosong");
            $('#password').focus();
            return false;
        } else if (password.length < 6) {
            alert("Password harus memiliki minimal 6 karakter");
            $('#password').focus();
            return false;
        }

        // Validasi Image (Pastikan file dipilih)
        var image = $('#image').val();
        if (image == "") {
            alert("Gambar harus dipilih");
            $('#image').focus();
            return false;
        }

        // Validasi Role
        var role = $('#role').val();
        if (role == "") {
            alert("Role belum dipilih");
            $('#role').focus();
            return false;
        }

        // Jika semua validasi berhasil, kirim form
        $('#formadduser').submit();
    }
</script>
<!-- End Validasi Add -->
 

<!-- Menampilkan nama file image -->
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("image").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
