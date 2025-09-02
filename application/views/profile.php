<div class="container-fluid">
    <h3 class="mb-3 text-dark"><?= $title; ?></h3>
    <div class="card shadow mb-4">
        <div class="card-body m-3"> 
            <div class="profile-settings">
                <form id="formedituser" name="formedituser" method="POST" action="<?= base_url('profile/edit/' . $user['id_user']); ?>" enctype="multipart/form-data" onsubmit="return validateEdit()">
                <div class="avatar">
                    <img src="<?= isset($user['image']) && !empty($user['image']) ? base_url('uploads/' . $user['image']) : base_url('assets/img/undraw_profile_1.svg'); ?>" 
                         alt="User Profile Picture" id="avatarImage">
                    <div>
                        <button class="btn btn-custom btn-sm" onclick="document.getElementById('fileUpload').click()">Upload</button>
                        <button class="btn btn-danger btn-sm" onclick="removeImage()">Remove</button>
                        <input type="file" id="fileUpload" name="image" style="display:none" onchange="previewImage(event)">
                        <input type="hidden" name="old_image" value="<?= $user['image'] ?>">
                    </div>
                </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_user" class="label-custom">ID User</label>
                            <input type="text" name="id_user" id="id_user" class="form-control form-custom" value="<?= $user['id_user'];?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role" class="label-custom">Role</label>
                            <input type="text" name="role" id="role" class="form-control form-custom" placeholder="Role" disabled value="<?= $user['role']?>" required>
                        </div>
                    </div>
                    <div class="form-group form-field">
                        <label for="username" class="label-custom">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-custom" placeholder="Username" value="<?= $user['username']?>" required>
                    </div>
                    <div class="form-group form-field">
                        <label for="email" class="label-custom">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-custom" placeholder="Email" value="<?= $user['email']?>" required>
                    </div>
                    <div class="form-group form-field">
                        <label for="current_password" class="label-custom">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control form-custom" placeholder="Password" minlength="6">
                                <small style="color:red;">
                                    <?= form_error('current_password'); ?>
                                </small>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="new_password" class="label-custom">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control form-custom" placeholder="Password" minlength="6">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_password" class="label-custom">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control form-custom" placeholder="Password" minlength="6">
                        </div>
                    </div>
                    <div class="form-group form-button">
                        <button type="submit" class="btn btn-custom btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('avatarImage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function removeImage() { 
    const oldImage = document.querySelector('input[name="old_image"]').value; // Ambil nama file gambar lama

    if (oldImage) {
        // Kirim permintaan ke server untuk menghapus file lama
        fetch("<?= base_url('profile/delete_image'); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `image_name=${encodeURIComponent(oldImage)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log(data.message); // Log sukses
            } else {
                console.error(data.message); // Log jika ada kesalahan
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Atur kembali gambar default dan kosongkan input
    document.getElementById('avatarImage').src = "<?= base_url('assets/img/undraw_profile_1.svg'); ?>";
    document.getElementById('fileUpload').value = null;
    document.querySelector('input[name="old_image"]').value = "";
}

</script>


<script language="javascript">
    function validateEdit() {
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

        // Jika semua validasi berhasil, kirim form
        $('#formedituser').submit();
    }
</script>
