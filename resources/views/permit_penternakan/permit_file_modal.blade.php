<!-- MODAL UPDATE RESIT AM -->
<div class="modal fade in" id="modal-upload-permit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Muat Naik Permit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form id="permitFileForm" data-parsley-validate>
                @csrf
                <input type="hidden" id="borang_id_permit" name="borang_id_permit" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="permitFile">Fail Permit (PDF)</label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="permitFile" name="permitFile[]" required>
                                  <label class="custom-file-label" for="permitFile">Choose file</label>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="btnUploadPermitFile" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
