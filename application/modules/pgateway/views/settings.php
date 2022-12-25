<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="col-md-8 row">
            <section class="col-md-10 row">
                <header class="panel-heading">
                    <?php
                    if (!empty($settings->name)) {
                        echo $settings->name;
                    }
                    ?> <?php echo lang('settings'); ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="pgateway/addNewSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('payment_gateway'); ?> <?php echo lang('name'); ?> &#42;</label>
                                    <input type="text" class="form-control" name="name"  value='<?php
                                    if (!empty($settings->name)) {
                                        echo $settings->name;
                                    }
                                    ?>' placeholder="" readonly>   
                                </div>
                                <?php if ($settings->name == "Pay U Money") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_key'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="merchant_key"  value="<?php
                                        if (!empty($settings->merchant_key)) {
                                            echo $settings->merchant_key;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('salt'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="salt"  value='<?php
                                        if (!empty($settings->salt)) {
                                            echo $settings->salt;
                                        }
                                        ?>' required="">
                                    </div
                                <?php } ?>
                                <?php if ($settings->name == "Authorize.Net") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('apiloginid'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="apiloginid"  value="<?php
                                        if (!empty($settings->apiloginid)) {
                                            echo $settings->apiloginid;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('transactionkey'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="transactionkey"  value="<?php
                                        if (!empty($settings->transactionkey)) {
                                            echo $settings->transactionkey;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    
                                <?php } ?>
                                <?php if ($settings->name == "Paytm") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_key'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="merchant_key"  value="<?php
                                        if (!empty($settings->merchant_key)) {
                                            echo $settings->merchant_key;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_mid'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="merchant_mid"  value="<?php
                                        if (!empty($settings->merchant_mid)) {
                                            echo $settings->merchant_mid;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_website'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="merchant_website"  value="<?php
                                        if (!empty($settings->merchant_website)) {
                                            echo $settings->merchant_website;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == "Paystack") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="secret"  value="<?php
                                        if (!empty($settings->secret)) {
                                            echo $settings->secret;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('public_key'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="public_key"  value='<?php
                                        if (!empty($settings->public_key)) {
                                            echo $settings->public_key;
                                        }
                                        ?>' required="">
                                    </div
                                <?php } ?>
                                <?php if ($settings->name == "PayPal") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('api_username'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="APIUsername"  value="<?php
                                        if (!empty($settings->APIUsername)) {
                                            echo $settings->APIUsername;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_password'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="APIPassword"  value='<?php
                                        if (!empty($settings->APIPassword)) {
                                            echo $settings->APIPassword;
                                        }
                                        ?>' required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_signature'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="APISignature"  value='<?php
                                        if (!empty($settings->APISignature)) {
                                            echo $settings->APISignature;
                                        }
                                        ?>' required="">
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == "2Checkout") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('merchantcode'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="merchantcode"  value='<?php
                                        if (!empty($settings->merchantcode)) {
                                            echo $settings->merchantcode;
                                        }
                                        ?>' required="">
                                    </div
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('privatekey'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="privatekey"  value="<?php
                                        if (!empty($settings->privatekey)) {
                                            echo $settings->privatekey;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('publishablekey'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="publishablekey"  value="<?php
                                        if (!empty($settings->publishablekey)) {
                                            echo $settings->publishablekey;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>

                                <?php } ?>
                                <?php if ($settings->name == "SSLCOMMERZ") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('store_id'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="store_id"  value="<?php
                                        if (!empty($settings->store_id)) {
                                            echo $settings->store_id;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('store_password'); ?>  &#42;</label>
                                        <input type="text" class="form-control" name="store_password"  value='<?php
                                        if (!empty($settings->store_password)) {
                                            echo $settings->store_password;
                                        }
                                        ?>' required="">
                                    </div>

                                <?php } ?>
                                <?php if ($settings->name == "Stripe") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?> &#42;</label>
                                        <input type="text" class="form-control" name="secret"  value='<?php
                                        if (!empty($settings->secret)) {
                                            echo $settings->secret;
                                        }
                                        ?>' placeholder="" <?php
                                               if (!$this->ion_auth->in_group('admin')) {
                                                   echo 'disabled';
                                               }
                                               ?> required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('publishkey'); ?> &#42;</label>
                                        <input type="text" class="form-control" name="publish"  value='<?php
                                        if (!empty($settings->publish)) {
                                            echo $settings->publish;
                                        }
                                        ?>' required="">
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('status'); ?> &#42;</label>
                                    <select class="form-control m-bot15" name="status" value='' required="">
                                        <option value="live" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'live') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('live'); ?> </option>
                                        <option value="test" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'test') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('test'); ?></option>
                                    </select>
                                </div>
                                    <?php if ($settings->name == "2Checkout") { ?>
                                    
                                    <ul>
                                        <li>
                                            <code>   Available only Live mood .</code>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                    <?php if ($settings->name == "SSLCOMMERZ") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('ipnsettings'); ?> &#42;</label>
                                        <input type="text" class="form-control" name=""  value=' <?php echo base_url(); ?>sslcommerzpayment/success' readonly="">                                 

                                    </div>
                                    <code>
                                        <?php echo "Copy  Ipn_settings to your merchant sslcommerz account. Follow steps below:" ?>
                                        <br><br>
                                        <ul>
                                            <li>>>Login at https://merchant.sslcommerz.com/ (LIVE) and <br>     https://sandbox.sslcommerz.com/manage/(TEST)</li>
                                            <li>>>Click on Menu My Stores > IPN Settings</li>
                                            <li>>>Tick mark Enable HTTP Listener, input above URL in the Box and save settings.</li>
                                        </ul>



                                    </code>
                                <?php } ?>
                                <input type="hidden" name="id" value='<?php
                                if (!empty($settings->id)) {
                                    echo $settings->id;
                                }
                                ?>'>
                                <div class="form-group clearfix">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>


<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/pgateway.js"></script>