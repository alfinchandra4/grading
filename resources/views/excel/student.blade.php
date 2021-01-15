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
  
        <td>Ruang kuliah yang bersih, nyaman dan rapi</td>
        <td>Fakultas Ilmu Komputer menyediakan sarana pembelajaran yang memadai di ruang kuliah.</td>
        <td>Fakultas Ilmu Komputer memiliki perpustakaan yang memadai</td>
        <td>Fakultas Ilmu Komputer memiliki laboratorium yang relevan dengan kebutuhan kompetensi keilmuan</td>
        <td>Fakultas Ilmu Komputer menyediakan buku referensi yang memadai di perpustakaan</td>
        <td>Fakultas Ilmu Komputer menyediakan fasilitas kamar kecil yang bersih</td>
        <td>Fakultas Ilmu Komputer memiliki fasilitas ibadah yang dapat dipergunakan oleh mahasiswa</td>
  
        <td>Dosen selalu mengulang materi perkuliahan sampai semua mahasiswa merasa jelas</td>
        <td>Dosen mengalokasikan waktu untuk diskusi dan tanya jawab</td>
        <td>Dosen memberi bahan ajar (suplemen) untuk melengkapi materi yang diberikan di Fakultas Ilmu Komputer</td>
        <td>Dosen selalu membagikan hasil ujian dengan nilai yang obyektif</td>
        <td>Dosen selalu datang tepat waktu</td>
        <Td>Jumlah dosen memadai (sesuai dengan bidang keahlian dan jumlahnya)</Td>
        <td>Dosen selalu membuat Rencana Pembelajaran Semester (RPS)</td>
        <td>Staf Akademik memiliki kemampuan untuk melayani kepentingan mahasiswa</td>
  
        <td>Fakultas Ilmu Komputer menyediakan dosen Pembimbing Akademi bagi mahasiswa</td>
        <td>Pelaksanaan ujian (UTS dan UAS) sesuai kalender akademik yang telah ditetapkan (tepat waktu</td>
        <td>Pembelajaran sesuai dengan waktu yang telah ditentukan</td>
        <td>Fakultas Ilmu Komputer menyediakan bantuan (keringanan) bagi mahasiswa tidak mampu</td>
        <td>Fakultas Ilmu Komputer selalu membantu mahasiswa apabila menghadapi masalah akademik</td>
        <td>Fakultas Ilmu Komputer menyediakan waktu khusus untuk orang tua mahasiswa untuk konsultasi</td>
  
        <td>Staf Akademik santun dalam melakukan pelayanan akademik</td>
        <td>Permasalahan/keluhan mahasiswa selalu ditangani oleh Fakultas Ilmu Komputer melalui dosen Pembimbing Akademik</td>
        <td>Setiap tugas kuliah selalu dikembalikan pada mahasiswa</td>
        <td>Waktu dipergunakan secara efektif oleh dosen dalam proses pengajaran</td>
        <td>Adanya sanksi bagi mahasiswa yang melanggar peraturan yang telah ditetapkan dan berlaku untuk semua mahasiswa tanpa terkecual</td>
  
        <td>Fakultas Ilmu Komputer selalu berusaha memahami kepentingan dan kesulitan mahasiswa</td>
        <td>Besarnya kontribusi biaya (sumbangan pengembangan institusi) dibicarakan dengan orang tua/wali mahasiswa</td>
        <td>Fakultas Ilmu Komputer selalu memonitor terhadap kemajuan mahasiswa melalui dosen Pembimbing Akademik</td>
        <td>Dosen bersedia membantu mahasiswa yang mengalami kesulitan studi</td>
        <td>Dosen bersikap bersahabat kepada mahasiswa</td>
        <td>Fakultas Ilmu Komputer berusaha memahami minat dan bakat mahasiswa dan berusaha untuk mengembangkannya</td>
  
      </tr>
    </thead>
    <tbody>
      @php
        $answers = App\Models\SqAnswer::select('student_id')->groupBy('student_id')->get()->toArray();

      @endphp

      @foreach ($answers as $key => $std)
          @php
              $student = App\Models\Student::where('id', $std)->first();
              $answer  = App\Models\SqAnswer::where('student_id', $std)->get();
          @endphp
                <tr>
                  <td>{{ $student->filled }}</td>
                  <td>{{ $student->name }}</td>
                  <td>{{ $student->nim }}</td>
                  <td>{{ $student->faculty }}</td>
                  <td>
                    @switch($student->major)
                        @case(1) S1 Sistem Informasi   @break
                        @case(2) S1 Teknik Informatika @break
                        @case(3) D3 Sistem Informasi   @break
                    @endswitch
                  </td>
                  <td>{{ $student->generation }}</td>
                  <td>{{ $student->gender == 1 ? 'pria' : 'wanita' }}</td>
                  <td>{{ $student->phone }}</td>
                  <td>{{ $student->email }}</td>
                    @foreach ($answer as $ans)
                    <td>{{ $ans->answer }}</td>
                    @endforeach
                </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="9" style="text-align: right">Nilai perkategori:</td>
          <td colspan="7" style="text-align: center">{{ number_format((float)$avg_cat1, 2, '.', '') }}</td>
          <td colspan="8" style="text-align: center">{{ number_format((float)$avg_cat2, 2, '.', '') }}</td>
          <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat3, 2, '.', '') }}</td>
          <td colspan="5" style="text-align: center">{{ number_format((float)$avg_cat4, 2, '.', '') }}</td>
          <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat5, 2, '.', '') }}</td>
      </tr>
      <tr>
        <td colspan="9" style="text-align: right">Presentase:</td>
          <td colspan="7" style="text-align: center">{{ number_format((float)$avg_cat1 / 4  * 100, 2, '.', '') }}</td>
          <td colspan="8" style="text-align: center">{{ number_format((float)$avg_cat2 / 4  * 100, 2, '.', '') }}</td>
          <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat3 / 4  * 100, 2, '.', '') }}</td>
          <td colspan="5" style="text-align: center">{{ number_format((float)$avg_cat4 / 4  * 100, 2, '.', '') }}</td>
          <td colspan="6" style="text-align: center">{{ number_format((float)$avg_cat5 / 4  * 100, 2, '.', '') }}</td>
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