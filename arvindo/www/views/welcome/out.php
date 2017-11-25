<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row" style="margin-top:5%;">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading"><h4 class="panel-title"><i class="icon-key"></i> Login</h4></div>
            <div class="panel-body">
                <div style="height: fit-content;">
                    <?= $table ?>
                    <form action="<?= site_url('login/verify/login'); ?>" method="POST" id="frmLogin" onsubmit="return false;">
                        <div class="form_sep">
                            <div class="form_sep">
                                <label for="UserID" class="req">Username</label>
                                <input type="text" id="UserID" name="UserID" class="form-control" data-required="true">
                            </div>

                            <div class="form_sep">
                                <label for="Password" class="req">Password</label>
                                <input type="password" name="Password" id="Password" class="form-control" data-required="true" data-minlength="8">
                            </div>
                            <div class="form_sep">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="KeyCode" class="req">Key Code</label>
                                        <input type="text" name="KeyCode" id="KeyCode" class="form-control" data-required="true" maxlength="5" style="text-align: center;text-transform: uppercase;">
                                    </div>
                                    <span><img style="padding-top:10px; float: right;" onClick="change_captcha('img-captcha')" width="150" height="60" id="img-captcha" style="cursor: pointer;" src="" data-toggle="tooltip" data-original-title="Klik untuk merubah kode Key Code"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form_sep">
                            <button class="btn btn-primary" type="button" type="submit" onclick="post('#frmLogin');
                                    return false;"> Login </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>

<script>
    $(document).ready(function () {
        change_captcha('img-captcha');
        formStyle();
    });
</script>