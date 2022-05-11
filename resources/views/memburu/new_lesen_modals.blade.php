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
                {{-- <input type="hidden" id="spesies12_borang_id" name="spesies12_borang_id" value="{{$borang_id}}">
                --}}
                <div class="modal-body">
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <input type="text" class="form-control" id="nama_spesies12" name="nama_spesies12"
                                    placeholder="Nama Spesies" required=""
                                    data-parsley-error-message="<p class='text-red'>Nama spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" id="nama_spesies12"
                                    name="nama_spesies12" required>
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
                                <input type="text" class="form-control" id="bilangan_spesies12"
                                    name="bilangan_spesies12" placeholder="(nombor sahaja)" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kawasan Memburu</label>
                                <input type="text" class="form-control" id="nama_kawasan12" name="nama_kawasan12"
                                    required="" placeholder="Nama kawasan memburu" maxlength="50"
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
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <input type="text" class="form-control" id="edit_nama_spesies12" name="edit_nama_spesies12"
                                    placeholder="Nama Spesies" required=""
                                    data-parsley-error-message="<p class='text-red'>Nama spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                    id="edit_nama_spesies12" name="edit_nama_spesies12" required>
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
                                <input type="text" class="form-control" id="edit_bilangan_spesies12"
                                    name="edit_bilangan_spesies12" placeholder="(nombor sahaja)" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kawasan Memburu</label>
                                <input type="text" class="form-control" id="edit_nama_kawasan12"
                                    name="edit_nama_kawasan12" required="" placeholder="Nama kawasan memburu"
                                    maxlength="50"
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

<!-- MODAL TAMBAH SPESIES 13 -->
<div class="modal fade in" id="modal-tambah-spesies13">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Spesies Komersil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>                
            </div>
            <form id="tambahSpesies13Form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" id="spesies13_borang_id" name="spesies13_borang_id" value="{{$borang_id}}">
                --}}
                <div class="modal-body">
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <input type="text" class="form-control" id="nama_spesies13" name="nama_spesies13"
                                    placeholder="Nama Spesies" required=""
                                    data-parsley-error-message="<p class='text-red'>Nama spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" id="nama_spesies13"
                                    name="nama_spesies13" required>
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
                                <input type="text" class="form-control" id="bilangan_spesies13"
                                    name="bilangan_spesies13" placeholder="" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Cara Tangkapan</label>
                                {{-- <input type="text" class="form-control" id="cara_tangkapan13" name="cara_tangkapan13"
                                    required="" placeholder="Contoh: Jerat, tembak, dsb."
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"> --}}
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                    id="cara_tangkapan13" name="cara_tangkapan13" required>
                                    <option value="">Pilih</option>
                                    <option value="Tembak">Tembak</option>
                                    <option value="Perangkap">Perangkap</option>
                                    <option value="Jerat">Jerat</option>
                                    <option value="Tangkap">Tangkap</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bilangan Peluru Digunakan</label>
                                <input type="text" class="form-control" id="bil_peluru13" name="bil_peluru13"
                                    required="" maxlength="5" placeholder="(nombor sahaja)"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="btnTambahSpesies13Modal" type="button" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT SPESIES 13 -->
<div class="modal fade in" id="modal-edit-spesies13">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Spesies Komersil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>                
            </div>
            <form id="editSpesies13Form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editIDSpesies13" name="editIDSpesies13" value="">
                <input type="hidden" name="editRowNo13" id="editRowNo13" value="">
                <div class="modal-body">
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <input type="text" class="form-control" id="edit_nama_spesies13"
                                    name="edit_nama_spesies13" placeholder="Nama Spesies" required=""
                                    data-parsley-error-message="<p class='text-red'>Nama spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Spesies</label>
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                    id="edit_nama_spesies13" name="edit_nama_spesies13" required>
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
                                <input type="text" class="form-control" id="edit_bilangan_spesies13"
                                    name="edit_bilangan_spesies13" placeholder="" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan spesies diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Cara Tangkapan</label>
                                {{-- <input type="text" class="form-control" id="edit_cara_tangkapan13"
                                    name="edit_cara_tangkapan13" required="" placeholder="Cara tangkapan"
                                    data-parsley-error-message="<p class='text-red'>Cara tangkapan diperlukan!</p>"> --}}
                                <select class="form-control select2" style="width: 100%;"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                    id="edit_cara_tangkapan13" name="edit_cara_tangkapan13" required>
                                    <option value="">Pilih</option>
                                    <option value="Tembak">Tembak</option>
                                    <option value="Perangkap">Perangkap</option>
                                    <option value="Jerat">Jerat</option>
                                    <option value="Tangkap">Tangkap</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bilangan Peluru Digunakan</label>
                                <input type="text" class="form-control" id="edit_bil_peluru13" name="edit_bil_peluru_13"
                                    required="" maxlength="5" placeholder="(nombor sahaja)"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnEditSpesies13Modal" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>