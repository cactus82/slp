<!DOCTYPE html>
<html>
<head>
<title>Permit Penternakan Haiwan / Penanaman Tumbuhan</title>
<style type="text/css">
.center-align {
	text-align: center;
}
.left-align {
	text-align: left;
	font-family: "Times New Roman", Times, serif;
}
.right-align {
	text-align: right;
	font-family: "Times New Roman", Times, serif;
}
.times-roman {
	font-family: "Times New Roman", Times, serif;
}
.times-roman-center {
	text-align: center;
	font-family: "Times New Roman", Times, serif;
}
.underline {
	text-decoration: underline;
}
.strikethrough {
	text-decoration: line-through;
}
</style>
</head>

<body>

<p class="center-align"><span class="times-roman">BORANG 30</span><br class="times-roman">
<span class="times-roman">(Peraturan 59)</span></p>
<p class="times-roman-center">NEGERI SABAH</p>
<p class="times-roman-center">ENAKMEN PEMELIHARAAN HIDUPAN LIAR 1997</p>
@if ($jenis=='haiwan')
<p class="times-roman-center">PERMIT PENTERNAKAN HAIWAN/<span class="strikethrough">PENANAMAN TUMBUHAN</span></p>
@else
<p class="times-roman-center"><span class="strikethrough">PERMIT PENTERNAKAN HAIWAN</span>/PENANAMAN TUMBUHAN</p>
@endif
<p class="times-roman-center">(Tidak boleh dipindah milik)</p>
<p class="times-roman-center">Nombor Permit <span class="underline">{{$no_permit}}</span></p>
<p>&nbsp;</p>
<p class="left-align">(Nama &amp; No. Kad Pengenalan) <span class="underline">&nbsp;{{$nama ?? ''}}&nbsp;({{$ic ?? ''}})&nbsp;</span>
    beralamat di (Alamat &amp; No. Telefon) <span class="underline">&nbsp;{{$alamat ?? ''}}&nbsp;({{$no_tel ?? ''}})&nbsp;</span>
    dengan ini dibenarkan untuk menjalankan perniagaan
    @if ($jenis == 'haiwan')
        penternakan haiwan / <span class="strikethrough">penanaman tumbuhan</span>
        * di (tempat penternakan haiwan / <span class="strikethrough">penanaman tumbuhan</span> *)
        <span class="underline">&nbsp;{{$alamat_penternakan_penanaman ?? ''}}&nbsp;</span>
        berhubung dengan haiwan / <span class="strikethrough">tumbuhan</span> * berikut:
    @else
        <span class="strikethrough">penternakan haiwan</span> / penanaman tumbuhan
        * di (tempat <span class="strikethrough">penternakan haiwan</span> / penanaman tumbuhan *)
        <span class="underline">&nbsp;{{$alamat_penternakan_penanaman ?? ''}}&nbsp;</span>
        berhubung dengan <span class="strikethrough">haiwan</span> / tumbuhan * berikut:
    @endif
    </p>
    <p class="left-align">&nbsp;</p>

    <table align="center" style="width: 50%">
        <tr>
            <td style="width: 48px"><span class="underline">No</span></td>
            <td style="width: 185px"><span class="underline">Spesis</span></td>
            <td><span class="underline">Bilangan</span></td>
        </tr>

        @foreach ($list as $v)
            <tr>
                <td style="width: 48px">{{$loop->iteration}}</td>
                <td style="width: 185px">{{$v->spesis}}</td>
                <td>{{$v->bilangan_kuantiti}}</td>
            </tr>
        @endforeach
    </table>

<p class="left-align">&nbsp;</p>
<p class="left-align">Permit ini adalah sah sehingga: {{$sah_sehingga ?? ''}}</p>
<p class="left-align">Fee dibayar: RM{{$jumlah_rm ?? ''}}</p>
<p class="left-align">Tarikh (Resit Am): {{$tarikh_resit}}</p>
<p class="times-roman">&nbsp;</p>
<p class="times-roman">&nbsp;</p>
<p class="center-align">PERMIT INI TIDAK MEMERLUKAN TANDATANGAN</p>

</body>

</html>
