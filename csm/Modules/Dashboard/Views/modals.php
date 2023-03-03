<div id="delete_log_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center"> Delete Log </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
        </div>
        <div class="modal-body">
            <h3>Are you sure you want to delete this log?</h3>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect modal_close" data-dismiss="modal">
                Close
            </button>
            <button type="submit" class="btn btn-danger waves-effect waves-light delete_log">
                Save changes
            </button>
        </div>
        </div>
    </div>
</div>

<div id="edit_log_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Edit Log </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
            </div>
            <form id="edit_log">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="in">Clock In</label>
                            <input type="hidden" name="id" id="log_id">
                            <input type="time" name="in" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="out">Clock Out</label>
                            <input type="time" name="out" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="out">Date</label>
                            <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect modal_close" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
