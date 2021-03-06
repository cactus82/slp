@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permit Peniaga Tumbuhan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/permit/peniaga">Peniaga</a></li>
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
                                    <h5 class="m-0">BORANG 18 (Peraturan 44(1))</h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="/permit/peniaga" class="btn btn-warning float-right">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <form id="formPermit" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>1. Nama Penuh</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="{{ Auth::user()->name ?? ''}}" disabled required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Alamat Kediaman</label>
                                            <input type="text" class="form-control" name="alamat" placeholder="Alamat kediaman pemohon" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>2. No Kad Pengenalan</label>
                                            <input type="text" class="form-control" id="no_kp" name="no_kp" placeholder="" value="{{ Auth::user()->ic_number ?? ''}}" disabled required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>3. No Telefon</label>
                                            <input type="text" class="form-control" name="no_tel" placeholder="Contoh: 014-3332020" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>4. Alamat Premis Perniagaan</label>
                                            <input type="text" class="form-control" name="alamat_premis" placeholder="Alamat premis berkenaan dengan mana permit diminta" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>5. Bilangan Pekerja</label>
                                            <input type="text" class="form-control" name="jumlah_pekerja" placeholder="Contoh: 5 orang" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>6. Jenis tumbuhan diniagakan</label>
                                            <input type="text" class="form-control" name="jenis_tumbuhan_diniaga" placeholder="Contoh: Bunga orkid" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>7. Butir-butir lesen atau permit terdahulu</label>
                                            <input type="text" class="form-control" name="butir_lesen_permit_terdahulu" placeholder="Permit yang dipegang dan permit-permit peniaga yang terdahulu" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>8. Tarikh penyata terakhir menurut Peraturan-Peraturan Hidupan Liar 1998</label>
                                            <div class="input-group date" id="tarikh_penyata_terakhir_div" data-target-input="nearest">
                                                <input type="text" name="tarikh_penyata_terakhir" placeholder="dd/mm/yyyy" class="form-control datetimepicker-input" data-target="#tarikh_penyata_terakhir_div">
                                                <div class="input-group-append" data-target="#tarikh_penyata_terakhir_div" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>9. Salinan penyata terbaru saya disertakan bersama borang ini</label>
                                            <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="salinan_penyata" name="salinan_penyata[]" multiple>
                                            <label class="custom-file-label" for="salinan_penyata">Choose file</label>
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
@push('script')
<script>
    $(function() {
        //Datepicker
        $('.date').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        bsCustomFileInput.init();
    });

    $('#btnSubmit').click(function(e) {
        e.preventDefault();
        $('#formPermit').parsley().validate();

        if ($('#formPermit').parsley().isValid()) {
            if(confirm("Adakah anda pasti untuk menghantar borang ini?")){
                $('#nama').prop('disabled', false);
                $('#no_kp').prop('disabled', false);
                $.ajax({
                    type: "post",
                    url: "/permit/perniagaan/postSubmitPeniagaTumbuhan",
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
        }
    });
</script>
@endpush
@endsection
