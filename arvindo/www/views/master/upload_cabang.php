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
        <form id="prop" method="post" action="<?= site_url('master/uploadFile/client') ?>" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3">Provinsi</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <?= form_dropdown("name", $result, '', 'id="prov" class="form-control" onchange="kotas();"'); ?>
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
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">File Upload</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="file" class="form-control" name="files" />
                </div>
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><a href="<?= str_replace('\sys\core', '', base_url() . 'template\cabang.xlsx') ; ?>" style="cursor:pointer !important;">Download Template .xls</a></label>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button class="btn btn-success" >Submit</button>
                </div>
            </div>

        </form>
    </div>
</div>