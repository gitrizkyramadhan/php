 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                <?php //print "<pre>"; print_r($arr); print "</pre>";  ?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Gaji Karyawan</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bulan</label>
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <select id="" name="bulan" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                           </select>
                        </div>
                        
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Minggu Ke-</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <select id="" name="mingguke" class="form-control">
                                <option value="1">1 (Pertama)</option>
                                <option value="2">2 (Kedua)</option>
                            </select>
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Harian</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" name="gaji_harian" value="<?= $data->gaji_harian ?>" placeholder="Rp" class="form-control">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Rupiah</label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hari Kerja</label>
                        <div class="col-md-1 col-sm-1 col-xs-4">
                          <input type="text" name="hari_kerja" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" name="gaji_pokok" value="<?= $data->gaji_pokok ?>" placeholder="Rp" class="form-control">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Rupiah</label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Over Time</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" name="over_time" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" name="uang_makan" placeholder="Rp" class="form-control">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Rupiah</label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kasbon Harian</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" name="kasbon_harian" placeholder="Rp" class="form-control">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Rupiah</label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kasbon Bulanan</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" name="kasbon_bulanan" placeholder="Rp" class="form-control">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Rupiah</label>
                      </div>
                      <div class="ln_solid"></div>
                      <input type="hidden" value="<?= $this->uri->segment(3) ?>" name="idkaryawan" />
                      <div class="form-group">
                                            
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <a class="btn btn-success" onclick="sub()">Bayar</a>
                        </div>
                      </div>                                             
                    </form>
                    
                  </div> 
                </div>
                <!-- E: PENAWARAN -->
                <script>
                    function sub(){
                            var msg = [];
                            $('form').find('input').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){
                                
                                   var name =$(elem).attr('name');    
                                    if(name == 'gaji_harian'){
                                        msg.push('  - Gaji Harian Harus Diisi\n');
                                    }else if(name == 'hari_kerja'){
                                        msg.push('  - Hari Kerja Harus Diisi\n');
                                    }else if(name == 'gaji_pokok'){
                                        msg.push('  - Gaji Pokok Harus Diisi\n');
                                    }else if(name == 'over_time'){
                                        msg.push('  - Over Time Harus Diisi\n');
                                    }else if(name == 'uang_makan'){
                                        msg.push('  - Uang Makan Harus Diisi');
                                    }else if(name == 'kasbon_bulanan'){
                                        msg.push('  - Kasbon Bulanan Harus Diisi\n');
                                    }else if(name == 'kasbon_harian'){
                                        msg.push('  - Kasbon Harian Harus Diisi\n');
                                    }
                                    
                               }
                            });
                            
                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    var msg2 = ( typeof msg[1] != 'undefined') ? msg[1] : '';
                                    var msg3 = ( typeof msg[2] != 'undefined') ? msg[2] : '';
                                    var msg4 = ( typeof msg[3] != 'undefined') ? msg[3] : '';
                                    var msg5 = ( typeof msg[4] != 'undefined') ? msg[4] : '';
                                    var msg6 = ( typeof msg[5] != 'undefined') ? msg[5] : '';
                                    var msg7 = ( typeof msg[6] != 'undefined') ? msg[6] : '';
                                    
                                    alert(msgH + '\n' + msg1  + msg2 + msg3 + msg4 + msg5 + msg6 + msg7);
                                    return false;
                            }
                            
                            request = $.ajax({
                                url: "<?= site_url('gaji/add') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#gaji/getTable') ?>";
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
                        //alert($('#filename').get(0).files[0]);
//                        return false;
                        var aFormData = new FormData();
                        aFormData.append("filename", $('#filename').get(0).files[0]);
                        
                        request = $.ajax({
                                url: "<?= site_url('master/upload/tagihan') ?>",
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
                                    $('#upload').html('<a href="<?= base_url('upload/tagihan/') ?>/'+response[1]+'" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                                    | <a onclick="hapus()"><b>Hapus</b></a>\
                                    ');
                                    $('#file_name').val("<?= base_url('upload/tagihan/') ?>/"+response[1]);
                                }
                                alert(response[0]);
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
               