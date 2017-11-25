 <h1>
            <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>
                <?php //print "<pre>"; print_r($arr); print "</pre>";  ?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Penawaran</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Produk</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" value="<?= ($arr->produk != '' ? $arr->produk : '') ?>" class="form-control" placeholder="" readonly="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ukuran</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" value="<?= ($arr->ukuran != '' ? $arr->ukuran : '') ?>" class="form-control" placeholder="" readonly="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <?= $lokasi ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Arah Pandang</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text"  value="<?= ($arr->arah_pandang != '' ? $arr->arah_pandang : '') ?>"  class="form-control" placeholder="" readonly="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Periode Kontrak</label>
                        <div class="col-md-1 col-sm-1 col-xs-4">
                            <input type="text"  value="<?= ($arr->periode != '' ? $arr->periode : '') ?>" class="form-control" placeholder="" maxlength="3" readonly="">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-5">
                          <select class="form-control" readonly="">
                            <option <?= ($arr->satuan_period == 'Tahun' ? 'selected="TRUE"' : '') ?>>Tahun</option>
                            <option <?= ($arr->satuan_period == 'Bulan' ? 'selected="TRUE"' : '') ?>>Bulan</option>
                            <option <?= ($arr->satuan_period == 'Hari' ? 'selected="TRUE"' : '') ?>>Hari</option>
                          </select>
                        </div>
                      </div>
                    
                    <input type="hidden" value="" name="file_name" id="file_name" />
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
                    
                  </div>
                </div>
                <!-- E: PENAWARAN -->
                
                <!-- S: DETAIL -->
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail Penawaran</h2>
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
                      
                      <div class="block">
                          <input type="hidden" id="count" value="1" />
                          
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-11">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2 right">
                            <label class="control-label  "><b>Total</b></label>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="text" id="total" class="form-control  currency has-feedback-left"  value="0"  readonly="true"  >
                          <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span>
                        </div>
                      </div>
                         
                      
                      <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5 ln_solid"></div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-11">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2 right">
                            <label class="control-label  "><b>PPN 10%</b></label>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="text" class="form-control  currency has-feedback-left" id="ppn" value="0"  readonly="true"  >
                          <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span>
                        </div>
                      </div>
                      <input type="hidden" name="idpenawaran" value="<?= $this->uri->segment(3) ?>" />
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-11">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2 right">
                            <label class="control-label  "><b>PPH</b></label>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="text" name="pph" class="form-control currency has-feedback-left pph"  value="0" id="pph" >
                          <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-11">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2 right">
                            <label class="control-label  "><b>Total Akhir</b></label>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="text" name="total_harga" class="form-control currency has-feedback-left"  value="0" id="totalAkhir" readonly="true" >
                          <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                      <label>Total Penawaran : <span id="ttl">1</span></label>
                      </div>
                        
                      <script>
                        $(document).on('click','.add',function() {
                            isi = count('add');
                            $('.block:last').append('\
                                <div class="form-group">\
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Penawaran</label>\
                                <div class="col-md-6 col-sm-6 col-xs-8">\
                                  <input type="text" class="form-control" placeholder="">\
                                </div>\
                                <div class="col-md-3 col-sm-3 col-xs-4">\
                                  <input type="text" class="form-control currency has-feedback-left penawaran" onkeyup="penawarans(this);" value="0">\
                                  <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span></div>\
                                  <div class="col-md-1  col-sm-1 col-xs-1">\
                                    <a class="remove fa-close fa" style="cursor: pointer;"> <span><b>remove</b></span></a>\
                                  </div>\
                                </div>\
                            ');
                        });
                        
                        $(document).on('click','.remove',function() {
                            count('delete');
                            $(this).parent().parent().remove();
                            penawarans();
                        });
                        
                        $(document).ready(function(){
                            <?php $i=1; foreach($dtlpenawaran as $dtl){?>
                                <?php if($i == 1){ ?>
                                $('.block:last').append('\
                                    <div class="form-group">\
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Penawaran</label>\
                                    <div class="col-md-6 col-sm-6 col-xs-8">\
                                      <input name="penawaran[ket][]" type="text" class="form-control" value="'+ '<?= $dtl['keterangan'] ?>' +'" placeholder="">\
                                    </div>\
                                    <div class="col-md-3 col-sm-3 col-xs-4">\
                                      <input name="penawaran[res][]" type="text" value="'+ '<?= $dtl['harga'] ?>' +'" class="form-control currency has-feedback-left penawaran"  value="0">\
                                      <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span></div>\
                                    <div class="col-md-1  col-sm-1 col-xs-1">\
                                    <a class="add fa-plus fa" style="cursor: pointer;"> <span><b>add</b></span></a></div>\
                                  </div>\
                                ');
                                <?php }else{ ?>
                                isi = count('add');
                                $('.block:last').append('\
                                    <div class="form-group">\
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Penawaran</label>\
                                    <div class="col-md-6 col-sm-6 col-xs-8">\
                                      <input name="penawaran[ket][]" type="text" class="form-control" value="'+ '<?= $dtl['keterangan'] ?>' +'" placeholder="">\
                                    </div>\
                                    <div class="col-md-3 col-sm-3 col-xs-4">\
                                      <input name="penawaran[res][]" value="'+ '<?= $dtl['harga'] ?>' +'" type="text" class="form-control currency has-feedback-left penawaran" onkeyup="penawarans(this);" value="0">\
                                      <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span></div>\
                                      <div class="col-md-1  col-sm-1 col-xs-1">\
                                        <a class="remove fa-close fa" style="cursor: pointer;"> <span><b>remove</b></span></a>\
                                      </div>\
                                    </div>\
                                ');           
                            <?php  
                                }
                                $i++;
                            } 
                            ?>
                            
                            var avalA=0;
    
                            $('.penawaran').each(function() {
                                if(this.value == ''){
                                    this.value = 0;
                                }
                                if(parseInt(this.value,10) !='') avalA += parseInt(this.value,10);
                            });
                            
                            $('#total').val(avalA);
                            
                            ppn = $('#total').val();
                            ppn = Math.round(ppn * 0.1);
                            $('#ppn').val(ppn);
                            $('#pph').val('<?= $arr->pph ?>');
                            pph = $('#pph').val();
                            if(pph == ''){
                                pph = 0;
                                pph = $('#pph').val(pph);
                                pph = $('#pph').val();   
                            }
                            totalAkhir = avalA + ppn + parseInt(pph);
                            $('#totalAkhir').val(totalAkhir);
                        });
                        
                      </script>
                      
                      
                    </form>
                  </div>
                </div>
                <!-- E: DETAIL -->
                
                <!-- S: CLIENT -->
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Client</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Client</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <?= form_dropdown("idclient", $client, '', 'id="client" class="form-control" onchange="clients();"'); ?>
                          <script>
                            function clients(){
                                param = $('#client').val();
                                request = $.ajax({
                                    url: "<?= site_url('po/detilClient') ?>",
                                    type: "post",
                                    data: { 'id' : param}
                                });
                        
                                // Callback handler that will be called on success
                                request.done(function (response, textStatus, jqXHR){
                                    if(response != '|||||'){
                                        data = response.split("|");
                                        npwp = data[2][0]+data[2][1]+'-'+data[2][3]+data[2][4]+data[2][5]+'-'+data[2][6]+data[2][7]+data[2][8]+'-'+data[2][9]+'-'+data[2][10]+data[2][11]+data[2][12]+'-'+data[2][13]+data[2][14];
                                        $('#blocking').html('\
                                            <div class="form-group">\
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">NPWP</label>\
                                            <div class="col-md-3 col-sm-3 col-xs-3">\
                                              <input type="text" class="form-control" value="' + npwp + '" readonly="true" >\
                                            </div>\
                                          </div>\
                                          <div class="form-group">\
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>\
                                            <div class="col-md-3 col-sm-3 col-xs-12">\
                                              <input type="text"  value="' + data[3] + '" class="form-control"  readonly="true"  placeholder="">\
                                            </div>\
                                          </div>\
                                          <div class="form-group">\
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kota</label>\
                                            <div class="col-md-3 col-sm-3 col-xs-12">\
                                              <input type="text"  value="' + data[4] + '" class="form-control"  readonly="true"  placeholder="">\
                                            </div>\
                                          </div>\
                                          <div class="form-group">\
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>\
                                            <div class="col-md-5 col-sm-5 col-xs-12">\
                                              <textarea class="form-control" rows="3" placeholder=""  readonly="true" >' + data[5] + '</textarea>\
                                            </div>\
                                          </div>\
                                          <div class="form-group">\
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>\
                                            <div class="col-md-5 col-sm-5 col-xs-12">\
                                              <input type="text" name="nama"  value="" class="form-control" placeholder="">\
                                            </div>\
                                          </div>\
                                          <div class="form-group">\
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>\
                                            <div class="col-md-3 col-sm-3 col-xs-12">\
                                              <input type="text"  name="jabatan" value="" class="form-control" placeholder="">\
                                            </div>\
                                          </div>\
                                        ');
                                        //$('#blocking').html(data[1]);
                                    }else{
                                        $('#blocking').html('');
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
                      
                      <div id="blocking">
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Biaya Aktual</label>
                        <div class="col-md-3 col-sm-3 col-xs-4">
                          <input type="text" name="biaya" value="" class="form-control currency has-feedback-left penawaran"  value="0">
                          <span class="form-control-feedback left" aria-hidden="true"><sup><b>Rp</b></sup></span></div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="text"  name="keterangan"value="" class="form-control" placeholder="">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                          <a onclick="sub()" class="btn btn-success">Submit</a>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>
                <!-- E: CLIENT -->  
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
                                url: "<?= site_url('po/add') ?>",
                                type: "post",
                                data: $('form').serialize()
                            });
                        
                            // Callback handler that will be called on success
                            request.done(function (response, textStatus, jqXHR){
                                alert(response);
                                location.href="<?= site_url('mockups#po/getTable') ?>";
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
                                url: "<?= site_url('po/upload') ?>",
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
                                    $('#upload').html('<a href="<?= base_url('upload/po/') ?>/'+response[1]+'" target="_blank" style="color: #1ABB9C;"><b>Preview File Upload</b></a>\
                                    | <a onclick="hapus()"><b>Hapus</b></a>\
                                    ');
                                    $('#file_name').val("<?= base_url('upload/po/') ?>/"+response[1]);
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