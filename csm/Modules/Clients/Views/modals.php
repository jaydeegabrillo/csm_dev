<div id="add_client_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> Add Client </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
        </div>
        <div class="modal-body">
            <form id="new_client">
                <div class="tab">
                    <button class="tablinks active" onclick="openTab(event, 'PatientInformation')">Patient Information</button>
                    <button class="tablinks" onclick="openTab(event, 'Address')">Address</button>
                </div>
                <div id="PatientInformation" class="tabcontent active" style="display:block">
                    <div class="form-group" style="display:inline-block; width:40%">
                        <label for="recipient-name" class="control-label">First Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required>
                        <input type="hidden" class="id" name="id">
                    </div>
                    <div class="form-group" style="display:inline-block; width:20%">
                        <label for="middle_name" class="control-label">Middle Initial<span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="middle_name" id="middle_name" maxlength="1" required>
                    </div>
                    <div class="form-group" style="display:inline-block; width:39%">
                        <label for="last_name" class="control-label">Last Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                    </div>
                    <div class="form-group">
                        <div class="form-group" style="display:inline-block; width:50%">
                            <label for="gender" class="control-label">Gender <span class="text-red">*</span></label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value="">Choose Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                        <div class="form-group" style="display:inline-block; width:49%">
                            <label for="recipient-name" class="control-label">Race/Ethnicity</label>
                            <select class="form-control" name="ethnicity" id="ethnicity" required>
                                <option value="">Choose Ethnicity</option>
                                <option value="1">American Indian or Alaska Native</option>
                                <option value="2">Asian</option>
                                <option value="3">Black or African-American</option>
                                <option value="4">Hispanic or Latino</option>
                                <option value="5">Native Hawaiian or Pacific Islander</option>
                                <option value="6">White</option>
                                <option value="7">Unknown</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label">Phone <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email <span class="text-red">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" required>
                        <span class="duplicate_email">Email already exists! Please use another email.</span>
                    </div>
                    <div class="form-group">
                        <label for="marital_status" class="control-label">Marital Status <span class="text-red">*</span></label>
                        <select class="form-control" name="marital_status" id="marital_status" required>
                            <option value="">Choose Status</option>
                            <option value="1">Married</option>
                            <option value="2">Widowed</option>
                            <option value="3">Divorced</option>
                            <option value="4">Single</option>
                            <option value="5">Separated</option>
                            <option value="6">Unknown</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="social_security" class="control-label">Social Security Number <span class="text-red">*</span></label>
                        <input type="number" class="form-control" name="social_security" id="social_security" required>
                    </div>
                </div>
                <div id="Address" class="tabcontent">
                    <div class="form-group">
                        <label for="primary_address" class="control-label">Primary Address <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="primary_address" id="primary_address" required>
                    </div>
                    <div class="form-group">
                        <label for="zip" class="control-label">Zip <span class="text-red">*</span></label>
                        <input type="number" class="form-control" name="zip" id="zip" maxlength="7" required>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="mailing_address" class="control-label">Mailing Address <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="mailing_address" id="mailing_address" required>
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