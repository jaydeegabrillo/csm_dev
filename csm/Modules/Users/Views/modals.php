<div id="add_user_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> Add User </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
        </div>
        <div class="modal-body">
            <form id="new_user">
            <div class="form-group">
                <div style="display:inline-block; width:50%">
                    <label for="first_name" class="control-label">First Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="first_name" id="first_name" required>
                    <input type="hidden" class="id" name="id">
                </div>
                <div style="display:inline-block; width:49%">
                    <label for="last_name" class="control-label">Last Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="last_name" id="last_name" required>
                </div>
            </div>
            <div class="form-group">
                <div style="display:inline-block; width:50%">
                    <label for="username" class="control-label">Username <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div style="display:inline-block; width:49%">
                    <label for="email" class="control-label">Email <span class="text-red">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="form-group" style="display:none">
                <div style="display:inline-block; width: 50%">
                    <span class="duplicate_username">Username already exists! Please use another username.</span>
                </div>
                <div style="display:inline-block; width: 49%">
                    <span class="duplicate_email">Email already exists! Please use another email.</span>
                </div>
            </div>
            <div>
                <div class="form-group" style="display:inline-block; width:50%">
                    <label for="position" class="control-label">Position <span class="text-red">*</span></label>
                    <!-- <input type="text" class="form-control" name="username" id="username" required> -->
                    <select class="form-control" name="position_id" id="position_id" required>
                        <option value=""></option>
                        <?php foreach ($positions as $position) { ?>
                            <option value="<?= $position->id ?>"><?= ucfirst($position->title) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group" style="display:inline-block; width:49%">
                    <label for="phone" class="control-label">Phone <span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="phone" id="phone" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Password <span class="text-red">*</span></label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="address" class="control-label">Address <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="address" id="address" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect modal_close" data-dismiss="modal">
            Close
            </button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">
            Save changes
            </button>
            </form>
        </div>
        </div>
    </div>
</div>