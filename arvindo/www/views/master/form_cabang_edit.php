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
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Provinsi</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <?= form_dropdown("name", $result, $data->kdprovinsi, 'id="prov" class="form-control" onchange="kotas();"'); ?>
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
                      <input type="hidden" value="<?= $data->kdcabang ?>" name="id" />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Cabang</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="text" name="nama_cabang" class="form-control" value="<?= $data->nama_cabang ?>" placeholder="">
                        </div>
                      </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Cabang</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <textarea class="form-control" name="alamat_cabang"  rows="3" placeholder=""><?= $data->alamat_cabang ?></textarea>
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
                $(document).ready(function(){
                    prov = $('#prov').val();
                                request = $.ajax({
                                    url: "<?= site_url('master/dataEdit') ?>",
                                    type: "post",
                                    data: { 'id' : prov, 'kd' : '<?= $data->kdkota ?>'}
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
                    
                });
                
                
                    function sub(){
                            var msg = [];
                            $('form').find('input, textarea').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){
                                   
                                   var name =$(elem).attr('name');                                       
                                   if(name == 'nama_cabang'){
                                        msg.push('  - Nama Cabang  Harus Diisi\n');
                                    }else if(name == 'alamat_cabang'){
                                        msg.push('  - Alamat Cabang Harus Diisi\n');
                                    }
                               }
                            });

                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    var msg2 = ( typeof msg[1] != 'undefined') ? msg[1] : '';
                                    
                                    alert(msgH + '\n' + msg1 + msg2);
                                    return false;
                            }

                            request = $.ajax({
                                url: "<?= site_url('master/update/cabang') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#master/ListData/cabang') ?>";
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