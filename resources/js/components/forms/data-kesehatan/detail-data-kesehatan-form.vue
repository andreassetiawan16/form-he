<template>
  <div class="container-fluid">

    <section v-if="data.peserta">
      <div class="head-content-section">
        <h3>Data Kesehatan {{ data.peserta.nama }}</h3>
        <a :href="urlEditKesehatan + data.id + '/edit'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">Nama</div>
        <div class="col-sm-9">: {{ data.peserta.nama }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="alamat">Alamat</label>
        </div>
        <div class="col-sm-9">: {{ data.peserta.alamat }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="jenis kelamin">Jenis Kelamin</label>
        </div>
        <div class="col-sm-9">: {{ data.peserta.jenis_kelamin }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="tinggi">Tinggi</label>
        </div>
        <div class="col-sm-9">: {{ data.peserta.tinggi }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="tempat lahir">Tempat dan Tanggal Lahir</label>
        </div>
        <div class="col-sm-9">: {{ data.peserta.tempat_lahir }}, {{ data.peserta.tanggal_lahir.substring(0, 10) }}</div>
      </div>
    </section>

    <div class="row form-group">
      <div class="col-sm-3">Tanggal He</div>
      <div class="col-sm-9">: {{ data.tanggal_he }}</div>
    </div>

    <div class="row form-group">
      <div class="col-sm-3">
        <div>Tempat HE</div>
      </div>
      <div class="col-sm-9">
        : {{data.tempat_he}}
      </div>
    </div>

    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div><b>Jenis Pemeriksaan</b></div></div>
      <div class="col-sm-3"><div class="text-center"><b>Hasil</b></div></div>
      <div class="col-sm-4"><div class="text-center"><b>Nilai Rujukan</b></div></div>
    </div>

    <!-- Bab Setiap Hari -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Bab Setiap Hari</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{data.bab_setiap_hari}} /hari</div>
      </div>
      <div class="col-sm-4"><div class="text-center">{{data.nilai_rujukan_bab_setiap_hari}} /hari</div></div>
    </div>
    <!-- Bab Setiap Hari -->

    <!-- Bak Malam Hari -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Bak Malam Hari</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.bab_malam_hari }} /malam</div>
      </div>
      <div class="col-sm-4"><div class="text-center"> &le; {{data.nilai_rujukan_bak_malam_hari}} kali</div></div>
    </div>
    <!-- Bak Malam Hari -->

    <!-- Tensi Sistol -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Tensi Sistol</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.tensi_sistol }} mmHg</div>
      </div>
      <div class="col-sm-4"><div class="text-center">S: {{data.nilai_rujukan_tensi_sistol}} mmHg</div></div>
    </div>
    <!-- Tensi Sistol -->

    <!-- Tensi Diastol -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Tensi Diastol</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.tensi_diastol }} mmHg</div>
      </div>
      <div class="col-sm-4"><div class="text-center">D: {{data.nilai_rujukan_tensi_diastol}} mmHg</div></div>
    </div>
    <!-- Tensi Diastol -->

    <!-- Asam Urat -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Asam Urat</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.asam_urat }} mg/dl</div>
      </div>
      <div class="col-sm-4"><div class="text-center">L : &#60; {{data.nilai_rujukan_asam_urat_l}}; P : &#60; {{data.nilai_rujukan_asam_urat_l}} mg/dl</div></div>
    </div>
    <!-- Asam Urat -->

    <!-- Gula Darah -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Gula Darah</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.gula_darah }} mg/dl</div>
      </div>
      <div class="col-sm-4"><div class="text-center">{{data.nilai_rujukan_gula_darah_gdp}} mg/dl (GDP) Dibawah {{data.nilai_rujukan_gula_darah_gdp}} mg/dl (GDS)</div></div>
    </div>
    <!-- Gula Darah -->

    <!-- Kolestrol -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Kolestrol</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.kolestrol }} mg/dl</div>
      </div>
      <div class="col-sm-4"><div class="text-center">&#60; {{data.nilai_rujukan_kolestrol}} mg/dl</div></div>
    </div>
    <!-- Kolestrol -->

    <!-- Lingkar Perut -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Lingkar Perut</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.hasil_lingkar_perut }} cm</div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">&#60; {{ data.nilai_rujukan_lingkar_perut }} cm</div>
      </div>
    </div>
    <!-- Lingkar Perut -->

    <!-- Berat Badan -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5">
        <div>Berat Badan</div>
      </div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.hasil_berat_badan }} Kg</div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">{{ data.nilai_rujukan_berat_badan }} Kg</div>
      </div>
    </div>
    <!-- Berat Badan -->

    <!-- Lemak Tubuh -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Lemak Tubuh (Angka, +/-)</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.angka_lemak_tubuh }} Kg, {{ data.perbandingan_standar_lemak_tubuh }}</div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">
          L: {{ data.nilai_rujukan_lemak_tubuh_l }}% P: {{ data.nilai_rujukan_lemak_tubuh_p }}%
        </div>
      </div>
    </div>
    <!-- Lemak Tubuh -->

    <!-- Indeks Massa Tubuh -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Indeks Massa Tubuh (BMI = BB/T<sup>2</sup>)</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.indeks_masa_tubuh }} Kg/m<sup>2</sup></div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">{{data.nilai_rujukan_indeks_masa_tubuh}} Kg/m<sup>2</sup></div>
      </div>
    </div>
    <!-- Indeks Massa Tubuh -->

    <!-- Lemak Lapisan Organ -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Lemak Lapisan Organ (Angka, +/-)</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.angka_lemak_lapisan_organ }} %, {{ data.perbandingan_standar_lemak_lapisan_organ }}</div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">{{data.nilai_rujukan_lemak_lapisan_organ}} %</div>
      </div>
    </div>
    <!-- Lemak Lapisan Organ -->

    <!-- Resting Metabolism -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Resting Metabolism</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.hasil_resting_metabolism }} </div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">{{ data.nilai_rujukan_resting_metabolism }} </div>
      </div>
    </div>
    <!-- Resting Metabolism -->

    <!-- Usia Tubuh -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Usia Tubuh</div></div>
      <div class="col-sm-3">
        <div class="text-center">{{ data.hasil_usia_tubuh }} Thn</div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">{{ data.nilai_rujukan_usia_tubuh }} Thn</div>
      </div>
    </div>
    <!-- Usia Tubuh -->

    <div class="form-group" style="margin-top: 10px">
      <label for="keluhan">Keluhan : </label>
      <p>{{ data.keluhan }}</p>
    </div>
    <div class="form-group">
      <label for="keluhan">Catatan Dokter : </label>
      <p>{{ data.catatan_dokter }}</p>
    </div>
  </div>
</template>
<script>
export default {
  props: ['datakesehatan'],
  data () {
    return {
      data: {},
      urlEditKesehatan: process.env.MIX_BASE_URL + '/data-kesehatan/'
    }
  },
  methods: {
    formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear()

      if (month.length < 2) 
        month = '0' + month
      if (day.length < 2) 
        day = '0' + day

      return [year, month, day].join('-')
    }
  },
  mounted () {
    this.data = Object.assign({}, JSON.parse(this.datakesehatan))
    this.data.tanggal_he = (this.formatDate(this.data.tanggal_he)).toString()
  }
}
</script>