<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($donor->id))
                    echo lang('add_donor');
                else
                    echo lang('add_new_donor');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table row">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="donor/addDonor" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-5">
                                <label for="exampleInputEmail1"><?php echo lang('name'); ?> &#42;</label>
                                <input type="text" class="form-control" name="name"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('name');
                                }
                                if (!empty($donor->name)) {
                                    echo $donor->name;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?> &#42;</label>
                                <select class="form-control m-bot15" name="group" value='' required="">
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group->group; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($group->group == set_value('group')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($donor->group)) {
                                            if ($group->group == $donor->group) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $group->group; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1"><?php echo lang('age'); ?> &#42;</label>
                                <input type="text" class="form-control" name="age"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('age');
                                }
                                if (!empty($donor->age)) {
                                    echo $donor->age;
                                }
                                ?>' placeholder="" required="">
                            </div>
                             <div class="form-group col-md-5">
                                <label for="exampleInputEmail1"><?php echo lang('last_donation_date'); ?> &#42;</label>
                                <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="ldd" value="<?php
                                if (!empty($setval)) {
                                    echo set_value('ldd');
                                }
                                if (!empty($donor->ldd)) {
                                    echo $donor->ldd;
                                }
                                ?>" placeholder="" required="">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &#42;</label>
                                <input type="text" class="form-control" name="phone"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('phone');
                                }
                                if (!empty($donor->phone)) {
                                    echo $donor->phone;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('sex'); ?> &#42;</label>
                                <select class="form-control m-bot15" name="sex" value='' required="">
                                    <option value="Male" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Male </option>
                                    <option value="Female" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Female') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Female') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Female </option>
                                    <option value="Others" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Others') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Others') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Others </option>
                                </select>
                            </div>
                           
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?> &#42;</label>
                                <input type="text" class="form-control" name="email"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('email');
                                }
                                if (!empty($donor->email)) {
                                    echo $donor->email;
                                }
                                ?>' placeholder="" required="">
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($donor->id)) {
                                echo $donor->id;
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
<!--main content end-->
<!--footer start-->
