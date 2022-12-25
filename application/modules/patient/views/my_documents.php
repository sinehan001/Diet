<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/patient/my_case_list.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('patient'); ?>  <?php echo lang('documents'); ?> 
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal1">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header> 
            <div class="">
                <div class="">
                    <div class="adv-table editable-table panel-body">
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                                <tr>
                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('patient'); ?></th>
                                    <th><?php echo lang('description'); ?></th>
                                    <th class="id_table1"><?php echo lang('document'); ?></th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($files as $file) { ?>
                                    <?php $patient_info = $this->db->get_where('patient', array('id' => $file->patient))->row(); ?>

                                    <tr class="">

                                        <td>
                                            <?php
                                            echo date('d-m-y', $file->date);
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $file->title;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $extension_url = explode(".", $file->url);

                                            $length = count($extension_url);
                                            $extension = $extension_url[$length - 1];
                                            if (strtolower($extension) == 'pdf') {
                                                $files = '<a class="example-image-link" href="' . $file->url . '" data-title="' . $file->title . '" target="_blank">' . '<img class="example-image" src="uploads/image/pdf.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } elseif (strtolower($extension) == 'docx') {
                                                $files = '<a class="example-image-link" href="' . $file->url . '" data-title="' . $file->title . '">' . '<img class="example-image" src="uploads/image/docx.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } elseif (strtolower($extension) == 'doc') {
                                                $files = '<a class="example-image-link" href="' . $file->url . '" data-title="' . $file->title . '">' . '<img class="example-image" src="uploads/image/doc.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } elseif (strtolower($extension) == 'odt') {
                                                $files = '<a class="example-image-link" href="' . $file->url . '" data-title="' . $file->title . '">' . '<img class="example-image" src="uploads/image/odt.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } else {
                                                $files = '<a class="example-image-link" href="' . $file->url . '" data-lightbox="example-1" data-title="' . $file->title . '">' . '<img class="example-image" src="' . $file->url . '" width="100px" height="100px"alt="image-1">' . '</a>';
                                            }
                                            echo $files;     
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<a class="btn btn-info btn-xs" href="' . $file->url . '" download> ' . lang('download') . ' </a>';
                                            ?>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Patient Material Modal-->
<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?> &#42;</label>
                        <input type="file" name="img_url" required="">
                        <span class="help-block"><?php echo lang('recommended_size'); ?> : 3000 x 2024</span>
                    </div>
                    <input type="hidden" name="redirect" value='patient/myDocuments'>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/patient/my_document.js"></script>

