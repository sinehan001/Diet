<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <div class="panel-body">
                <link href="common/extranal/css/settings/backup.css" rel="stylesheet">
                <aside class="right-side">		
                    <section class="content">
                        <div class="">
                            <div class="panel panel-primary">

                                <header class="panel-heading">
                                    <?php echo lang('backup_database'); ?>
                                </header>

                                <div class="panel-body">
                                    <div class="">
                                        <h4><i class="livicon" data-name="servers" data-loop="true" data-color="#000" data-hovercolor="#000" data-size="20"></i> <a href="<?= site_url('settings/backup_database'); ?>" id="backup_databse" class="btn btn-primary"><i class="livicon" data-name="servers" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="20"></i> <?= lang('backup_database'); ?></a></h4>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="content-panel">

                                                <div class="row">
                                                    <div class="col-md-12 button_option">
                                                        <?php
                                                        if (!empty($dbs)) {
                                                            echo '<ul class="list-group">';
                                                            foreach ($dbs as $file) {
                                                                $file = basename($file);
                                                                echo '<li class="list-group-item">';
                                                                $date_string = substr($file, 13, 10);
                                                                $time_string = substr($file, 24, 8);
                                                                $date = $date_string . ' ' . str_replace('-', ':', $time_string);
                                                                $bkdate = $this->sma->hrld($date);
                                                                //echo $bkdate;
                                                                echo '<strong>' . lang('backup_on') . ' <span class="text-primary"><i class="fa fa-database"></i> ' . $bkdate . '</span><div class="btn-group pull-right download_button">' . anchor('settings/download_database/' . substr($file, 0, -4), '<i class="livicon" data-name="download" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i> ' . lang('download'), 'class="btn btn-primary"') . ' ' . anchor('settings/restore_database/' . substr($file, 0, -4), '<i class="livicon" data-name="recycled" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="20"></i> ' . lang('restore'), 'class="btn btn-warning restore_db"') . ' ' . anchor('settings/delete_database/' . substr($file, 0, -4), '<i class="livicon" data-name="trash" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i> ' . lang('delete'), 'class="btn btn-danger delete_file"') . ' </div></strong>';
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <i class="livicon" data-name="download" data-size="50" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-96"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="content-panel"> 


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        if (!empty($files)) {
                                                            echo '<ul class="list-group">';
                                                            foreach ($files as $file) {
                                                                $file = basename($file);
                                                                echo '<li class="list-group-item">';
                                                                $date_string = substr($file, 12, 10);
                                                                $time_string = substr($file, 23, 8);
                                                                $date = $date_string . ' ' . str_replace('-', ':', $time_string);
                                                                $bkdate = $this->sma->hrld($date);
                                                                echo '<strong>' . lang('backup_on') . ' <span class="text-primary">' . $bkdate . '</span><div class="btn-group pull-right download_button">' . anchor('settings/download_backup/' . substr($file, 0, -4), '<i class="livicon" data-name="download" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i> ' . lang('download'), 'class="btn btn-primary"') . ' ' . anchor('settings/restore_backup/' . substr($file, 0, -4), '<i class="livicon" data-name="recycled" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="20"></i> ' . lang('restore'), 'class="btn btn-warning restore_backup"') . ' ' . anchor('settings/delete_backup/' . substr($file, 0, -4), '<i class="livicon" data-name="trash" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i> ' . lang('delete'), 'class="btn btn-danger delete_file"') . ' </div></strong>';
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>
                </aside>


            </div>
        </section>
        <!-- page end-->
    </section>
</section>



<div class="modal fade" id="wModal" tabindex="-1" role="dialog" aria-labelledby="wModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="wModalLabel"><?= lang('please_wait'); ?></h4>
            </div>
            <div class="modal-body">
                <?= lang('backup_modal_msg'); ?>
            </div>
        </div>
    </div>
</div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var restore_confirm = "<?php echo lang('restore_confirm'); ?>";</script>
<script type="text/javascript">var restore_modal_heading = "<?php echo lang('restore_modal_heading'); ?>";</script>
<script type="text/javascript">var backup_modal_heading = "<?php echo lang('backup_modal_heading'); ?>";</script>
<script type="text/javascript">var delete_confirm = "<?php echo lang('delete_confirm'); ?>";</script>
<script type="text/javascript">var href_file = "<?php echo site_url('settings/backup_files'); ?>";</script>
<script src="common/extranal/js/settings/backup.js"></script>