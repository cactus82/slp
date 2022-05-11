<!DOCTYPE html>
<html>
<head>
<title>Permit Membawa Masuk</title>
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

<p class="center-align"><span class="times-roman">BORANG 25</span><br class="times-roman">
<span class="times-roman">(Peraturan 50(1))</span></p>
<p class="times-roman-center">NEGERI SABAH</p>
<p class="times-roman-center">ENAKMEN PEMELIHARAAN HIDUPAN LIAR 1997</p>
<p class="times-roman-center">PERMIT UNTUK MEMBAWA MASUK HAIWAN DLL. DARI NEGERI</p>
<p class="times-roman-center">(Tidak boleh dipindah milik)</p>
<p class="times-roman-center">Nombor Permit <span class="underline">{{$no_permit}}</span></p>
<p>&nbsp;</p>
<p class="left-align">(Nama &amp; No. Kad Pengenalan) <span class="underline">&nbsp;{{$nama ?? ''}}&nbsp;({{$ic ?? ''}})&nbsp;</span>
    beralamat di (Alamat &amp; No. Telefon) <span class="underline">&nbsp;{{$alamat ?? ''}}&nbsp;({{$no_tel ?? ''}})&nbsp;</span>
    adalah dibenarkan untuk membawa masuk ke dalam Negeri haiwan/hasil
    haiwan/ tumbuhan/ hasil tumbuhan yang disenaraikan dalam Jadual di bawah setelah memuaskan hati
    Pengarah Hidupan Liar bahawa haiwan/ hasil haiwan/ tumbuhan/ hasil tumbuhan itu di bawa masuk
    menurut Enakmen Pemeliharaan Hidupan Liar 1997 dan Konvensyen Perdagangan Antarabangsa Spesies
    Terancam Fauna dan Flora Liar (CITES) dan bahawa dalam kes haiwan hidup kemudahan-kemudahan yang
    wajar dan mencukupi akan disediakan bagi penjagaan haiwan tersebut.
    </p>
    <p class="left-align">&nbsp;</p>
    <p class="center-align">JADUAL</p>
    @if ($listHidup)
        <p class="left-align">Haiwan / tumbuhan hidup:</p>
        <table align="center" style="width: 80%">
            <tr>
                <td><span class="underline">Spesis</span></td>
                <td align="center"><span class="underline">Bilangan bagi tiap-tiap jantina</span></td>
            </tr>

            @foreach ($listHidup as $v)
                <tr>
                    <td>{{$v->spesis}}</td>
                    <td align="center">{{$v->bilangan}}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($listHasil)
        <p class="left-align">Hasil haiwan (bahagian atau terbitan) / tumbuhan:</p>
        <table align="center" style="width: 80%">
            <tr>
                <td><span class="underline">Jenis barang</span></td>
                <td align="center"><span class="underline">Bilangan</span></td>
            </tr>

            @foreach ($listHasil as $v)
                <tr>
                    <td>{{$v->jenis}} ({{ $v->spesis ?? '' }})</td>
                    <td align="center">{{$v->bilangan}}</td>
                </tr>
            @endforeach
        </table>
    @endif
<p class="left-align">&nbsp;</p>
<p class="left-align">Permit ini adalah sah sehingga: {{$sah_sehingga ?? ''}}</p>
<p class="left-align">Fee dibayar: RM{{$jumlah_rm ?? ''}}</p>
<p class="left-align">Tarikh (Resit Am): {{$tarikh_resit}}</p>
<p class="times-roman">&nbsp;</p>
<p class="times-roman">&nbsp;</p>
<p class="center-align">PERMIT INI TIDAK MEMERLUKAN TANDATANGAN</p>

</body>

</html>
