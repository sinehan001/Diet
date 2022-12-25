<?php

?>

<html>
<head>
    <title>Payment Successful</title>
</head>

<body>
<div>
    <h1>Thank You!</h1>
    <p>A payment of <strong>N<?php echo number_format($amount);?></strong> was successfully paid. </p>
    <hr>
   
    <p>
        <a class="btn btn-primary btn-sm" href="finance" role="button">Continue to homepage</a>
    </p>
</div>
</body>
</html>