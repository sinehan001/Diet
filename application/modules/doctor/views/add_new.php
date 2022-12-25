<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($doctor->id))
                    echo lang('edit_doctor');
                else
                    echo lang('add_doctor');
                ?>
            </header> 
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="doctor/addNew" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('name'); ?> &#42;</label>
                                <input type="text" class="form-control" name="name"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('name');
                                }
                                if (!empty($doctor->name)) {
                                    echo $doctor->name;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?> &#42;</label>
                                <input type="text" class="form-control" name="email"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('email');
                                }
                                if (!empty($doctor->email)) {
                                    echo $doctor->email;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('password'); ?><?php if(empty($doctor->id)) { ?> &#42;<?php } ?></label>
                                <input type="password" class="form-control" name="password"  placeholder="********"<?php if(empty($doctor->id)) { ?> required=""<?php } ?>>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                                <input type="text" class="form-control" name="address"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('address');
                                }
                                if (!empty($doctor->address)) {
                                    echo $doctor->address;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &#42;</label>
                                <input type="text" class="form-control" name="phone"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('phone');
                                }
                                if (!empty($doctor->phone)) {
                                    echo $doctor->phone;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('visit_price'); ?> &#42;</label>
                                <input type="text" class="form-control" name="visit_price"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('visit_price');
                                }
                                if (!empty($doctor->visit_price)) {
                                    echo $doctor->visit_price;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('profile'); ?> &#42;</label>
                                <input type="text" class="form-control" name="profile"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('profile');
                                }
                                if (!empty($doctor->profile)) {
                                    echo $doctor->profile;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                <input type="file" name="img_url">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($doctor->id)) {
                                echo $doctor->id;
                            }
                            ?>'>
                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
