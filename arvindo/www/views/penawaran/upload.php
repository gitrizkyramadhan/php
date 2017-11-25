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
        <form id="prop" method="post" action="<?= site_url('penawaran/uploadFile') ?>" enctype="multipart/form-data"  class="form-horizontal form-label-left">
			<div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang Arvindo</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <?= form_dropdown("cabang", $cabang, '', 'id="suplier" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <?= $lokasi ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">File Upload</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="file" class="form-control" name="files" />
                </div>
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><a href="<?= __DIR__. '/../../template/penawaran.xlsx' ; ?>" style="cursor:pointer !important;">Download Template .xls</a></label>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- E: PENAWARAN -->