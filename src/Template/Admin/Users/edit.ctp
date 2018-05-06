<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title">User Details
            <a href="/admin/users" class="btn btn-info btn-xs pull-right" title="Back to users list"><i class="lnr lnr-arrow-left"></i></a>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <!-- FORM -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit User</h3>
                    </div>
                    <div class="panel-body">
                        <form id="edit-user-form" data-slug="<?= $slug ?>" >
                            <?php include('form.ctp') ?>
                        </form>
                    </div>
                </div>
                <!-- FORM -->
            </div>
        </div>
    </div>
</div>