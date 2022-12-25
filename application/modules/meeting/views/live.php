<!DOCTYPE html>
<head>
    <title><?php echo lang('live_meeting'); ?></title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/react-select.css" />
    <link href="common/extranal/css/meeting/live.css" rel="stylesheet">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>

    <?php
    $meeting_details = $this->meeting_model->getMeetingById($live_id);
    $topic = $meeting_details->topic;
    $doctor = $meeting_details->doctorname;
    $patient = $meeting_details->patientname;
    
    $settings = $this->settings_model->getSettings();
    $hospital = $settings->system_vendor;
    
    
    if($this->ion_auth->in_group(array('Patient'))){
        $redirect = 'appointment/myTodays';
    }else{
        $redirect = 'appointment';
    }
    
    
    ?>

    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <h4><i class="fa fa-chromecast"></i> <?php echo $hospital ?> : <?php echo lang('live'); ?> <?php echo lang('appointment'); ?> </h4>
            </div>
            <div class="navbar-form navbar-right">
                <?php if ($this->ion_auth->in_group('Patient')) { ?>
                    <h5><i class="far fa-user-circle"></i> <?php echo lang('doctor'); ?> : <?php echo $doctor; ?></h5>
                <?php } ?>
                <?php if ($this->ion_auth->in_group('Doctor')) { ?>
                    <h5><i class="far fa-user-circle"></i> <?php echo lang('patient'); ?> <?php echo lang('name'); ?> : <?php echo $patient; ?> , <?php echo lang('id'); ?>: <?php echo $meeting_details->patient; ?></h5>
                <?php } ?>
            </div>
        </div>
    </nav>

    <!-- import ZoomMtg dependencies -->
    <script src="https://source.zoom.us/1.7.7/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/lodash.min.js"></script>

    <!-- import ZoomMtg -->
    <script src="https://source.zoom.us/zoom-meeting-1.7.7.min.js"></script>
    <script type="text/javascript">var api_key = "<?php echo $api_key; ?>";</script>
    <script type="text/javascript">var secret_key = "<?php echo $secret_key; ?>";</script>
     <script type="text/javascript">var meeting_id = "<?php echo $meeting_id; ?>";</script>
    <script type="text/javascript">var username = "<?php echo $this->ion_auth->user()->row()->username; ?>";</script>
     <script type="text/javascript">var meeting_password = "<?php echo $meeting_password; ?>";</script>
    <script type="text/javascript">var link = "<?php echo base_url(); ?><?php echo $redirect; ?>";</script>
    <script src="common/extranal/js/meeting/live.js"></script>
</body>
</html>
