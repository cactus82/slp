@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Senarai Lesen Pungutan Tumbuhan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Lesen Pungutan Tumbuhan</a></li>
                            <li class="breadcrumb-item active">Senarai Permohonan</li>
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
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="m-0">Borang Lesen</h5>
                                    </div>
                                    @if (Auth::user()->role == 'client')
                                    <div class="col-6">
                                        <a href="/lesen/tumbuhan/baru" class="btn btn-primary float-right"><i
                                                class="fas fa-plus"></i> Permohonan Baru</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tableBorang" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:35px">ID</th>
                                            <th>Tarikh Kemaskini</th>
                                            <th>Nama Pemohon</th>
                                            <th>No KP</th>
                                            <th>Jenis Lesen</th>
                                            {{-- <th>Keputusan Ujian</th> --}}
                                            <th>Kawasan Seliaan</th>
                                            <th style="width: 60px">Resit Am</th>
                                            <th>Status</th>
                                            <th>Lesen</th>
                                            <th style="width: 60px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div id="loading" class="overlay"><i class="fas fa-sync-alt fa-spin"></i></div>
                            <div class="card-footer">
                                ...
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
                                    <label>No Lesen *</label>
                                    <input type="text" class="form-control" id="no_lesen" name="no_lesen"
                                        placeholder="Nombor Lesen (Autoset)" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tempoh Lesen</label>
                                    <select class="form-control" id="tempoh_lesen" name="tempoh_lesen"
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


    <!-- /.loading animation -->
    <div class="loader" style="display:none"></div>

    @push('css')
        <style>
            .loader {
                border: 10px solid #f3f3f3;
                /* Light grey */
                border-top: 10px solid #3498db;
                /* Blue */
                border-radius: 50%;
                width: 60px;
                height: 60px;
                animation: spin 2s linear infinite;
                position: absolute;
                z-index: 2000;
                left: 50%;
                top: 35%;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

        </style>
    @endpush
    @push('script')
        <script>
            $(function() {
                $('#loading').hide();
                initDataTable();
                fillDataTable();
                //$('#tarikh_resit').datepicker({format: 'yyyy-mm-dd',autoclose: true});
                //$('#tarikh_resit').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
                $('.datemask').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                });

                //Initialize Select2 Elements
                $('.select2').select2();
                $('.select2').css({
                    'padding-top': '0px',
                    'font-size': '12px'
                });
                $('.select2-selection').css('border-radius', '0px');
                $('.select2-container').children().css('border-radius', '0px');
            });

            function initDataTable() {
                $('#tableBorang').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            }

            //Populate Datatable
            function fillDataTable() {
                $('#loading').show();
                //Send ajax requests
                $.ajax({
                    url: '/lesen/tumbuhan/loadLesenDatatable',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        addDataTableRow(response);
                        initDataTable();
                        $('#loading').hide();
                    }
                });
            };

            function addDataTableRow(response) {
                //Destroy datatable and empty records
                $('#tableBorang').DataTable().destroy();
                $("#tableBorang tbody").empty();

                var user_role = "{{ Auth::user()->role }}";

                //Append data on body
                $.each(response.result, function(i, data) {
                    var viewButton = '<a href="/lesen/tumbuhan/view/' + data.id +
                        '" type="button" class="btn btn-warning btn-xs btn-flat"><i class="fas fa-eye"></i></a>';
                    var deleteButton =
                        '<button type="button" class="btn btn-danger btn-xs btn-flat btnDeleteLesen" data-id="' + data
                        .id + '"><i class="fas fa-trash"></i></button>';

                    var resitAmUpdate = '<button type="button" class="btn btn-block btn-default btn-sm" data-id="' +
                        data.id + '" data-resit_id="' + data.resit_am_id + '"  data-no_resit="' + data.no_resit +
                        '" data-tarikh_resit="' + data.tarikh_resit + '" data-pejabat_pembayaran_id="' + data
                        .pejabat_pembayaran_id + '" data-jumlah_rm="' + data.jumlah_rm + '" data-no_lesen="' + data
                        .no_lesen + '" data-pejabat_pembayaran_id="' + data.pejabat_pembayaran_id +
                        '" data-tempoh_lesen="'+data.tempoh_permit_lesen+'" data-target="#modal-update-resitam" data-toggle="modal"><i class="fas fa-pen"></i></button>';
                    if (data.no_resit) { //show no resit button
                        resitAmUpdate = '<button type="button" class="btn btn-block btn-default btn-sm" data-id="' +
                            data.id + '" data-resit_id="' + data.resit_am_id + '" data-no_resit="' + data.no_resit +
                            '" data-tarikh_resit="' + data.tarikh_resit + '" data-pejabat_pembayaran_id="' + data
                            .pejabat_pembayaran_id + '" data-tempoh_lesen="'+data.tempoh_permit_lesen+'" data-jumlah_rm="' + data.jumlah_rm + '" data-no_lesen="' + data
                            .no_lesen + '" data-pejabat_pembayaran_id="' + data.pejabat_pembayaran_id + '" data-target="#modal-update-resitam" data-toggle="modal">' + data
                            .no_resit +
                            '</button>';
                    }

                    if (user_role == 'client') {
                        if (data.status_borang_id != 7) {
                            deleteButton = ""; //disable for client. only enable if draft
                        }

                        resitAmUpdate = ((data.no_resit) ? data.no_resit : "");

                        var borangID = ["1", "2", "4", "5", "6",
                            "8"
                        ]; //disable semua kecuali draft (id=7) & dikembalikan (id=3)
                        if (borangID.indexOf(data.status_borang_id) !== -1) {
                            viewButton = "";
                        }
                    } else if (user_role == 'normal') {
                        deleteButton = ""; //disable for normal user
                    }

                    var keputusanUjian = "";
                    if (data.keputusan_ujian_id) {
                        switch (data.keputusan_ujian_id.toString()) {
                            case "1":
                                keputusanUjian = '<td><span class="label label-success">Lulus</span></td>';
                                break;
                            case "2":
                                keputusanUjian = '<td><span class="label label-danger">Gagal</span></td>';
                                break;
                            case "3":
                                keputusanUjian = '<td><span class="label label-default">Belum diketahui</span></td>';
                                break;
                            default:
                                keputusanUjian = '<td></td>';
                                break;
                        }
                    } else {
                        keputusanUjian = '<td></td>';
                    }

                    //Label class for borang status
                    var labelClass = "secondary";
                    switch (data.status_borang_id) {
                        case 2:
                            labelClass = "info";
                            break;
                        case 3:
                            labelClass = "warning";
                            break;
                        case 4:
                            labelClass = "primary";
                            break;
                        case 5:
                            labelClass = "success";
                            break;
                        case 6:
                            labelClass = "danger";
                            break;
                        default:
                            break;
                    }

                    //Permit PDF link
                    generatePDF = '';
                    if (data.status_borang_id == 5 && data.resit_am_id) {
                        generatePDF =
                            '<a type="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Generate Permit" class="btn btn-default btn-sm" href="/lesen/tumbuhan/pdf/' +
                            data.id + '&' + data.resit_am_id + '"><i class="fa fa-paperclip"></i></a>';
                    } else {
                        if (data.status_borang_id != 5 && !data.resit_am_id) permitFile = '';
                    }

                    var renewLesen = '';
                    if (data.status_borang_id == 5) {
                        renewLesen =
                            '<button type="button" data-toggle="tooltip" data-placement="top" title="Renew Permit" class="btn btn-primary btn-xs btnrenewLesen" data-id="' +
                            data.id + '"><i class="fas fa-sync-alt"></i></button>';
                    }

                    var btnGroupLesen = '<div class="btn-group">' +
                        generatePDF + '</div>';

                    var btnGroup = '<div class="btn-group">' +
                        viewButton +
                        renewLesen +
                        deleteButton + '</div>';

                    //Append row to body
                    $("#tableBorang tbody").append('<tr>' +
                        '<td>' + data.id + '</td>' +
                        '<td>' + ((data.updated_at) ? data.updated_at : "") + '</td>' +
                        '<td>' + data.nama_pemohon + '</td>' +
                        '<td>' + data.no_kp + '</td>' +
                        '<td>' + data.jenis_lesen + '</td>'
                        //+keputusanUjian
                        +
                        '<td>' + ((data.daerah_memungut) ? data.daerah_memungut : "") + '</td>' +
                        '<td>' + ((data.status_borang_id == 5) ? resitAmUpdate  : '') + '</td>' +
                        '<td>' + ((data.status_borang) ? '<span class="badge badge-' + labelClass +
                            '">' + data.status_borang + '</span>' : "") + '</td>' +
                        '<td style="text-align: center">' + btnGroupLesen + '</td>' +
                        '<td>' + btnGroup + '</td>' +
                        '</tr>');
                });
            }

            $('#tableBorang').on("click", ".btnDeleteLesen", function() {
                if (confirm('Adakah anda pasti untuk hapuskan borang ini? Klik OK untuk hapuskan sekarang')) {
                    var row_id = $(this).closest('.btnDeleteLesen').attr('data-id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Send ajax requests
                    $.ajax({
                        url: '/lesen/tumbuhan/postDeleteLesen',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: row_id,
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            addDataTableRow(response);
                        }
                    });
                }
            });

            $('#modal-update-resitam').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#resitAmForm').trigger('reset');
                $('#resitAmForm').parsley().reset();
                $('#borang_id_resitam').val(button.data('id'));
                $('#resit_am_id').val(button.data('resit_id'));
                $('#no_resit').val(button.data('no_resit'));

                $('#no_lesen').prop('disabled', false);
                $('#no_lesen').val(button.data('no_lesen'));
                $('#no_lesen').prop('disabled', true);

                var tResit = '';
                if (button.data('tarikh_resit')) {
                    tResit = formatDateToDefault(button.data('tarikh_resit'));
                }
                $('#tarikh_resit').val(tResit);

                $('#jumlah_rm').val(button.data('jumlah_rm'));
                $('#pejabat_pembayaran_id').val(button.data('pejabat_pembayaran_id')).select2().trigger('change');
                $('#tempoh_lesen').val(button.data('tempoh_lesen')).select2().trigger('change');
            });


            $('#btnSaveResitAm').click(function(e) {
                e.preventDefault();

                $('#resitAmForm').parsley().validate();

                if ($('#resitAmForm').parsley().isValid()) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Send ajax requests
                    $.ajax({
                        url: '/lesen/tumbuhan/view/postUpdateResitAm',
                        type: 'POST',
                        data: $('#resitAmForm').serialize(),
                        dataType: 'JSON',
                        success: function(response) {
                            addDataTableRow(response);
                            $('#modal-update-resitam').modal('hide');
                        }
                    });
                }
            });

            $('#tableBorang').on("click", ".btnrenewLesen", function() {
                if (confirm('Adakah anda pasti untuk memperbaharui permohonan ini?')) {
                    var row_id = $(this).closest('.btnrenewLesen').attr('data-id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Send ajax requests
                    $.ajax({
                        url: '/lesen/tumbuhan/postRenewPermit',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            permit_id: row_id,
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            addDataTableRow(response);
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
