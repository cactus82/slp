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
                            <li class="breadcrumb-item active">Permohonan Baru</li>
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
                                        <h5 class="m-0">BORANG 24 (Peraturan 50(1))</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/permit/membawamasuk" class="btn btn-warning float-right">Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <form id="formPermit" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12"><h4><u>Maklumat Pemohon</u></h4></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Penuh</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="" value="{{ Auth::user()->name ?? '' }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Kad Pengenalan</label>
                                                <input type="text" class="form-control" id="no_kp" name="no_kp"
                                                    placeholder="" value="{{ Auth::user()->ic_number ?? '' }}" disabled
                                                    required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Alamat Kediaman</label>
                                                <input type="text" class="form-control" name="alamat"
                                                    placeholder="Alamat perniagaan / rumah" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Telefon</label>
                                                <input type="text" class="form-control" name="no_tel"
                                                    placeholder="Contoh: 014-3332020" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Tujuan Dibawa Masuk</label>
                                                <input type="text" class="form-control" name="tujuan_dibawa_masuk"
                                                    placeholder="Untuk dipelihara, diniagakan, dll." required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Negara Asal</label>
                                                <select id="negara_asal_id" name="negara_asal_id" style="width: 100%" required>
                                                    <option value="" selected>Sila Pilih</option>
                                                    @foreach ($negara as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                                    <input class="custom-control-input custom-control-input-danger mediumPenghantaran" type="radio" id="dibawa_individu" name="medium_penghantaran" value="1" checked>
                                                    <label for="dibawa_individu" class="custom-control-label">Dibawa oleh individu</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="sykt_pkt_darat" value="2" name="medium_penghantaran">
                                                    <label for="sykt_pkt_darat" class="custom-control-label">Melalui syarikat pengangkutan darat</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="sykt_penerbangan" value="3" name="medium_penghantaran">
                                                    <label for="sykt_penerbangan" class="custom-control-label">Melalui syarikat penerbangan</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="kurier" value="4" name="medium_penghantaran">
                                                    <label for="kurier" class="custom-control-label">Melalui kurier</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline mediumPenghantaran" type="radio" id="sykt_perkapalan_laut" value="5" name="medium_penghantaran">
                                                    <label for="sykt_perkapalan_laut" class="custom-control-label">Melalui syarikat perkapalan laut</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="medium_penghantaran_remark"
                                            id="medium_penghantaran_remark" placeholder="Nama penuh dan NRIC Pembawa" required>
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
                                                    <option value="" selected>Sila Pilih</option>
                                                    @foreach ($jenis as $item)
                                                        <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><h4><u>Senarai Barang Dibawa Masuk</u></h4></div>
                                    </div>
                                    {{-- sambung sini --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" data-target="#modal-add-item-new" data-toggle="modal" class="btn btn-info btn-sm float-right" id="btnAddBarang"><i class="fa fa-plus"></i>&nbsp; <strong>Add Item</strong></button>
                                        </div>
                                    </div>
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
                                                    {{-- <tr>
                                                        <td>1</td>
                                                        <td>Haiwan Hidup</td>
                                                        <td>Babi Hutan</td>
                                                        <td>15</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
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

        //Tambah senarai barang dibawa keluar
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

        //Hapus senarai barang di bawa keluar
        $('#tableBarang').on('click', '.btnDeleteSenaraiBarang', function () {
            if(confirm("Adakah anda pasti untuk hapuskan rekod ini? Klik OK untuk hapuskan")){
                $('#tableBarang').DataTable().destroy();
                $(this).closest('tr').remove();
                initDataTable();
            }
        });

        //Submit application
        $('#btnSubmit').click(function(e) {
            e.preventDefault();
            $('#formPermit').parsley().validate();

            if ($('#formPermit').parsley().isValid()) {

                //Check if senarai barang provided at least 1
                if($('#tableBarang').DataTable().rows().count()==0){
                    alert('Sila tambah senarai barang dibawa keluar terlebih dahulu!');
                    return;
                }

                if(confirm("Adakah anda pasti untuk menghantar borang ini?")){
                    $('#nama').prop('disabled', false);
                    $('#no_kp').prop('disabled', false);

                    //Convert senarai barang to array
                    var senaraiBarang = new Array();
                    $('#tableBarang tr').each(function(row, tr){
                        senaraiBarang[row]={
                            "jenis" : $(tr).find('td:eq(1)').text(),
                            "spesis" : $(tr).find('td:eq(2)').text(),
                            "bilangan" : $(tr).find('td:eq(3)').text(),
                        }
                    });
                    senaraiBarang.shift();

                    var formData = new FormData($('#formPermit')[0]);
                    formData.append('senaraiBarang',JSON.stringify(senaraiBarang));
                    $.ajax({
                        type: "post",
                        url: "/permit/membawamasuk/postSubmit",
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
    </script>
    @endpush
@endsection
