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

        <form id="lesenForm">
            <input type="hidden" id="borang_id" name="borang_id" value="{{ $borang_id }}">
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
                                            <h5 class="m-0">Maklumat Lesen</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1a. Jenis Lesen <span class="text-red">*</span></label>
                                                <select class="form-control" id="jenis_lesen" name="jenis_lesen"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                                    @if ($borang->jenis_lesen == 'pemungut')
                                                        <option value="">Pilih</option>
                                                        <option value="pemungut" selected>Lesen Pungutan Tumbuhan Pemungut
                                                        </option>
                                                        <option value="komersil">Lesen Pungutan Tumbuhan Komersil</option>
                                                    @elseif ($borang->jenis_lesen == 'komersil')
                                                        <option value="">Pilih</option>
                                                        <option value="pemungut">Lesen Pungutan Tumbuhan Pemungut</option>
                                                        <option value="komersil" selected>Lesen Pungutan Tumbuhan Komersil
                                                        </option>
                                                    @else
                                                        <option value="" selected>Pilih</option>
                                                        <option value="pemungut">Lesen Pungutan Tumbuhan Pemungut</option>
                                                        <option value="komersil">Lesen Pungutan Tumbuhan Komersil</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1b. Daerah Memungut <span class="text-red">*</span></label>
                                                <select class="form-control" id="daerah_memungut_id"
                                                    name="daerah_memungut_id"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    <!-- To Do Loop Here -->
                                                    @foreach ($daerah_memungut as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($borang->daerah_memungut_id == $item->id) selected @endif>
                                                            {{ $item->daerah }}</option>
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
                                                <option value="{{$item->id}}" @if ($borang->pejabat_lesen_id == $item->id)
                                                    selected
                                                    @endif
                                                    >{{$item->nama_pejabat}}</option>
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
                                                <input type="text" class="form-control" placeholder="Nama penuh"
                                                    name="nama_penuh" id="nama_penuh" value="{{ $borang->nama_pemohon }}"
                                                    @if (Auth::user()->role == 'client') disabled @endif
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>3. No. Kad Pengenalan <span class="text-red">*</span></label>
                                                <input type="text" class="form-control" placeholder="No KP" name="no_kp"
                                                    id="no_kp" value="{{ $borang->no_kp }}"
                                                    @if (Auth::user()->role == 'client') disabled @endif
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>4. Nombor Telefon (Rumah / HP)</label>
                                                <table style="width:100%">
                                                    <tbody>
                                                        <tr>
                                                            <th><input type="text" class="form-control"
                                                                    placeholder="Rumah (optional)" id="no_tel_r"
                                                                    name="no_tel_r" value="{{ $borang->no_tel_rumah }}">
                                                            </th>
                                                            <th><input type="text" class="form-control"
                                                                    placeholder="HP (optional)" id="no_tel_hp"
                                                                    name="no_tel_hp" value="{{ $borang->no_tel_hp }}">
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>5. Penduduk Sabah atau bukan <span
                                                        class="text-red">*</span></label>
                                                <select class="form-control" id="penduduk_sabah" name="penduduk_sabah"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                                    @if ($borang->penduduk_sabah == 'Ya')
                                                        <option value="">Pilih</option>
                                                        <option value="Ya" selected>Penduduk Sabah</option>
                                                        <option value="Bukan">Bukan Penduduk</option>
                                                    @elseif ($borang->penduduk_sabah == 'Bukan')
                                                        <option value="">Pilih</option>
                                                        <option value="Ya">Penduduk Sabah</option>
                                                        <option value="Bukan" selected>Bukan Penduduk</option>
                                                    @else
                                                        <option value="" selected>Pilih</option>
                                                        <option value="Ya">Penduduk Sabah</option>
                                                        <option value="Bukan">Bukan Penduduk</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>6. Alamat Kediaman <span class="text-red">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nyatakan alamat kediaman di Sabah" id="alamat_kediaman"
                                                    name="alamat_kediaman" value="{{ $borang->alamat_kediaman }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <dd>(Bukan penduduk berikan juga alamat di Sabah)</dd>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>7. Nama Penuh dan No Kad Pengenalan Pemungut tumbuhan<span
                                                        class="text-red">*</span></label>
                                            </div>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Nama Penuh</th>
                                                        <th style="width:50%">No. Kad Pengenalan</th>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="nama_pemungut" name="nama_pemungut"
                                                                value="{{ $borang->nama_penuh_pemungut }}"
                                                                data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                                required></td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_kp_pemungut" name="no_kp_pemungut"
                                                                value="{{ $borang->no_kp_pemungut }}"
                                                                data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                                required>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>8. Senaraikan di bawah spesies, jumlah tumbuhan dan kawasan di mana lesen
                                                dipohon <span class="text-red">*</span></label>
                                            <dd>(Lesen-lesen berasingan akan dikehendaki bagi kawasan berlainan jika ianya
                                                dalam kawasan
                                                memburu yang berlainan)</dd>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (in_array($borang->status_borang_id,array(3,7,8)))
                                                <button id="btnTambahSpesies12" type="button" class="btn btn-primary btn-xs"
                                                    data-toggle="modal" data-target="#modal-tambah-spesies12"><i
                                                        class="fas fa-plus"></i> Tambah</button>
                                            @endif
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
                                                    <?php $i = 1; ?>
                                                    @forelse ($spesies_dipohon as $item)
                                                        <tr>
                                                            <td class="cNo">{{ $i }}</td>
                                                            <td class="cID">{{ $item->id }}</td>
                                                            <td class="cNamaSpesies">{{ $item->spesies }}</td>
                                                            <td class="cBilanganSpesies">{{ $item->bilangan }}</td>
                                                            <td class="cNamaKawasan">{{ $item->kawasan }}</td>
                                                            <td>
                                                                @if (in_array($borang->status_borang_id,array(3,7,8)))
                                                                    <button type="button"
                                                                        class="btn btn-xs btn-warning btnEditRow12"
                                                                        data-id="{{ $item->id }}"
                                                                        data-nama_spesies="{{ $item->spesies }}"
                                                                        data-bilangan_spesies="{{ $item->bilangan }}"
                                                                        data-nama_kawasan="{{ $item->kawasan }}"
                                                                        data-toggle="modal"
                                                                        data-target="#modal-edit-spesies12"><i
                                                                            class="fas fa-pen"></i></button>

                                                                    <button type="button"
                                                                        class="btn btn-xs btn-danger btnDeleteRow12"
                                                                        data-id="{{ $item->id }}"><i
                                                                            class="fas fa-trash"></i></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" style="text-align:center">Tiada Rekod</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer"
                                    @if (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'normal') style="display:block"
                                @else
                                    style="display:none" @endif>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><u>KEGUNAAN PEJABAT</u></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Keputusan Ujian</label>
                                                <select class="form-control" id="keputusan_ujian_id"
                                                    name="keputusan_ujian_id">
                                                    <option value="" @if (!$borang->keputusan_ujian_id) selected @endif>
                                                        Pilih
                                                    </option>
                                                    @if (Auth::user()->role == 'super admin')
                                                        @foreach ($keputusan_ujian as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if ($borang->keputusan_ujian_id == $item->id) selected @endif>
                                                                {{ $item->keputusan }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($keputusan_ujian as $item)
                                                            @if ($item->id == 3)
                                                                <option value="{{ $item->id }}"
                                                                    @if ($borang->keputusan_ujian_id == $item->id) selected @endif>
                                                                    {{ $item->keputusan }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ulasan Daripada JHL</label>
                                                <input class="form-control" type="text" name="ulasan_jhl" id="ulasan_jhl"
                                                    placeholder="(optional)" value="{{ $borang->ulasan_jhl }}">
                                            </div>
                                        </div>
                                        @php
                                            $tUlasanDiterima = '';
                                            $tUlasanDipohon = '';
                                            if ($borang->tarikh_ulasan_dipohon) {
                                                $tUlasanDipohon = date_format(date_create($borang->tarikh_ulasan_dipohon), 'd/m/Y');
                                            }
                                            if ($borang->tarikh_ulasan_diterima) {
                                                $tUlasanDiterima = date_format(date_create($borang->tarikh_ulasan_diterima), 'd/m/Y');
                                            }
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tarikh Ulasan Dipohon</label>
                                                <div class="input-group date" id="tarikh_ulasan_dipohon_div"
                                                    data-target-input="nearest">
                                                    <input type="text" name="tarikh_ulasan_dipohon"
                                                        name="tarikh_ulasan_dipohon" placeholder="(autoset)"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#tarikh_ulasan_dipohon_div"
                                                        value="{{ $tUlasanDiterima }}" disabled>
                                                    <div class="input-group-append" data-target="#tarikh_ulasan_dipohon_div"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tarikh Ulasan Diterima</label>
                                                <div class="input-group date" id="tarikh_ulasan_diterima_div"
                                                    data-target-input="nearest">
                                                    <input type="text" name="tarikh_ulasan_diterima"
                                                        name="tarikh_ulasan_diterima" placeholder="(autoset)"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#tarikh_ulasan_diterima_div"
                                                        value="{{ $tUlasanDiterima }}" disabled>
                                                    <div class="input-group-append"
                                                        data-target="#tarikh_ulasan_diterima_div"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kaedah Mendapatkan Ulasan</label>
                                            <select class="form-control" id="kaedah_ulasan_id" name="kaedah_ulasan_id">
                                                <option value="" @if (!$borang->kaedah_ulasan_id) selected @endif>Pilih (optional)
                                                </option>
                                                @foreach ($kaedah_ulasan as $item)
                                                <option value="{{$item->id}}" @if ($borang->kaedah_ulasan_id == $item->id) selected
                                                    @endif>{{$item->kaedah}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Komen</label>
                                                <input type="text" class="form-control" placeholder="optional" id="komen"
                                                    name="komen" value="{{ $borang->komen }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <a href="/lesen/tumbuhan" type="button" class="btn btn-default">Back</a>
                                    @if (Auth::user()->role == 'client')
                                        @if (!in_array($borang->status_borang_id, ['2', '6', '5', '4']))
                                            <button id="btnSaveDraft" class="btn btn-default">Save as Draft</button>
                                            <button id="btnSaveSubmit" class="btn btn-primary">Save & Submit</button>
                                        @endif
                                    @else
                                        @if ($borang->status_borang_id == 1)
                                            <button id="btnSaveSubmit" class="btn btn-primary">Save & Submit</button>
                                        @endif
                                    @endif

                                    @if (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'normal')
                                        @if ($borang->status_borang_id == 2)
                                            <button id="btnSahkan" class="btn btn-info">Sahkan Borang</button>
                                            <button id="btnKembalikan" class="btn btn-warning">Kembalikan Borang</button>
                                        @endif
                                        @if ($borang->status_borang_id == 4 || $borang->status_borang_id == 8)
                                            <button id="btnApprove" class="btn btn-success">Luluskan Borang</button>
                                            <button id="btnReject" class="btn btn-danger">Reject Borang</button>
                                        @endif
                                        @if ($borang->status_borang_id == 5)
                                            <button id="btnReject" class="btn btn-danger">Reject Borang</button>
                                        @endif
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <strong>Status Borang: </strong><code>{{ $borang->status_borang }}</code>
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
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </form>
    </div>
    <!-- /.content-wrapper -->

    @include('tumbuhan.view_lesen_modals')

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
            $(function() {
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

            function SaveSpecies() {
                //Convert table Species Buruan to array data
                var tableSpeciesTumbuhan = new Array();
                $('#tblSpesies12 tr').each(function(row, tr) {
                    tableSpeciesTumbuhan[row] = {
                        "id": $(tr).find('td:eq(1)').text(),
                        "spesies": $(tr).find('td:eq(2)').text(),
                        "bilangan": $(tr).find('td:eq(3)').text(),
                        "kawasan": $(tr).find('td:eq(4)').text()
                    }
                });
                tableSpeciesTumbuhan.shift(); // remove first row (column name)

                //Prepare header xsrf
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/lesen/tumbuhan/view/postSaveSpeciesDipohon',
                    type: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        spc: tableSpeciesTumbuhan,
                        borang_id: $('#borang_id').val()
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.result == 'success') {
                            //reload species table
                            addSpeciesTableRow(response)
                        }
                    }
                });
            }

            function addSpeciesTableRow(response) {
                //Spesies dipohon
                $('#tblSpesies12 tbody').empty();
                var j = 0;
                if (response.spesies1) {
                    $.each(response.spesies1, function(i, data) {
                        var editButton = '';
                        var deleteButton = '';
                        editButton = '<button type="button" class="btn btn-xs btn-warning btnEditRow12" data-id="' +
                            data.id + '"' +
                            'data-nama_spesies="' + data.spesies + '" data-bilangan_spesies="' + data.bilangan + '"' +
                            'data-nama_kawasan="' + data.kawasan +
                            '" data-toggle="modal" data-target="#modal-edit-spesies12"><i ' +
                            'class="fas fa-pen"></i></button>';

                        if ("{{ $borang->status_borang_id }}" != "6") { //Exclude tidak berjaya
                            deleteButton =
                                '<button type="button" class="btn btn-xs btn-danger btnDeleteRow12" data-id="' + data
                                .id + '"><i ' +
                                'class="fas fa-trash"></i></button>';
                        }

                        $('#tblSpesies12 tbody').append('<tr>' +
                            '<td class="cNo">' + (j + 1) + '</td>' +
                            '<td class="cID">' + data.id + '</td>' +
                            '<td class="cNamaSpesies">' + data.spesies + '</td>' +
                            '<td class="cBilanganSpesies">' + data.bilangan + '</td>' +
                            '<td class="cNamaKawasan">' + data.kawasan + '</td>' +
                            '<td>' +
                            editButton + deleteButton +
                            '</td>' +
                            '</tr>');
                        j = j + 1;
                    });
                }

                if (j == 0) { //No record
                    $('#tblSpesies12 tbody').append('<tr>' +
                        '<td colspan="6" style="text-align:center">Tiada Rekod</td>' +
                        '</tr>');
                }

            }

            //===================================== TABLE SPESIES 12 ========================================
            //Button click event - tambah spesies 12
            $('#btnTambahSpesies12Modal').click(function(e) {
                e.preventDefault();

                $('#tambahSpesies12Form').parsley().validate();

                if ($('#kawasan_larangan_new').is(':visible')) {
                    alert('Kawasan dipilih adalah dilarang!');
                    return;
                }

                if ($('#nama_spesies12').val() !== '' && $('#bilangan_spesies12').val() !== '' && $('#nama_kawasan12')
                    .val() !== '') {

                    //Delete first row if no record
                    $('#tblSpesies12 tr').each(function(row, tr) {
                        if ($(tr).find('td:eq(0)').text() == 'Tiada Rekod') {
                            $('#tblSpesies12 tbody').empty();
                        }
                    });

                    //get last number
                    var lastNum = $('#tblSpesies12 tr:last').find('td:eq(0)').text();
                    if (lastNum) {
                        lastNum = parseInt(lastNum) + 1;
                    } else {
                        lastNum = 1;
                    }

                    $('#tblSpesies12 tbody').append('<tr>' +
                        '<td class="cNo">' + lastNum + '</td>' +
                        '<td class="cID"></td>' +
                        '<td class="cNamaSpesies">' + $('#nama_spesies12').val() + '</td>' +
                        '<td class="cBilanganSpesies">' + $('#bilangan_spesies12').val() + '</td>' +
                        '<td class="cNamaKawasan">' + $('#nama_kawasan12').val() + '</td>' +
                        '<td>' +
                        '<button type="button" data-id="" data-nama_spesies="' + $('#nama_spesies12').val() +
                        '" data-bilangan_spesies="' + $('#bilangan_spesies12').val() + '" data-nama_kawasan="' + $(
                            '#nama_kawasan12').val() +
                        '" class="btn btn-xs btn-warning btnEditRow12" data-target="#modal-edit-spesies12" data-toggle="modal"><i class="fas fa-pen"></i></button>' +
                        '<button type="button" data-id="" class="btn btn-xs btn-danger btnDeleteRow12" data-id=""><i class="fas fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>');
                    $('#modal-tambah-spesies12').modal('hide');
                }

            });

            //Modal show event
            $('#modal-tambah-spesies12').on('show.bs.modal', function(e) {
                $('#tambahSpesies12Form').parsley().reset();
                $('#tambahSpesies12Form').trigger('reset');
                $('#kawasan_larangan_new').hide();
            });

            //Delete row spesies 12
            $("#tblSpesies12").on("click", ".btnDeleteRow12", function() {
                if (confirm('Anda pasti untuk delete rekod ini?')) {

                    //Get id for the clicked row
                    var recID = $(this).closest('tr').find('.cID').text();
                    if (recID) {
                        //Delete record from the database
                        DeleteRow('/lesen/tumbuhan/view/postDeleteSpesies', recID, 'tblSpesies12');
                    }

                    $(this).closest("tr").remove();
                    if ($('#tblSpesies12 tr').length == 1) { //add tiada rekod
                        $('#tblSpesies12 tbody').append(
                            '<tr><td colspan="6" style="text-align:center">Tiada Rekod</td></tr>');
                    }
                }
            });

            //Edit row button click event
            $("#tblSpesies12").on("click", ".btnEditRow12", function() {
                $('#editSpesies12Form').parsley().reset();
                $('#editSpesies12Form').trigger('reset');
                $('#kawasan_larangan_edit').hide();

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
            $('#btnEditSpesies12Modal').click(function() {
                if ($('#kawasan_larangan_edit').is(':visible')) {
                    alert('Kawasan dipilih adalah dilarang!');
                    return;
                } else {
                    $('#tblSpesies12 tr').each(function(row, tr) {
                        if ($(tr).find('td:eq(0)').text() == $('#editRowNo12').val()) {
                            $(tr).find('td:eq(2)').text($('#edit_nama_spesies12').val());
                            $(tr).find('td:eq(3)').text($('#edit_bilangan_spesies12').val());
                            $(tr).find('td:eq(4)').text($('#edit_nama_kawasan12').val());
                            return;
                        }
                    });
                    $('#modal-edit-spesies12').modal('hide');
                }
            });
            //============================== END OF TABLE SPESIES 12 ===============================

            //=======================
            //Function to Delete Rows
            //=======================
            function DeleteRow(processURL, deleteID, speciesTable) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: processURL,
                    type: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        delete_id: deleteID,
                        species_table: speciesTable,
                        borang_id: "{!! $borang_id !!}"
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.result == 'success') {
                            //reload species table
                            addSpeciesTableRow(response)
                        }
                    }
                });
            }

            //-----------------------
            //Save form and submit
            //-----------------------
            $('#btnSaveSubmit').click(function(e) {
                e.preventDefault();
                $('#lesenForm').parsley().validate();

                //Validate species
                var proceed = 'Yes';
                $('#tblSpesies12 tr').each(function(row, tr) {
                    if ($(tr).find('td').text() == 'Tiada Rekod') {
                        alert('Sila lengkapkan kesemua maklumat diperlukan termasuklah spesies dipohon!');
                        proceed = 'No';
                    }
                });

                if (proceed == 'No') {
                    return;
                } else {
                    if (confirm("Anda pasti untuk submit borang ini? Klik OK untuk submit")) {
                        if ($('#lesenForm').parsley().isValid()) {
                            //Enable fields
                            $("#nama_penuh").prop("disabled", false);
                            $("#no_kp").prop("disabled", false);

                            $('.loader').show();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                url: '/lesen/tumbuhan/view/postSaveSubmit',
                                type: 'post',
                                data: $('#lesenForm').serialize(),
                                dataType: 'JSON',
                                success: function(response) {
                                    if (response.result == 'success') {
                                        $('#lesenForm').parsley().reset();
                                        //Save species buruan. no 12 & 13
                                        SaveSpecies();
                                        $('.loader').hide();
                                        //alert('Borang berjaya dihantar!');
                                        window.location.href = "/lesen/tumbuhan";
                                    } else {
                                        alert('Error saving');
                                        $('.loader').hide();
                                        //Disable fields
                                        $("#nama_penuh").prop("disabled", true);
                                        $("#no_kp").prop("disabled", true);
                                    }
                                }
                            });
                        }
                    }

                }
            });

            //-----------------------
            //Save form and submit
            //-----------------------
            $('#btnSaveDraft').click(function(e) {
                e.preventDefault();
                $('#lesenForm').parsley().validate();

                //Validate species
                var proceed = 'Yes';
                $('#tblSpesies12 tr').each(function(row, tr) {
                    if ($(tr).find('td').text() == 'Tiada Rekod') {
                        alert('Sila lengkapkan kesemua maklumat diperlukan termasuklah spesies dipohon!');
                        proceed = 'No';
                    }
                });

                if (proceed == 'No') {
                    return;
                } else {
                    if ($('#lesenForm').parsley().isValid()) {
                        //Enable fields
                        $("#nama_penuh").prop("disabled", false);
                        $("#no_kp").prop("disabled", false);

                        $('.loader').show();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: '/lesen/tumbuhan/view/postSaveDraft',
                            type: 'post',
                            data: $('#lesenForm').serialize(),
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.result == 'success') {
                                    $('#lesenForm').parsley().reset();
                                    //Save species buruan. no 12 & 13
                                    SaveSpecies();
                                    $('.loader').hide();
                                    //alert('Borang berjaya dihantar!');
                                    window.location.href = "/lesen/tumbuhan";
                                } else {
                                    alert('Error saving');
                                    $('.loader').hide();
                                    //Disable fields
                                    $("#nama_penuh").prop("disabled", true);
                                    $("#no_kp").prop("disabled", true);
                                }
                            }
                        });
                    }

                }
            });

            //Sahkan borang (untuk admin dan normal user)
            $('#btnSahkan').click(function(e) {
                e.preventDefault();
                if (!$('#keputusan_ujian_id').val()) {
                    alert('Keputusan ujian harus dipilih! Rujuk bahagian KEGUNAAN PEJABAT');
                    return;
                }
                if ($('#keputusan_ujian_id').val() == '2') {
                    alert('Pengesahan tidak dapat dibuat jika keputusan ujian gagal!');
                    return;
                }
                if (confirm(
                        "Anda pasti untuk sahkan borang ini? Borang yang sah dianggap tiada kesilapan. Klik OK untuk sahkan"
                        )) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "/lesen/tumbuhan/view/postSahkan",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borang_id').val(),
                            keputusan_ujian_id: $('#keputusan_ujian_id').val(),
                            ulasan_jhl: $('#ulasan_jhl').val(),
                            //kaedah_ulasan_id: $('#kaedah_ulasan_id').val(),
                            komen: $('#komen').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = "/lesen/tumbuhan";
                            } else {
                                alert("Error");
                            }
                        }
                    });
                }
            });

            //Kembalikan borang (untuk admin dan normal user)
            $('#btnKembalikan').click(function(e) {
                if (confirm("Anda pasti untuk kembalikan borang ini?")) {
                    var comment = prompt("Sila nyatakan sebab kenapa anda mengembalikan permohonan ini. Klik Cancel untuk membatalkan.","");
                    if(comment != null){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "post",
                            url: "/lesen/tumbuhan/view/postKembalikan",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                borang_id: $('#borang_id').val(),
                                return_remark: comment,
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.result == 'success') {
                                    window.location.href = "/lesen/tumbuhan";
                                } else {
                                    alert("Error");
                                }
                            }
                        });
                    }
                }
            });

            //Luluskan borang (untuk admin dan normal user)
            $('#btnApprove').click(function(e) {
                if (!$('#komen').val()) {
                    alert('Sila isikan ruangan Komen terlebih dahulu! Nyatakan komen anda mengapa diluluskan');
                    return;
                }

                if (confirm("Anda pasti untuk luluskan (approve) borang ini?")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "/lesen/tumbuhan/view/postApprove",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borang_id').val(),
                            keputusan_ujian_id: $('#keputusan_ujian_id').val(),
                            ulasan_jhl: $('#ulasan_jhl').val(),
                            //kaedah_ulasan_id: $('#kaedah_ulasan_id').val(),
                            komen: $('#komen').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = "/lesen/tumbuhan";
                            } else {
                                alert("Error");
                            }
                        }
                    });
                }
            });

            //Reject borang (untuk admin dan normal user)
            $('#btnReject').click(function(e) {
                if (!$('#komen').val()) {
                    alert('Sila isikan ruangan Komen untuk sebap kenapa permohonan ditolak!');
                    return;
                }

                if (confirm("Anda pasti untuk tolak (reject) borang ini?")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "/lesen/tumbuhan/view/postReject",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borang_id').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = "/lesen/tumbuhan";
                            } else {
                                alert("Error");
                            }
                        }
                    });
                }
            });

            //Periksa jika kawasan yang dipilih adalah larangan
            $('#edit_nama_kawasan12').change(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "/lesen/tumbuhan/view/postCheckKawasan",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        nama_kawasan: $('#edit_nama_kawasan12').val(),
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.result == 'success') {
                            $('#kawasan_larangan_edit').hide(); //on modal show, hide div back!
                        } else {
                            $('#kawasan_larangan_edit').show();
                        }
                    }
                });
            });
            $('#nama_kawasan12').change(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "/lesen/tumbuhan/view/postCheckKawasan",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        nama_kawasan: $('#nama_kawasan12').val(),
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.result == 'success') {
                            $('#kawasan_larangan_new').hide(); //on modal show, hide div back!
                        } else {
                            $('#kawasan_larangan_new').show();
                        }
                    }
                });
            });
        </script>
    @endpush

@endsection
