<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Rizvi">
    <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
    <link rel="shortcut icon" href="uploads/favicon.png">
    <title>Login - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="common/css/bootstrap-reset.css" rel="stylesheet"> -->
    <!--external css-->
    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <!-- <link href="common/css/style.css" rel="stylesheet"> -->
    <link href="common/css/style-responsive.css" rel="stylesheet" />
    <link href="common/extranal/css/auth.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans');

* {
  font-family: 'Open Sans', sans-serif;
}

body {
  margin: 0;
  padding: 0;
}

.main-container {
  width: 100%;
  height: 100vh;
  background: url('https://michaelbeststrategies.com/wp-content/uploads/2020/10/Doctor-in-hospital-background-with-copy-space-949812160_7952x5304-1-scaled.jpeg');
  background-size: cover !important;
  transition: 0.4s linear;
}

.box {
  width: 400px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(0, 0, 0, .8);
  padding: 40px;
  box-sizing: border-box;
  box-shadow: 0px 15px 25px rgba(0, 0, 0, .5);
  border-radius: 10px;
}

.box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.box p {
  margin-bottom: 0;
}

.box p:nth-child(even) {
  margin-top: 0;
}

.box a {
  color: #9a9d9e;
  font-size: 14px;
  text-decoration: none;
}

.box input[type=submit] {
  display: table;
  margin: 0 auto;
}
p {
  text-align: center;
}
.box .input-box {
  position: relative;
}

.box .input-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  margin-bottom: 30px;
  color: #fff;
  border: 1px solid #fff;
  border: none;
  border-bottom-style: solid;
  outline: none;
  letter-spacing: 1px;
  background: transparent;
}

.box .input-box label {
  position: absolute;
  color: #fff;
  top: 0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  pointer-events: none;
  transition: .5s;
}

.box .input-box input:focus ~ label,
.box .input-box input:valid ~ label{
  top: -18px;
  left: 0;
  color: #03a9f4;
  font-size: 12px;
}

.box input[type=submit] {
  background: transparent;
  border: none;
  outline: none;
  background: #03a9f4;
  color: #fff;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
}

#logged-in {
  width: 100%;
  height: auto;
  text-align: center;
  margin: auto;
  position: absolute;
  top: 50px;
  display: none;
}

.login-true {
  opacity: 0;
}
#infoMessage {
  color: #ff0000;
  padding-bottom: 10px;
}
    </style>
</head>
<body class="login-body">
    <div id="main" class="main-container">
        <div class="box">
            <h2>Login</h2>
            <div id="infoMessage"><?php echo $message; ?></div>
            <form class="form-signin" method="post" action="auth/login">
                <div class="login-wrap">
                    <div class="input-box">
                        <input id="user-name" type="text" class="form-control" name="identity" autofocus required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <input id="user-pass" type="password" class="form-control"  name="password" required>
                        <label>Password</label>
                    </div>
                    <input id="submit" class="btn btn-lg btn-login btn-block" type="submit" name="" value="SIGN IN">
                </div>
            </form>
            <br />
            <p><a href="#">Forget password?</a></p>
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="auth/forgot_password">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <input class="btn detailsbutton" type="submit" name="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="common/js/jquery.js"></script>
        <script src="common/js/bootstrap.min.js"></script>
</body>
</html>