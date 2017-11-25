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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="username" class="form-control" placeholder="">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input id="pass" type="password" name="password" class="form-control" placeholder="" onkeyup="cek();">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input id="conf" type="password" name="confirm" class="form-control" placeholder=""  onkeyup="cek();">
                        </div>
						<label id="confLabel" style="display:none;"><font color="red">Password Tidak Sama !</font></label>
                      </div>
					  <script>
						function cek(){
							if($('#pass').val() != $('#conf').val()){
								$('#confLabel').show();
							}else{
								$('#confLabel').hide();
							}
						}
					  </script>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <?= form_dropdown("cabang", $cabang, '', 'id="suplier" class="form-control"'); ?>
                        </div>
                      </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama User</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="conf" type="text" name="nama_user" class="form-control" placeholder=""  onkeyup="cek();">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="conf" type="text" name="email" class="form-control" placeholder=""  onkeyup="cek();">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Role</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?= form_dropdown("role", $role, '', 'id="role" class="form-control"'); ?>
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
                                url: "<?= site_url('master/action/add/users') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#master/ListData/users') ?>";
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