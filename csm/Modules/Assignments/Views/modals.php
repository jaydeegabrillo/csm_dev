<div id="add_assignment_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> Add Assignment </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
        </div>
        <div class="modal-body">
            <form id="new_assignment">
            <div class="form-group row">
                <div class="col-sm-6">
                  <label for="start_date" class="control-label">Start Date <span class="text-red">*</span></label>
                  <input type="date" class="form-control" name="start_date" id="start_date" required>
                </div>
                <div class="col-sm-6">
                  <label for="end_date" class="control-label">End Date <span class="text-red">*</span></label>
                  <input type="date" class="form-control" name="end_date" id="end_date" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                  <label for="time_start" class="control-label">Time Start <span class="text-red">*</span></label>
                  <input type="time" class="form-control" name="time_start" id="time_start" required>
                </div>
                <div class="col-sm-6">
                  <label for="time_end" class="control-label">Time End <span class="text-red">*</span></label>
                  <input type="time" class="form-control" name="time_end" id="time_end" required>
                </div>
            </div>
            <div class="form-group">
                <label for="client" class="control-label">Client Name<span class="text-red">*</span></label>
                <select class="form-control" name="client" id="client" required>
                    <option value=""></option>
                    <?php foreach ($clients as $client) { ?>
                        <option value="<?= $client->id ?>"><?= $client->name ?></option>
                    <?php } ?>
                </select>
                <input type="hidden" class="id" name="id">
            </div>
            <div class="form-group">
                <label for="specialty" class="control-label">Specialty <span class="text-red">*</span></label>
                <select class="form-control" name="specialty" id="specialty" required>
                    <option value=""></option>
                    <?php foreach ($positions as $position) { ?>
                        <option value="<?= $position->id ?>"><?= ucfirst($position->title) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_user" class="control-label">Staff Name <span class="text-red">*</span></label>
                <select class="form-control" name="assigned_user" id="assigned_user" required>
                    <option value="" disabled></option>
                    <?php if($staves){ ?>
                        <?php foreach($staves as $staff){ ?>
                            <option value="<?= $staff->id ?>" class="staff_option[<?= $staff->id ?>]" disabled><?= $staff->name ?></option>
                        <?php } ?>
                    <?php }else{ ?>
                        <option value="">No Staff Available</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="reason" class="control-label">Reason:<span class="text-red">*</span></label>
                <textarea name="reason" id="reason" class="form-control" cols="20" rows="5"></textarea>
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
