 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ubah <?= $title ?></h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Kode Barang</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" name="kode" value = "<?= $barang->kd_brg ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div  id="kota" class="form-group">
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="nama" class="form-control" placeholder="" value="<?= $barang->nama_barang ?>" readonly="">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Stock</label>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                          <input type="text" id="stoking" name="stok" class="form-control" placeholder="" value="<?= $barang->stock ?>"  readonly="">
                        </div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12">Satuan</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text" name="satuan" class="form-control" value="<?= $barang->satuan ?>" placeholder="" readonly="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Action</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select name="aksi" id="aksiPilih" class="form-control" onchange="aksis();">
                            <option value="">-- Pilih --</option>
                            <option value="Ditambah">Ditambah</option>
                            <option value="Dikurangi">Dikurangi</option>
                          </select>
                          <script>
                            function aksis(){
                                var a = $('#aksiPilih').find(':selected').val();
                                var hasil = '';
                                $('#aksi').html('Jumlah '+a);
                                var b = parseInt($('#stoking').val());
                                var c = $('#aksiKet').val();
                                
                                if(c == ''){
                                    c = 0;
                                }
                                
                                hasil = hitung(a, b, parseInt(c));    
                                
                                if(hasil <= 0){
                                    alert('Stok Tidak Boleh Habis');
                                    $('#aksiKet').val('0');
                                    $('#stokA').val(b);    
                                    return false;
                                }
                                
                                $('#stokA').val(hasil);
                            }
                            
                            function hitung(a, b, c){
                                if(a == 'Ditambah'){
                                    hasil = b + c;       
                                }else{
                                    hasil = b - c;
                                }
                                
                                return hasil;
                            }
                          </script>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="aksi">Jumlah </label>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                          <input type="text" name="aksiKet" value="0" id="aksiKet" class="form-control" onkeyup="aksis()" placeholder="">
                        </div>  
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Stok Akhir</label>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                          <input type="text" name="stokA" class="form-control" id="stokA" placeholder="" readonly="">
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
                      <!--
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Foto</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="file" class="form-control" />
                        </div>
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

                    </form>
                  </div>
                </div>
                <script>
                    function sub(){
                            var msg = [];
                            $('form').find('input, select').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){
                                   var name =$(elem).attr('name');                                 
                                   if(name == 'aksi'){
                                        msg.push('  - Aksi  Harus Dipilih\n');
                                    }
                               }
                            });
                            
                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    
                                    alert(msgH + '\n' + msg1);
                                    return false;
                            }
                            
                            request = $.ajax({
                                url: "<?= site_url('master/action/update/barang') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#master/ListData/barang') ?>";
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