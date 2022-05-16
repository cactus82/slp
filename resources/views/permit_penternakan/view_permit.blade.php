@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Borang Permit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/permit/penternakan">Senarai Permit</a></li>
                            <li class="breadcrumb-item active">View Permit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col-md-6 -->
                    @if ($borang->sebab_dikembalikan)
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Borang Dikembalikan!</h5>
                                <strong>Sebab dikembalikan:</strong> {{ $borang->sebab_dikembalikan ?? '' }}
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="m-0">Borang Permohonan Permit</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/permit/penternakan" class="btn btn-warning float-right">Kembali</a>
                                    </div>
                                </div>
                            </div>
                                <div class="card-body">
                                <form id="formPermit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="borang_id" value="{{ $borang_id }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>1. Jenis Permit</label>
                                                <select class="form-control" id="jenis_permit" name="jenis_permit">
                                                    <option value="haiwan"
                                                        @if ($borang->jenis_permit === 'haiwan') selected @endif>Penternakan Haiwan
                                                    </option>
                                                    <option value="tumbuhan"
                                                        @if ($borang->jenis_permit === 'tumbuhan') selected @endif>Penanaman Tumbuhan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>2. Nama Penuh</label>
                                                <input type="text" class="form-control" id="nama_penuh" name="nama_penuh"
                                                    placeholder="" value="{{ $borang->nama_penuh ?? '' }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>3. No Kad Pengenalan</label>
                                                <input type="text" class="form-control" id="no_kp" name="no_kp"
                                                    placeholder="" value="{{ $borang->no_kp ?? '' }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>4. No Telefon</label>
                                                <input type="text" class="form-control" name="no_tel" placeholder=""
                                                    value="{{ $borang->no_tel ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>5. Alamat Kediaman</label>
                                                <input type="text" class="form-control" name="alamat_kediaman"
                                                    placeholder="" value="{{ $borang->alamat_kediaman ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>6. Butir-butir lesen atau permit lain yang dipegang. (Jika ada)</label>
                                            <textarea class="form-control" rows="3" name="butir_permit_lain" id="butir_permit_lain"
                                                placeholder="Nyatakan butiran..."
                                                value="{{ $borang->butir_lesen_permit ?? '' }}"
                                                style="margin-top: 0px; margin-bottom: 0px; height: 87px;"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>7. Alamat di mana penternakan haiwan atau penanaman tumbuhan* akan
                                                diusahakan</label>
                                            <input type="text" class="form-control" name="alamat_penternakan"
                                                id="alamat_penternakan"
                                                value="{{ $borang->alamat_penternakan_penanaman ?? '' }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Daerah</label>
                                                <select id="daerah_id" name="daerah_id" style="width: 100%" required>
                                                    <option value="" selected>Sila Pilih</option>
                                                    @foreach ($daerah as $item)
                                                        <option value="{{ $item->id }}">{{ $item->daerah }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>8. Kawasan akan digunakan untuk penternakan atau penanaman *</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Saiz (Ekar/Hektar)</label>
                                            <input type="text" class="form-control" name="saiz" id="saiz"
                                                placeholder="Contoh: 5 hektar" value="{{ $borang->saiz_kawasan ?? '' }}"
                                                required>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="petaFile">Peta/Pelan (Imej Saiz Maximum 5MB)</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="petaFile"
                                                        name="petaFile[]" multiple>
                                                    <label class="custom-file-label" for="petaFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="petaFailAttachment">
                                            <div class="card-footer bg-white">
                                                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                    @foreach ($fail_permit_penternakan as $item)
                                                        <li>
                                                            {{-- <span class="mailbox-attachment-icon"><i class="fas fa-file-text-o"></i></span> --}}
                                                            <div class="mailbox-attachment-info">
                                                                <a href="/permit/penternakan/download/{{ basename($item->file_name) }}"
                                                                    class="mailbox-attachment-name"><i
                                                                        class="fas fa-paperclip"></i>
                                                                    {{ basename($item->original_name) }}</a>
                                                                <span class="mailbox-attachment-size">
                                                                    {{ $item->file_size }}KB
                                                                    @if (in_array($borang->status_borang_id,array(3,7,8)))
                                                                    <a href="/permit/penternakan/deletefile/{{ $item->id }}"
                                                                        onclick="return confirm('Adakah anda pasti untuk delete fail ini?')"
                                                                        class="btn btn-default btn-xs pull-right"><i
                                                                            class="fas fa-times"></i></a>
                                                                    @endif
                                                                    <a href="/permit/penternakan/download/{{ basename($item->file_name) }}"
                                                                        class="btn btn-default btn-xs pull-right"><i
                                                                            class="fas fa-download"></i></a>
                                                                </span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>9. Deskripsi bangunan atas mana kawasan digunakan</label>
                                            <input type="text" class="form-control" name="deskripsi_bangunan"
                                                id="deskripsi_bangunan" value="{{ $borang->deskripsi_bangunan ?? '' }}"
                                                required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>10. Butir-butir peraturan bagi menjamin haiwan daripada terlepas</label>
                                            <textarea class="form-control" rows="3" name="butir_peraturan" id="butir_peraturan" placeholder="Nyatakan butiran..."
                                                style="margin-top: 0px; margin-bottom: 0px; height: 87px;"
                                                required>{{ $borang->butir_peraturan ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>11. Butir-butir haiwan/tumbuhan yang dicadangkan untuk
                                                diternak/ditanam</label>
                                        </div>
                                        <div class="col-md-12">
                                            @if ($borang->status_borang_id == 3 && Auth::user()->role == 'client')
                                                <button type="button" id="btnTambahSpesis"
                                                    class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                                    data-target="#modal-tambah-spesies">Tambah</button><br><br>
                                            @endif

                                            <table id="dataTable" class="table table-bordered nowrap table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Spesis</th>
                                                        <th>Anggaran bilangan/Kuantiti</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>12. Butir-butir stok yang akan digunakan untuk memulakan
                                                penternakan/penanaman dengan memberikan sumber.</label>
                                            <textarea class="form-control" rows="3" name="butir_stok" id="butir_stok" placeholder="Nyatakan butiran..."
                                                style="margin-top: 0px; margin-bottom: 0px; height: 87px;"
                                                required>{{ $borang->butir_stok ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>13. Butir-butir ringkas tentang diet yang dicadangkan untuk diberikan
                                                kepada haiwan.</label>
                                            <textarea class="form-control" rows="3" name="butir_diet" id="butir_diet" placeholder="Nyatakan butiran..."
                                                style="margin-top: 0px; margin-bottom: 0px; height: 87px;"
                                                required>{{ $borang->butir_diet ?? '' }}</textarea>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>14. Salinan-salinan ramalan kewangan bagi perniagaan yang dicadangkan
                                                mestilah dikemukakan dengan permohonan termasuk aliran tunai dan butir-butir
                                                input wang tunai.</label>
                                            <input type="text" class="form-control" name="salinan_ramalan"
                                                id="salinan_ramalan" value="{{ $borang->salinan_ramalan ?? '' }}"
                                                required>
                                        </div>
                                    </div><br>
                                </form>
                                <form id="formLaporanSite" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="borang_id2" value="{{ $borang_id }}">
                                    @if (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'normal')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>15. Laporan Site Inspection (Harus ada sebelum boleh
                                                        disahkan)</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="laporan_site_inspection" name="laporan_site_inspection[]"
                                                            multiple>
                                                        <label class="custom-file-label"
                                                            for="laporan_site_inspection">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" id="petaFailAttachment">
                                                <div class="card-footer bg-white">
                                                    <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                        @foreach ($laporan_site_inspection as $item)
                                                            <li>
                                                                {{-- <span class="mailbox-attachment-icon"><i class="fas fa-file-text-o"></i></span> --}}
                                                                <div class="mailbox-attachment-info">
                                                                    <a href="/permit/penternakan/downloadLS/{{ basename($item->file_name) }}"
                                                                        class="mailbox-attachment-name"><i
                                                                            class="fas fa-paperclip"></i>
                                                                        {{ basename($item->original_name) }}</a>
                                                                    <span class="mailbox-attachment-size">
                                                                        {{ $item->file_size }}KB
                                                                        @if (in_array($borang->status_borang_id,array(3,7,8)))
                                                                        <a href="/permit/penternakan/deleteLS/{{ $item->id }}"
                                                                            onclick="return confirm('Adakah anda pasti untuk delete fail ini?')"
                                                                            class="btn btn-default btn-xs pull-right"><i
                                                                                class="fas fa-times"></i></a>
                                                                        @endif
                                                                        <a href="/permit/penternakan/downloadLS/{{ basename($item->file_name) }}"
                                                                            class="btn btn-default btn-xs pull-right"><i
                                                                                class="fas fa-download"></i></a>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                                </div>
                                <div class="card-footer">
                                    {{-- <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button> --}}
                                    @if (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'normal')
                                        @if ($borang->status_borang_id == 2)
                                            <button id="btnSahkan" class="btn btn-info">Sahkan Borang</button>
                                            <button id="btnKembalikan" class="btn btn-warning">Kembalikan Borang</button>
                                        @endif
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super admin')
                                            @if ($borang->status_borang_id == 4 || $borang->status_borang_id == 8)
                                                <button id="btnApprove" class="btn btn-success">Luluskan Borang</button>
                                                <button id="btnReject" class="btn btn-danger">Reject Borang</button>
                                            @endif
                                            @if ($borang->status_borang_id == 5)
                                                <button id="btnReject" class="btn btn-danger">Reject Borang</button>
                                            @endif
                                        @endif
                                    @endif

                                    @if ($borang->status_borang_id == 3 && Auth::user()->role == 'client')
                                        <button id="btnHantarSemula" class="btn btn-info">Update</button>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <strong>Status Borang: </strong><code>{{ $status_borang->status }}</code>
                                    @if ($borang->status_borang_id == 3)
                                        &nbsp;<strong>Dikembalikan Oleh:
                                        </strong><code>{{ $borang->dikembalikan_oleh_nama }}</code>
                                        &nbsp;<strong>Tarikh Dikembalikan:
                                        </strong><code>{{ $borang->tarikh_dikembalikan }}</code>
                                    @elseif($borang->status_borang_id == 4)
                                        &nbsp;<strong>Disahkan Oleh:
                                        </strong><code>{{ $borang->disahkan_oleh_nama }}</code>
                                        &nbsp;<strong>Tarikh Disahkan: </strong><code>{{ $borang->tarikh_disahkan }}</code>
                                    @elseif($borang->status_borang_id == 5)
                                        &nbsp;<strong>Diluluskan Oleh:
                                        </strong><code>{{ $borang->diluluskan_oleh_nama }}</code>
                                        &nbsp;<strong>Tarikh Diluluskan:
                                        </strong><code>{{ $borang->tarikh_diluluskan }}</code>
                                    @elseif($borang->status_borang_id == 6)
                                        {{-- &nbsp;<strong>Ditolak Oleh: </strong><code>{{$borang->ditolak_oleh_nama}}</code> --}}
                                        &nbsp;<strong>Tarikh Ditolak: </strong><code>{{ $borang->tarikh_ditolak }}</code>
                                    @endif
                                    <input type="hidden" name="cur_status_borang_id"
                                        value="{{ $borang->status_borang_id }}">
                                </div>

                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('permit_penternakan.view_permit_modal')

    @push('script')
        <script>
            $(function() {
                $('#dataTable').DataTable({
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "bFilter": false
                });

                $('#formPermit').parsley();

                //Initialize Select2 Elements
                $('.select2').select2();
                $('.select2').css({
                    'padding-top': '0px',
                    'font-size': '12px'
                });
                $('.select2-selection').css('border-radius', '0px');
                $('.select2-container').children().css('border-radius', '0px');

                LoadSpecies();

                bsCustomFileInput.init();
                $('#daerah_id').select2();
            });

            function LoadSpecies() {
                $.ajax({
                    type: "post",
                    url: "/permit/penternakan/postLoadSpesies",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        borang_id: "{{ $borang_id }}",
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#dataTable').DataTable().destroy();
                        $('#dataTable tbody').empty();
                        $.each(response.spesies, function(i, data) {
                            // var actionButton = '<div class="btn-group"><button type="button" class="btn btn-primary btn-xs" data-id="'+data.id+'" data-spesis="'+data.spesis+'" data-bil_kuantiti="'+data.bilangan_kuantiti+'" data-toggle="modal" data-target="#modal-edit-spesies"><i class="fas fa-pen"></i></button>'
                            // +'<button type="button" class="btn btn-danger btn-xs btnDeleteSpesis" data-id="'+data.id+'"><i class="fas fa-trash"></i></button></div>';

                            var actionButton =
                                '<button type="button" class="btn btn-danger btn-xs btnDeleteSpesis" data-id="' +
                                data.id + '"><i class="fas fa-trash"></i></button></div>';

                            if ("$borang->status_borang_id" != 3) {
                                actionButton = '';
                            }

                            $("#dataTable tbody").append('<tr>' +
                                '<td class="sID">' + data.id + '</td>' +
                                '<td>' + data.spesis + '</td>' +
                                '<td>' + data.bilangan_kuantiti + '</td>' +
                                '<td>' + actionButton + '</td>' +
                                '</tr>');
                        });

                        //Initialize datatable
                        $('#dataTable').DataTable({
                            "paging": false,
                            "ordering": false,
                            "info": false,
                            "bFilter": false
                        });
                    }
                });
            }

            //Load Edit data on modal form
            $('#modal-edit-spesies').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#editIDSpesies').val(button.data('id'));
                $('#edit_nama_spesies').val(button.data('spesis')).trigger('change');
                $('#edit_bilangan_spesies').val(button.data('bil_kuantiti'));
            });

            //Delete record from table (bug... not functioning)
            $('#dataTable tbody').on('click', '.btnDeleteSpesis', function(e) {
                e.preventDefault();
                //Delete selected clicked row
                $('#dataTable').DataTable().destroy();
                $(this).closest('tr').remove();
                //Initialize datatable
                $('#dataTable').DataTable({
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "bFilter": false
                });
            });

            $('#btnHantarSemula').click(function(e) {
                e.preventDefault();
                $('#formPermit').parsley().validate();

                //if species table is empty then don't proceed

                if ($('#formPermit').parsley().isValid()) {
                    $('#nama_penuh').prop('disabled', false);
                    $('#no_kp').prop('disabled', false);
                    $.ajax({
                        type: "post",
                        url: "/permit/penternakan/postSubmitPermitSemula",
                        data: new FormData($('#formPermit')[0]),
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function(response) {
                            $('#nama_penuh').prop('disabled', true);
                            $('#no_kp').prop('disabled', true);
                            SaveSpecies(response.borang_id);
                        }
                    });
                }

            });

            function SaveSpecies($borangID) {
                //Convert table to array
                var tableSpesis = new Array();
                $('#dataTable tr').each(function(row, tr) {
                    tableSpesis[row] = {
                        "id": $(tr).find('td:eq(0)').text(),
                        "spesis": $(tr).find('td:eq(1)').text(),
                        "bilangan": $(tr).find('td:eq(2)').text()
                    }
                });
                tableSpesis.shift();

                $.ajax({
                    url: "/permit/penternakan/postSaveSpesis",
                    type: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        spesis: tableSpesis,
                        borang_id: $borangID
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.result == 'success') {
                            window.location.href = '/permit/penternakan';
                        }
                    }
                });
            }

            //Button click event - tambah spesies
            $('#btnTambahSpesiesModal').click(function(e) {
                e.preventDefault();

                $('#tambahSpesiesForm').parsley().validate();

                if ($('#nama_spesies').val() !== '' && $('#bilangan_spesies').val() !== '') {

                    $('#dataTable').DataTable().destroy();

                    $('#dataTable tbody').append('<tr>' +
                        '<td class="cID"></td>' +
                        '<td class="cNamaSpesies">' + $('#nama_spesies').val() + '</td>' +
                        '<td class="cBilanganSpesies">' + $('#bilangan_spesies').val() + '</td>' +
                        '<td>'
                        //+'<button type="button" data-id="" data-spesis="'+$('#nama_spesies').val()+'" data-bil_kuantiti="'+$('#bilangan_spesies').val()+'" class="btn btn-xs btn-warning btnEditRow" data-target="#modal-edit-spesies" data-toggle="modal"><i class="fas fa-pen"></i></button>'
                        +
                        '<button type="button" data-id="" class="btn btn-xs btn-danger btnDeleteRow" data-id=""><i class="fas fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>');
                    $('#modal-tambah-spesies').modal('hide');
                }

                //Recreate DataTable
                $('#dataTable').DataTable({
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "bFilter": false
                });
            });

            //Sahkan Borang
            $('#btnSahkan').click(function(e) {
                e.preventDefault();

                if ($('#laporan_site_inspection')[0].files.length === 0) {
                    alert('Laporan Site Inspection perlu disertakan dan HARUS dibaca terlebih dahulu!');
                    return;
                } else {
                    if (confirm('Adakah anda pasti untuk sahkan borang permit ini?')) {
                        $.ajax({
                            type: "post",
                            url: "/permit/penternakan/postSahkanBorang",
                            data: new FormData($('#formLaporanSite')[0]),
                            contentType: false,
                            processData: false,
                            dataType: "JSON",
                            success: function(response) {
                                if (response.result == 'success') {
                                    window.location.href = '/permit/penternakan';
                                } else {
                                    alert(
                                        'Terdapat masalah untuk mengesahkan borang ini! Tidak dapat dilaksanakan!');
                                }
                            }
                        });
                    }
                }

            });

            //Kembalikan Borang
            $('#btnKembalikan').click(function(e) {
                e.preventDefault();
                if (confirm('Adakah anda pasti untuk kembalikan (return) borang permit ini?')) {
                    var comment = prompt("Sila nyatakan sebab kenapa anda mengembalikan permohonan ini. Klik Cancel untuk membatalkan.","");
                    if(comment != null){
                        $.ajax({
                            type: "post",
                            url: "/permit/penternakan/postKembaliBorang",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                borang_id: "{{ $borang_id }}",
                                return_remark: comment,
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.result == 'success') {
                                    window.location.href = '/permit/penternakan';
                                } else {
                                    alert(
                                        'Terdapat masalah untuk mengembalikan borang ini! Tidak dapat dilaksanakan!');
                                }
                            }
                        });
                    }

                }
            });

            $('#btnApprove').click(function(e) {
                e.preventDefault();
                if (confirm('Adakah anda pasti untuk luluskan borang permit ini?')) {
                    $.ajax({
                        type: "post",
                        url: "/permit/penternakan/postApproveBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: "{{ $borang_id }}",
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/penternakan';
                            } else {
                                alert(
                                    'Terdapat masalah untuk meluluskan borang ini! Tidak dapat dilaksanakan!');
                            }
                        }
                    });
                }
            });

            $('#btnReject').click(function(e) {
                e.preventDefault();
                if (confirm('Adakah anda pasti untuk tolak/reject borang permit ini?')) {
                    $.ajax({
                        type: "post",
                        url: "/permit/penternakan/postRejectBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: "{{ $borang_id }}",
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/penternakan';
                            } else {
                                alert(
                                'Terdapat masalah untuk reject borang ini! Tidak dapat dilaksanakan!');
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
