<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
         <link href="common/extranal/css/patient/my_case_list.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('my'); ?> <?php echo lang('cases'); ?> 
            </header> 
            <div class="panel-body"> 
                <div class="adv-table editable-table">
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th class="id_table"><?php echo lang('id'); ?></th>
                                <th class="id_table1"><?php echo lang('case'); ?> <?php echo lang('title'); ?></th>
                                <th  class="id_table2"><?php echo lang('case'); ?></th> 
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($medical_histories as $medical_history) { ?>
                                <?php $patient_info = $this->db->get_where('patient', array('id' => $medical_history->patient_id))->row(); ?>

                                <tr class="">

                                    <td>
                                        <?php
                                        echo $medical_history->id;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $medical_history->title;
                                        ?>
                                    </td>

                                    <td><?php
                                        if (!empty($medical_history->description)) {
                                            echo $medical_history->description;
                                        }
                                        ?></td>

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





<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/patient/my_case_list.js"></script>