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
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" name="npwp" class="form-control" data-inputmask="'mask' : '**-***-***-*-***-***'" maxlength="15" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="text" name="nama" class="form-control" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Provinsi</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <?= form_dropdown("prov", $result, '', 'id="prov" class="form-control" onchange="kotas();"'); ?>
                          <script>
                              function kotas(){
                                prov = $('#prov').val();
                                request = $.ajax({
                                    url: "<?= site_url('master/data') ?>",
                                    type: "post",
                                    data: { 'id' : prov}
                                });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                kota = '<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kota</label>\
                                <div class="col-md-3 col-sm-3 col-xs-12">\
                                  ' + response + '</div>';       
                                $('#kota').html(kota);
                            });
                        
                            // Callback handler that will be called on failure
                            request.fail(function (jqXHR, textStatus, errorThrown){
                                console.error(
                                    "The following error occurred: "+
                                    textStatus, errorThrown
                                );
                            });
                              }
                          </script>
                        </div>
                      </div>
                      <div  id="kota" class="form-group">
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Perusahaan</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <textarea name="alamat" class="form-control" rows="3" placeholder=""></textarea>
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
                                   var name =$(elem).attr('name').trim();
                                                              
                                   if(name == 'npwp'){
                                        msg.push('  - NPWP Client  Harus Diisi\n');
                                    }else if(name == 'nama'){
                                        msg.push('  - Nama Client Harus Diisi\n');
                                    }else if(name == 'prov'){
                                        msg.push('  - Provinsi Harus Dipilih\n');
                                    }else if(name == 'alamat'){
                                        msg.push('  - Alamat Client Harus Diisi\n');
                                    }
                               }
                            });
                            //return false;
                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    var msg2 = ( typeof msg[1] != 'undefined') ? msg[1] : '';
                                    var msg3 = ( typeof msg[2] != 'undefined') ? msg[2] : '';
                                    var msg4 = ( typeof msg[3] != 'undefined') ? msg[3] : '';
                                    
                                    alert(msgH + '\n' + msg1 + msg2 + msg3 + msg4);
                                    return false;
                            }
                            
                            request = $.ajax({
                                url: "<?= site_url('master/action/add/client') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#master/ListData/client') ?>";
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