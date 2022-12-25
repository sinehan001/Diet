<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
     <link href="common/extranal/css/settings/edit_language.css" rel="stylesheet">
        <div class="col-md-12 row">
            <section class="col-md-10 row">
                <header class="panel-heading">
                    <?php
                    if ($languagename == 'arabic') {
                        $language = lang('arabic');
                    }
                    if ($languagename == 'english') {
                        $language = lang('english');
                    }
                    if ($languagename == 'italian') {
                        $language = lang('italian');
                    }
                    if ($languagename == 'french') {
                        $language = lang('french');
                    }
                    if ($languagename == 'indonesian') {
                        $language = lang('indonesian');
                    }
                    if ($languagename == 'zh_cn') {
                        $language = lang('chinese');
                    }
                    if ($languagename == 'spanish') {
                        $language = lang('spanish');
                    }
                    if ($languagename == 'portuguese') {
                        $language = lang('portuguese');
                    }
                    if ($languagename == 'russian') {
                        $language = lang('russian');
                    }
                    if ($languagename == 'turkish') {
                        $language = lang('turkish');
                    } if ($languagename == 'japanese') {
                        $language = lang('japanese');
                    }
                    if ($languagename == 'persian') {
                        $language = lang('persian');
                    }
                    if ($languagename == 'german') {
                        $language = lang('german');
                    }
                    ?>
                    <?php echo lang('language'); ?> <?php echo lang('translation'); ?> :  <?php echo $language; ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
<?php echo validation_errors(); ?>
                            <form role="form" action="settings/addLanguageTranslation" class="clearfix" method="post" enctype="multipart/form-data" id="myForm">
                                <input type="hidden" name="language" value="<?php echo $languagename; ?>">
                                <input type="hidden" name="valueupdate" value="">
                                <input type="hidden" name="indexupdate" value="">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo lang('name'); ?></th>
                                            <th><?php echo lang('translation'); ?></th>
                                        </tr>
                                    </thead><tbody>
<?php
$i = 0;
foreach ($languages as $key => $value) {
    $i = $i + 1;
    ?>
                                            <tr class="table-bordered">
                                                <td><?php echo $i; ?></td>
                                                <td class="table-bordered">  
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="index[]" id="index" value='<?php
                                        echo $key;
                                        ?>' placeholder="" readonly> </div>
                                                </td>
                                                <td class="table-bordered">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="value[]" id="value" value="<?php
                                        echo $value;
                                        ?>" placeholder="">  
                                                    </div> 
                                                </td>
                                            </tr>
<?php } ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td> <button id="submit" type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>




                                    </tfoot>
                                   
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/edit_language.js"></script>