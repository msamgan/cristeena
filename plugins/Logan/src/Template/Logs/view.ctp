<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <span class="pull-right" ><?= $this->element('menu-toggle') ?></span>
        <div class="container">
            <div class="page-header">
                <h1>Date: <?= $date ?></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel with-nav-tabs panel-success">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <?php $count = 0; foreach ($contents as $key => $content): ?>
                                    <li class="<?php if ($count == 0) { echo 'active'; } ?>">
                                        <a href="#<?= $key ?>" data-toggle="tab"><?= ucfirst($key) ?>(<?= count($content) ?>)</a>
                                    </li>
                                    <?php $count++; endforeach; ?>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <?php $count = 0; foreach ($contents as $key => $content): ?>
                                    <div class="tab-pane fade<?php if ($count == 0) { echo ' in active'; } ?>" id="<?= $key ?>">
                                        <table class="table table-bordered" >
                                            <?php foreach ($content as $logData): ?>
                                                <tr>
                                                    <td>
                                                        <?= $logData ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                    <?php $count++; endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
