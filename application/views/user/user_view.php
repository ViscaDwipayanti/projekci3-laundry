
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
        <a href="<?= base_url('user/add')?>" class="btn btn-custom">
            Tambah
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
                                        <th>Id User</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Role</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
 
                                <tbody>
                                <?php
                                    $no = 1;
                                    foreach($data as $row) {?> 
                                        <tr>
                                            <td><?= $no++?></td>
                                            <td><?= $row->id_user;?></td>
                                            <td><?= $row->username;?></td>
                                            <td><?= $row->email;?></td>
                                            <td>
                                                <img src="<?= base_url('uploads/'.$row->image);?>" alt="Image" class="img-thumbnail">
                                            </td>
                                            <td><?= $row->role;?></td>
                                            <td>
                                                <button type="button" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#EditUserModal<?= $row->id_user ?>">Edit</button>
                                                <?php if ($row->role !== 'admin') { ?>
                                                    <a href="<?= base_url()?>user/delete/<?= $row->id_user;?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus user?')">Delete</a>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-sm" disabled>Delete</button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="EditUserModal<?= $row->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="EditUserModalLabel<?= $row->id_user ?>" aria-hidden="true"> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditUserModalLabel">Form Edit User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form id="formedituser<?= $row->id_user ?>" name="formedituser" method="POST" action="<?= base_url('user/edit/'.$row->id_user);?>" enctype="multipart/form-data">
                                                        <div class="form-group form-field">
                                                            <label for="id_user" class="label-custom">ID User</label>
                                                            <input type="text" name="id_user" id="edit_id_user" value="<?= $row->id_user?>" class="form-control form-custom" readonly>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="username" class="label-custom">Username</label>
                                                                <input type="text" name="username" id="edit_username" value="<?= $row->username?>" class="form-control form-custom" placeholder="Username" autocomplete="off" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="email" class="label-custom">Email</label>
                                                                <input type="email" name="email" id="edit_email" value="<?= $row->email?>" class="form-control form-custom" placeholder="Email" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="role" class="label-custom">Role</label>
                                                            <select name="role" id="edit_role" class="form-control form-custom" required>
                                                                <option value="" disabled selected>Select Role</option>
                                                                <option value="admin" <?= ($row->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                                <option value="kasir" <?= ($row->role == 'kasir') ? 'selected' : ''; ?>>Kasir</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group form-button">
                                                                <button type="submit" class="btn btn-custom btn-sm" onClick="validateEdit();">Edit</button>
                                                                <a href="<?= base_url()?>user" class="btn btn-danger btn-sm">Batal</a>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- End Modal Edit -->
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
</div>




<!-- Validasi Edit -->
<script language="javascript">
    function validateEdit() {
        // Validasi Username
        var username = $('#edit_username').val();
        if (username == "") {
            alert("Username masih kosong");
            $('#edit_username').focus();
            return false;
        }

        // Validasi Email
        var email = $('#edit_email').val();
        if (email == "") {
            alert("Email masih kosong");
            $('#edit_email').focus();
            return false;
        }

        // Validasi Role
        var role = $('#edit_role').val();
        if (role == "") {
            alert("Role belum dipilih");
            $('#edit_role').focus();
            return false;
        }

        // Jika semua validasi berhasil, kirim form
        $('#formedituser').submit();
    }
</script>
<!-- End Validasi Edit -->


<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 