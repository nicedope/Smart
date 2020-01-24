<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $pageInfo['title']; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="<?= base_url(); ?>" name="baseurl">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet/less" type="text/css" href="<?= base_url('assets/css/frontend/ftr_css.less'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/js/plugins/datatables/dataTables.bootstrap4.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" id="css-main" href="<?= base_url('assets/css/'); ?>oneui.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>
  <script src="<?= base_url('assets/js/frontend/ftr_js.js'); ?>"></script>

</head>
<body>

	<?php echo $content; ?>
  
</body>
</html>