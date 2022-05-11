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
                                        <h5 class="m-0">BORANG 9 (Peraturan 31(1))</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/permit/haiwantawanan" class="btn btn-warning float-right">Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <form id="formPermit" method="post" enctype="multipart/form-data">
                                @csrf
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
                                        value="{{ Auth::user()->name ?? '' }}" disabled required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_tel" class="col-sm-2 col-form-label">3. Nombor Telefon: </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_tel" placeholder="(Diperlukan)" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">4. Alamat Kediaman: </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="alamat" placeholder="(Diperlukan)" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>5. Butir-butir permit haiwan tawanan lain yang dipegang (jika ada)</label>
                                                <input type="text" class="form-control" name="butir_permit_lain">
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" data-target="#modal-add-item-new" data-toggle="modal" class="btn btn-info btn-sm float-right" id="btnAddSpesis"><i class="fa fa-plus"></i>&nbsp; <strong>Add Item</strong></button>
                                        </div>
                                    </div>
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
                                                    placeholder="(Diperlukan)" required>
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
                                                    placeholder="(Diperlukan)" required>
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
                                                        name="salinan_sijil_kesihatan[]" multiple required>
                                                    <label class="custom-file-label" for="salinan_sijil_kesihatan">Choose
                                                        file</label>
                                                </div>
                                            </div>
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

        $('#btnSubmit').click(function(e) {
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
                            "spesis" : $(tr).find('td:eq(1)').text(),
                            "bilangan" : $(tr).find('td:eq(2)').text(),
                        }
                    });
                    senaraiSpesis.shift();

                    var formData = new FormData($('#formPermit')[0]);
                    formData.append('senaraiSpesis',JSON.stringify(senaraiSpesis));
                    $.ajax({
                        type: "post",
                        url: "/permit/haiwantawanan/postSubmit",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function(response) {
                            $('#nama').prop('disabled', true);
                            $('#no_kp').prop('disabled', true);
                            window.location.href = "/permit/haiwantawanan";
                        }
                    });
                }
            }
        });
    </script>
    @endpush
@endsection
