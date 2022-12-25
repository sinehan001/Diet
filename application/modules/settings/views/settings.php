<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('settings'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix row">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="settings/update" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('system_name'); ?> &#42;</label>
                                <input type="text" class="form-control" name="name"  value='<?php
                                if (!empty($settings->system_vendor)) {
                                    echo $settings->system_vendor;
                                }
                                ?>' placeholder="system name" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                                <input type="text" class="form-control" name="title"  value='<?php
                                if (!empty($settings->title)) {
                                    echo $settings->title;
                                }
                                ?>' placeholder="title" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                                <input type="text" class="form-control" name="address"  value='<?php
                                if (!empty($settings->address)) {
                                    echo $settings->address;
                                }
                                ?>' placeholder="address" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &#42;</label>
                                <input type="text" class="form-control" name="phone"  value='<?php
                                if (!empty($settings->phone)) {
                                    echo $settings->phone;
                                }
                                ?>' placeholder="phone" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('hospital_email'); ?> &#42;</label>
                                <input type="text" class="form-control" name="email"  value='<?php
                                if (!empty($settings->email)) {
                                    echo $settings->email;
                                }
                                ?>' placeholder="email" required="">
                            </div>





                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('currency'); ?> &#42;</label>
                                <input type="text" class="form-control" name="currency"  value='<?php
                                if (!empty($settings->currency)) {
                                    echo $settings->currency;
                                }
                                ?>' placeholder="currency" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('timezone'); ?></label>
                                <select class="form-control m-bot15 js-example-basic-single" name="timezone" value=''>
                                    <?php
                                    foreach ($timezones as $key => $timezone) {
                                        ?>
                                        <option value="<?php echo $key ?>" <?php
                                        if ($key == $settings->timezone) {
                                            echo 'selected';
                                        }
                                        ?> ><?php echo $timezone; ?></option>
                                                <?php
                                            }
                                            ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('footer_message'); ?> &ast;</label>
                                                        <input type="text" class="form-control" name="footer_message"  value='<?php
                                                        if (!empty($settings->footer_message)) {
                                                            echo $settings->footer_message;
                                                        }
                                                        ?>' placeholder="ByCodearistos" required="">
                                                    </div>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('show_odontogram_in_history'); ?> &ast;</label>
                                                        <select name="show_odontogram_in_history"  class="form-control" id="" required>
                                                            <option value="yes" <?php if ($settings->show_odontogram_in_history =='yes') {
                                                            echo 'selected';
                                                        } ?>><?php echo lang('yes'); ?></option>
                                                            <option value="no" <?php if ($settings->show_odontogram_in_history =='no') {
                                                            echo 'selected';
                                                        } ?>><?php echo lang('no'); ?></option>
                                                        </select>
                                                        
                                                    </div>
                                                        <?php } ?>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('invoice_logo'); ?></label>
                                <input type="file" class="form-control" name="img_url"  value='<?php
                                if (!empty($settings->invoice_logo)) {
                                    echo $settings->invoice_logo;
                                }
                                ?>' placeholder="">
                                <span class="help-block"><?php echo lang('recommended_size'); ?> : 200x100</span>
                            </div>
                            <div class="form-group hidden col-md-3">
                                <label for="exampleInputEmail1">Buyer</label>
                                <input type="hidden" class="form-control" name="buyer"  value='<?php
                                if (!empty($settings->codec_username)) {
                                    echo $settings->buyer;
                                }
                                ?>' placeholder="codec_username">
                            </div>
                            <div class="form-group hidden col-md-3">
                                <label for="exampleInputEmail1">Purchase Code</label>
                                <input type="hidden" class="form-control" name="p_code"  value='<?php
                                if (!empty($settings->codec_purchase_code)) {
                                    echo $settings->phone;
                                }
                                ?>' placeholder="codec_purchase_code">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($settings->id)) {
                                echo $settings->id;
                            }
                            ?>'>
                            <div class="form-group col-md-12">
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/language.js"></script>