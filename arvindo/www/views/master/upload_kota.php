<h1>
    <a href="<?= site_url() ?>">Form</a> <?= $title ?></h1>

<div class="x_panel">
    <div class="x_title">
        <h2>Upload Provinsi</h2>
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
        <form id="prop" method="post" action="<?= site_url('master/uploadFile/kota') ?>" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3">Provinsi</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <?= form_dropdown("kdprov", $result, '', ' class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">File Upload</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="file" class="form-control" name="files" />
                </div>
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><a href="<?= base_url(). 'template/kota.xlsx' ; ?>" style="cursor:pointer !important;">Download Template .xls</a></label>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="javascript:history.back()">Cancel</a>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button class="btn btn-primary" >Submit</button>
                </div>
            </div>

        </form>
    </div>
</div>
