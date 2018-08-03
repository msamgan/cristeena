<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title">My Profile Details
            <a href="/dashboard" class="btn btn-info btn-xs pull-right" title="Back to users list"><i class="lnr lnr-arrow-left"></i></a>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <!-- FORM -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Profile</h3>
                    </div>
                    <div class="panel-body">
                        <form id="profile-form" method="post" action="/api/users/edit/<?= $authUser->slug ?>" data-slug="<?= $authUser->slug ?>" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <label for="email-label" >Email:</label>
                                        <label class="form-control" id="email-label" disabled="" ></label>
                                        <br>
                                    </div>
                                    <div>
                                        <label for="name" >Full Name:</label>
                                        <input id="name" type="text" class="form-control" placeholder="user full name" name="name" required>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6" >
                                        <img src="/img/profile/profile.jpg" alt="Avatar" id="preview_image" class="img-circle pull-left avatar" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="col-md-6" >
                                        <label for="profile_image" >Profile Image:</label>
                                        <input id="profile_image" type="file" class="form-control" placeholder="Profile image" name="profile_image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-success btn-sm" value="Save" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- FORM -->
            </div>
        </div>
    </div>
</div>
