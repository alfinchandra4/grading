<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <table>
    <thead>
      <tr>
        <td>Timestamp</td>
        <td>Nama</td>
        <td>Nim</td>
        <td>Fakultas</td>
        <td>Jurusan</td>
        <td>Angkatan</td>
        <td>Gender</td>
        <td>Telp</td>
        <td>Email</td>
  
        <td>Integritas (etika dan moral)</td>
        <td>Keahlian pada bidang ilmu (kompetensi utama)</td>
        <td>Keluasan wawasan antardisiplin ilmu</td>
        <td>Kepemimpinan</td>
        <td>Kerja sama dalam tim</td>
        <td>Kemampuan berbahasa asing</td>
        <td>Kemampuan berkomunikasi</td>
        <td>Penggunaan teknologi informasi</td>
        <td>Pengembangan diri</td>

        <td>Kemampuan dan kerja lulusan Fakultas Ilmu Komputer UPN “Veteran” Jakarta di tempat kerja</td>
        <td>Kemandirian lulusan Fakultas Ilmu Komputer UPN “Veteran” Jakarta</td>
        <td>Kompetensi lulusan UPN “Veteran” Jakarta untuk bersaing di dunia usaha maupun dunia industri saat ini</td>
        <td>Kualitas UPN “Veteran” Jakarta dalam meningkatkan kemampuan, keterampilan dan kemandirian alumni Fakultas Ilmu Komputer UPN “Veteran” Jakarta</td>

        <td>Perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi yang dialami dunia usaha dan dunia industri pada masa lalu</td>
        <td>Pengetahuan tentang perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi dunia usaha dan dunia industri</td>
        <td>Kemampuan menerapkan teori perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi dalam kasus yang dihadapi.</td>
        <td>Kemampuan dalam melakukan identifikasi permasalahan dan pemecahan permasalahan melalui data-data yang akurat</td>
        <td>Kemampuan dalam membuat konsep perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi.</td>
  
      </tr>
    </thead>
    <tbody>
      @php
        $answers = App\Models\AqAnswer::select('alumni_id')->groupBy('alumni_id')->get()->toArray();

      @endphp

      @foreach ($answers as $key => $std)
          @php
              $alumni = App\Models\Alumni::where('id', $std)->first();
              $answer  = App\Models\AqAnswer::where('alumni_id', $std)->get();
          @endphp
                <tr>
                  <td>{{ $alumni->filled }}</td>
                  <td>{{ $alumni->name }}</td>
                  <td>{{ $alumni->nim }}</td>
                  <td>{{ $alumni->faculty }}</td>
                  <td>
                    @switch($alumni->major)
                        @case(1) S1 Sistem Informasi   @break
                        @case(2) S1 Teknik Informatika @break
                        @case(3) D3 Sistem Informasi   @break
                    @endswitch
                  </td>
                  <td>{{ $alumni->generation }}</td>
                  <td>{{ $alumni->gender == 1 ? 'pria' : 'wanita' }}</td>
                  <td>{{ $alumni->phone }}</td>
                  <td>{{ $alumni->email }}</td>
                    @foreach ($answer as $ans)
                    <td>{{ $ans->answer }}</td>
                    @endforeach
                </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="9" style="text-align: right">Nilai perkategori:</td>
          <td colspan="9" style="text-align: center">{{ number_format((float)$avg_cat1, 2, '.', '') }}</td>
          <td colspan="4" style="text-align: center">{{ number_format((float)$avg_cat2, 2, '.', '') }}</td>
          <td colspan="5" style="text-align: center">{{ number_format((float)$avg_cat3, 2, '.', '') }}</td>
      </tr>
      <tr>
        <td colspan="9" style="text-align: right">Presentase:</td>
          <td colspan="9" style="text-align: center">{{ number_format((float)$avg_cat1 / 4  * 100, 2, '.', '') }}</td>
          <td colspan="4" style="text-align: center">{{ number_format((float)$avg_cat2 / 4  * 100, 2, '.', '') }}</td>
          <td colspan="5" style="text-align: center">{{ number_format((float)$avg_cat3 / 4  * 100, 2, '.', '') }}</td>
      </tr>
      <tr>
        <td colspan="9" style="text-align: right">Nilai keseluruhan:</td>
        <td>{{ number_format((float)$avg, 2, '.', '') }}</td>
      </tr>
      <tr>
        <td colspan="9" style="text-align: right">Presentase:</td>
        <td>{{ number_format((float)$avg / 4 * 100, 2, '.', '') }}</td>
      </tr>
    </tfoot>
  </table>
</body>
</html>