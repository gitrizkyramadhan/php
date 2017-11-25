 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                <?php //print "<pre>"; print_r($arr); print "</pre>";  ?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ijin</h2>
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
                    <br>
                    <form class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" value="" class="form-control" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Beli</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                                <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="Tanggal" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" id="single_cal1" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi Listrik</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text"  value=""  class="form-control" placeholder="">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12" style="text-align: left;">Watt</label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nominal</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text" value="" class="form-control" placeholder="">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12" style="text-align: left;">Rupiah</label>
                      </div>
                      <!--
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Scan</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="file" class="form-control" />
                        </div>
                      </div>
                      -->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- E: PENAWARAN -->
                
                