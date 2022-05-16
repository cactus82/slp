@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permit Peniaga Haiwan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/permit/peniaga">Peniaga</a></li>
                            <li class="breadcrumb-item active">View Borang</li>
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
                                        <h5 class="m-0">BORANG 11 (Peraturan 35(1))</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/permit/peniaga" class="btn btn-warning float-right">Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <form id="formPermit" method="post" enctype="multipart/form-data">
                                @csrf
                                <input id="borangId" name="borangId" value="{{ $borang->id ?? '' }}" type="hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>1. Nama Penuh</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="" value="{{ $borang->nama ?? ''}}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Alamat Kediaman</label>
                                                <input type="text" class="form-control" name="alamat"
                                                    placeholder="Alamat kediaman pemohon" value="{{ $borang->alamat ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>2. No Kad Pengenalan</label>
                                                <input type="text" class="form-control" id="no_kp" name="no_kp"
                                                    placeholder="" value="{{ $borang->no_kp ?? '' }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>3. No Telefon</label>
                                                <input type="text" class="form-control" name="no_tel"
                                                    placeholder="Contoh: 014-3332020" value="{{ $borang->no_tel_hp ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>4. Alamat Premis Perniagaan</label>
                                                <input type="text" class="form-control" name="alamat_premis"
                                                    placeholder="Alamat premis berkenaan dengan mana permit diminta"
                                                    value="{{ $borang->alamat_premis ?? '' }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>5. Bilangan Pekerja</label>
                                                <input type="text" class="form-control" name="jumlah_pekerja"
                                                    placeholder="Nombor sahaja. Contoh 5" value="{{ $borang->jumlah_pekerja ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>6. Jenis Perniagaan</label>
                                                <select id="jenis_perniagaan_id" name="jenis_perniagaan_id" style="width: 100%" required>
                                                    @foreach ($jenis_perniagaan as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($selected_jenis_perniagaan->id == $item->id)
                                                                selected
                                                            @endif
                                                            >{{ $item->jenis }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>7. Jenis haiwan & hasil haiwan yang didagangkan</label>
                                                <input type="text" class="form-control" name="jenis_haiwan"
                                                    placeholder="Contoh: Kulit Binatang, dsb."
                                                    value="{{ $borang->jenis_haiwan_hasil ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>8. Butir-butir lesen atau permit lain</label>
                                                <input type="text" class="form-control"
                                                    name="butir_lesen_permit_terdahulu"
                                                    placeholder="Permit yang dipegang dan permit-permit peniaga yang terdahulu"
                                                    value="{{ $borang->butir_lesen_permit_terdahulu ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $tarikhSerahSimpan = '';
                                        if ($borang->tarikh_akhir_serah_simpan) {
                                            $tarikhSerahSimpan = date_format(date_create($borang->tarikh_akhir_serah_simpan), 'd/m/Y');
                                        }
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>9. Tarikh akhir serahsimpan penyata menurut Peraturan-Peraturan
                                                    Hidupan Liar 1998</label>
                                                <div class="input-group date" id="tarikh_akhir_serah_simpan_div"
                                                    data-target-input="nearest">
                                                    <input type="text" name="tarikh_akhir_serah_simpan"
                                                        placeholder="dd/mm/yyyy" class="form-control datetimepicker-input"
                                                        data-target="#tarikh_akhir_serah_simpan_div"
                                                        value="{{ $tarikhSerahSimpan ?? '' }}">
                                                    <div class="input-group-append"
                                                        data-target="#tarikh_akhir_serah_simpan_div"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>10. Salinan penyata terakhir saya disertakan bersama borang
                                                    ini</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="salinan_penyata"
                                                        name="salinan_penyata[]" multiple>
                                                    <label class="custom-file-label" for="salinan_penyata">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="petaFailAttachment">
                                            <div class="card-footer bg-white">
                                                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                    @foreach ($fail_permit_perniagaan as $item)
                                                        <li>
                                                            {{-- <span class="mailbox-attachment-icon"><i class="fas fa-file-text-o"></i></span> --}}
                                                            <div class="mailbox-attachment-info">
                                                                <a href="/permit/peniaga/download/haiwan/{{ basename($item->file_name) }}"
                                                                    class="mailbox-attachment-name"><i
                                                                        class="fas fa-paperclip"></i>
                                                                    {{ basename($item->original_name) }}</a>
                                                                <span class="mailbox-attachment-size">
                                                                    {{ $item->file_size }}KB
                                                                    @if (in_array($data->status_borang_id,array(3,7,8)))
                                                                    <a href="/permit/peniaga/deletefile/haiwan/{{ $item->id }}"
                                                                        onclick="return confirm('Adakah anda pasti untuk delete fail ini?')"
                                                                        class="btn btn-default btn-xs pull-right"><i
                                                                            class="fas fa-times"></i></a>
                                                                    @endif
                                                                    <a href="/permit/peniaga/download/haiwan/{{ basename($item->file_name) }}"
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
                                    @if (Auth::user()->role == 'client')
                                        @if (in_array($borang->status_borang_id,[1,3]))
                                            <button type="button" id="btnSubmit" class="btn btn-primary">Update</button>
                                        @endif
                                    @else
                                        @if ($borang->status_borang_id == 2)
                                            <button id="btnSahkan" class="btn btn-info">Sahkan Borang</button>
                                            <button type="button" class="btn btn-warning" id="btnReturn">Kembalikan Borang</button>
                                        @endif
                                        @if ($borang->status_borang_id == 4 || $borang->status_borang_id == 8)
                                            <button type="button" id="btnApprove" class="btn btn-success">Luluskan Borang</button>
                                            <button type="button" id="btnReject" class="btn btn-danger">Reject Borang</button>
                                        @endif
                                        @if ($borang->status_borang_id == 5)
                                            <button type="button" id="btnReject" class="btn btn-danger">Reject Borang</button>
                                        @endif
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <strong>Status Borang: </strong><code>{{ $borang->status_borang }}</code>
                                    &nbsp;<strong>Tarikh Permohonan: </strong><code>{{ date_format(date_create($borang->created_at), 'd/m/Y') ?? '' }}</code>
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
    @push('script')
    <script>
        $(function() {
            //Datepicker
            $('.date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            bsCustomFileInput.init();
            $('#jenis_perniagaan_id').select2();
        });

        $('#btnSubmit').click(function(e) {
            e.preventDefault();
            $('#formPermit').parsley().validate();

            if ($('#formPermit').parsley().isValid()) {
                $('#nama').prop('disabled', false);
                $('#no_kp').prop('disabled', false);
                $.ajax({
                    type: "post",
                    url: "/permit/peniaga/postUpdatePeniagaHaiwan",
                    data: new FormData($('#formPermit')[0]),
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(response) {
                        $('#nama').prop('disabled', true);
                        $('#no_kp').prop('disabled', true);
                        window.location.href = "/permit/peniaga";
                    }
                });
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
                    url: "/permit/perniagaan/postReturn",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        borang_id: $('#borangId').val(),
                        return_remark: comment,
                        borangType: "haiwan",
                    },
                    dataType: "JSON",
                    success: function (response) {
                        window.location.href = "/permit/peniaga";
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
                url: "/permit/perniagaan/postSahkanBorang",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    borang_id: "{{ $borang->id }}",
                    borangType: "haiwan",
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.result == 'success') {
                        window.location.href = '/permit/peniaga';
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
                url: "/permit/perniagaan/postApproveBorang",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    borang_id: "{{ $borang->id }}",
                    borangType: "haiwan",
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.result == 'success') {
                        window.location.href = '/permit/peniaga';
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
                url: "/permit/perniagaan/postRejectBorang",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    borang_id: "{{ $borang->id }}",
                    borangType: "haiwan",
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.result == 'success') {
                        window.location.href = '/permit/peniaga';
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
