<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="">
            <header class="panel-heading no-print">
                 <?php echo lang('prescription'); ?>
            </header>
            <div class="panel-body col-md-8 panel-primary">
                 <link href="common/extranal/css/prescription/prescription_view.css" rel="stylesheet">
                <div class="panel">
                    <div class="invoice-list">

                        <div class="text-center corporate-id">


                            <h3>
                                <?php echo $settings->title ?>
                            </h3>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                            <img alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="200" height="100">
                            <h4 class="lang">
                                <?php echo lang('prescription') ?>
                                <hr class="hr_class">
                            </h4>
                        </div>

                      

                        <?php $patient = $this->patient_model->getPatientById($prescription->patient); ?>



                        <div class="col-md-12">
                            <div class="col-md-4 pull-left row patient_div">
                                <div class="col-md-12 row details">
                                    <p>
                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $prescription->patient))->row(); ?>
                                        <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->name . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('patient_id'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->id . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('age'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            $birthDate = strtotime($patient_info->birthdate);
                                            $birthDate = date('m/d/Y', $birthDate);
                                            $birthDate = explode("/", $birthDate);
                                            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                            echo $age . ' Year(s)';
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"> <?php echo lang('address'); ?> </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->address . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                        <span> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->phone . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>


                            </div>

                            <div class="col-md-4 pull-left patient_div">
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('doctor'); ?> <?php echo lang('name'); ?> </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($prescription->doctor)) {
                                                $doctor = $this->doctor_model->getDoctorById($prescription->doctor);
                                                echo $doctor->name;
                                            }
                                            ?>
                                        </span> 
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('profile'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($doctor->profile)) {
                                                echo $doctor->profile . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($doctor->phone)) {
                                                echo $doctor->phone . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4 pull-right patient_div">

                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"> <?php echo lang('prescription'); ?> <?php echo lang('id'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($prescription->id)) {
                                                echo $prescription->id;
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>


                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('date'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($prescription->date)) {
                                                echo date('d-m-Y', $prescription->date) . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>





                            </div>

                        </div>

                    </div>

                    <br>
                    <br>

                    <br>
                    <br>

                    <br>

                    <div class="col-md-12 panel-body clearfix">

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="control-label col-md-12"><?php echo lang('symptom'); ?></label>
                                <?php echo $prescription->symptom ?>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-12"><?php echo lang('note'); ?></label>
                                <?php echo $prescription->note ?>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <table class="table table-striped table-hover">                      
                                <thead>       
                                <th><?php echo lang('medicine'); ?></th>
                                <th><?php echo lang('instruction'); ?></th>
                                <th><?php echo lang('frequency'); ?></th>    
                                </thead>
                                <tbody>
                                    <?php
                                    $medicine = $prescription->medicine;
                                    $medicine = explode('###', $medicine);
                                    foreach ($medicine as $key => $value) {
                                        ?>
                                        <tr>
                                            <?php $single_medicine = explode('***', $value); ?>

                                            <td class=""><?php echo $this->medicine_model->getMedicineById($single_medicine[0])->name . ' - ' . $single_medicine[1]; ?> </td>
                                            <td class=""><?php echo $single_medicine[3] . ' - ' . $single_medicine[4]; ?> </td>
                                            <td class=""><?php echo $single_medicine[2] ?> </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>



                    <div class="text-center invoice-btn no-print">
                        <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

