<div id="timesheet_pdf" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none" aria-modal="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> Timesheet PDF </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
        </div>
        <div class="modal-body">
            <form id="timesheet_pdf_form">
            <div class="form-group">
                <div class="col-sm-12">
                  <label for="start_date" class="control-label">Start Date <span class="text-red">*</span></label>
                  <input type="date" class="form-control" name="start_date" id="start_date" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                  <label for="end_date" class="control-label">End Date <span class="text-red">*</span></label>
                  <input type="date" class="form-control" name="end_date" id="end_date" required>
                </div>
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
