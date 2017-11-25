 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                <?php //print "<pre>"; print_r($arr); print "</pre>";  ?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Voucer Listrik & Ijin Sewa</h2>
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
                    <input type="hidden" value="" name="file_name" id="file_name" />
                    <input type="hidden" name="idprod" value="<?= $this->uri->segment(3) ?>" />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Voucer</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <?= form_dropdown("idvoucer", $client, '', 'id="prov" class="form-control" onchange="vouchers();"'); ?>
                          <script>
                              function vouchers(){
                                prov = $('#prov').val();
                                request = $.ajax({
                                    url: "<?= site_url('realisasi/data') ?>",
                                    type: "post",
                                    data: { 'id' : prov}
                                });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                if(response != '||'){
                                var data = response.split('|');
                                kota = '<div class="form-group">\
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Watt</label>\
                        <div class="col-md-2 col-sm-2 col-xs-4">\
                          <input type="text" value="'+data[0]+'" readonly=""  class="form-control">\
                        </div>\
                      </div>\
                      <div class="form-group">\
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nominal Harga</label>\
                        <div class="col-md-2 col-sm-2 col-xs-4">\
                          <input type="text" value="'+data[1]+'" readonly=""  class="form-control">\
                        </div>\
                      </div>\
                      <div class="form-group">\
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Beli</label>\
                        <div class="col-md-2 col-sm-2 col-xs-4">\
                          <input type="text" value="'+data[2]+'" readonly=""  class="form-control">\
                        </div>\
                      </div>';
                                $('#kota').html(kota);
                                }else{
                                $('#kota').html('');    
                                }
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
                      <div id="kota"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Penggunaan Listrik</label>
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="date" class="form-control" name="awal" placeholder="YYYY-MM-DD" >
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="date" class="form-control" name="akhir" placeholder="YYYY-MM-DD"  >
                        </div>
                      </div>                                            
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ijin Sewa</label>
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="date" class="form-control" name="awali" placeholder="YYYY-MM-DD" >
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="date" class="form-control" name="akhiri" placeholder="YYYY-MM-DD"  >
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Biaya</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" placeholder="Rp" id="totalBiaya" value="<?= $biaya->perkiraan_budget ?>" readonly="" class="form-control">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Rupiah</label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Angsuran</label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" placeholder="Rp" value="0" readonly="" id="totalAngsuran" class="form-control">
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Rupiah</label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Lama Angsuran</label>
                        <div class="col-md-1 col-sm-1 col-xs-4">
                          <input id="angsuran" onkeyup="angssurane()" type="text" value="0" class="form-control" name="angsuran">
                          <script>
                                function angssurane(){
                                   $('#bloking3').html(''); 
                                   $('#totalAngsuran').val('0');
                                   var a = $('#angsuran').val();
                                   var i = 1;
                                   if( a == ''){
                                    a = 0;
                                   }

                                   if(a != 0){
                                        for(i = 1; i<=a; i++){
                                            $('#bloking3').append('<div class="form-group">\
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Angsuran '+i+'</label>\
                                                <div class="col-md-2 col-sm-2 col-xs-4">\
                                                  <input type="text" name="angsurandtl[harga][]" placeholder="Rp" class="realisasi form-control" onkeyup="realisasi(this);">\
                                                </div>\
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Jatuh Tempo</label>\
                                                <div class="col-md-2 col-sm-2 col-xs-4">\
                                                  <input type="date" name="angsurandtl[date][]" placeholder="YYYY-MM-DD" class="form-control">\
                                                </div>\
                                              </div>');
                                        }
                                   } 
                                }
                                
                                function realisasi(){
                                    var avalA=0;
                                    $('.realisasi').each(function() {
                                        if(this.value == ''){
                                            this.value = 0;
                                        }
                                        if(parseInt(this.value,10) !='') avalA += parseInt(this.value,10);
                                    });
                                    $('#totalAngsuran').val(avalA);
                                }
                          </script>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <label class="" style="margin-top: 10px;">Kali</label>
                        </div>
                      </div>
                      
                      <div id="bloking3"></div>                                            
                      
                                                                   
                    </form>
                    
                  </div>
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
                  <div class="ln_solid"></div>
                      <div class="form-group">
                                            
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <a class="btn btn-success" onclick="sub()">Submit</a>
                        </div>
                      </div> 
                </div>
                <!-- E: PENAWARAN -->
                <script>
                    function sub(){
                            var msg = [];
                            $('form').find('input, textarea, select').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){   
                                   var name =$(elem).attr('name').trim();
                                   //alert(name);                                
                                   if(name == 'file_name'){
                                        msg.push('  - Scan File PO Harus Diupload\n');
                                    }else if(name == 'idclient'){
                                        msg.push('  - Client Harus Dipilih\n');
                                    }else if(name == 'nama'){
                                        msg.push('  - Nama Client Harus Diisi\n');
                                    }else if(name == 'jabatan'){
                                        msg.push('  - Jabatan Harus Diisi\n');
                                    }else if(name == 'keterangan'){
                                        msg.push('  - Keterangan Harus Diisi\n');
                                    }else if(name == 'Biaya'){
                                        msg.push('  - Biaya Harus Diisi\n');
                                    }else if(name == 'awal'){
                                        msg.push('  - Tanggal Awal Listrik Harus Diisi\n');
                                    }else if(name == 'akhir'){
                                        msg.push('  - Tanggal Akhir Listrik Harus Diisi\n');
                                    }else if(name == 'awali'){
                                        msg.push('  - Tanggal Awal Ijin Sewa Harus Diisi\n');
                                    }else if(name == 'akhiri'){
                                        msg.push('  - Tanggal Akhir Ijin Sewa Harus Diisi\n');
                                    }
                               }
                            });
                            if($('#totalBiaya').val() != $('#totalAngsuran').val()){
                                msg.push('  - Total Angsuran Berbeda dengan Total Keseluruhan\n');
                            }
                            
                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    var msg2 = ( typeof msg[1] != 'undefined') ? msg[1] : '';
                                    var msg3 = ( typeof msg[2] != 'undefined') ? msg[2] : '';
                                    var msg4 = ( typeof msg[3] != 'undefined') ? msg[3] : '';
                                    var msg5 = ( typeof msg[4] != 'undefined') ? msg[4] : '';
                                    var msg6 = ( typeof msg[5] != 'undefined') ? msg[5] : '';
                                    var msg7 = ( typeof msg[6] != 'undefined') ? msg[6] : '';
                                    var msg8 = ( typeof msg[7] != 'undefined') ? msg[7] : '';
                                    var msg9 = ( typeof msg[8] != 'undefined') ? msg[8] : '';
                                    var msg10 = ( typeof msg[9] != 'undefined') ? msg[9] : '';
                                    
                                    alert(msgH + '\n' + msg1 + msg2 + msg3 + msg4 + msg5 + msg6 + msg7 + msg8 + msg9 + msg10);
                                    return false;
                            }
                            
                            request = $.ajax({
                                url: "<?= site_url('realisasi/add') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#realisasi/getTable') ?>";
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
                                url: "<?= site_url('realisasi/upload') ?>",
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
                                    $('#upload').html('<a href="<?= base_url('upload/realisasi/') ?>/'+response[1]+'" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                                    | <a onclick="hapus()"><b>Hapus</b></a>\
                                    ');
                                    $('#file_name').val("<?= base_url('upload/realisasi/') ?>/"+response[1]);
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
               