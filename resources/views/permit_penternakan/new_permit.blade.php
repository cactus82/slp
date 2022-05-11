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
                        <li class="breadcrumb-item active">Permit Baru</li>
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
                                    <h5 class="m-0">Borang Permohonan Permit</h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="/permit/penternakan" class="btn btn-warning float-right">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <form id="formPermit" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>1. Jenis Permit</label>
                                            <select class="form-control" id="jenis_permit" name="jenis_permit">
                                              <option value="haiwan" selected>Penternakan Haiwan</option>
                                              <option value="tumbuhan">Penanaman Tumbuhan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>2. Nama Penuh</label>
                                            <input type="text" class="form-control" id="nama_penuh" name="nama_penuh" placeholder=""
                                            value="{{ Auth::user()->name ?? ''}}" disabled required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>3. No Kad Pengenalan</label>
                                            <input type="text" class="form-control" id="no_kp" name="no_kp" placeholder="" value="{{ Auth::user()->ic_number ?? ''}}" disabled required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>4. No Telefon</label>
                                            <input type="text" class="form-control" name="no_tel" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>5. Alamat Kediaman</label>
                                            <input type="text" class="form-control" name="alamat_kediaman" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>6. Butir-butir lesen atau permit lain yang dipegang. (Jika ada)</label>
                                        <textarea class="form-control" rows="3" name="butir_permit_lain" id="butir_permit_lain" placeholder="Nyatakan butiran..." style="margin-top: 0px; margin-bottom: 0px; height: 87px;"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>7. Alamat di mana penternakan haiwan atau penanaman tumbuhan* akan diusahakan</label>
                                        <input type="text" class="form-control" name="alamat_penternakan" id="alamat_penternakan" required>
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
                                        <input type="text" class="form-control" name="saiz" id="saiz" placeholder="Contoh: 5 hektar" required>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="petaFile">Peta/Pelan (Imej Saiz Maximum 5MB)</label>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" id="petaFile" name="petaFile[]" multiple>
                                              <label class="custom-file-label" for="petaFile">Choose file</label>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>9. Deskripsi bangunan atas mana kawasan digunakan</label>
                                        <input type="text" class="form-control" name="deskripsi_bangunan" id="deskripsi_bangunan" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>10. Butir-butir peraturan bagi menjamin haiwan daripada terlepas</label>
                                        <textarea class="form-control" rows="3" name="butir_peraturan" id="butir_peraturan" placeholder="Nyatakan butiran..." style="margin-top: 0px; margin-bottom: 0px; height: 87px;" required></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>11. Butir-butir haiwan/tumbuhan yang dicadangkan untuk diternak/ditanam</label>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="btnTambahSpesis" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-tambah-spesies">Tambah</button><br><br>
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
                                        <label>12. Butir-butir stok yang akan digunakan untuk memulakan penternakan/penanaman dengan memberikan sumber.</label>
                                        <textarea class="form-control" rows="3" name="butir_stok" id="butir_stok" placeholder="Nyatakan butiran..." style="margin-top: 0px; margin-bottom: 0px; height: 87px;" required></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>13. Butir-butir ringkas tentang diet yang dicadangkan untuk diberikan kepada haiwan.</label>
                                        <textarea class="form-control" rows="3" name="butir_diet" id="butir_diet" placeholder="Nyatakan butiran..." style="margin-top: 0px; margin-bottom: 0px; height: 87px;" required></textarea>

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>14. Salinan-salinan ramalan kewangan bagi perniagaan yang dicadangkan mestilah dikemukakan dengan permohonan termasuk aliran tunai dan butir-butir input wang tunai.</label>
                                        <input type="text" class="form-control" name="salinan_ramalan" id="salinan_ramalan" required>
                                    </div>
                                </div>
                                <br>
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

@include('permit_penternakan.new_permit_modal')

@push('script')
<script>
    $(function(){
        $('#dataTable').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter":  false
        });

        $('#formPermit').parsley();

        //Initialize Select2 Elements
        $('.select2').select2();
        $('.select2').css({ 'padding-top': '0px', 'font-size': '12px' });
        $('.select2-selection').css('border-radius', '0px');
        $('.select2-container').children().css('border-radius', '0px');
        bsCustomFileInput.init();
        $('#daerah_id').select2();
    });

    $('#btnSubmit').click(function (e) {
        e.preventDefault();
        $('#formPermit').parsley().validate();

        //if species table is empty then don't proceed

        if($('#formPermit').parsley().isValid()){
            $('#nama_penuh').prop('disabled', false);
            $('#no_kp').prop('disabled', false);
            $.ajax({
                type: "post",
                url: "/permit/penternakan/postSubmitPermit",
                data: new FormData($('#formPermit')[0]),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    $('#nama_penuh').prop('disabled', true);
                    $('#no_kp').prop('disabled', true);
                    SaveSpecies(response.borang_id);
                }
            });
        }

    });

    function SaveSpecies($borangID){
        //Convert table to array
        var tableSpesis = new Array();
        $('#dataTable tr').each(function(row, tr){
            tableSpesis[row]={
                "id" : $(tr).find('td:eq(0)').text()
                , "spesis" :$(tr).find('td:eq(1)').text()
                , "bilangan" : $(tr).find('td:eq(2)').text()
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
            success: function (response) {
                if(response.result == 'success'){
                    window.location.href = '/permit/penternakan';
                }
            }
        });
    }

    //Button click event - tambah spesies
    $('#btnTambahSpesiesModal').click(function(e){
        e.preventDefault();

        $('#tambahSpesiesForm').parsley().validate();

        if($('#nama_spesies').val()!=='' && $('#bilangan_spesies').val()!==''){

            $('#dataTable').DataTable().destroy();

            $('#dataTable tbody').append('<tr>'
            +'<td class="cID"></td>'
            +'<td class="cNamaSpesies">'+$('#nama_spesies').val()+'</td>'
            +'<td class="cBilanganSpesies">'+$('#bilangan_spesies').val()+'</td>'
            +'<td>'
                +'<button type="button" data-id="" data-nama_spesies="'+$('#nama_spesies').val()+'" data-bilangan_spesies="'+$('#bilangan_spesies').val()+'" class="btn btn-xs btn-warning btnEditRow" data-target="#modal-edit-spesies" data-toggle="modal"><i class="fas fa-pen"></i></button>'
                +'<button type="button" data-id="" class="btn btn-xs btn-danger btnDeleteRow" data-id=""><i class="fas fa-trash"></i></button>'
                +'</td>'
            +'</tr>');
            $('#modal-tambah-spesies').modal('hide');
        }

        //Recreate DataTable
        $('#dataTable').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter":  false
        });
    });

    //Clear Field On Modal Show
    $('#modal-tambah-spesies').on('show.bs.modal', function(e){
        //sambung sini...

    });
</script>
@endpush
@endsection
