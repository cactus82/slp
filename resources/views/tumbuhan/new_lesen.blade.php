@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lesen Pungutan Tumbuhan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/lesen/tumbuhan">Senarai Permohonan</a></li>
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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="m-0">Maklumat Borang</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="lesenForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>1a. Jenis Lesen <span class="text-red">*</span></label>
                                            <select class="form-control" id="jenis_lesen" name="jenis_lesen"
                                            data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                                <option value="">Pilih</option>
                                                <option value="pemungut" selected>Lesen Pungutan Tumbuhan Pemungut</option>
                                                <option value="komersil">Lesen Pungutan Tumbuhan Komersil</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>1b. Daerah Memungut <span class="text-red">*</span></label>
                                            <select class="form-control" id="daerah_memungut_id" name="daerah_memungut_id"
                                            data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                                <option value="">Pilih</option>
                                                @foreach ($daerah_memungut as $item)
                                                    <option value="{{$item->id}}">{{$item->daerah}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label>1c. Pejabat lesen hendak diambil <span class="text-red">*</span></label>
                                            <select class="form-control" id="pejabat_lesen_id" name="pejabat_lesen_id"
                                            data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                                <option value="">Pilih</option>
                                                @foreach ($pejabat_lesen as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_pejabat}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <input type="hidden" name="pejabat_lesen_id" id="pejabat_lesen_id" value="">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>2. Nama Penuh Pemohon <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Nama penuh" name="nama_penuh" id="nama_penuh"
                                                @if (Auth::user()->role=='client')
                                                    value="{{Auth::user()->name}}" disabled
                                                @else
                                                    value=""
                                                @endif
                                                data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>3. No. Kad Pengenalan <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="No KP" name="no_kp" id="no_kp"
                                            @if (Auth::user()->role=='client')
                                                value="{{Auth::user()->ic_number}}" disabled
                                            @else
                                                value=""
                                            @endif
                                                data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>4. Nombor Telefon (Rumah / HP)</label>
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <th><input type="text" class="form-control" placeholder="Rumah (optional)"
                                                                id="no_tel_r" name="no_tel_r" value=""></th>
                                                        <th><input type="text" class="form-control" placeholder="HP (optional)"
                                                                id="no_tel_hp" name="no_tel_hp" value=""></th>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>5. Penduduk Sabah atau bukan <span class="text-red">*</span></label>
                                            <select class="form-control" id="penduduk_sabah" name="penduduk_sabah"
                                                data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                                <option value="" selected>Pilih</option>
                                                <option value="Ya">Penduduk Sabah</option>
                                                <option value="Bukan">Bukan Penduduk</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>6. Alamat Kediaman <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Nyatakan alamat kediaman di Sabah"
                                                id="alamat_kediaman" name="alamat_kediaman" value=""
                                                data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <dd>(Bukan penduduk berikan juga alamat di Sabah)</dd>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>7. Nama Penuh dan No Kad Pengenalan Pemungut tumbuhan <span class="text-red">*</span></label>
                                        </div>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Nama Penuh</th>
                                                    <th style="width:50%">No. Kad Pengenalan</th>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" placeholder="" id="nama_pemungut"
                                                            name="nama_pemungut" value=""
                                                            data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required></td>
                                                    <td><input type="text" class="form-control" placeholder="" id="no_kp_pemungut"
                                                            name="no_kp_pemungut" value=""
                                                            data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>8. Senaraikan di bawah spesies, jumlah tumbuhan dan kawasan di mana lesen dipohon <span class="text-red">*</span></label>
                                        <dd>(Lesen-lesen berasingan akan dikehendaki bagi kawasan berlainan jika ianya dalam kawasan
                                            yang berlainan)</dd>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="btnTambahSpesies12" type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                            data-target="#modal-tambah-spesies12"><i class="fas fa-plus"></i> Tambah</button>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tblSpesies12">
                                            <thead>
                                                <tr>
                                                    <th style="width:50px">No</th>
                                                    <th style="width:50px">ID</th>
                                                    <th>Species</th>
                                                    <th>Bilangan</th>
                                                    <th>Kawasan</th>
                                                    <th style="width:70px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="6" style="text-align:center">Tiada Rekod</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="card-footer"@if (Auth::user()->role=='super admin'||Auth::user()->role=='admin'||Auth::user()->role=='normal')
                            style="display:block"
                        @else
                            style="display:none"
                        @endif>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><u>KEGUNAAN PEJABAT</u></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keputusan Ujian</label>
                                        <select class="form-control" id="keputusan_ujian_id" name="keputusan_ujian_id">
                                            <option value="" selected>Pilih (optional)</option>
                                            @if (Auth::user()->role == 'super admin')
                                                @foreach ($keputusan_ujian as $item)
                                                    <option value="{{$item->id}}">{{$item->keputusan}}</option>
                                                @endforeach
                                            @else
                                                @foreach ($keputusan_ujian as $item)
                                                    @if ($item->id == 3)
                                                        <option value="{{$item->id}}">{{$item->keputusan}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ulasan Daripada JHL</label>
                                        <input class="form-control" type="text" name="ulasan_jhl" id="ulasan_jhl" placeholder="(optional)"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tarikh Ulasan Dipohon</label>
                                        <div class="input-group date" id="tarikh_ulasan_dipohon_div" data-target-input="nearest">
                                            <input type="text" name="tarikh_ulasan_dipohon" name="tarikh_ulasan_dipohon" placeholder="(autoset)"
                                                class="form-control datetimepicker-input" data-target="#tarikh_ulasan_dipohon_div" disabled>
                                            <div class="input-group-append" data-target="#tarikh_ulasan_dipohon_div" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tarikh Ulasan Diterima</label>
                                        <div class="input-group date" id="tarikh_ulasan_diterima_div" data-target-input="nearest">
                                            <input type="text" name="tarikh_ulasan_diterima" name="tarikh_ulasan_diterima" placeholder="(autoset)"
                                                class="form-control datetimepicker-input" data-target="#tarikh_ulasan_diterima_div" disabled>
                                            <div class="input-group-append" data-target="#tarikh_ulasan_diterima_div" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kaedah Mendapatkan Ulasan</label>
                                        <select class="form-control" id="kaedah_ulasan_id" name="kaedah_ulasan_id">
                                            <option value="" selected>Pilih (optional)</option>
                                            @foreach ($kaedah_ulasan as $item)
                                            <option value="{{$item->id}}">{{$item->kaedah}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Komen</label>
                                        <input type="text" class="form-control" placeholder="optional" id="komen" name="komen" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="/lesen/tumbuhan" type="button" class="btn btn-default">Back</a>
                            @if (Auth::user()->role=='client')
                                <button id="btnSaveDraft" class="btn btn-default">Save as Draft</button>
                            @endif
                            <button id="btnSaveSubmit" class="btn btn-success">Save & Submit</button>
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

@include('tumbuhan.new_lesen_modals')

<!-- /.loading animation -->
<div class="loader" style="display:none"></div>

@push('styles')
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
        top: 45%;
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
    $(function(){
        //Date picker
        /* $('#tarikh_pengeluaran').datepicker({format: 'yyyy-mm-dd',autoclose: true});
        $('#tarikh_ulasan_dipohon').datepicker({format: 'yyyy-mm-dd',autoclose: true});
        $('#tarikh_ulasan_diterima').datepicker({format: 'yyyy-mm-dd',autoclose: true}); */

        //Datepicker
        $('.date').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('#lesenForm').parsley();
    });

    function SaveSpecies($borangID){
        //Convert table Species Buruan to array data
        var tableSpeciesTumbuhan = new Array();
        $('#tblSpesies12 tr').each(function(row, tr){
            tableSpeciesTumbuhan[row]={
                "id" : $(tr).find('td:eq(1)').text()
                , "spesies" :$(tr).find('td:eq(2)').text()
                , "bilangan" : $(tr).find('td:eq(3)').text()
                , "kawasan" : $(tr).find('td:eq(4)').text()
            }
        });
        tableSpeciesTumbuhan.shift();  // remove first row (column name)

        //Prepare header xsrf
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $.ajax({
            url: '/lesen/tumbuhan/view/postSaveSpeciesDipohon',
            type: 'post',
            data: {_token: $('meta[name="csrf-token"]').attr('content'), spc: tableSpeciesTumbuhan, borang_id: $borangID},
            dataType: 'JSON',
            success: function (response) {
                if(response.result == 'success'){
                    //reload species table
                    addSpeciesTableRow(response)
                }
            }
        });
    }

    function addSpeciesTableRow(response){
        //Spesies dipohon
        $('#tblSpesies12 tbody').empty();
        var j=0;
        if(response.spesies1){
            $.each(response.spesies1, function(i,data){
                var editButton = '';
                var deleteButton = '';
                editButton = '<button type="button" class="btn btn-xs btn-warning btnEditRow12" data-id="'+data.id+'"'
                    +'data-nama_spesies="'+data.spesies+'" data-bilangan_spesies="'+data.bilangan+'"'
                    +'data-nama_kawasan="'+data.kawasan+'" data-toggle="modal" data-target="#modal-edit-spesies12"><i '
                    +'class="fas fa-pen"></i></button>';
                deleteButton = '<button type="button" class="btn btn-xs btn-danger btnDeleteRow12" data-id="'+data.id+'"><i '
                    +'class="fas fa-trash"></i></button>';

                $('#tblSpesies12 tbody').append('<tr>'
                +'<td class="cNo">'+(j+1)+'</td>'
                +'<td class="cID">'+data.id+'</td>'
                +'<td class="cNamaSpesies">'+data.spesies+'</td>'
                +'<td class="cBilanganSpesies">'+data.bilangan+'</td>'
                +'<td class="cNamaKawasan">'+data.kawasan+'</td>'
                +'<td>'
                    +editButton+deleteButton
                +'</td>'
                +'</tr>');
                j=j+1;
            });
        }

        if(j==0){//No record
            $('#tblSpesies12 tbody').append('<tr>'
                +'<td colspan="6" style="text-align:center">Tiada Rekod</td>'
            +'</tr>');
        }
    }

    //===================================== TABLE SPESIES 12 ========================================
    //Button click event - tambah spesies 12
    $('#btnTambahSpesies12Modal').click(function(e){
        e.preventDefault();

        $('#tambahSpesies12Form').parsley().validate();

        if($('#nama_spesies12').val()!=='' && $('#bilangan_spesies12').val()!=='' && $('#nama_kawasan12').val()!==''){

            //Delete first row if no record
            $('#tblSpesies12 tr').each(function(row, tr){
                if($(tr).find('td:eq(0)').text()=='Tiada Rekod'){
                    $('#tblSpesies12 tbody').empty();
                }
            });

            //get last number
            var lastNum = $('#tblSpesies12 tr:last').find('td:eq(0)').text();
            if(lastNum){
                lastNum = parseInt(lastNum)+1;
            }else{
                lastNum = 1;
            }

            $('#tblSpesies12 tbody').append('<tr>'
            +'<td class="cNo">'+lastNum+'</td>'
            +'<td class="cID"></td>'
            +'<td class="cNamaSpesies">'+$('#nama_spesies12').val()+'</td>'
            +'<td class="cBilanganSpesies">'+$('#bilangan_spesies12').val()+'</td>'
            +'<td class="cNamaKawasan">'+$('#nama_kawasan12').val()+'</td>'
            +'<td>'
                +'<button type="button" data-id="" data-nama_spesies="'+$('#nama_spesies12').val()+'" data-bilangan_spesies="'+$('#bilangan_spesies12').val()+'" data-nama_kawasan="'+$('#nama_kawasan12').val()+'" class="btn btn-xs btn-warning btnEditRow12" data-target="#modal-edit-spesies12" data-toggle="modal"><i class="fas fa-pen"></i></button>'
                +'<button type="button" data-id="" class="btn btn-xs btn-danger btnDeleteRow12" data-id=""><i class="fas fa-trash"></i></button>'
                +'</td>'
            +'</tr>');
            $('#modal-tambah-spesies12').modal('hide');
        }

    });

    //Modal show event
    $('#modal-tambah-spesies12').on('show.bs.modal',function(e){
        $('#tambahSpesies12Form').parsley().reset();
        $('#tambahSpesies12Form').trigger('reset');
    });

    //Delete row spesies 12
    $("#tblSpesies12").on("click", ".btnDeleteRow12", function() {
        if(confirm('Anda pasti untuk delete rekod ini?')){

            //Get id for the clicked row
            var recID = $(this).closest('tr').find('.cID').text();
            if(recID){
                //Delete record from the database
                DeleteRow('/lesen/tumbuhan/view/postDeleteSpesies', recID, 'tblSpesies12');
            }

            $(this).closest("tr").remove();
            if($('#tblSpesies12 tr').length==1){//add tiada rekod
                $('#tblSpesies12 tbody').append('<tr><td colspan="6" style="text-align:center">Tiada Rekod</td></tr>');
            }
        }
    });

    //Edit row button click event
    $("#tblSpesies12").on("click", ".btnEditRow12", function() {
        $('#editSpesies12Form').parsley().reset();
        $('#editSpesies12Form').trigger('reset');

        //Set recNo and recId on modal
        var recNo = $(this).closest('tr').find('.cNo').text();
        var recID = $(this).closest('tr').find('.cID').text();
        $('#editRowNo12').val(recNo);
        $('#editIDSpesies12').val(editIDSpesies12);

        //Set edit data
        $('#edit_nama_spesies12').val($(this).closest('tr').find('.cNamaSpesies').text());
        $('#edit_bilangan_spesies12').val($(this).closest('tr').find('.cBilanganSpesies').text());
        $('#edit_nama_kawasan12').val($(this).closest('tr').find('.cNamaKawasan').text());
    });

    //Edit event (set edit modal value)
    $('#btnEditSpesies12Modal').click(function(){
        $('#tblSpesies12 tr').each(function(row, tr){
            if($(tr).find('td:eq(0)').text() == $('#editRowNo12').val()){
                $(tr).find('td:eq(2)').text($('#edit_nama_spesies12').val());
                $(tr).find('td:eq(3)').text($('#edit_bilangan_spesies12').val());
                $(tr).find('td:eq(4)').text($('#edit_nama_kawasan12').val());
                return;
            }
        });
        $('#modal-edit-spesies12').modal('hide');
    });
    //============================== END OF TABLE SPESIES 12 ===============================

    //=======================
    //Function to Delete Rows
    //=======================
    function DeleteRow(processURL,deleteID,speciesTable){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $.ajax({
            url: processURL,
            type: 'post',
            data: {_token: $('meta[name="csrf-token"]').attr('content'),delete_id: deleteID,species_table: speciesTable, borang_id: 'none' },
            dataType: 'JSON',
            success: function (response) {
                if(response.result == 'success'){
                    //reload species table
                    addSpeciesTableRow(response)
                }
            }
        });
    }


    //-----------------------
    //Save form and submit
    //-----------------------
    $('#btnSaveSubmit').click(function(e){
        e.preventDefault();

        $('#lesenForm').parsley().validate();

        //Validate species
        var proceed = 'Yes';
        $('#tblSpesies12 tr').each(function(row, tr){
            if($(tr).find('td').text()=='Tiada Rekod'){
                alert('Sila lengkapkan kesemua maklumat diperlukan termasuklah spesies dipohon!');
                proceed = 'No';
            }
        });

        if(proceed=='No'){
            return;
        }else{
            if(confirm("Anda pasti untuk hantar borang ini sekarang?")){
                if($('#lesenForm').parsley().isValid()){
                    //Enable fields
                    $("#nama_penuh").prop( "disabled", false );
                    $("#no_kp").prop( "disabled", false );
                    $('.loader').show();
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });

                    $.ajax({
                        url: '/lesen/tumbuhan/new/postSaveSubmit',
                        type: 'post',
                        data: $('#lesenForm').serialize(),
                        dataType: 'JSON',
                        success: function (response) {
                            if(response.result == 'success'){
                                $('#lesenForm').parsley().reset();
                                //Save species buruan. no 12
                                SaveSpecies(response.borang_id);
                                $('.loader').hide();
                                //alert('Borang berjaya dihantar!');
                                window.location.href = "/lesen/tumbuhan";
                            }else{
                                alert('Error saving');
                                $('.loader').hide();
                                //Disable fields
                                $("#nama_penuh").prop( "disabled", true );
                                $("#no_kp").prop( "disabled", true );
                            }
                        }
                    });
                }
            }
        }

    });

    //-----------------------
    //Save form - draft
    //-----------------------
    $('#btnSaveDraft').click(function(e){
        e.preventDefault();

        $('#lesenForm').parsley().validate();

        //Validate species
        var proceed = 'Yes';
        $('#tblSpesies12 tr').each(function(row, tr){
            if($(tr).find('td').text()=='Tiada Rekod'){
                alert('Sila lengkapkan kesemua maklumat diperlukan termasuklah spesies dipohon!');
                proceed = 'No';
            }
        });

        if(proceed=='No'){
            return;
        }else{
            if($('#lesenForm').parsley().isValid()){
                //Enable fields
                $("#nama_penuh").prop( "disabled", false );
                $("#no_kp").prop( "disabled", false );
                $('.loader').show();
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });

                $.ajax({
                    url: '/lesen/tumbuhan/new/postSaveDraftNew',
                    type: 'post',
                    data: $('#lesenForm').serialize(),
                    dataType: 'JSON',
                    success: function (response) {
                        if(response.result == 'success'){
                            $('#lesenForm').parsley().reset();
                            //Save species buruan. no 12
                            SaveSpecies(response.borang_id);
                            $('.loader').hide();
                            //alert('Borang berjaya dihantar!');
                            window.location.href = "/lesen/tumbuhan";
                        }else{
                            alert('Error saving');
                            $('.loader').hide();
                            //Disable fields
                            $("#nama_penuh").prop( "disabled", true );
                            $("#no_kp").prop( "disabled", true );
                        }
                    }
                });
            }
        }

    });

</script>
@endpush

@endsection
