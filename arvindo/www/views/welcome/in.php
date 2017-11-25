<?php if (!defined('BASEPATH')) die('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-8">
        <div class="user_heading">
            <div class="row">
                <!-- <div class="col-sm-2 hidden-xs">
                    <img src="aset/img/logo-kemkes.png" class="img-thumbnail user_avatar">
                </div> -->
                <div class="col-sm-10">
                    <div class="user_heading_info">
                        <!-- <div class="user_actions pull-right">
                            <a href="#" class="edit_form" data-toggle="tooltip" data-placement="top auto" title="Edit profile"><span class="icon-edit"></span></a>
                            <a href="#" class="remove_user" data-toggle="tooltip" data-placement="top auto" title="Remove User"><span class="icon-remove"></span></a>
                        </div> -->
                        <h2>SELAMAT DATANG DI E-FILING</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="user_content">
            <div class="row">
                <div class="col-sm-10">
                    <form class="form-horizontal user_form">
                        <h3 class="heading_a">Pengguna Aplikasi</h3>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?= $data['U_NAME'] ?></p>
                                <div class="hidden_control">
                                    <input type="text" class="form-control" value="<?= $data['U_ALAMAT'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">NIP</label>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?= $data['NIP'] ?></p>
                                <div class="hidden_control">
                                    <input type="text" class="form-control" value="<?= $data['U_ALAMAT'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Golongan</label>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?= $data['U_GRADE'] ?></p>
                                <div class="hidden_control">
                                    <input type="text" class="form-control" value="<?= $data['U_ALAMAT'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jabatan</label>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?= $data['U_POSITION'] ?></p>
                                <div class="hidden_control">
                                    <input type="text" class="form-control" value="<?= $data['U_ALAMAT'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?= $data['U_ADDRESS'] ?></p>
                                <div class="hidden_control">
                                    <input type="text" class="form-control" value="<?= $data['U_ALAMAT'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?= $data['U_EMAIL'] ?></p>
                                <div class="hidden_control">
                                    <input type="text" class="form-control" value="<?= $data['U_ALAMAT'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $data['T_ROLE'] . ', ' . $data['T_FLAG']; ?></p>
                                <div class="hidden_control">
                                    <input type="text" class="form-control" value="<?= $data['U_ALAMAT'] ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title"><span class="icon-file"></span> Aplikasi Android e-Penatausahaan </h4>
            </div>
            <div class="panel-body" style="text-align: center;">
                <a href="<?= base_url('aset/file/epu.apk'); ?>" alt="e-Penatausahaan Mobile" title="Download e-Penatausahaan Mobile">
                    <span class="icon-android icon-5x" style="color: #97C03D"></span> 
                </a>
                <br><br>Download APK, klik logo Android
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit_form').click(function (e) {
        e.preventDefault();
        $('.user_form .editable p').hide();
        $('.user_form .editable .hidden_control,.user_form .form_submit').show();
    })
</script>
