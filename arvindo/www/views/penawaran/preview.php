<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Preview Penawaran</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Penawaran Produk
                                          <small class="pull-right">Tanggal: 16/08/2016</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-3 invoice-col">
                            <address>
                              Nama Produk
                              <br>Arah Pandang
                              <br>
                              <br>Lokasi
                            </address>
                        </div>
                        <!-- /.col
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                                          <strong>John Doe</strong>
                                          <br>795 Freedom Ave, Suite 600
                                          <br>New York, CA 94107
                                          <br>Phone: 1 (804) 123-9876
                                          <br>Email: jon@ironadmin.com
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                          <b style="font-size: 15px;"><?= ($arr->produk != '' ? $arr->produk : '-') ?></b>
                          <br>
                          <?= ($arr->arah_pandang != '' ? $arr->arah_pandang : '-') ?>
                          <br>
                          <?= ($arr->alamat_lokasi != '' ? $arr->alamat_lokasi.", ". $arr->nama_kota.", ".$arr->nama_provinsi: '-') ?>
                        </div>
                        
                        <div class="col-sm-3 invoice-col">
                            <address>
                              Ukuran
                              <br>Periode Kontrak
                            </address>
                        </div>
                        
                        <div class="col-sm-3 invoice-col">
                            <b><?= ($arr->ukuran != '' ? $arr->ukuran : '-') ?></b>
                              <br>
                              <b><?= ($arr->periode != '' ? $arr->periode." ".$arr->satuan_period : '-') ?></b>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 76%">Keterangan</th>
                                <th></th>
                                <th style="width: 10%">Harga</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($dtlpenawaran as $dtl ){ ?>
                                  <tr>
                                    <td><?= $dtl['keterangan'] ?></td>
                                    <td>Rp </td>
                                    <td><span style="float:right"><?= $dtl['harga'] ?></span></td>
                                  </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Catatan:</p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            
                            <b>Lampiran:</b><br />
                            &nbsp; # Scan Foto <br />&nbsp; &nbsp; &nbsp; <b><a style="color: #1ABB9C;" href="#">Preview</a> | <a href="#">Download</a> <br /></b>
                            
                          </p>
                          
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Total Akhir</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Total:</th>
                                  <td>Rp <span style="float:right">250.30</span></td>
                                </tr>
                                <tr>
                                  <th>PPn (10%):</th>
                                  <td>Rp <span style="float:right">10.34</span></td>
                                </tr>
                                <tr>
                                  <th>PPh:</th>
                                  <td>Rp <span style="float:right">5.80</span></td>
                                </tr>
                                <tr>
                                  <th>Total Akhir:</th>
                                  <td><b>Rp <span style="font-size:20px;float:right">265.24</span></b></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <!--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->
                          <a href="<?= site_url('penawaran/genPDF'); ?>" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>