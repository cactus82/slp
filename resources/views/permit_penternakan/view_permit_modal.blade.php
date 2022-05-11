<!-- MODAL TAMBAH SPESIES -->
<div class="modal fade in" id="modal-tambah-spesies">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Spesies Dipohon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>                
            </div>
            <form id="tambahSpesiesForm" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" id="nama_spesies"
                                    name="nama_spesies" required>
                                    <option value="">Pilih</option>
                                    @foreach($hidupan_liar as $item)
                                    <option value="{{$item->NAMA_TEMPATAN}}">{{$item->NAMA_TEMPATAN}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bilangan</label>
                                <input type="text" class="form-control" id="bilangan_spesies"
                                    name="bilangan_spesies12" placeholder="Contoh: 3 ekor" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnTambahSpesiesModal" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT SPESIES -->
<div class="modal fade in" id="modal-edit-spesies">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Spesies Dipohon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>                
            </div>
            <form id="editSpesiesForm" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editIDSpesies" name="editIDSpesies" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                    id="edit_nama_spesies" name="edit_nama_spesies" required>
                                    <option value="">Pilih</option>
                                    @foreach($hidupan_liar as $item)
                                    <option value="{{$item->NAMA_TEMPATAN}}">{{$item->NAMA_TEMPATAN}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bilangan</label>
                                <input type="text" class="form-control" id="edit_bilangan_spesies"
                                    name="edit_bilangan_spesies" placeholder="Contoh: 3 ekor" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnEditSpesiesModal" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
