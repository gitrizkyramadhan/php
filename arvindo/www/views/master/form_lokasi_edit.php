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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Lokasi</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input name="id" readonly=""  type="text" class="form-control"  value="<?= $data->kdlokasi ?>" placeholder="" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lokasi</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input name="nama_lokasi" type="text" class="form-control" placeholder="" value="<?= $data->nama_lokasi ?>" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Provinsi</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <?= form_dropdown("name", $result, $data->kdprovinsi, 'id="prov" class="form-control" onchange="kotas();"'); ?>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Lokasi</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <textarea name="alamat_lokasi" class="form-control" rows="3" placeholder=""><?= $data->alamat_lokasi ?></textarea>
                        </div>
                      </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Arah Pandang</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <textarea name="arah_pandang" class="form-control" rows="3" placeholder=""><?= $data->arah_pandang ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select name="status" class="form-control">
                            <option value="01">Aktif</option>
                            <option value="00">Non-Active</option>
                          </select>
                        </div>
                      </div>
                      <!--<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Foto</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="file" class="form-control" />
                        </div>
                      </div>-->
                      
                      <!--<input type="hidden" value="" name="file_name" id="file_name" />-->
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
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <a class="btn btn-success" onclick="sub()">Submit</a>
                        </div>
                      </div>
                  </div>
                </div>
                <script>
                $(document).ready(function(){
                  <?php if($upload->fileupload != ''){ ?>
                    $('#upload').html('<a href="<?= $upload->fileupload ?>" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                        | <a onclick="hapus()"><b>Hapus</b></a>\
                        ');
                        $('#file_name').val("<?= $upload->fileupload ?>");
                    <?php } ?>
  
                });
                
                    function sub(){
                            var msg = [];
                            $('form').find('input').each(function(idx, elem){
                               if($(elem).val().length == 0 && $(elem).attr('name') != 'filename'){
                                   var name =$(elem).attr('name'); 
                                                                                  
                                   if(name == 'kdlokasi'){
                                        msg.push('  - Kode Lokasi  Harus Diisi\n');
                                    }else if(name == 'nama_lokasi'){
                                        msg.push('  - Nama Lokasi Harus Diisi\n');
                                    }else if(name == 'file_name'){
                                        msg.push('  - Photo Belum di Upload\n');
                                    }
                               }
                            });
                            
                            if( msg.length != 0 ){
                                    var msgH = 'Terdapat Kesalahan:';
                                    var msg1 = ( typeof msg[0] != 'undefined') ? msg[0] : '';
                                    var msg2 = ( typeof msg[1] != 'undefined') ? msg[1] : '';
                                    var msg3 = ( typeof msg[2] != 'undefined') ? msg[2] : '';
                                    
                                    alert(msgH + '\n' + msg1 + msg2 + msg3);
                                    return false;
                            }
                            
                            request = $.ajax({
                                url: "<?= site_url('master/update/lokasi') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#master/ListData/lokasi') ?>";
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
                                url: "<?= site_url('master/upload/lokasi') ?>",
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
                                    $('#upload').html('<a href="<?= base_url('upload/lokasi/') ?>/'+response[1]+'" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                                    | <a onclick="hapus()"><b>Hapus</b></a>\
                                    ');
                                    $('#file_name').val("<?= base_url('upload/lokasi/') ?>/"+response[1]);
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