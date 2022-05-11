@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Borang Lesen Memburu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/lesen/memburu">Lesen Memburu</a></li>
                            <li class="breadcrumb-item active">Permohonan</li>
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

                        <form id="lesenForm">
                            <input type="hidden" id="borang_id" name="borang_id" value="{{ $borang_id }}">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="m-0">Permohonan Lesen Memburu</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="/lesen/memburu" class="btn btn-warning float-right">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1a. Jenis Lesen *</label>
                                                <select class="form-control" id="jenis_lesen" name="jenis_lesen"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                                    @if ($borang->jenis_lesen == 'komersil')
                                                        <option value="">Pilih</option>
                                                        <option value="sukan">Lesen Sukan</option>
                                                        <option value="komersil" selected>Lesen Memburu Komersil</option>
                                                    @elseif ($borang->jenis_lesen == 'sukan')
                                                        <option value="">Pilih</option>
                                                        <option value="sukan" selected>Lesen Sukan</option>
                                                        <option value="komersil">Lesen Memburu Komersil</option>
                                                    @else
                                                        <option value="" selected>Pilih</option>
                                                        <option value="sukan">Lesen Sukan</option>
                                                        <option value="komersil">Lesen Memburu Komersil</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1b. Daerah Memburu *</label>
                                                <select class="form-control" id="daerah_memburu_id"
                                                    name="daerah_memburu_id"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    @foreach ($daerah_memburu as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($borang->daerah_memburu_id == $item->id) selected @endif>
                                                            {{ $item->daerah }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label>1c. Pejabat lesen hendak diambil *</label>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1d. Kawasan Memburu *</label>
                                                <input type="text" name="kawasan_memburu" id="kawasan_memburu"
                                                    maxlength="50" class="form-control" placeholder="Nama kawasan memburu"
                                                    value="{{ $borang->kawasan_memburu }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1e. Tempoh Sah Memburu *</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    @php
                                                        $tempohFrom = date_create($borang->tarikh_mula_memburu);
                                                        $tempohTo = date_create($borang->tarikh_tamat_memburu);
                                                        $tempohSahMemburu = date_format($tempohFrom, 'd/m/Y') . ' - ' . date_format($tempohTo, 'd/m/Y');
                                                    @endphp
                                                    <input type="text" class="form-control float-right" id="tempoh_memburu"
                                                        name="tempoh_memburu" required autocomplete="off"
                                                        value="{{ $tempohSahMemburu }}"
                                                        data-parsley-error-message="<p class='text-red'>Diperlukan!</p>">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>2. Nama Penuh Pemohon *</label>
                                                <input type="text" class="form-control" placeholder="Nama penuh"
                                                    name="nama_penuh" id="nama_penuh" value="{{ $borang->nama_pemohon }}"
                                                    @if (Auth::user()->role == 'client') disabled @endif
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>3. No. Kad Pengenalan *</label>
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
                                                                    name="no_tel_r"
                                                                    value="{{ $borang->no_tel_rumah ?? '' }}"></th>
                                                            <th><input type="text" class="form-control"
                                                                    placeholder="HP (optional)" id="no_tel_hp"
                                                                    name="no_tel_hp"
                                                                    value="{{ $borang->no_tel_hp ?? '' }}"></th>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>5. No. Pendaftaran Kereta untuk memburu *</label>
                                                <input type="text" class="form-control"
                                                    placeholder="No pendaftaran kereta" id="no_pendaftaran_kereta"
                                                    name="no_pendaftaran_kereta"
                                                    value="{{ $borang->no_pendaftaran_kereta ?? '' }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>6. Penduduk Sabah atau bukan *</label>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>7. Alamat Kediaman *</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nyatakan alamat kediaman di Sabah" id="alamat_kediaman"
                                                    name="alamat_kediaman" value="{{ $borang->alamat_kediaman ?? '' }}"
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
                                                <label>8. Nama Penuh dan No Kad Pengenalan Teman Pemburu</label><br>
                                                (Maximum yang boleh mengikut pemburu adalah empat orang)
                                            </div>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:10px">No</th>
                                                        <th>Nama Penuh</th>
                                                        <th>No. Kad Pengenalan</th>
                                                        <th>No. Lesen Senjata</th>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="nama_teman_1" name="nama_teman_1"
                                                                value="{{ $borang->nama_teman_1 ?? '' }}"></td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_kp_1" name="no_kp_1"
                                                                value="{{ $borang->no_kp_teman_1 ?? '' }}">
                                                        </td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_lesen_senjata_teman1" name="no_lesen_senjata_teman1"
                                                                value="{{ $borang->no_lesen_senjata_teman1 ?? '' }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="nama_teman_2" name="nama_teman_2"
                                                                value="{{ $borang->nama_teman_2 ?? '' }}"></td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_kp_2" name="no_kp_2"
                                                                value="{{ $borang->no_kp_teman_2 ?? '' }}">
                                                        </td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_lesen_senjata_teman2" name="no_lesen_senjata_teman2"
                                                                value="{{ $borang->no_lesen_senjata_teman2 ?? '' }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="nama_teman_3" name="nama_teman_3"
                                                                value="{{ $borang->nama_teman_3 ?? '' }}"></td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_kp_3" name="no_kp_3"
                                                                value="{{ $borang->no_kp_teman_3 ?? '' }}">
                                                        </td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_lesen_senjata_teman3" name="no_lesen_senjata_teman3"
                                                                value="{{ $borang->no_lesen_senjata_teman3 ?? '' }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="nama_teman_4" name="nama_teman_4"
                                                                value="{{ $borang->nama_teman_4 ?? '' }}"></td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_kp_4" name="no_kp_4"
                                                                value="{{ $borang->no_kp_teman_4 ?? '' }}">
                                                        </td>
                                                        <td><input type="text" class="form-control" placeholder=""
                                                                id="no_lesen_senjata_teman4" name="no_lesen_senjata_teman4"
                                                                value="{{ $borang->no_lesen_senjata_teman4 ?? '' }}">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>9. Butir-butir senjata api yang dipegang dan ingin digunakan bagi memburu
                                                di bawah lesen
                                                yang dipohon</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Buatan *</label>
                                                <input type="text" class="form-control" placeholder="Contoh: Thailand"
                                                    id="buatan" name="buatan" value="{{ $borang->buatan_senjata_api }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ukuran Garis Pusat *</label>
                                                <input type="text" class="form-control" placeholder="Contoh: 25mm"
                                                    id="ukuran_garis_pusat" name="ukuran_garis_pusat"
                                                    value="{{ $borang->ukuran_garis_pusat }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Serial *</label>
                                                <input type="text" class="form-control" placeholder="Contoh: 112233"
                                                    id="serial" name="serial" value="{{ $borang->serial_senjata_api }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <dd>(Hanya (1) senjata api sahaja untuk (1) permohonan)</dd>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>10. Butir-butir Lesen Senjata Api</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Lesen Senjata Api *</label>
                                                <input type="text" class="form-control"
                                                    placeholder="No lesen senjata api" id="no_lesen_senjata"
                                                    name="no_lesen_senjata" value="{{ $borang->no_lesen_senjata_api }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tarikh Pengeluaran *</label>
                                                <div class="input-group date" id="tarikh_pengeluaran_div"
                                                    data-target-input="nearest">
                                                    <input type="text" name="tarikh_pengeluaran" name="tarikh_pengeluaran"
                                                        placeholder="dd/mm/yyyy" class="form-control datetimepicker-input"
                                                        data-target="#tarikh_pengeluaran_div"
                                                        value="{{ date_format(date_create($borang->tarikh_pengeluaran_senjata_api), 'd/m/Y') }}"
                                                        data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                        required>
                                                    <div class="input-group-append" data-target="#tarikh_pengeluaran_div"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tempat Pengeluaran *</label>
                                                <input type="text" class="form-control" placeholder="Contoh: Pnom Penh"
                                                    id="tempat_pengeluaran" name="tempat_pengeluaran"
                                                    value="{{ $borang->tempat_pengeluaran_senjata_api }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>11. Syarat lesen Senjata Api</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                <div class="radio">
                                                    <label><input type="radio" name="syarat_lesen_senjata" value="Sukan"
                                                            {{ $borang->syarat_lesen_senjata_api == 'Sukan' ? 'Checked' : '' }}>&nbsp;
                                                        Sukan</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="radio">
                                                    <label><input type="radio" name="syarat_lesen_senjata" value="Memburu"
                                                            {{ $borang->syarat_lesen_senjata_api == 'Memburu' ? 'Checked' : '' }}>&nbsp;
                                                        Memburu</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <dd>(Pemohon akan dikehendaki untuk mengemukanakan lesen senjata api sebelum
                                                pemberian lesen
                                                memburu
                                                & boleh dikehendaki
                                                untuk mengemukakan senjata api yang berkaitan)</dd>
                                            <dd>(Pemohon dikehendaki membawa surat kebenaran daripada pemilik tanah yang
                                                ingin diburu. Sila
                                                rujuk senarai semak
                                                dokumen bagi keterangan lanjut)</dd>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>12. Senaraikan di bawah spesies, bilangan dan kawasan yang mana lesen
                                                atau lesen-lesen
                                                diminta. *</label>
                                            <dd>(Lesen-lesen berasingan akan dikehendaki bagi kawasan berlainan jika ianya
                                                dalam kawasan
                                                memburu yang berlainan)</dd>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (in_array($borang->status_borang_id,array(3,7,8)))
                                                <button id="btnTambahSpesies12" type="button"
                                                    class="btn btn-primary btn-xs" data-toggle="modal"
                                                    data-target="#modal-tambah-spesies12"><i class="fas fa-plus"></i>
                                                    Tambah</button>
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>13. Dalam kes lesen memburu komersil, nyatakan berapa banyak haiwan
                                                ditangkap dan dengan
                                                cara apa.</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (in_array($borang->status_borang_id,array(3,7,8)))
                                                <button type="button" id="btnTambbahSpesies13"
                                                    class="btn btn-primary btn-xs" data-toggle="modal"
                                                    data-target="#modal-tambah-spesies13"><i class="fas fa-plus"></i>
                                                    Tambah</button>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered" id="tblSpesies13">
                                                <thead>
                                                    <tr>
                                                        <th style="width:50px">No</th>
                                                        <th style="width:50px">ID</th>
                                                        <th>Species</th>
                                                        <th>Bilangan Ditangkap</th>
                                                        <th>Cara Tangkapan</th>
                                                        <th>Bil. Peluru Digunakan</th>
                                                        <th style="width:70px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @forelse ($spesies_komersil as $item)
                                                        <tr>
                                                            <td class="cNo">{{ $i }}</td>
                                                            <td class="cID">{{ $item->id }}</td>
                                                            <td class="cNamaSpesies">{{ $item->spesies }}</td>
                                                            <td class="cBilanganSpesies">
                                                                {{ $item->bilangan_angka_perkataan }}</td>
                                                            <td class="cCaraTangkapan">{{ $item->cara_tangkapan }}</td>
                                                            <td class="cBilPeluru">
                                                                {{ $item->bilangan_peluru_digunakan }}</td>
                                                            <td>
                                                                @if (in_array($borang->status_borang_id,array(3,7,8)))
                                                                    <button type="button"
                                                                        class="btn btn-xs btn-warning btnEditRow13"
                                                                        data-id="{{ $item->id }}"
                                                                        data-nama_spesies="{{ $item->spesies }}"
                                                                        data-bilangan_spesies="{{ $item->bilangan_angka_perkataan }}"
                                                                        data-cara_tangkapan="{{ $item->cara_tangkapan }}"
                                                                        data-toggle="modal"
                                                                        data-target="#modal-edit-spesies13"><i
                                                                            class="fas fa-pen"></i></button>
                                                                    <button type="button"
                                                                        class="btn btn-xs btn-danger btnDeleteRow13"
                                                                        data-id="{{ $item->id }}"><i
                                                                            class="fas fa-trash"></i></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" style="text-align:center">Tiada Rekod</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="kawasan_ditangkap">Kawasan Ditangkap*</label>
                                                <input type="text" class="form-control" name="kawasan_ditangkap"
                                                    id="kawasan_ditangkap" placeholder="nama kawasan"
                                                    value="{{ $borang->kawasan_ditangkap }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Soalan EPHL</label>
                                                <select class="form-control" id="soalan_ephl_id" name="soalan_ephl_id"
                                                    required @if (Auth::user()->role == 'client') disabled @endif>
                                                    <option value="" @if (!$borang->soalan_ephl_id) selected @endif>
                                                        Pilih</option>
                                                    @foreach ($soalan_ephl as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($borang->soalan_ephl_id == $item->id) selected @endif>
                                                            {{ $item->soalan_ephl }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <label for="jawapan">Jawapan: <span class="text-red">*</span></label>
                                                <input type="text" class="form-control" id="jawapan_ephl"
                                                    name="jawapan_ephl" value="{{ $borang->jawapan_soalan_ephl }}"
                                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>"
                                                    required>
                                            </div>
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
                                                        value="{{ $tUlasanDipohon }}" disabled>
                                                    <div class="input-group-append"
                                                        data-target="#tarikh_ulasan_dipohon_div"
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
                                                <input type="text" class="form-control" placeholder="optional" id="komen"
                                                    name="komen" value="{{ $borang->komen }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="card-footer">
                                    <a href="/lesen/memburu" type="button" class="btn btn-default">Back</a>
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

                                    @if (Auth::user()->role != 'client')
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
                        </form>

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        @include('memburu.view_lesen_modals')

    </div>
    <!-- /.content-wrapper -->

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
                //Daterangepicker
                $('#tempoh_memburu').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });

                //Datepicker
                $('.date').datetimepicker({
                    format: 'DD/MM/YYYY'
                });

                $('#lesenForm').parsley();

                //Initialize Select2 Elements
                $('.select2').select2();
                $('.select2').css({
                    'padding-top': '0px',
                    'font-size': '12px'
                });
                $('.select2-selection').css('border-radius', '0px');
                $('.select2-container').children().css('border-radius', '0px');
            });

            function SaveSpecies() {
                //Convert table Species Buruan to array data
                var tableSpeciesBuruan = new Array();
                $('#tblSpesies12 tr').each(function(row, tr) {
                    tableSpeciesBuruan[row] = {
                        "id": $(tr).find('td:eq(1)').text(),
                        "spesies": $(tr).find('td:eq(2)').text(),
                        "bilangan": $(tr).find('td:eq(3)').text(),
                        "kawasan": $(tr).find('td:eq(4)').text()
                    }
                });
                tableSpeciesBuruan.shift(); // remove first row (column name)

                //Convert table Species Buruan Komersil to array data
                var tableSpeciesBuruanKomersil = new Array();
                $('#tblSpesies13 tr').each(function(row, tr) {
                    tableSpeciesBuruanKomersil[row] = {
                        "id": $(tr).find('td:eq(1)').text(),
                        "spesies": $(tr).find('td:eq(2)').text(),
                        "bilangan": $(tr).find('td:eq(3)').text(),
                        "cara_tangkapan": $(tr).find('td:eq(4)').text(),
                        "bil_peluru": $(tr).find('td:eq(5)').text()
                    }
                });
                tableSpeciesBuruanKomersil.shift(); // remove first row (column name)

                //Prepare header xsrf
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/lesen/memburu/view/postSaveSpeciesBuruan',
                    type: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        spc: tableSpeciesBuruan,
                        borang_id: $('#borang_id').val(),
                        spc_komersil: tableSpeciesBuruanKomersil
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



                //Spesies komersil
                $('#tblSpesies13 tbody').empty();
                j = 0;
                if (response.spesies2) {
                    $.each(response.spesies2, function(i, data) {
                        var editButton = '';
                        var deleteButton = '';
                        editButton = '<button type="button" class="btn btn-xs btn-warning btnEditRow13" data-id="' +
                            data.id + '"' +
                            'data-nama_spesies="' + data.spesies + '" data-bilangan_spesies="' + data
                            .bilangan_angka_perkataan + '"' +
                            'data-cara_tangkapan="' + data.cara_tangkapan + '" data-bil_peluru="' + data
                            .bilangan_peluru_digunakan +
                            '" data-toggle="modal" data-target="#modal-edit-spesies13"><i ' +
                            'class="fas fa-pen"></i></button>';
                        deleteButton = '<button type="button" class="btn btn-xs btn-danger btnDeleteRow13" data-id="' +
                            data.id + '"><i ' +
                            'class="fas fa-trash"></i></button>';

                        $('#tblSpesies13 tbody').append('<tr>' +
                            '<td class="cNo">' + (j + 1) + '</td>' +
                            '<td class="cID">' + data.id + '</td>' +
                            '<td class="cNamaSpesies">' + data.spesies + '</td>' +
                            '<td class="cBilanganSpesies">' + data.bilangan_angka_perkataan + '</td>' +
                            '<td class="cCaraTangkapan">' + data.cara_tangkapan + '</td>' +
                            '<td class="cBilPeluru">' + data.bilangan_peluru_digunakan + '</td>' +
                            '<td>' +
                            editButton + deleteButton +
                            '</td>' +
                            '</tr>');
                        j = j + 1;
                    });
                }

                if (j == 0) { //no record
                    $('#tblSpesies13 tbody').append('<tr>' +
                        '<td colspan="7" style="text-align:center">Tiada Rekod</td>' +
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
                $('#edit_nama_spesies12').val('');
                $('#edit_nama_spesies12').select2().trigger('change');
            });

            //Delete row spesies 12
            $("#tblSpesies12").on("click", ".btnDeleteRow12", function() {
                if (confirm('Anda pasti untuk delete rekod ini?')) {

                    //Get id for the clicked row
                    var recID = $(this).closest('tr').find('.cID').text();
                    if (recID) {
                        //Delete record from the database
                        DeleteRow('/lesen/memburu/view/postDeleteSpesies', recID, 'tblSpesies12');
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
                $('#edit_nama_spesies12').val('');
                $('#edit_nama_spesies12').select2().trigger('change');

                //Set recNo and recId on modal
                var recNo = $(this).closest('tr').find('.cNo').text();
                var recID = $(this).closest('tr').find('.cID').text();
                $('#editRowNo12').val(recNo);
                $('#editIDSpesies12').val(editIDSpesies12);

                //Set edit data
                //$('#edit_nama_spesies12').val($(this).closest('tr').find('.cNamaSpesies').text());
                $('#edit_nama_spesies12').val($(this).closest('tr').find('.cNamaSpesies').text());
                $('#edit_nama_spesies12').select2().trigger('change');
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

            //============================== TABLE SPESIES 13 ======================================
            //Button click event - tambah spesies 13
            $('#btnTambahSpesies13Modal').click(function(e) {
                e.preventDefault();

                $('#tambahSpesies13Form').parsley().validate();

                if ($('#nama_spesies13').val() !== '' && $('#bilangan_spesies13').val() !== '' && $('#cara_tangkapan13')
                    .val() !== '' && $('#bil_peluru13').val() !== '') {

                    //Delete first row if no record
                    $('#tblSpesies13 tr').each(function(row, tr) {
                        if ($(tr).find('td:eq(0)').text() == 'Tiada Rekod') {
                            $('#tblSpesies13 tbody').empty();
                        }
                    });

                    //get last number
                    var lastNum = $('#tblSpesies13 tr:last').find('td:eq(0)').text();
                    if (lastNum) {
                        lastNum = parseInt(lastNum) + 1;
                    } else {
                        lastNum = 1;
                    }

                    $('#tblSpesies13 tbody').append('<tr>' +
                        '<td class="cNo">' + lastNum + '</td>' +
                        '<td class="cID"></td>' +
                        '<td class="cNamaSpesies">' + $('#nama_spesies13').val() + '</td>' +
                        '<td class="cBilanganSpesies">' + $('#bilangan_spesies13').val() + '</td>' +
                        '<td class="cCaraTangkapan">' + $('#cara_tangkapan13').val() + '</td>' +
                        '<td class="cBilPeluru">' + $('#bil_peluru13').val() + '</td>' +
                        '<td>' +
                        '<button type="button" data-id="" data-nama_spesies="' + $('#nama_spesies13').val() +
                        '" data-bilangan_spesies="' + $('#bilangan_spesies13').val() + '" data-cara_tangkapan="' +
                        $('#cara_tangkapan13').val() + '" data-bil_peluru="' + $('#bil_peluru13').val() +
                        '" class="btn btn-xs btn-warning btnEditRow13" data-target="#modal-edit-spesies13" data-toggle="modal"><i class="fas fa-pen"></i></button>' +
                        '<button type="button" data-id="" class="btn btn-xs btn-danger btnDeleteRow13" data-id=""><i class="fas fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>');
                    $('#modal-tambah-spesies13').modal('hide');
                }

            });

            //Modal show event
            $('#modal-tambah-spesies13').on('show.bs.modal', function(e) {
                $('#tambahSpesies13Form').parsley().reset();
                $('#tambahSpesies13Form').trigger('reset');
                $('#nama_spesies13').val(null);
                $('#nama_spesies13').select2().trigger('change');
                $('#cara_tangkapan13').val(null);
                $('#cara_tangkapan13').select2().trigger('change');
            });

            //Delete row
            $("#tblSpesies13").on("click", ".btnDeleteRow13", function() {
                if (confirm('Anda pasti untuk delete rekod ini?')) {
                    //Get id for the clicked row
                    var recID = $(this).closest('tr').find('.cID').text();
                    if (recID) {
                        //Delete record from the database
                        DeleteRow('/lesen/memburu/view/postDeleteSpesies', recID, 'tblSpesies13');
                    }

                    $(this).closest("tr").remove();
                    if ($('#tblSpesies13 tr').length == 1) { //add tiada rekod
                        $('#tblSpesies13 tbody').append(
                            '<tr><td colspan="7" style="text-align:center">Tiada Rekod</td></tr>');
                    }
                }
            });

            //Edit row button click event
            $("#tblSpesies13").on("click", ".btnEditRow13", function() {
                $('#editSpesies13Form').parsley().reset();
                $('#editSpesies13Form').trigger('reset');
                $('#edit_nama_spesies13').val(null);
                $('#edit_nama_spesies13').select2().trigger('change');
                $('#edit_cara_tangkapan13').val(null);
                $('#edit_cara_tangkapan13').select2().trigger('change');

                //Set recNo and recId on modal
                var recNo = $(this).closest('tr').find('.cNo').text();
                var recID = $(this).closest('tr').find('.cID').text();
                $('#editRowNo13').val(recNo);
                $('#editIDSpesies13').val(editIDSpesies12);

                //Set edit data
                //$('#edit_nama_spesies13').val($(this).closest('tr').find('.cNamaSpesies').text());
                $('#edit_nama_spesies13').val($(this).closest('tr').find('.cNamaSpesies').text());
                $('#edit_nama_spesies13').select2().trigger('change');
                $('#edit_bilangan_spesies13').val($(this).closest('tr').find('.cBilanganSpesies').text());
                $('#edit_cara_tangkapan13').val($(this).closest('tr').find('.cCaraTangkapan').text());
                $('#edit_cara_tangkapan13').select2().trigger('change');
                $('#edit_bil_peluru13').val($(this).closest('tr').find('.cBilPeluru').text());
            });

            //Edit event (set edit modal value)
            $('#btnEditSpesies13Modal').click(function() {
                $('#tblSpesies13 tr').each(function(row, tr) {
                    if ($(tr).find('td:eq(0)').text() == $('#editRowNo13').val()) {
                        $(tr).find('td:eq(2)').text($('#edit_nama_spesies13').val());
                        $(tr).find('td:eq(3)').text($('#edit_bilangan_spesies13').val());
                        $(tr).find('td:eq(4)').text($('#edit_cara_tangkapan13').val());
                        $(tr).find('td:eq(5)').text($('#edit_bil_peluru13').val());
                        return;
                    }
                });
                $('#modal-edit-spesies13').modal('hide');
            });
            //========================================== END OF TABLE SPESIES 13 =========================================

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
                        borang_id: {!! $borang_id !!}
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
                            $("#soalan_ephl_id").prop("disabled", false);

                            $('.loader').show();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                url: '/lesen/memburu/view/postSaveSubmit',
                                type: 'post',
                                data: $('#lesenForm').serialize() + '&soalan_ephl_id=' + $('#soalan_ephl_id')
                                    .val(),
                                dataType: 'JSON',
                                success: function(response) {
                                    if (response.result == 'success') {
                                        $('#lesenForm').parsley().reset();
                                        //Save species buruan. no 12 & 13
                                        SaveSpecies();
                                        $('.loader').hide();
                                        //alert('Borang berjaya dihantar!');
                                        window.location.href = "/lesen/memburu";
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
            //Save as Draft
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

                /* //Validate tempoh sah memburu (sambung ke save sumbit..)
                if($('#tarikh_mula_memburu').val() && $('#tarikh_tamat_memburu').val()){
                    t_mula = formatDate($('#tarikh_mula_memburu').val(),'');
                    t_tamat = formatDate($('#tarikh_tamat_memburu').val(),'');

                    //validate range
                    if(checkDateRange(t_mula,t_tamat)==false){
                        $('#tarikh_tamat_memburu').val(null);
                        proceed = 'No';
                    }
                } */

                if (proceed == 'No') {
                    return;
                } else {
                    if ($('#lesenForm').parsley().isValid()) {
                        //Enable fields
                        $("#nama_penuh").prop("disabled", false);
                        $("#no_kp").prop("disabled", false);
                        $("#soalan_ephl_id").prop("disabled", false);

                        $('.loader').show();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: '/lesen/memburu/view/postSaveDraft',
                            type: 'post',
                            data: $('#lesenForm').serialize() + '&soalan_ephl_id=' + $('#soalan_ephl_id').val(),
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.result == 'success') {
                                    $('#lesenForm').parsley().reset();
                                    //Save species buruan. no 12 & 13
                                    SaveSpecies();
                                    $('.loader').hide();
                                    //alert('Borang berjaya dihantar!');
                                    window.location.href = "/lesen/memburu";
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
                        url: "/lesen/memburu/view/postSahkan",
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
                                window.location.href = "/lesen/memburu";
                            } else {
                                alert("Error");
                            }
                        }
                    });
                }
            });

            //Kembalikan borang (untuk admin dan normal user)
            $('#btnKembalikan').click(function(e) {
                e.preventDefault();
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
                            url: "/lesen/memburu/view/postKembalikan",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                borang_id: $('#borang_id').val(),
                                return_remark: comment,
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.result == 'success') {
                                    window.location.href = "/lesen/memburu";
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
                        url: "/lesen/memburu/view/postApprove",
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
                                window.location.href = "/lesen/memburu";
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
                        url: "/lesen/memburu/view/postReject",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            borang_id: $('#borang_id').val(),
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.result == 'success') {
                                window.location.href = "/lesen/memburu";
                            } else {
                                alert("Error");
                            }
                        }
                    });
                }
            });

            //Periksa jika kawasan yang dipilih adalah larangan
            $('#edit_nama_kawasan12').on('input', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "/lesen/memburu/view/postCheckKawasan",
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
            $('#nama_kawasan12').on('input', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "/lesen/memburu/view/postCheckKawasan",
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
