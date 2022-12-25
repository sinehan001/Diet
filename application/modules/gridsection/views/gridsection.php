
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
         <link href="common/extranal/css/gridsection.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('gridsection'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_gridsection'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('title'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('position'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        

                        <?php foreach ($gridsections as $gridsection) { ?>
                            <tr class="">
                                <td class="img_class"><img class="img_position" src="<?php echo $gridsection->img; ?>"></td>
                                <td><?php echo $gridsection->category; ?></td>
                                <td> <?php echo $gridsection->title; ?></td>
                                <td><?php echo $gridsection->description; ?></td>
                                <td><?php echo $gridsection->position; ?></td>
                                <td>
                                    <?php
                                    if ($gridsection->status == 'Active') {
                                        echo lang('active');
                                    } else {
                                        echo lang('in_active');
                                    }
                                    ?>
                                </td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $gridsection->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="gridsection/delete?id=<?php echo $gridsection->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                        <?php } ?>




                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Slide Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_gridsection'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="gridsection/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?> &#42;</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                        <textarea class="form-control" name="description"  value='' placeholder="" cols="20" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('position'); ?> &#42;</label>
                        <input type="number" class="form-control" name="position"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?>  &#42;</label>
                        <select class="form-control m-bot15" name="status" value='' required="">
                            <option value="Active" <?php
                            if (!empty($setval)) {
                                if ($gridsection->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($gridsection->status)) {
                                if ($gridsection->status == 'Active') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('active'); ?> 
                            </option>
                            <option value="Inactive" <?php
                            if (!empty($setval)) {
                                if ($gridsection->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($gridsection->status)) {
                                if ($gridsection->status == 'Inactive') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('in_active'); ?> 
                            </option>
                        </select>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail div_thumnail">
                                    <img src=""  alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail div_child_thumbnail"></div>
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

                    <input type="hidden" name="id" value=''>


                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Slide Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_gridsection'); ?></h4>
            </div>

            <div class="modal-body">
                <form role="form" id="editSlideForm" class="clearfix" action="gridsection/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?> &#42;</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                        <textarea type="text" class="form-control" name="description"  value='' placeholder="" cols="20" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('position'); ?> &#42;</label>
                        <input type="number" class="form-control" name="position"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="status" value='' required="">
                            <option value="Active" <?php
                            if (!empty($setval)) {
                                if ($gridsection->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($gridsection->status)) {
                                if ($gridsection->status == 'Active') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('active'); ?> 
                            </option>
                            <option value="Inactive" <?php
                            if (!empty($setval)) {
                                if ($gridsection->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($gridsection->status)) {
                                if ($gridsection->status == 'Inactive') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('in_active'); ?> 
                            </option>
                        </select>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail div_thumnail">
                                    <img src="" id="img" alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail div_child_thumbnail"></div>
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

                    <input type="hidden" name="id" value=''>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/gridsection.js"></script>