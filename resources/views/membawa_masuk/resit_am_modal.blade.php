<!-- MODAL UPDATE RESIT AM -->
<div class="modal fade in" id="modal-update-resitam">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kemaskini Resit Am</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form id="resitAmForm" data-parsley-validate>
                @csrf
                <input type="hidden" id="borang_id_resitam" name="borang_id_resitam" value="">
                <input type="hidden" id="resit_am_id" name="resit_am_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>No Resit *</label>
                                <input type="text" class="form-control" id="no_resit" name="no_resit"
                                    placeholder="Nombor Resit" required=""
                                    data-parsley-error-message="<p class='text-red'>Nombor resit am diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tarikh Resit: *</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control datemask" data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric"
                                        id="tarikh_resit" name="tarikh_resit"
                                        data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jumlah RM *</label>
                                <input type="text" class="form-control" id="jumlah_rm" name="jumlah_rm" required=""
                                    data-parsley-error-message="<p class='text-red'>Jumlah RM Diperlukan! (nombor sahaja)</p>"
                                    placeholder="0" min="0" max="20000" step="100" data-parsley-validation-threshold="1"
                                    data-parsley-trigger="keyup" data-parsley-type="number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>No Permit *</label>
                                <input type="text" class="form-control" id="no_permit" name="no_permit"
                                    placeholder="Nombor Permit (Autoset)" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tempoh Permit</label>
                                <select class="form-control" id="tempoh_permit" name="tempoh_permit"
                                data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                    <option value="">Pilih</option>
                                    <option value="1">1 tahun</option>
                                    <option value="2">2 tahun</option>
                                    <option value="3">3 tahun</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Pejabat Pembayaran -->
                            <div class="form-group">
                                <label>Pejabat Pembayaran: *</label>
                                <select class="form-control select2" style="width:100%" name="pejabat_pembayaran_id"
                                    id="pejabat_pembayaran_id"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                    <option value="">Pilih</option>
                                    @foreach ($pejabat as $item)
                                        <option value="{{ $item->id}}">{{ $item->pejabat}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnSaveResitAm" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
