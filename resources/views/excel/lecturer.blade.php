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
        <td>Nidn</td>
        <td>Fakultas</td>
        <td>Gender</td>
        <td>Telp</td>
        <td>Email</td>
            {{-- 6 --}}
            <td>Kebutuhan untuk studi lanjut</td>
            <td>Pengembangan diri untuk mengikuti kursus/pelatihan</td>
            <td>Pengembangan diri mengikuti seminar/workshop</td>
            <td>Pengembangan diri mengikuti magang</td>
            <td>Kesempatan untuk mengikuti studi banding dalam negeri</td>
            <td>Kesempatan untuk mengikuti studi banding luar negeri</td>

            {{-- 7 --}}
            <td>Mendapatkan informasi tentang jenjang karir</td>
            <td>Mendapatkan layanan tentang jenjang karir</td>
            <td>Memproleh kesempatan untuk peningkata jenjang karir</td>
            <td>Mendapatkan informasi tentang jabatan</td>
            <td>Mendapatkan layanan tentang jabatan</td>
            <td>Memproleh kesempatan untuk peningkatan jabatan struktural</td>
            <td>Memproleh kesempatan untuk peningkatan jabatan nonstruktural</td>

            {{-- 9 --}}
            <td>Fasilitas memperoleh informasi tentang kegiatan penelitian</td>
            <td>Fasilitas memperoleh pelayanan untuk melakukan kegiatan penelitian</td>
            <td>Ketersediaan sarana prasarana pendukung kegiatan penelitian</td>
            <td>Memperoleh penilaian proposal penelitian dari reviewer</td>
            <td>Memperoleh pemerataan penelitian berdasarkan distribusi dosen</td>
            <td>Memperoleh pemerataan penelitian berdasarkan kualifikasi dosen</td>
            <td>Memperoleh kesempatan bimbingan penyusunan proposal penelitian dan laporan akhir</td>
            <td>Kesempatan menjadi reviewer penelitian</td>
            <td>Ketersediaan informasi jurnal terakreditasi sebagai media publikasi karya ilmiah</td>

            {{-- 7 --}}
            <td>Fasilitas memperoleh informasi tentang kegiatan pengabdian kepada masyarakat.</td>
            <td>Fasilitas memperoleh pelayanan untuk melakukan kegiatan pengabdian kepada masyarakat.</td>
            <td>Ketersediaan sarana prasarana pendukung kegiatan pengabdian kepada masyarakat.</td>
            <td>Memperoleh penilaian proposal pengabdian kepada masyarakat dari reviewer</td>
            <td>Memperoleh pemerataan pengabdian kepada masyarakat berdasarkan distribusi dosen</td>
            <td>Memperoleh pemerataan pengabdian kepada masyarakat berdasarkan kualifikasi dosen</td>
            <td>Memperoleh kesempatan bimbingan penyusunan proposal pengabdian kepada masyarakat dan laporanakhir</td>

            {{-- 6 --}}
            <td>Mendapatkan informasi tentang tugas tambahan (kepanitiaan, narasumber, keanggotaan suatu unit, dan lain-lain)</td>
            <td>Mendapatkan kesempatan dalam tugas tambahan</td>
            <td>Memperoleh pemerataan dalam mendapatkan tugas tambahan</td>
            <td>Kesempatan untuk mewakili menjadi utusan badan normatif ditingkat fakultas</td>
            <td>Kesempatan untuk mewakili menjadi utusan badan normatif di tingkat universitas</td>
            <td>Mendapatkan tugas tambahan mengajar di luar home base</td>

            {{-- 3 --}}
            <td>Memperoleh informasi tentang berbagai fasilitas kesejahteraan (seperti: mess, kendaraan dan lain-lain).</td>
            <td>Memperoleh layanan penggunaan fasilitas pendukung untuk rekreasi seperti Mess dan mobil/bus universitas</td>
            <td>Pemberian penghargaan atas prestasi kerja yang baik</td>

            {{-- 3 --}}
            <td>Memperoleh informasi tentang layanan kesehatan</td>
            <td>Memperoleh layanan pemeriksaan kesehatan oleh dokter melalui poliklinik universitas</td>
            <td>Memperoleh layanan peningkatan kebugaran jasmani melalui sarana prasarana olahraga</td>
            
            {{-- 3 --}}
            <td>Memperoleh layanan kebutuhan sosial</td>
            <td>Menggunakan fasilitas untuk melakukan ibadah</td>
            <td>Memperoleh layanan kematian seperti mobil jenazah</td>
  
      </tr>
    </thead>
    <tbody>
      @php
        $answers = App\Models\LqAnswer::select('lecturer_id')->groupBy('lecturer_id')->get()->toArray();

      @endphp

      @foreach ($answers as $key => $std)
          @php
              $lecturer = App\Models\Lecturer::where('id', $std)->first();
              $answer  = App\Models\LqAnswer::where('lecturer_id', $std)->get();
          @endphp
                <tr>
                  <td>{{ $lecturer->filled }}</td>
                  <td>{{ $lecturer->name }}</td>
                  <td>{{ $lecturer->nidn }}</td>
                  <td>{{ $lecturer->faculty }}</td>
                  <td>{{ $lecturer->gender == 1 ? 'pria' : 'wanita' }}</td>
                  <td>{{ $lecturer->phone }}</td>
                  <td>{{ $lecturer->email }}</td>
                    @foreach ($answer as $ans)
                    <td>{{ $ans->answer }}</td>
                    @endforeach
                </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="7" style="text-align: right">Nilai perkategori:</td>
          <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat1, 2, '.', '') }}</td>
          <td colspan="7" style="text-align: center">{{ number_format((float)$avg_cat2, 2, '.', '') }}</td>
          <td colspan="9" style="text-align: center">{{ number_format((float)$avg_cat3, 2, '.', '') }}</td>
          <td colspan="7" style="text-align: center">{{ number_format((float)$avg_cat4, 2, '.', '') }}</td>
          <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat5, 2, '.', '') }}</td>
          <td colspan="3" style="text-align: center">{{ number_format((float)$avg_cat6, 2, '.', '') }}</td>
          <td colspan="3" style="text-align: center">{{ number_format((float)$avg_cat7, 2, '.', '') }}</td>
          <td colspan="3" style="text-align: center">{{ number_format((float)$avg_cat8, 2, '.', '') }}</td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: right">Presentase:</td>
        <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat1 / 4  * 100, 2, '.', '') }}</td>
        <td colspan="7" style="text-align: center">{{ number_format((float)$avg_cat2 / 4  * 100, 2, '.', '') }}</td>
        <td colspan="9" style="text-align: center">{{ number_format((float)$avg_cat3 / 4  * 100, 2, '.', '') }}</td>
        <td colspan="7" style="text-align: center">{{ number_format((float)$avg_cat4 / 4  * 100, 2, '.', '') }}</td>
        <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat5 / 4  * 100, 2, '.', '') }}</td>
        <td colspan="3" style="text-align: center">{{ number_format((float)$avg_cat6 / 4  * 100, 2, '.', '') }}</td>
        <td colspan="3" style="text-align: center">{{ number_format((float)$avg_cat7 / 4  * 100, 2, '.', '') }}</td>
        <td colspan="3" style="text-align: center">{{ number_format((float)$avg_cat8 / 4  * 100, 2, '.', '') }}</td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: right">Nilai keseluruhan:</td>
        <td>{{ number_format((float)$avg, 2, '.', '') }}</td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: right">Presentase:</td>
        <td>{{ number_format((float)$avg / 4 * 100, 2, '.', '') }}</td>
      </tr>
    </tfoot>
  </table>
</body>
</html>