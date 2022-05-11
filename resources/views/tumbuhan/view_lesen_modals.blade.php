<!-- MODAL TAMBAH SPESIES 12 -->
<div class="modal fade in" id="modal-tambah-spesies12">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Spesies Dipohon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>                
            </div>
            <form id="tambahSpesies12Form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="spesies12_borang_id" name="spesies12_borang_id" value="{{$borang_id}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <input type="text" class="form-control" id="nama_spesies12" name="nama_spesies12"
                                    placeholder="Nama Spesies" required=""
                                    data-parsley-error-message="<p class='text-red'>Nama spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bilangan</label>
                                <input type="text" class="form-control" id="bilangan_spesies12"
                                    name="bilangan_spesies12" placeholder="(nombor sahaja)" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kawasan Memungut</label>
                                <input type="text" class="form-control" id="nama_kawasan12" name="nama_kawasan12"
                                    required="" placeholder="Nama kawasan memungut tumbuhan"
                                    data-parsley-error-message="<p class='text-red'>Nama kawasan diperlukan!</p>">
                                <div id="kawasan_larangan_new" style="display:none"><span class="text-red">Kawasan
                                        Larangan!</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="btnTambahSpesies12Modal" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT SPESIES 12 -->
<div class="modal fade in" id="modal-edit-spesies12">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Spesies Dipohon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>                
            </div>
            <form id="editSpesies12Form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editIDSpesies12" name="editIDSpesies12" value="">
                <input type="hidden" name="editRowNo12" id="editRowNo12" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <input type="text" class="form-control" id="edit_nama_spesies12"
                                    name="edit_nama_spesies12" placeholder="Nama Spesies" required=""
                                    data-parsley-error-message="<p class='text-red'>Nama spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bilangan</label>
                                <input type="text" class="form-control" id="edit_bilangan_spesies12"
                                    name="edit_bilangan_spesies12" placeholder="(nombor sahaja)" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kawasan</label>
                                <input type="text" class="form-control" id="edit_nama_kawasan12"
                                    name="edit_nama_kawasan12" required="" placeholder="Nama kawasan memburu"
                                    data-parsley-error-message="<p class='text-red'>Nama kawasan diperlukan!</p>">
                                <div id="kawasan_larangan_edit" style="display:none"><span class="text-red">Kawasan
                                        Larangan!</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnEditSpesies12Modal" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>