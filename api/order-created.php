<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Order created</title>
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Order Created</h3>
                    <p>This transaction has been approved.</p>
                    <p>Payment UUID : <?php echo isset($_GET['pid']) ? $_GET['pid'] : 'NULL' ?></p>
                </div>
            </div>
        </div>
    </body>
</html>