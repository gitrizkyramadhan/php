 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                <?php //print "<pre>"; print_r($arr); print "</pre>";  ?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Rekapitulasi</h2>
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
                    <form class="form-horizontal form-label-left" action="<?= site_url('rekapitulasi/'.$url) ?>" method="post">

                      
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Awal</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                                <input name="awal" type="date" class="form-control has-feedback-left" id="single_cal3" placeholder="Tanggal" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" id="single_cal1" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Akhir</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                                <input name="akhir" type="date" class="form-control has-feedback-left" id="single_cal3" placeholder="Tanggal" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" id="single_cal1" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <button type="submit" class="btn btn-primary">Submit</button>
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
                                                                       
                                   if(name == 'keterangan'){
                                        msg.push('  - Kode Lokasi  Harus Diisi\n');
                                    }else if(name == 'tgl_beli'){
                                        msg.push('  - Nama Lokasi Harus Diisi\n');
                                    }else if(name == 'watt'){
                                        msg.push('  - Photo Belum di Upload\n');
                                    }else if(name == 'nominal'){
                                        msg.push('  - Photo Belum di Upload\n');
                                    }
                               }
                            });
                            
                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    var msg2 = ( typeof msg[1] != 'undefined') ? msg[1] : '';
                                    var msg3 = ( typeof msg[2] != 'undefined') ? msg[2] : '';
                                    var msg4 = ( typeof msg[2] != 'undefined') ? msg[3] : '';
                                    
                                    alert(msgH + '\n' + msg1 + msg2 + msg3 + msg4);
                                    return false;
                            }
                            
                            request = $.ajax({
                                url: "<?= site_url('listrik/add') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#listrik/getTable') ?>";
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
                                url: "<?= site_url('master/upload/listrik') ?>",
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
                                    $('#upload').html('<a href="<?= base_url('upload/listrik/') ?>/'+response[1]+'" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                                    | <a onclick="hapus()"><b>Hapus</b></a>\
                                    ');
                                    $('#file_name').val("<?= base_url('upload/listrik/') ?>/"+response[1]);
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
                