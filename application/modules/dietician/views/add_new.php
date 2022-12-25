<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($dietician->id))
                    echo lang('edit_dietician');
                else
                    echo lang('add_dietician');
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
                        <form role="form" action="dietician/addNew" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('name'); ?> &#42;</label>
                                <input type="text" class="form-control" name="name"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('name');
                                }
                                if (!empty($dietician->name)) {
                                    echo $dietician->name;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?> &#42;</label>
                                <input type="text" class="form-control" name="email"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('email');
                                }
                                if (!empty($dietician->email)) {
                                    echo $dietician->email;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('password'); ?><?php if(empty($dietician->id)) { ?> &#42;<?php } ?></label>
                                <input type="password" class="form-control" name="password"  placeholder="********"<?php if(empty($dietician->id)) { ?> required=""<?php } ?>>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                                <input type="text" class="form-control" name="address"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('address');
                                }
                                if (!empty($dietician->address)) {
                                    echo $dietician->address;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &#42;</label>
                                <input type="text" class="form-control" name="phone"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('phone');
                                }
                                if (!empty($dietician->phone)) {
                                    echo $dietician->phone;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('visit_price'); ?> &#42;</label>
                                <input type="text" class="form-control" name="visit_price"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('visit_price');
                                }
                                if (!empty($dietician->visit_price)) {
                                    echo $dietician->visit_price;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('profile'); ?> &#42;</label>
                                <input type="text" class="form-control" name="profile"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('profile');
                                }
                                if (!empty($dietician->profile)) {
                                    echo $dietician->profile;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                <input type="file" name="img_url">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($dietician->id)) {
                                echo $dietician->id;
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
