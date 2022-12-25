<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    <i class="fa fa-gear"></i>  <?php echo $settings->name; ?> <?php echo lang('sms_settings'); ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <?php echo validation_errors(); ?>
                                        <form role="form" action="sms/addNewSettings" method="post" enctype="multipart/form-data">

                                            <?php if ($settings->name == 'Clickatell') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('username'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="username"  value='<?php
                                                    if (!empty($settings->username)) {
                                                        echo base64_decode($settings->username);
                                                    }
                                                    ?>' placeholder="" <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?> required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('api'); ?> <?php echo lang('password'); ?> &#42;</label>
                                                    <input type="password" class="form-control" name="password" value='<?php
                                                    if (!empty($settings->password)) {
                                                        echo base64_decode($settings->password);
                                                    }
                                                    ?>'  placeholder="********" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('api'); ?> <?php echo lang('id'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="api_id"  value='<?php
                                                    if (!empty($settings->api_id)) {
                                                        echo $settings->api_id;
                                                    }
                                                    ?>' placeholder="" <?php
                                                           if (!empty($settings->username)) {
                                                               echo $settings->username;
                                                           }
                                                           ?> <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?> required="">
                                                </div>
                                            <?php } ?>

                                            <?php if ($settings->name == 'Bulk Sms') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('username'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="username"  value='<?php
                                                    if (!empty($settings->username)) {
                                                        echo base64_decode($settings->username);
                                                    }
                                                    ?>' placeholder="" <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?> required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('password'); ?> &#42;</label>
                                                    <input type="password" class="form-control" name="password" value='<?php
                                                    if (!empty($settings->password)) {
                                                        echo base64_decode($settings->password);
                                                    }
                                                    ?>'  placeholder="********" required="">
                                                </div>

                                            <?php } ?>

                                            <?php if ($settings->name == 'MSG91') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php echo lang('authkey'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="authkey"  value='<?php
                                                    if (!empty($settings->authkey)) {
                                                        echo $settings->authkey;
                                                    }
                                                    ?>' placeholder="" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php echo lang('sender'); ?> &#42;</label>   
                                                    <input type="text" class="form-control" name="sender"  value='<?php
                                                    if (!empty($settings->sender)) {
                                                        echo $settings->sender;
                                                    }
                                                    ?>' placeholder="" required="">
                                                </div>
                                            <?php } ?>
                                            <?php if ($settings->name == 'Twilio') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('sid'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="sid"  value='<?php
                                                    if (!empty($settings->sid)) {
                                                        echo $settings->sid;
                                                    }
                                                    ?>' placeholder="" <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?> required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('token'); ?> <?php echo lang('password'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="token" value='<?php
                                                    if (!empty($settings->token)) {
                                                        echo $settings->token;
                                                    }
                                                    ?>'<?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?>  required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('sendernumber'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="sendernumber"  value='<?php
                                                    if (!empty($settings->sendernumber)) {
                                                        echo $settings->sendernumber;
                                                    }
                                                    ?>' <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?> required="">
                                                </div>
                                            <?php } ?>
                                            <?php if ($settings->name == 'Bd Bulk Sms') { ?>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('token'); ?> <?php echo lang('password'); ?> &#42;</label>
                                                    <input type="text" class="form-control" name="token" value='<?php
                                                    if (!empty($settings->token)) {
                                                        echo $settings->token;
                                                    }
                                                    ?>'<?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?>  required="">
                                                </div>

                                            <?php } ?>
                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($settings->id)) {
                                                echo $settings->id;
                                            }
                                            ?>'>
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/sms/settings.js"></script>