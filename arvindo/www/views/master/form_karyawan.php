 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Input <?= $title ?></h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">NPWP</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="text" name="npwp" class="form-control" data-inputmask="'mask' : '**-***-***-*-***-***'">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Karyawan</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="text" name="nama" class="form-control" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                                <input type="date" name="tgl_lahir" class="form-control has-feedback-left" id="single_cal3" placeholder="YYYY-MM-DD" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" id="single_cal1" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Usia</label>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <input name="usia" type="text" id="usiamu" class="form-control" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select name="jns_kelamin" class="form-control">
                            <option>Laki - Laki</option>
                            <option>Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select name="agama" class="form-control">
                            <option>Islam</option>
                            <option>Kristen Protestan</option>
                            <option>Kristen Katolik</option>
                            <option>Hindu</option>
                            <option>Buddha</option>
                            <option>Kong Hu Cu</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Asal</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <textarea class="form-control" name="alamat_asl" rows="3" placeholder=""></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Domisili</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <textarea class="form-control" name="alamat_dom" rows="3" placeholder=""></textarea>
                        </div>
                      </div>
                      
                      
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Harian</label>
                    <div class="col-md-3 col-sm-6 col-xs-8">
                      <input type="text" name="gaji_harian" class="form-control currency has-feedback-left penawaran"  value="0">
                      <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span>
                    </div>
                  </div>
              
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select name="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Non-Active</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <a class="btn btn-success" onclick="sub()">Submit</a>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
                <script>
                    function sub(){
                             var msg = [];
                            $('form').find('input, textarea, select').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){   
                                   var name =$(elem).attr('name');
                                   //alert(name);                                       
                                   if(name == 'npwp'){
                                        msg.push('  - NPWP  Harus Diisi\n');
                                    }else if(name == 'nama'){
                                        msg.push('  - Nama Karyawan Harus Diisi\n');
                                    }else if(name == 'tgl_lahir'){
                                        msg.push('  - Tanggal Lahir Harus Diisi\n');
                                    }else if(name == 'usia'){
                                        msg.push('  - Usia Harus Diisi\n');
                                    }else if(name == 'alamat_asl'){
                                        msg.push('  - Alamat Asal Harus Diisi\n');
                                    }else if(name == 'alamat_dom'){
                                        msg.push('  - Alamat Domisili Harus Diisi\n');
                                    }
                               }
                            });
                            //return false;
                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    var msg2 = ( typeof msg[1] != 'undefined') ? msg[1] : '';
                                    var msg3 = ( typeof msg[2] != 'undefined') ? msg[2] : '';
                                    
                                    alert(msgH + '\n' + msg1 + msg2 + msg3);
                                    return false;
                            }
                            request = $.ajax({
                                url: "<?= site_url('master/action/add/karyawan') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#master/ListData/karyawan') ?>";
                                return false;
                            });
                        
                            // Callback handler that will be called on failure
                            request.fail(function (jqXHR, textStatus, errorThrown){
                                console.error(
                                    "The following error occurred: "+
                                    textStatus, errorThrown
                                );
                            });
                            return false;
                    }
                </script>