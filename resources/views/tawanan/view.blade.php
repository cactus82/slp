@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permit Haiwan Tawanan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/permit/haiwantawanan">Haiwan Tawanan</a></li>
                            <li class="breadcrumb-item active">View</li>
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
                    @if ($data->sebab_dikembalikan)
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Borang Dikembalikan!</h5>
                                <strong>Sebab dikembalikan:</strong> {{ $data->sebab_dikembalikan ?? '' }}
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="m-0">BORANG 9 (Peraturan 31(1))</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/permit/haiwantawanan" class="btn btn-warning float-right">Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <form id="formPermit" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="borangId" name="borangId" value="{{ $data->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12"><p></p></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label">1. Permohonan adalah dengan ini dibuat bagi permit haiwan tawanan</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-2 col-form-label">2. Nama Penuh: </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $data->nama ?? '' }}" disabled required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_tel" class="col-sm-2 col-form-label">3. Nombor Telefon: </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_tel"
                                        value="{{ $data->no_tel_hp ?? '' }}" placeholder="(Diperlukan)" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">4. Alamat Kediaman: </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="alamat"
                                        value="{{ $data->alamat ?? '' }}" placeholder="(Diperlukan)" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>5. Butir-butir permit haiwan tawanan lain yang dipegang (jika ada)</label>
                                                <input type="text" class="form-control" value="{{ $data->butir_permit_tawanan_lain ?? '' }}"
                                                name="butir_permit_lain">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>6.  Senaraikan di bawah spesis dan bilangan haiwan yang diminta (permit berasingan
                                                    dikehendaki bagi tiap-tiap haiwan):</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if (in_array($data->status_borang_id,array(3,7,8)))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" data-target="#modal-add-item-new" data-toggle="modal" class="btn btn-info btn-sm float-right" id="btnAddSpesis"><i class="fa fa-plus"></i>&nbsp; <strong>Add Item</strong></button>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="tableSpesis" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                <th>ID</th>
                                                <th>Spesis</th>
                                                <th>Bilangan</th>
                                                <th style="width: 100px">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($senarai_spesis as $item)
                                                        <tr>
                                                            <td class="senaraiID">{{ $item->id ?? '' }}</td>
                                                            <td>{{ $item->spesis ?? '' }}</td>
                                                            <td>{{ $item->bilangan ?? '' }}</td>
                                                            <td>
                                                                @if ($data->status_borang_id == 3)
                                                                    <a href="#" class="btnDeleteSenaraiSpesis"><i class="fa fa-trash text-danger"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>7. Berikan butir-butir ringkas tentang pengaturan yang akan dibuat bagi penyimpanan selamat haiwan-haiwan</label>
                                                <p></p>
                                                <input type="text" class="form-control" name="butir_pengaturan_penyimpanan"
                                                    placeholder="(Diperlukan)" value="{{ $data->butir_ringkas_pengaturan ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>(Pelan dan lakaran lengkap akan dikehendaki untuk diserahsimpan dengan Pengarah. Pelan
                                                dan lakaran ini akan dikehendaki mematuhi spesifikasi standard bagi penempatan spesies haiwan yang
                                                mana permohonan dibuat. Tiada permit boleh dikeluarkan sehingga penempatan telah
                                                diperiksa dan diluluskan bagi pihak pengarah. Permit sementara boleh dikeluarkan atas
                                                permohonan).</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>8. Berikan butir-butir ringkas tentang diet yang dicadangkan untuk diberikan kepada
                                                    haiwan:</label>
                                                <input type="text" class="form-control" name="butir_diet"
                                                    placeholder="(Diperlukan)" value="{{ $data->butir_ringkas_diet ?? '' }}" required>
                                                <p>(Pelan diet akan diberikan kepada pemohon, jika berjaya, dan kemungkinan bahawa syarat
                                                        lesen akan menghendaki bahawa pelan dipatuhi). </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>9. Sila lampirkan bersama Salinan Sijil Kesihatan daripada Jabatan Haiwan</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="salinan_sijil_kesihatan"
                                                        name="salinan_sijil_kesihatan[]" multiple>
                                                    <label class="custom-file-label" for="salinan_sijil_kesihatan">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="salinanSijil">
                                            <div class="card-footer bg-white">
                                                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                    @foreach ($salinan_sijil_kesihatan as $item)
                                                        <li>
                                                            {{-- <span class="mailbox-attachment-icon"><i class="fas fa-file-text-o"></i></span> --}}
                                                            <div class="mailbox-attachment-info">
                                                                <a href="/permit/haiwantawanan/download/{{ basename($item->file_name) }}"
                                                                    class="mailbox-attachment-name"><i
                                                                        class="fas fa-paperclip"></i>
                                                                    {{ basename($item->original_name) }}</a>
                                                                <span class="mailbox-attachment-size">
                                                                    {{ $item->file_size }}KB
                                                                    @if (in_array($data->status_borang_id,array(3,7,8)))
                                                                    <a href="/permit/haiwantawanan/deletefile/{{ $item->id }}"
                                                                        onclick="return confirm('Adakah anda pasti untuk delete fail ini?')"
                                                                        class="btn btn-default btn-xs pull-right"><i
                                                                            class="fas fa-times"></i></a>
                                                                    @endif
                                                                    <a href="/permit/haiwantawanan/download/{{ basename($item->file_name) }}"
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
                                </div>
                                <div class="card-footer">
                                    @if (in_array($data->status_borang_id,[1,3]) && Auth::user()->role == 'client')
                                        <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
                                    @endif
                                    @if (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'normal')
                                        @if ($data->status_borang_id == 2)
                                            <button type="button" id="btnSahkan" class="btn btn-info">Sahkan Borang</button>
                                            <button type="button" class="btn btn-warning" id="btnReturn">Return</button>
                                        @endif
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super admin')
                                            @if ($data->status_borang_id == 4 || $data->status_borang_id == 8)
                                                <button type="button" id="btnApprove" class="btn btn-success">Luluskan Borang</button>
                                                <button type="button" id="btnReject" class="btn btn-danger">Reject Borang</button>
                                            @endif
                                            @if ($data->status_borang_id == 5)
                                                <button type="button" id="btnReject" class="btn btn-danger">Reject Borang</button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <strong>Status Borang: </strong><code>{{ $status_borang->status }}</code>
                                    @if ($data->status_borang_id == 3)
                                        &nbsp;<strong>Dikembalikan Oleh:
                                        </strong><code>{{ $data->dikembalikan_oleh_nama }}</code>
                                        &nbsp;<strong>Tarikh Dikembalikan:
                                        </strong><code>{{ $data->tarikh_dikembalikan }}</code>
                                    @elseif($data->status_borang_id == 4)
                                        &nbsp;<strong>Disahkan Oleh:
                                        </strong><code>{{ $data->disahkan_oleh_nama }}</code>
                                        &nbsp;<strong>Tarikh Disahkan: </strong><code>{{ $data->tarikh_disahkan }}</code>
                                    @elseif($data->status_borang_id == 5)
                                        &nbsp;<strong>Diluluskan Oleh:
                                        </strong><code>{{ $data->diluluskan_oleh_nama }}</code>
                                        &nbsp;<strong>Tarikh Diluluskan:
                                        </strong><code>{{ $data->tarikh_diluluskan }}</code>
                                    @elseif($data->status_borang_id == 6)
                                        {{-- &nbsp;<strong>Ditolak Oleh: </strong><code>{{$borang->ditolak_oleh_nama}}</code> --}}
                                        &nbsp;<strong>Tarikh Ditolak: </strong><code>{{ $data->tarikh_ditolak }}</code>
                                    @endif
                                    <input type="hidden" name="cur_status_borang_id"
                                        value="{{ $data->status_borang_id }}">
                                </div>
                            </form>
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
    @include('tawanan.add_item_new')
    @push('script')
    <script>
        $(function() {
            //Datepicker
            $('.date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            bsCustomFileInput.init();
            $('#spesis_new_id').select2();
            initDataTable();
        });

        function initDataTable(){
            $('#tableSpesis').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
        });
    }

        $('#btnAddSpesis').click(function (e) {
            e.preventDefault();
            $('#formNewSpesis').parsley().reset();
            $('#formNewSpesis').trigger('reset');
            $('#spesis_new_id').val(null).trigger('change');
        });

        $('#btnTambahSpesiesModal').click(function (e) {
            e.preventDefault();
            $('#formNewSpesis').parsley().validate();
        });

        $('#btnTambahSpesiesModal').click(function (e) {
            e.preventDefault();
            if(!$('#spesis_new_id').val() || !$('#bilangan_new').val()){
                alert("Spesis dan bilangan diperlukan!");
                return;
            }
            $('#tableSpesis').DataTable().row.add([
                '',
                $('#spesis_new_id').val(),
                $('#bilangan_new').val(),
                '<a href="#" class="btnDeleteSenaraiSpesis"><i class="fa fa-trash text-danger"></i></a>'
            ]).draw(false);
            $('#modal-add-item-new').modal('hide');
        });

        $('#tableSpesis').on('click', '.btnDeleteSenaraiSpesis', function () {
            if(confirm("Adakah anda pasti untuk hapuskan rekod ini? Klik OK untuk hapuskan")){
                $('#tableSpesis').DataTable().destroy();
                $(this).closest('tr').remove();
                initDataTable();
            }
        });

        $('#btnUpdate').click(function(e) {
            e.preventDefault();
            $('#formPermit').parsley().validate();

            if ($('#formPermit').parsley().isValid()) {

                //Check if senarai barang provided at least 1
                if($('#tableSpesis').DataTable().rows().count()==0){
                    alert('Sila tambah senarai spesis haiwan tawanan terlebih dahulu!');
                    return;
                }

                if(confirm("Adakah anda pasti untuk menghantar borang ini?")){
                    $('#nama').prop('disabled', false);

                    //Convert senarai barang to array
                    var senaraiSpesis = new Array();
                    $('#tableSpesis tr').each(function(row, tr){
                        senaraiSpesis[row]={
                            "spesisId" : $(tr).find('td:eq(0)').text(),
                            "spesis" : $(tr).find('td:eq(1)').text(),
                            "bilangan" : $(tr).find('td:eq(2)').text(),
                        }
                    });
                    senaraiSpesis.shift();

                    var formData = new FormData($('#formPermit')[0]);
                    formData.append('senaraiSpesis',JSON.stringify(senaraiSpesis));
                    $.ajax({
                        type: "post",
                        url: "/permit/haiwantawanan/postUpdate",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function(response) {
                            $('#nama').prop('disabled', true);
                            window.location.href = "/permit/haiwantawanan";
                        }
                    });
                }
            }
        });

        //Return to user
        $('#btnReturn').click(function (e) {
            e.preventDefault();
            if(confirm("Adakah anda pasti untuk mengembalikan borang permohonan ini kepada pemohon? Klik OK untuk setuju")){
                var comment = prompt("Sila nyatakan sebab kenapa anda mengembalikan permohonan ini. Klik Cancel untuk membatalkan.","");
                if(comment != null){
                    $.ajax({
                        type: "POST",
                        url: "/permit/haiwantawanan/postReturn",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                            return_remark: comment,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            window.location.href = "/permit/haiwantawanan";
                        }
                    });
                }
            }
        });

         //Sahkan Borang
         $('#btnSahkan').click(function(e) {
                e.preventDefault();

                if (confirm('Adakah anda pasti untuk sahkan borang permit ini?')) {
                    $.ajax({
                        type: "post",
                        url: "/permit/haiwantawanan/postSahkanBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/haiwantawanan';
                            } else {
                                alert(
                                    'Terdapat masalah untuk mengesahkan borang ini! Tidak dapat dilaksanakan!');
                            }
                        }
                    });
                }

            });

            $('#btnApprove').click(function(e) {
                e.preventDefault();
                if (confirm('Adakah anda pasti untuk luluskan borang permit ini?')) {
                    $.ajax({
                        type: "post",
                        url: "/permit/haiwantawanan/postApproveBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/haiwantawanan';
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
                        url: "/permit/haiwantawanan/postRejectBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/haiwantawanan';
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
