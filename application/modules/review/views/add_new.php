<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($review->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_review');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_review');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="review/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">    
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="name"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($review->name)) {
                                                echo $review->name;
                                            }
                                            ?>' placeholder="" required="">   
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('designation'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="designation"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('designation');
                                            }
                                            if (!empty($review->designation)) {
                                                echo $review->designation;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('review'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="review"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('review');
                                            }
                                            if (!empty($review->review)) {
                                                echo $review->review;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?> &#42;</label>
                                            <select class="form-control m-bot15" name="status" value='' required="">
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($review->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($review->status)) {
                                                    if ($review->status == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($review->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($review->status)) {
                                                    if ($review->status == 'Inactive') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('in_active'); ?> 
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="img_url">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($review->id)) {
                                            echo $review->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                    </form>
                                </div>
                            </section>
                        </div>  
                    </div> 
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
