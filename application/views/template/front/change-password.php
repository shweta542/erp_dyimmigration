<div class="page-wrapper" style="min-height: 614px;">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Change Password</h3>

                        </div>
                    </div>
                </div>

                <form id="changepassword">
                	<input type="hidden" name="USER_ID" value="<?= $logged_in_user->USER_ID ?>">
                    <div class="form-group">
                        <label>Old password</label>
                        <input type="password" name="oldpassword" required="true" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>New password</label>
                        <input type="password" name="password" required="true" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" name="confirmpassword" required="true" class="form-control" />
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>