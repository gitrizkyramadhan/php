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
                    <form id='barang' class="form-horizontal form-label-left">
                      <div class="form-group">
					  <input type="hidden" name="id" value="<?= $this->uri->segment(4) ?>" />
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Cabang Arvindo</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <?= form_dropdown("cabang", $cabang, $barang->idcabang, 'id="suplier" class="form-control"'); ?>
                        </div>
                      </div>
                      <div  id="kota" class="form-group">
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="nama" value="<?= $barang->nama_barang ?>" class="form-control" placeholder="">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Stock</label>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                          <input type="number" name="stok" value="<?= $barang->stock ?>" class="form-control" placeholder="">
                        </div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12">Satuan</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text" name="satuan" value="<?= $barang->satuan ?>" class="form-control" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alert</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select name="status" class="form-control" id="sts" onChange="alet();">
						    <option value="0" <?= $barang->status == '0' ? 'selected' : '' ?> >Non-Active</option>
                            <option value="1" <?= $barang->status == '1' ? 'selected' : '' ?>>Aktif</option>
                          </select>
						  <script>
							function alet(){
								var a = $('#sts :selected').val();
								if(a == '1'){
									$('#ale').show();
								}else{
									$('#ale').hide();
									$('#al').val('');
								}
							}
						  </script>
                        </div>
                      </div>
					  <div class="form-group" style=" <?= $barang->status == '0' ? 'display:none;' : '' ?>" id="ale">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Alert</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="date" name="alert" id="al" value="<?= $barang->alert ?>" class="form-control" placeholder="">
                        </div>
                      </div>
                      <!--
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Foto</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="file" class="form-control" />
                        </div>
                      </div>
                      
                      <input type="text" value="" name="file_name" id="file_name" />
                      -->
                    </form>
                    <!--
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <form id="upload"  enctype="multipart/form-data">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                           <input type="file" id="filename" name="filename" class="form-control"/>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <a onclick="uploads()"  class="btn btn-success"  >Upload</a>
                        </div>
                        </form>
                    </div>
                    -->
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <a onclick="sub()" class="btn btn-success">Submit</a>
                        </div>
                      </div>
                  </div>
                </div>
                <script>
                    function sub(){
                            var msg = [];
                            $('form').find('input, textarea, select').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){   
                                   var name =$(elem).attr('name').trim();
                                   //alert(name);                                
                                   if(name == 'nama'){
                                        msg.push('  - Nama  Harus Diisi\n');
                                    }else if(name == 'stok'){
                                        msg.push('  - Jumlah Harus Dipilih\n');
                                    }else if(name == 'satuan'){
                                        msg.push('  - Satuan Harus Diisi\n');
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
                                url: "<?= site_url('master/action/update/atk') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#master/ListData/atk') ?>";
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
                    
                    function uploads(){
                        var aFormData = new FormData();
                        aFormData.append("filename", $('#filename').get(0).files[0]);
                        
                        request = $.ajax({
                                url: "<?= site_url('master/upload/barang') ?>",
                                type: "post",
                                processData: false,
                                contentType: false,       
                                cache: false,          
                                data: aFormData
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                response = response.split('#');
                                if(response[0] == 'sukses'){
                                    $('#upload').html('<a href="<?= base_url('upload/barang/') ?>/'+response[1]+'" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                                    | <a onclick="hapus()"><b>Hapus</b></a>\
                                    ');
                                    $('#file_name').val("<?= base_url('upload/barang/') ?>/"+response[1]);
                                }
                                alert(response[2]);
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
                    
                    function hapus(){
                        $('#upload').html('<div class="col-md-5 col-sm-5 col-xs-12">\
                           <input type="file" id="filename" name="filename" class="form-control"/>\
                        </div>\
                        <div class="col-md-3 col-sm-3 col-xs-12">\
                            <a onclick="uploads()"  class="btn btn-success"  >Upload</a>\
                        </div>\
                                    ');
                        $('#file_name').val('');
                    }
                </script>