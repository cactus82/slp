@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permit Membawa Masuk Haiwan DLL</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/permit/membawamasuk">Bawa Masuk</a></li>
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
                                        <h5 class="m-0">BORANG 24 (Peraturan 50(1))</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/permit/membawamasuk" class="btn btn-warning float-right">Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <form id="formPermit" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="borangId" name="borangId" value="{{ $data->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12"><h4><u>Maklumat Pemohon</u></h4></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Penuh</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="" value="{{ $data->nama ?? '' }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Kad Pengenalan</label>
                                                <input type="text" class="form-control" id="no_kp" name="no_kp"
                                                    placeholder="" value="{{ $data->no_kp ?? '' }}" disabled
                                                    required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Alamat Kediaman</label>
                                                <input type="text" class="form-control" name="alamat"
                                                    placeholder="Alamat perniagaan / rumah"
                                                    value="{{ $data->alamat ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Telefon</label>
                                                <input type="text" class="form-control" name="no_tel"
                                                    placeholder="Contoh: 014-3332020"
                                                    value="{{ $data->no_tel_hp ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Tujuan Dibawa Masuk</label>
                                                <input type="text" class="form-control" name="tujuan_dibawa_masuk"
                                                    placeholder="Untuk dipelihara, diniagakan, dll." value="{{ $data->tujuan_dibawa_masuk ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Negara Asal</label>
                                                <select id="negara_asal_id" name="negara_asal_id" style="width: 100%" required>
                                                    <option value="">Sila Pilih</option>
                                                    @foreach ($negara as $item)
                                                    <option value="{{ $item->id }}" @if ($item->id == $data->negara_asal_id)
                                                        selected
                                                    @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><h4><u>Medium Penghantaran Digunakan</u></h4></div>
                                        <div class="col-md-12"><p>Sila pilih yang berkenaan sahaja</p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- radio -->
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger mediumPenghantaran" type="radio" id="dibawa_individu" name="medium_penghantaran" value="1" @if ($data->medium_penghantaran_id==1) checked @endif>
                                                    <label for="dibawa_individu" class="custom-control-label">Dibawa oleh individu</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="sykt_pkt_darat" value="2" name="medium_penghantaran" @if ($data->medium_penghantaran_id==2) checked @endif>
                                                    <label for="sykt_pkt_darat" class="custom-control-label">Melalui syarikat pengangkutan darat</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="sykt_penerbangan" value="3" name="medium_penghantaran" @if ($data->medium_penghantaran_id==3) checked @endif>
                                                    <label for="sykt_penerbangan" class="custom-control-label">Melalui syarikat penerbangan</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="kurier" value="4" name="medium_penghantaran" @if ($data->medium_penghantaran_id==4) checked @endif>
                                                    <label for="kurier" class="custom-control-label">Melalui kurier</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="sykt_perkapalan_laut" value="5" name="medium_penghantaran" @if ($data->medium_penghantaran_id==5) checked @endif>
                                                    <label for="sykt_perkapalan_laut" class="custom-control-label">Melalui syarikat perkapalan laut</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="medium_penghantaran_remark"
                                            id="medium_penghantaran_remark" placeholder="Nama penuh dan NRIC Pembawa"
                                            value="{{ $data->medium_penghantaran_remark ?? '' }}" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12"><h4><u>Maklumat Barang Dibawa Masuk</u></h4></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jenis Barang Dibawa Masuk</label>
                                                <select id="jenis_dibawa_masuk_id" name="jenis_dibawa_masuk_id" style="width: 100%" required>
                                                    <option value="">Sila Pilih</option>
                                                    @foreach ($jenis as $item)
                                                        <option value="{{ $item->id }}" @if ($item->id == $data->jenis_dibawa_masuk_id)
                                                            selected
                                                        @endif>{{ $item->jenis }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><h4><u>Senarai Barang Dibawa Masuk</u></h4></div>
                                    </div>
                                    @if (in_array($data->status_borang_id,array(3,7,8)))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" data-target="#modal-add-item-new" data-toggle="modal" class="btn btn-info btn-sm float-right" id="btnAddBarang"><i class="fa fa-plus"></i>&nbsp; <strong>Add Item</strong></button>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="tableBarang" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                <th>ID</th>
                                                <th>Jenis</th>
                                                <th>Spesis</th>
                                                <th>Bilangan</th>
                                                <th style="width: 100px">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($senarai_dibawa as $item)
                                                        <tr>
                                                            <td class="senaraiID">{{ $item->id ?? '' }}</td>
                                                            <td>{{ $item->jenis_dibawa_masuk ?? '' }}</td>
                                                            <td>{{ $item->spesis ?? '' }}</td>
                                                            <td>{{ $item->bilangan ?? '' }}</td>
                                                            <td>
                                                                @if ($data->status_borang_id == 3)
                                                                    <a href="#" class="btnDeleteSenaraiBarang"><i class="fa fa-trash text-danger"></i></a>
                                                                @endif
                                                                {{-- &nbsp;<a href="#" class="btnEditSenaraiBarang"><i class="fa fa-pen text-primary"></i></a> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
    @include('membawa_masuk.add_item_new')
    @push('script')
    <script>
        $(function() {
            //Datepicker
            $('.date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            bsCustomFileInput.init();
            $('#negara_asal_id').select2();
            $('#jenis_dibawa_masuk_id').select2();
            $('#jenis_dibawa_masuk_new_id').select2();
            $('#spesis_new_id').select2();
            initDataTable();
        });

        function initDataTable(){
            $('#tableBarang').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
        });
    }

        $('input:radio[name="medium_penghantaran"]').change(
            function(){
                var radioValue = $('input[name="medium_penghantaran"]:checked').val();
                switch (radioValue) {
                    case "1":
                        $('#medium_penghantaran_remark').attr("placeholder", "Nama penuh dan NRIC Pembawa");
                        break;
                    case "2":
                        $('#medium_penghantaran_remark').attr("placeholder", "Nama syarikat pengangkutan darat");
                        break;
                    case "3":
                        $('#medium_penghantaran_remark').attr("placeholder", "Nama syarikat penerbangan");
                        break;
                    case "4":
                        $('#medium_penghantaran_remark').attr("placeholder", "Nama perkhidmatan Kurier");
                        break;
                    case "5":
                        $('#medium_penghantaran_remark').attr("placeholder", "Nama syarikat perkapalan laut");
                        break;
                    default:
                        $('#medium_penghantaran_remark').attr("placeholder", "Nama penuh dan NRIC Pembawa");
                        break;
                }
        });

        $('#btnAddBarang').click(function (e) {
            e.preventDefault();
            $('#formNewSpesis').parsley().reset();
            $('#formNewSpesis').trigger('reset');
            $('#jenis_dibawa_masuk_new_id').val(null).trigger('change');
            $('#spesis_new_id').val(null).trigger('change');
        });

        $('#btnTambahSpesiesModal').click(function (e) {
            e.preventDefault();
            $('#formNewSpesis').parsley().validate();
        });

        //Tambah senarai barang dibawa masuk
        $('#btnTambahSpesiesModal').click(function (e) {
            e.preventDefault();
            $('#tableBarang').DataTable().row.add([
                '',
                $('#jenis_dibawa_masuk_new_id').val(),
                $('#spesis_new_id').val(),
                $('#bilangan_new').val(),
                '<a href="#" class="btnDeleteSenaraiBarang"><i class="fa fa-trash text-danger"></i></a>'
                // +'&nbsp;<a href="#" class="btnEditSenaraiBarang"><i class="fa fa-pen text-primary"></i></a>'
            ]).draw(false);
            $('#modal-add-item-new').modal('hide');
        });

        //Hapus senarai barang di bawa masuk
        $('#tableBarang').on('click', '.btnDeleteSenaraiBarang', function () {
            if(confirm("Adakah anda pasti untuk hapuskan rekod ini? Rekod dalam database juga akan dihapuskan. Klik OK untuk hapuskan")){
                $('#tableBarang').DataTable().destroy();
                $(this).closest('tr').remove();
                initDataTable();

                var senaraiID = $(this).closest('tr').find('.senaraiID').text();

                $.ajax({
                    type: "POST",
                    url: "/permit/membawamasuk/postDeleteSpesis",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        senarai_id: senaraiID,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        //nothing to do
                    }
                });
            }
        });

        //Submit application
        $('#btnUpdate').click(function(e) {
            e.preventDefault();
            $('#formPermit').parsley().validate();

            if ($('#formPermit').parsley().isValid()) {

                //Check if senarai barang provided at least 1
                if($('#tableBarang').DataTable().rows().count()==0){
                    alert('Sila tambah senarai barang dibawa masuk terlebih dahulu!');
                    return;
                }

                if(confirm("Adakah anda pasti untuk menghantar borang ini?")){
                    $('#nama').prop('disabled', false);
                    $('#no_kp').prop('disabled', false);

                    //Convert senarai barang to array
                    var senaraiBarang = new Array();
                    $('#tableBarang tr').each(function(row, tr){
                        senaraiBarang[row]={
                            "barangId" : $(tr).find('td:eq(0)').text(),
                            "jenis" : $(tr).find('td:eq(1)').text(),
                            "spesis" : $(tr).find('td:eq(2)').text(),
                            "bilangan" : $(tr).find('td:eq(3)').text(),
                            "berat" : $(tr).find('td:eq(4)').text(),
                            "tanda" : $(tr).find('td:eq(5)').text(),
                        }
                    });
                    senaraiBarang.shift();

                    var formData = new FormData($('#formPermit')[0]);
                    formData.append('senaraiBarang',JSON.stringify(senaraiBarang));
                    $.ajax({
                        type: "post",
                        url: "/permit/membawamasuk/postUpdate",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function(response) {
                            $('#nama').prop('disabled', true);
                            $('#no_kp').prop('disabled', true);
                            window.location.href = "/permit/membawamasuk";
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
                        url: "/permit/membawamasuk/postReturn",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                            return_remark: comment,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            window.location.href = "/permit/membawamasuk";
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
                        url: "/permit/membawamasuk/postSahkanBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/membawamasuk';
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
                        url: "/permit/membawamasuk/postApproveBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/membawamasuk';
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
                        url: "/permit/membawamasuk/postRejectBorang",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borangId').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = '/permit/membawamasuk';
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
