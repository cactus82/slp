@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permit Peniaga</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/permit/peniaga">Peniaga</a></li>
                            <li class="breadcrumb-item active">Senarai Permit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Permit Perniagaan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="select2" id="selectType" style="width: 250px">
                                            <option value="Permit Peniaga Haiwan" selected>Permit Peniaga Haiwan</option>
                                            <option value="Permit Peniaga Daging">Permit Peniaga Daging</option>
                                            <option value="Permit Peniaga Tumbuhan">Permit Peniaga Tumbuhan</option>
                                        </select>
                                    </div>
                                    @if (Auth::user()->role == 'client')
                                        <div class="col-md-6">
                                            <button id="btnBaru" class="btn btn-primary float-right"><i
                                                    class="fa fa-plus"></i> Permohonan Baru</button>
                                        </div>
                                    @endif
                                </div>
                                <table id="tablePermit" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>T_Kemaskini</th>
                                            <th>Nama_Pemohon</th>
                                            <th>No_KP</th>
                                            <th>Resit_Am</th>
                                            <th>Status</th>
                                            <th>Fail_Permit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div id="loading" class="overlay"><i class="fas fa-sync-alt fa-spin"></i></div>
                            <div class="card-footer">
                                ...
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    @include('peniaga.resit_am_modal');
@include('peniaga.permit_file_modal');

    @push('script')
        <script>
            var selectedPermit = "";
            $(function() {
                $('#loading').hide();
                initDataTable();
                fillDataTable();
                // $('#selectType').select2();
                selectedPermit = "Permit Peniaga Haiwan";
                $('.datemask').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                });
                $('.select2').select2();
            });

            function initDataTable() {
                $('#tablePermit').DataTable({
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //Send ajax requests
                $.ajax({
                    url: '/permit/perniagaan/loadBorangPeniaga',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        type: $('#selectType').val(),
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
                $('#tablePermit').DataTable().destroy();
                $("#tablePermit tbody").empty();

                var user_role = "{{ Auth::user()->role }}";

                // if(response.result.length == 0){
                //     alert('No record!');
                // }
                var permitType = "";
                switch ($('#selectType').val()) {
                    case 'Permit Peniaga Haiwan':
                        permitType = "haiwan";
                        break;
                    case 'Permit Peniaga Daging':
                        permitType = "daging";
                        break;
                    case 'Permit Peniaga Tumbuhan':
                        permitType = "tumbuhan";
                        break;
                    default:
                        break;
                }

                $.each(response.result, function(i, data) {
                    var viewButton = '<a href="/permit/peniaga/view/' + permitType + "/" + data.id +
                        '" type="button" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>';
                    var deleteButton = '<button type="button" class="btn btn-danger btn-xs btnDeletePermit" data-id="' +
                        data.id + '"><i class="fas fa-trash"></i></button>';

                    var resitAmUpdate = '<button type="button" class="btn btn-block btn-default btn-sm" data-id="' +
                        data.id + '" data-resit_id="' + data.resit_am_id + '"  data-no_resit="' + data.no_resit +
                        '" data-tarikh_resit="' + data.tarikh_resit + '" data-jumlah_rm="' + data.jumlah_rm +
                        '" data-no_permit="' + data.no_lesen + '" data-pejabat_pembayaran_id="' + data.pejabat_pembayaran_id +
                        '" data-tempoh_permit="'+data.tempoh_permit_lesen+'" data-target="#modal-update-resitam" data-toggle="modal"><i class="fas fa-pen"></i></button>';
                    if (data.no_resit) { //show no resit button
                        resitAmUpdate = '<button type="button" class="btn btn-block btn-default btn-sm" data-id="' +
                            data.id + '" data-resit_id="' + data.resit_am_id + '" data-no_resit="' + data.no_resit +
                            '" data-tarikh_resit="' + data.tarikh_resit + '" data-jumlah_rm="' + data.jumlah_rm +
                            '" data-no_permit="' + data.no_lesen + '" data-pejabat_pembayaran_id="' + data.pejabat_pembayaran_id +
                            '" data-tempoh_permit="'+data.tempoh_permit_lesen+'" data-target="#modal-update-resitam" data-toggle="modal">' + data.no_resit + '</button>';
                    }

                    if (user_role == 'client') {
                        if (data.status_borang_id != 7) {
                            deleteButton = ""; //disable for client. only enable if draft
                        }

                        if (data.no_resit) {
                            resitAmUpdate = data.no_resit;
                        } else {
                            resitAmUpdate = "";
                        }

                        var borangID = ["1", "2", "4", "5", "6", "8"]; //disable semua kecuali draft (id=7) & dikembalikan (id=3)
                        if (borangID.indexOf(data.status_borang_id) !== -1) {
                            viewButton = "";
                        }
                    } else if (user_role == 'normal') {
                        deleteButton = ""; //disable for normal user
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

                    var renewPermit = '';
                    if (data.status_borang_id == 5) {
                        renewPermit =
                            '<button type="button" data-toggle="tooltip" data-placement="top" title="Renew Permit" class="btn btn-primary btn-xs btnRenewPermit" data-id="' +
                            data.id + '"><i class="fas fa-sync-alt"></i></button>';
                    }

                    //Permit PDF link
                    generatePDF = '';
                    if (data.status_borang_id == 5 && data.resit_am_id) {
                        generatePDF =
                            '<a type="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Generate Permit" class="btn btn-default btn-sm" ' +
                            'href="/permit/pdf/' + permitType + '/' + data.id + '&' + data.resit_am_id + '"><i class="fa fa-paperclip"></i></a>';
                    } else {
                        if (data.status_borang_id != 5 && !data.resit_am_id) permitFile = '';
                    }

                    var btnGroupPermit = '<div class="btn-group">' +
                        generatePDF + '</div>';

                    var btnGroup = '<div class="btn-group">' +
                        viewButton +
                        renewPermit +
                        deleteButton + '</div>';

                    $("#tablePermit tbody").append('<tr>' +
                        '<td>' + data.id + '</td>' +
                        '<td>' + ((data.updated_at) ? data.updated_at : "") + '</td>' +
                        '<td>' + data.nama + '</td>' +
                        '<td>' + data.no_kp + '</td>' +
                        '<td>' + ((data.status_borang_id == 5) ? resitAmUpdate  : '') + '</td>' +
                        '<td>' + ((data.status_borang) ? '<span class="badge badge-' + labelClass +
                            '">' + data.status_borang + '</span>' : "") + '</td>' +
                        '<td style="text-align: center">' + btnGroupPermit + '</td>' +
                        '<td>' + btnGroup + '</td>' +
                        '</tr>');
                });
            }

            $('#btnBaru').click(function(e) {
                e.preventDefault();
                var link = "/permit/peniaga/baru/";
                var type;
                switch (selectedPermit) {
                    case "Permit Peniaga Haiwan":
                        type = "haiwan";
                        break;
                    case "Permit Peniaga Daging":
                        type = "daging";
                        break;
                    case "Permit Peniaga Tumbuhan":
                        type = "tumbuhan";
                        break;
                    default:
                        break;
                }
                link = link + type;
                window.location.href = link;
            });

            $('#selectType').change(function(e) {
                e.preventDefault();
                selectedPermit = $('#selectType').val();
            });

            $('#tablePermit').on("click", ".btnDeletePermit", function() {
                if (confirm('Adakah anda pasti untuk hapuskan borang ini? Klik OK untuk hapuskan sekarang')) {
                    var row_id = $(this).closest('.btnDeletePermit').attr('data-id');

                    var borangType;
                    switch (selectedPermit) {
                        case "Permit Peniaga Haiwan":
                            borangType = "haiwan";
                            break;
                        case "Permit Peniaga Daging":
                            borangType = "daging";
                            break;
                        case "Permit Peniaga Tumbuhan":
                            borangType = "tumbuhan";
                            break;
                        default:
                            break;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Send ajax requests
                    $.ajax({
                        url: '/permit/perniagaan/postDeleteBorang',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: row_id,
                            type: borangType,
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            addDataTableRow(response);
                            initDataTable();
                            $('#loading').hide();
                        }
                    });
                }
            });

            $('#selectType').change(function (e) {
                e.preventDefault();
                fillDataTable();
            });

            $('#modal-update-resitam').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#resitAmForm').trigger('reset');
                $('#resitAmForm').parsley().reset();
                $('#borang_id_resitam').val(button.data('id'));
                $('#resit_am_id').val(button.data('resit_id'));
                $('#no_resit').val(button.data('no_resit'));

                $('#no_permit').prop('disabled', false);
                $('#no_permit').val(button.data('no_permit'));
                $('#no_permit').prop('disabled', true);

                var tResit = '';
                if (button.data('tarikh_resit')) {
                    tResit = formatDateToDefault(button.data('tarikh_resit'));
                }
                $('#tarikh_resit').val(tResit);

                $('#jumlah_rm').val(button.data('jumlah_rm'));
                $('#pejabat_pembayaran_id').val(button.data('pejabat_pembayaran_id')).select2().trigger('change');
                $('#tempoh_permit').val(button.data('tempoh_permit')).select2().trigger('change');
            });

            $('#btnSaveResitAm').click(function(e) {
                e.preventDefault();

                $('#resitAmForm').parsley().validate();

                if ($('#resitAmForm').parsley().isValid()) {

                    var borangType;
                    switch (selectedPermit) {
                        case "Permit Peniaga Haiwan":
                            borangType = "haiwan";
                            break;
                        case "Permit Peniaga Daging":
                            borangType = "daging";
                            break;
                        case "Permit Peniaga Tumbuhan":
                            borangType = "tumbuhan";
                            break;
                        default:
                            break;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Send ajax requests
                    $.ajax({
                        url: '/permit/perniagaan/postUpdateResitAm',
                        type: 'POST',
                        data: $('#resitAmForm').serialize() + "&borangType=" + borangType,
                        dataType: 'JSON',
                        success: function(response) {
                            addDataTableRow(response);
                            $('#modal-update-resitam').modal('hide');
                        }
                    });
                }
            });

            $('#tablePermit').on("click", ".btnRenewPermit", function() {
                if (confirm('Adakah anda pasti untuk renew permohonan ini?')) {
                    var row_id = $(this).closest('.btnRenewPermit').attr('data-id');

                    var borangType;
                    switch (selectedPermit) {
                        case "Permit Peniaga Haiwan":
                            borangType = "haiwan";
                            break;
                        case "Permit Peniaga Daging":
                            borangType = "daging";
                            break;
                        case "Permit Peniaga Tumbuhan":
                            borangType = "tumbuhan";
                            break;
                        default:
                            break;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Send ajax requests
                    $.ajax({
                        url: '/permit/peniaga/postRenewPermit',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            permit_id: row_id,
                            type: borangType,
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
