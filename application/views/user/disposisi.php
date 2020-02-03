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

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambahkan Disposisi Surat</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Surat Dari</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Tanggal Surat</th>
                        <th scope="col">Tanggal Terima</th>
                        <th scope="col">Sifat</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Teruskan Kepada</th>
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
                                    <h5 class="modal-title" id="updateModalLabel">Update Disposisi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('user/updatedisposisi/'.$sm['id']); ?>" method="post">
                                    <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $sm['id'];?>">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="surat_dari" name="surat_dari"  value="<?= $sm['surat_dari']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?= $sm['no_surat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="tgl_surat" name="tgl_surat" value="<?= $sm['tgl_surat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" value="<?= $sm['tgl_terima']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="sifat" name="sifat" value="<?= $sm['sifat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $sm['perihal']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="teruskan" name="teruskan" value="<?= $sm['teruskan']; ?>">
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
                        <td><?= $sm['surat_dari']; ?></td>
                        <td><?= $sm['no_surat']; ?></td>
                        <td><?= $sm['tgl_surat']; ?></td>
                        <td><?= $sm['tgl_terima']; ?></td>
                        <td><?= $sm['sifat']; ?></td>
                        <td><?= $sm['perihal']; ?></td>
                        <td><?= $sm['teruskan']; ?></td>

                        <td>
                            <a href="" class="badge badge-success" data-toggle="modal" data-target=<?php echo "#updateModal".$sm['id']?>>Update</a>
                            <a href="<?php echo base_url().'user/deleteDisposisi/'.$sm['id']; ?>" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Disposisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/disposisi'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="surat_dari" name="surat_dari" placeholder="Surat Dari">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tgl_surat" name="tgl_surat" placeholder="Tanggal Surat">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" placeholder="Tanggal Surat Diterima">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="sifat" name="sifat" placeholder="Sifat Surat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" id="teruskan" name="teruskan" placeholder="Teruskan kepada">
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