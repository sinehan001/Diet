<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
          <link href="common/extranal/css/patient/files.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('medical_history'); ?> | <?php echo $patient->name; ?> | <?php echo $patient->phone; ?>
            </header> 
            <div class="col-md-6">
                <div class="panel-body">
                    <div class="panel-body">
                        <a class="btn btn-info btn_width" data-toggle="modal" href="#myModal">
                            <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?> 
                        </a>
                    </div>
                    <header class="panel-heading">
                        <?php echo lang('patient'); ?>  <?php echo lang('history'); ?> 
                    </header> 

                    <div class="adv-table editable-table panel-body">
                        <table class="table table-striped table-hover table-bordered" id="">
                            <thead>
                                <tr>
                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('description'); ?></th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($medical_histories as $medical_history) { ?>
                                    <tr class="">

                                        <td><?php echo $medical_history->date; ?></td>
                                        <td><?php echo $medical_history->description; ?></td>
                                        <td class="no-print">
                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $medical_history->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="medical_history/delete?id=<?php echo $medical_history->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-body">
                    <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                        <div class="panel-body">
                            <a class="btn btn-info btn_width" data-toggle="modal" href="#myModa3">
                                <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?> 
                            </a>
                        </div>
                    <?php } ?>
                    <header class="panel-heading">
                        <?php echo lang('prescription'); ?> 
                    </header> 

                    <div class="adv-table editable-table panel-body">
                        <table class="table table-striped table-hover table-bordered" id="">
                            <thead>
                                <tr>

                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('doctor'); ?></th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($prescriptions as $prescription) { ?>
                                    <tr class="">
                                        <td><?php echo date('m/d/Y', $prescription->date); ?></td>
                                        <td><?php echo $this->doctor_model->getDoctorById($prescription->doctor)->name; ?></td>
                                        <td class="no-print">
                                              <a class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=<?php echo $prescription->id; ?>"><i class="fa fa-eye"> <?php echo lang('view'); ?> </i></a> 
                                            <?php if ($this->ion_auth->in_group('Doctor')) { ?>
                                                <button type="button" class="btn btn-info btn-xs btn_width editPrescription" data-toggle="modal" data-id="<?php echo $prescription->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                                <a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=<?php echo $prescription->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="panel-body">
                    <div class="panel-body">
                        <a class="btn btn-info btn_width" data-toggle="modal" href="#myModal1">
                            <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?> 
                        </a>
                    </div>
                    <header class="panel-heading">
                        <?php echo lang('patient'); ?>  <?php echo lang('files'); ?> 
                    </header>
                    <div class="adv-table editable-table ">



                        <div class="panel-body">
                            <?php foreach ($patient_materials as $patient_material) { ?>
                                <div class="panel col-md-3 patient_material_delete"  style="">
                                    <a class="btn btn-info btn-xs btn_width" href="patient/deletePatientMaterial?id=<?php echo $patient_material->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                    <div class="post-info">
                                        <img src="<?php echo $patient_material->url; ?>" width="100%">
                                    </div>
                                    <div class="post-info">
                                        <?php
                                        if (!empty($patient_material->title)) {
                                            echo $patient_material->title;
                                        }
                                        ?>
                                    </div>
                                    <div class="post-info">
                                        <a class="btn btn-info btn-xs btn_width" href="<?php echo $patient_material->url; ?>" download> <?php echo lang('download'); ?> </a>
                                        <hr>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?> &#42;</label>
                        <input type="file" name="img_url" required="">
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>


                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_medical_history'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker readonly"  required name="date"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?> &#42;</label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="description" value="" rows="10" required=""></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_medical_history'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="medical_historyEditForm" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker readonly" required="" name="date"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?> &#42;</label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10" required=""></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>

<div class="modal fade" id="myModa3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_prescription'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="prescription/addNewPrescription" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <input type="hidden" class="form-control form-control-inline input-medium default-date-picker" name="doctor"  value='<?php
                        if (!empty($doctor_id)) {
                            echo $doctor_id;
                        }
                        ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker readonly" required="" name="date"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="patient" value='' required=""> 
                            <option value="">Select .....</option>
                            <?php foreach ($patients as $patientss) { ?>
                                <option value="<?php echo $patientss->id; ?>" <?php
                                if (!empty($prescription->patient)) {
                                    if ($prescription->patient == $patientss->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patientss->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('history'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="symptom" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('medication'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="medicine" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('note'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_prescription'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" id="prescriptionEditForm" action="prescription/addNewPrescription" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <input type="hidden" class="form-control form-control-inline input-medium default-date-picker" name="doctor"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker readonly" required="" name="date"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="patient" value='' required=""> 
                            <option value="">Select .....</option>
                            <?php foreach ($patients as $patientss) { ?>
                                <option value="<?php echo $patientss->id; ?>" <?php
                                if (!empty($prescription->patient)) {
                                    if ($prescription->patient == $patientss->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patientss->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('history'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor1" name="symptom" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('medication'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor2" name="medicine" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('note'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor3" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/patient/files.js"></script>