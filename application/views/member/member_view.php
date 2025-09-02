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
            <a href="<?= base_url()?>member/add" class="btn btn-custom">
                Tambah</a>
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
                                            <th>Id Member</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Poin</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach($data as $row) {?>
                                                <tr>
                                                    <td>
                                                        <?= $no++?> 
                                                    </td>
                                                    <td>
                                                        <?= $row->id_member;?>
                                                    </td>
                                                    <td>
                                                        <?= $row->nama;?>
                                                    </td>
                                                    <td>
                                                        <?= $row->alamat;?>
                                                    </td>
                                                    <td>
                                                        <?= $row->no_telepon;?>
                                                    </td>
                                                    <td> 
                                                        <?= $row->poin;?>
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#EditMemberModal<?= $row->id_member?>">Edit</button>
                                                    <a href="<?= base_url()?>member/delete/<?= $row->id_member;?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus member ini?')">Delete</a>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit -->
                                        <div class="modal fade" id="EditMemberModal<?= $row->id_member?>" tabindex="-1" role="dialog" aria-labelledby="EditMemberModalLabel<?= $row->id_member?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditLayananModalLabel">Form Edit Member</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form id="formeditmember<?= $row->id_member?>" name="formeditmember" method="POST" action="<?= base_url('member/edit/'.$row->id_member);?>">
                                                        <div class="form-group form-field">
                                                            <label for="id_member" class="label-custom">ID Member</label>
                                                            <input type="text" name="id_member" id="edit_id_member" value="<?= $row->id_member; ?>" class="form-control form-custom" readonly>
                                                            </div>
                                                        <div class="form-group form-field">
                                                            <label for="nama" class="label-custom">Nama</label>
                                                            <input type="text" name="nama" id="edit_nama" value="<?= $row->nama;?>" class="form-control form-custom" placeholder="Nama" autocomplete="off" required>
                                                        </div>
                                                        <div class="form-group form-field">
                                                            <label for="alamat" class="label-custom">Alamat</label>
                                                            <textarea name="alamat" id="edit_alamat" cols="30" row="5" class="form-control form-custom" placeholder="Alamat" autocomplete="off" required><?= $row->alamat;?></textarea>
                                                        </div>
                                                        <div class="form-group form-field">
                                                            <label for="no_telepon" class="label-custom">No Telepon</label>
                                                            <input type="tel" name="no_telepon" id="edit_no_telepon" value="<?= $row->no_telepon ?>" 
                                                                   class="form-control form-custom" placeholder="No Telepon" autocomplete="off" required 
                                                                   pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
                                                        </div>

                                                        <div class="form-group form-button">
                                                        <button type="submit" class="btn btn-custom btn-sm" onClick="validateEdit();">Edit</button>
                                                        <a href="<?= base_url()?>member" class="btn btn-danger btn-sm">Batal</a>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit -->
                                            <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
                         


<!-- Validasi Edit -->
<script language="javascript">
    function validateEdit() {
    var nama = $('#edit_nama').val();
    if (nama == "") {
        alert("Nama masih kosong");
        $('#edit_nama').focus();
        return false;
    }

    var alamat = $('#edit_alamat').val();
    if (alamat == "") {
        alert("Alamat masih kosong");
        $('#edit_alamat').focus();
        return false;
    }

    var no_telepon = $('#edit_no_telepon').val();
    if (no_telepon == "") {
        alert("No telepon masih kosong");
        $('#edit_no_telepon').focus();
        return false;
    }

    


    $('#formeditmember').submit();
}

</script>
<!-- End Validasi Edit -->
