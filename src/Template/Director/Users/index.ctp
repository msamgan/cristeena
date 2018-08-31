<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title">Listing All Users
            <a href="/director/users/add" class="btn btn-success btn-xs pull-right" title="Add new user"><i class="lnr lnr-plus-circle"></i></a>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <!-- TABLE HOVER -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Users</h3>
                    </div>
                    <div class="panel-body">
                        <?= $this->element('User/table') ?>
                    </div>
                </div>
                <!-- END TABLE HOVER -->
            </div>
        </div>
    </div>
</div>
