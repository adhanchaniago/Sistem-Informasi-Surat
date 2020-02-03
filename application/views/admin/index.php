<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
      <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <p><h5><b>Surat Masuk</b></h5></p>
                </div>
                <div>
                <h2><b><?php echo $total_asset; ?> surat</b></h2>
                </div>
                <div class="icon">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
                <a href="<?php echo base_url(); ?>user/suratmasuk"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <p><h5><b>Surat Keluar</b></h5></p>
                </div>
                <div>
                <h2><b><?php echo $total_asset2; ?> surat</b></h2>
                </div>
                <div class="icon">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
                <a href="<?php echo base_url(); ?>user/suratkeluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <p><h5><b>Disposisi</b></h5></p>
                </div>
                <div>
                <h2><b><?php echo $total_asset3; ?> surat</b></h2>
                </div>
                <div class="icon">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
                <a href="<?php echo base_url(); ?>user/disposisi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
              </div>
            </div><!-- ./col -->
          </div>
    </section>
</div>