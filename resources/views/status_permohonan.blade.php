<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SLP-JHL | Status Permohonan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <b>SLP</b>JHL
        </div>

        <!-- User name -->
        <div class="lockscreen-name">Semak Keputusan Permohonan Lesen (Memburu/Tumbuhan)</div>

        <br>
        <div id="keputusan_memburu" style="display: none">
        
        </div>
        <div id="keputusan_tumbuhan" style="display: none">
        
        </div>
        <br>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="{{url('img/smart-card-96.png')}}" alt="Check Image">
            </div>
            <!-- /.lockscreen-image -->            

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials" id="search_form">
                @csrf
                <div class="input-group">
                    <input type="text" id="ic_number" name="ic_number" class="form-control" placeholder="Cth: 8409125327">
            
                    <div class="input-group-append">
                        <button id="btnSearch" type="button" class="btn">
                            <i class="fas fa-arrow-right text-muted"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Masukkan nombor kad pengenalan anda
        </div>
        <div class="text-center">
            <a href="/">atau login ke sistem SLP-JHL</a>
        </div>
        <div class="lockscreen-footer text-center">
            Copyright &copy; 2020 <b><a href="#" class="text-black">Jabatan Hidupan Liar, Sabah</a></b><br>
            All rights reserved
        </div>
    </div>
    <!-- /.center -->

    <!-- jQuery -->
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>

