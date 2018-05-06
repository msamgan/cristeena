<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | <?= SITE_TITLE ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <?= $this->element('Common/head') ?>
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
<!-- END WRAPPER -->
<script data-main="/js/Auth/config"  src="/js/require.js"></script>
</body>

</html>
