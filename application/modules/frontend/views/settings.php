<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/frontend/settings.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-gear"></i> <?php echo lang('website'); ?> <?php echo lang('settings'); ?>
            </header>
            <div class="panel-body">
                <div class="clearfix">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <?php echo validation_errors(); ?>
                                <form role="form" action="frontend/update" method="post" enctype="multipart/form-data">
                                    <div class="panel-group m-bot20" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                                                        <div class="form-group col-md-6">
                                                            <h4>General Settings</h4>
                                                        </div>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="title"  value='<?php
                                                        if (!empty($settings->title)) {
                                                            echo $settings->title;
                                                        }
                                                        ?>' placeholder="system name" required="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Image Upload</label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail" style="width: 200px; height: <?php
                                                                if (!empty($settings->logo)) {
                                                                    echo "auto";
                                                                } else {
                                                                    echo "150px";
                                                                }
                                                                ?>;">
                                                                    <img src="<?php
                                                                    if (empty($settings->logo)) {
                                                                        echo '//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                                                    } else {
                                                                        echo $settings->logo;
                                                                    }
                                                                    ?>" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                <div>
                                                                    <span class="btn btn-white btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                        <input type="file" class="default" name="img_url"/>
                                                                    </span>
                                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                                </div>
                                                            </div>

                                                        </div>
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
                                                        <input type="number" class="form-control" name="phone"  value='<?php
                                                        if (!empty($settings->phone)) {
                                                            echo $settings->phone;
                                                        }
                                                        ?>' placeholder="phone" required="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('emergency'); ?></label>
                                                        <input type="text" class="form-control" name="emergency"  value='<?php
                                                        if (!empty($settings->emergency)) {
                                                            echo $settings->emergency;
                                                        }
                                                                    ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('support_number'); ?></label>
                                                        <input type="text" class="form-control" name="support"  value='<?php
                                                        if (!empty($settings->support)) {
                                                            echo $settings->support;
                                                        }
                                                                    ?>' placeholder="">
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
                                                        <div class="form-group col-md-6">
                                                            <h4>Block Text Settings</h4>
                                                        </div> 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('footer') . " " . lang('description'); ?></label>
                                                        <input type="text" class="form-control" name="description"  value='<?php
                                                        if (!empty($settings->description)) {
                                                            echo $settings->description;
                                                        }
                                                                    ?>' placeholder="Footer Description">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('block_1_text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="block_1_text_under_title"  value='<?php
                                                        if (!empty($settings->block_1_text_under_title)) {
                                                            echo $settings->block_1_text_under_title;
                                                        }
                                                                    ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('service_block__text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="service_block__text_under_title"  value='<?php
                                                        if (!empty($settings->service_block__text_under_title)) {
                                                            echo $settings->service_block__text_under_title;
                                                        }
                                                                    ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('doctor_block__text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="doctor_block__text_under_title"  value='<?php
                                                        if (!empty($settings->doctor_block__text_under_title)) {
                                                            echo $settings->doctor_block__text_under_title;
                                                        }
                                                                    ?>' placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false">
                                                        <div class="form-group col-md-6">
                                                            <h4>Appointment Button Block Settings</h4>
                                                        </div> 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('apppointment_block_title'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="appointment_title"  value='<?php
                                                        if (!empty($settings->appointment_title)) {
                                                            echo $settings->appointment_title;
                                                        }
                                                        ?>' placeholder="" required="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('apppointment_block_subtitle'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="appointment_subtitle"  value='<?php
                                                        if (!empty($settings->appointment_subtitle)) {
                                                            echo $settings->appointment_subtitle;
                                                        }
                                                        ?>' placeholder="" required="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('apppointment_block_description'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="appointment_description"  value='<?php
                                                        if (!empty($settings->appointment_description)) {
                                                            echo $settings->appointment_description;
                                                        }
                                                        ?>' placeholder="" required="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label"><?php echo lang('apppointment_block_image'); ?></label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail" style="width: 200px; height: <?php
                                                                if (!empty($settings->logo)) {
                                                                    echo "auto";
                                                                } else {
                                                                    echo "150px";
                                                                }
                                                                    ?>;">
                                                                    <img src="<?php
                                                                         if (empty($settings->appointment_img_url)) {
                                                                             echo '//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                                                         } else {
                                                                             echo $settings->appointment_img_url;
                                                                         }
                                                                    ?>" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                <div>
                                                                    <span class="btn btn-white btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                        <input type="file" class="default" name="appointment_img_url"/>
                                                                    </span>
                                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">
                                                        <div class="form-group col-md-6">
                                                            <h4>Social Settings</h4>
                                                        </div> 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                                <div class="panel-body">


                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('facebook_id'); ?></label>
                                                        <input type="text" class="form-control" name="facebook_id"  value='<?php
                                                                         if (!empty($settings->facebook_id)) {
                                                                             echo $settings->facebook_id;
                                                                         }
                                                                    ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('twitter_id'); ?></label>
                                                        <input type="text" class="form-control" name="twitter_id"  value='<?php
                                                        if (!empty($settings->twitter_id)) {
                                                            echo $settings->twitter_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('twitter_username'); ?></label>
                                                        <input type="text" class="form-control" name="twitter_username"  value='<?php
                                                               if (!empty($settings->twitter_username)) {
                                                                   echo $settings->twitter_username;
                                                               }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('google_id'); ?></label>
                                                        <input type="text" class="form-control" name="google_id"  value='<?php
                                                        if (!empty($settings->google_id)) {
                                                            echo $settings->google_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('youtube_id'); ?></label>
                                                        <input type="text" class="form-control" name="youtube_id"  value='<?php
                                                        if (!empty($settings->youtube_id)) {
                                                            echo $settings->youtube_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('skype_id'); ?></label>
                                                        <input type="text" class="form-control" name="skype_id"  value='<?php
                                                        if (!empty($settings->skype_id)) {
                                                            echo $settings->skype_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/frontend/settings.js"></script>