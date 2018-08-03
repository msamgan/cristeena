<!doctype html>
<html lang="en">

<head>
    <title>Users | <?= SITE_TITLE ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <?= $this->element('Common/head') ?>
    <?= $this->element('Common/meta') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    <?= $this->element('Common/nav') ?>
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    <?= $this->element('Common/sidebar') ?>
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <?= $this->fetch('content') ?>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <?= $this->element('Common/footer') ?>
</div>
<!-- END WRAPPER -->

<!-- Javascript -->
<script data-main="/js/Users/config"  src="/js/require.js"></script>
</body>

</html>
