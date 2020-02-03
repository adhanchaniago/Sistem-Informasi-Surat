<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambahkan Surat Keluar</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Tanggal Surat</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Lokasi Arsip</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>

                        <div class="modal fade" id="updateModal<?=$sm['id'];?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Surat Keluar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('user/updatesuratkeluar/'.$sm['id']); ?>" method="post">
                                    <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $sm['id'];?>">
                                        <div class="form-group">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?= $sm['no_surat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $sm['tanggal']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?= $sm['tujuan']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $sm['perihal']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $sm['lokasi']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['no_surat']; ?></td>
                        <td><?= $sm['tanggal']; ?></td>
                        <td><?= $sm['tujuan']; ?></td>
                        <td><?= $sm['perihal']; ?></td>
                        <td><?= $sm['lokasi']; ?></td>
                        <td>
                            <a href="" class="badge badge-success" data-toggle="modal" data-target=<?php echo "#updateModal".$sm['id']?>>Update</a>
                            <a href="<?php echo base_url().'user/deleteSurat/'.$sm['id']; ?>" class="badge badge-danger">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Daftar Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/suratkeluar'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Surat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Tujuan Pengiriman">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi Arsip">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div> 
