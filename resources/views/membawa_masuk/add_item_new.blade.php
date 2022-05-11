<!-- MODAL TAMBAH ITEM -->
<div class="modal fade in" id="modal-add-item-new">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Senarai Barang Dibawa Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form id="formNewSpesis">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="jenis_dibawa_masuk_new_id">Jenis Dibawa Masuk</label>
                            <select id="jenis_dibawa_masuk_new_id" name="jenis_dibawa_masuk_new_id" style="width: 100%" required
                            data-parsley-error-message="<p class='text-red'>Jenis diperlukan!</p>">
                                <option value="" selected>Sila Pilih</option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->jenis }}">{{ $item->jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="spesis_new_id">Spesis</label>
                            <select id="spesis_new_id" name="spesis_new_id" style="width: 100%" required
                            data-parsley-error-message="<p class='text-red'>Spesis diperlukan!</p>">
                                <option value="" selected>Sila Pilih</option>
                                @foreach ($spesis ?? '' as $item)
                                    <option value="{{ $item->NAMA_TEMPATAN }}">{{ $item->NAMA_TEMPATAN }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bilangan (mengikut jantina)</label>
                                <input type="text" class="form-control" id="bilangan_new"
                                    name="bilangan_new" placeholder="Contoh: bilangan mengikut jantina" required=""
                                    data-parsley-error-message="<p class='text-red'>Bilangan diperlukan!</p>">
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