<script>
    $(function(){
        $('#btnSearch').click(function(e){
            e.preventDefault();
            $('#keputusan_memburu').hide();
            $('#keputusan_tumbuhan').hide();
            if($('#ic_number').val()){
                submitForm();
            }else{
                alert("Sila masukkan nombor kad pengenalan anda dan klik butang anak panah (Arrow Button)");
            }
        });

        function submitForm(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                url: '/permohonan/semak/postGetInfo',
                type: 'post',
                data: {_token: $('meta[name="csrf-token"]').attr('content'),p_data: $('#ic_number').val()},
                dataType: 'JSON',
                success: function (response) {
                    if(response.lesen_memburu || response.lesen_tumbuhan){                         
                        //Show type of alert based on keputusan memburu  
                         if(response.lesen_memburu){    
                           if(response.lesen_memburu.status_borang_id==2){//Dalam Proses
                            $('#keputusan_memburu').html('<div class="alert alert-info"><h4><i class="icon fa fa-info"></i> Sedang Diproses!</h4>'+
                            'Permohonan <b><u>lesen memburu</u></b> anda sedang diproses dan diperiksa. Terima kasih.</div>');
                            $('#keputusan_memburu').show();
                          }else if(response.lesen_memburu.status_borang_id==3){//Dikembalikan
                            $('#keputusan_memburu').html('<div class="alert alert-warning"><h4><i class="icon fa fa-info"></i> Dikembalikan!</h4>'+
                            'Permohonan <b><u>lesen memburu</u></b> anda telah dikembalikan untuk tindakan anda. Sila login dan kemaskini permohonan. Terima kasih.</div>');
                            $('#keputusan_memburu').show();
                          }else if(response.lesen_memburu.status_borang_id==4){//Disahkan
                            $('#keputusan_memburu').html('<div class="alert alert-info"><h4><i class="icon fa fa-info"></i> Disahkan!</h4>'+
                            'Permohonan <b><u>lesen memburu</u></b> anda telah disahkan dan masih dalam proses penilaian. Terima kasih.</div>');
                            $('#keputusan_memburu').show();
                          }else if(response.lesen_memburu.status_borang_id==5){//Lulus
                            $('#keputusan_memburu').html('<div class="alert alert-success"><h4><i class="icon fa fa-check"></i> Lulus!</h4>'+
                            'Permohonan <b><u>lesen memburu</u></b> anda berjaya. Sila datang ke pejabat JHL untuk mendapatkan maklumat lanjut. Terima kasih.</div>');
                            $('#keputusan_memburu').show();
                          }else if(response.lesen_memburu.status_borang_id==6){//Tidak Berjaya
                            $('#keputusan_memburu').html('<div class="alert alert-danger"><h4><i class="icon fa fa-info"></i> Tidak Berjaya!</h4>'+
                            'Maaf, permohonan <b><u>lesen memburu</u></b> anda tidak berjaya. Sila hubungi pejabat JHL di mana anda memohon untuk maklumat lanjut.</div>');
                            $('#keputusan_memburu').show();
                          }else{//Tiada Data
                            $('#keputusan_memburu').html('<div class="alert alert-danger"><h4><i class="icon fa fa-info"></i> Tiada Maklumat Permohonan!</h4>'+
                            'Jenis Lesen: Lesen Memburu</div>');
                            $('#keputusan_memburu').show();
                          }                            
                        } 
                        if(response.lesen_tumbuhan){
                          //Show type of alert based on keputusan tumbuhan
                          if(response.lesen_tumbuhan){    
                            if(response.lesen_tumbuhan.status_borang_id==2){//Dalam Proses
                              $('#keputusan_tumbuhan').html('<div class="alert alert-info"><h4><i class="icon fa fa-info"></i> Sedang Diproses!</h4>'+
                              'Permohonan <b><u>lesen pungutan tumbuhan</u></b> anda sedang diproses dan diperiksa. Terima kasih.</div>');
                              $('#keputusan_tumbuhan').show();
                            }else if(response.lesen_tumbuhan.status_borang_id==3){//Dikembalikan
                              $('#keputusan_tumbuhan').html('<div class="alert alert-warning"><h4><i class="icon fa fa-info"></i> Dikembalikan!</h4>'+
                              'Permohonan <b><u>lesen pungutan tumbuhan</u></b> anda telah dikembalikan untuk tindakan anda. Sila login dan kemaskini permohonan. Terima kasih.</div>');
                              $('#keputusan_tumbuhan').show();
                            }else if(response.lesen_tumbuhan.status_borang_id==4){//Disahkan
                              $('#keputusan_tumbuhan').html('<div class="alert alert-info"><h4><i class="icon fa fa-info"></i> Disahkan!</h4>'+
                              'Permohonan <b><u>lesen pungutan tumbuhan</u></b> anda telah disahkan dan masih dalam proses penilaian. Terima kasih.</div>');
                              $('#keputusan_tumbuhan').show();
                            }else if(response.lesen_tumbuhan.status_borang_id==5){//Lulus
                              $('#keputusan_tumbuhan').html('<div class="alert alert-success"><h4><i class="icon fa fa-check"></i> Lulus!</h4>'+
                              'Permohonan <b><u>lesen pungutan tumbuhan</u></b> anda berjaya. Sila datang ke pejabat JHL untuk mendapatkan maklumat lanjut. Terima kasih.</div>');
                              $('#keputusan_tumbuhan').show();
                            }else if(response.lesen_tumbuhan.status_borang_id==6){//Tidak Berjaya
                              $('#keputusan_tumbuhan').html('<div class="alert alert-danger"><h4><i class="icon fa fa-info"></i> Tidak Berjaya!</h4>'+
                              'Maaf, permohonan <b><u>lesen pungutan tumbuhan</u></b> anda tidak berjaya. Sila hubungi pejabat JHL di mana anda memohon untuk maklumat lanjut.</div>');
                              $('#keputusan_tumbuhan').show();
                            }else{//Tiada Data
                              $('#keputusan_tumbuhan').html('<div class="alert alert-danger"><h4><i class="icon fa fa-info"></i> Tiada Maklumat Permohonan!</h4>'+
                              'Jenis Lesen: Lesen Pungutan Tumbuhan</div>');
                              $('#keputusan_tumbuhan').show();
                            } 
                          }
                        }

                        //Jika kedua-dua jenis lesen tiada dalam status ini (Fix error)
                        var statusSah = [2,3,4,5,6];
                        if(statusSah.indexOf(response.lesen_memburu.status_borang_id) !== -1 && statusSah.indexOf(response.lesen_tumbuhan.status_borang_id) == -1){
                          //lesen tumbuhan is null, just show lesen memburu
                          $('#keputusan_tumbuhan').hide();
                        }else if(statusSah.indexOf(response.lesen_memburu.status_borang_id) == -1 && statusSah.indexOf(response.lesen_tumbuhan.status_borang_id) !== -1){
                          //lesen memburu is null, just show lesen tumbuhan
                          $('#keputusan_memburu').hide();
                        }else if(statusSah.indexOf(response.lesen_memburu.status_borang_id) == -1 && statusSah.indexOf(response.lesen_tumbuhan.status_borang_id) == -1){
                          //lesen tumbuhan and lesen memburu is null, just show lesen memburu div for error
                          $('#keputusan_memburu').html('<div class="alert alert-danger"><h4><i class="icon fa fa-info"></i> Tiada Maklumat Permohonan!</h4></div>');
                          $('#keputusan_memburu').show();
                          $('#keputusan_tumbuhan').hide();
                        }else{
                          //both not null, let all alert appear. do nothing here...
                        }
                    }else{
                        //show error notification
                        $('#keputusan_memburu').html('<div class="alert alert-danger"><h4><i class="icon fa fa-info"></i> Tiada Maklumat Permohonan!</h4></div>');
                        $('#keputusan_memburu').show();
                    }
                }
            });
        }
    });
</script>