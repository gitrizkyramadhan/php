 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                <?php //print "<pre>"; print_r($arr); print "</pre>";  ?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Sewa</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Ijin</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                                <input type="date" class="form-control has-feedback-left" name="tgl_ijin" id="single_cal3" placeholder="Tanggal" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" id="single_cal1" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                                <input type="date" class="form-control has-feedback-left" name="tgl_akhir" id="single_cal3" placeholder="Tanggal" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" id="single_cal1" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nominal</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" value="" class="form-control" name="nominal" placeholder="">
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
                      <input type="hidden" value="" name="file_name" id="file_name" />
                      <input type="hidden" value="<?= $this->uri->segment(3) ?>" name="kdlokasi" id="kdlokasi" />
                    </form>
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
                          <button type="button" class="btn btn-primary">Cancel</button>
                          <a class="btn btn-success" onclick="sub()">Submit</a>
                        </div>
                      </div>
                  </div>
                </div>
                <!-- E: PENAWARAN -->
                
                <script>
                function sub(){
                            var msg = [];
                            $('form').find('input').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){
                                   var name =$(elem).attr('name'); 
                                   //alert(name);                                               
                                   if(name == 'nomor_ijin'){
                                        msg.push('  - Nomor Ijin Harus Diisi\n');
                                    }else if(name == 'tgl_ijin'){
                                        msg.push('  - Tanggal Ijin Harus Diisi\n');
                                    }else if(name == 'tgl_Akhir'){
                                        msg.push('  - Tanggal Akhir Ijin Harus Diisi\n');
                                    }else if(name == 'nominal'){
                                        msg.push('  - Nominal Harus Diisi\n');
                                    }else if(name == 'file_name'){
                                        msg.push('  - Scan Ijin Harus Diupload\n');
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
                                    var msg5 = ( typeof msg[4] != 'undefined') ? msg[4] : '';
                                    
                                    alert(msgH + '\n' + msg1 + msg2 + msg3 + msg4 + msg5);
                                    return false;
                            }
                            
                            request = $.ajax({
                                url: "<?= site_url('sewa/add') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                //return false;
                                location.href="<?= site_url('mockups#sewa/getTable') ?>";
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
                                url: "<?= site_url('master/upload/sewa') ?>",
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
                                    $('#upload').html('<a href="<?= base_url('upload/sewa/') ?>/'+response[1]+'" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                                    | <a onclick="hapus()"><b>Hapus</b></a>\
                                    ');
                                    $('#file_name').val("<?= base_url('upload/sewa/') ?>/"+response[1]);
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