@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permit Membawa Keluar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/penguatkuasaan">Permit Membawa Keluar</a></li>
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
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Senarai Permit</h5>
                        </div>
                        <div class="col-md-6">
                            @if (Auth::user()->role == 'client')
                            <a href="/permit/membawakeluar/baru" id="btnBaru" class="btn btn-primary float-right"><i
                                class="fa fa-plus"></i> Permohonan Baru</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

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

@include('membawa_keluar.resit_am_modal');
@include('membawa_keluar.permit_file_modal');

@push('script')
<script>
    $(function () {
        $('#loading').hide();
        initDataTable();
        fillDataTable();

        $('.datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        });
    });

    function initDataTable(){
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
            url: '/permit/membawakeluar/loadBorang',
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

        $.each(response.result, function(i, data) {
            var viewButton = '<a href="/permit/membawakeluar/view/' + data.id +
                '" type="button" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>';
            var deleteButton = '<button type="button" class="btn btn-danger btn-xs btnDeletePermit" data-id="' +
                data.id + '"><i class="fas fa-trash"></i></button>';

            var resitAmUpdate = '<button type="button" class="btn btn-block btn-default btn-sm btnResitAm" data-id="' +
                data.id + '" data-resit_id="' + data.resit_am_id + '"  data-no_resit="' + data.no_resit +
                '" data-tarikh_resit="' + data.tarikh_resit + '" data-jumlah_rm="' + data.jumlah_rm +
                '" data-no_lesen="' + data.no_lesen + '" data-pejabat_pembayaran_id="' + data.pejabat_pembayaran_id +
                '" data-tempoh_permit="'+data.tempoh_permit_lesen+'" data-target="#modal-update-resitam" data-toggle="modal"><i class="fas fa-pen"></i></button>';
            if (data.no_resit) { //show no resit button
                resitAmUpdate = '<button type="button" class="btn btn-block btn-default btn-sm btnResitAm" data-id="' +
                    data.id + '" data-resit_id="' + data.resit_am_id + '" data-no_resit="' + data.no_resit +
                    '" data-tarikh_resit="' + data.tarikh_resit + '" data-jumlah_rm="' + data.jumlah_rm +
                    '" data-no_lesen="' + data.no_lesen + '" data-pejabat_pembayaran_id="' + data.pejabat_pembayaran_id +
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

            var permitFile = '<button type="button" class="btn btn-default btn-sm" data-id="' + data.id +
                '" data-target="#modal-upload-permit" data-toggle="modal"><i class="fa fa-upload"></i></button>';
            var deletePermitFile =
                '<button type="button" data-toggle="tooltip" data-placement="top" title="Delete Permit" class="btn btn-default btn-xs btnDeletePermitFile" data-id="' +
                data.permit_file_id + '"><i class="fa fa-times text-red"></i></button>';

            if (data.permit_file_id) {
                //change button to download - if contains file
                permitFile =
                    '<a type="button" data-toggle="tooltip" data-placement="top" title="Download Permit" class="btn btn-default btn-sm" href="/permit/download/' +
                    data.permit_file_id + '"><i class="fa fa-paperclip"></i></a>';
                if (user_role == 'client') {
                    deletePermitFile = "";
                }
            } else {
                deletePermitFile = "";
                if (user_role == 'client') {
                    permitFile = "";
                }
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
                    '<a type="button" target="_blank" data-toggle="tooltip" data-placement="top" title="Generate Permit" class="btn btn-default btn-sm" href="/permit/bawakeluar/pdf/' +
                    data.id + '&' + data.resit_am_id + '"><i class="fa fa-paperclip"></i></a>';
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
                '<td class="permitRowId">' + data.id + '</td>' +
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

    $('#tablePermit').on("click", ".btnDeletePermit", function() {
        if (confirm('Adakah anda pasti untuk hapuskan borang ini? Klik OK untuk hapuskan sekarang')) {
            var row_id = $(this).closest('tr').find('.permitRowId').text();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Send ajax requests
            $.ajax({
                url: '/permit/membawakeluar/postDeleteBorang',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    borang_id: row_id,
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

    $('#modal-update-resitam').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        $('#resitAmForm').trigger('reset');
        $('#resitAmForm').parsley().reset();
        $('#borang_id_resitam').val(button.data('id'));
        $('#resit_am_id').val(button.data('resit_id'));
        $('#no_resit').val(button.data('no_resit'));

        $('#no_permit').prop('disabled', false);
        $('#no_permit').val(button.data('no_lesen'));
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Send ajax requests
            $.ajax({
                url: '/permit/membawakeluar/postUpdateResitAm',
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

    $('#tablePermit').on("click", ".btnRenewPermit", function() {
        if (confirm('Adakah anda pasti untuk renew permohonan ini?')) {
            var row_id = $(this).closest('.btnRenewPermit').attr('data-id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Send ajax requests
            $.ajax({
                url: '/permit/membawakeluar/postRenewPermit',
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
