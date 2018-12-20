<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/Logan/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/Logan/css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">
    <?= $this->element('sidebar') ?>
    <?= $this->fetch('content') ?>
</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="/Logan/vendor/jquery/jquery.min.js"></script>
<script src="/Logan/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>
