<template>
  <div class="container-fluid">
    <loading-modal />

    <success-modal>
      Berhasil membuat data kesehatan baru
    </success-modal>

    <peserta-table-modal @selectedPeserta="selectPeserta($event)" />

    <!-- title form -->
    <div class="head-content-section">
      <h3>Create Data Kesehatan</h3>
    </div>
    <!-- end title form -->

    <!-- search peserta -->
    <div class="form-group">
      <label for="nama" class="required">Nama Peserta</label>
      <div class="input-group">
        <vue-select placeholder="Cari Peserta" :options="pesertas" label="nama" @search="searchPeserta" :clearable="false" :value="peserta.nama"  @input="selectPeserta" :class="getErrorMessage('peserta_id')"></vue-select>
        <div class="input-group-addon clickable" @click="showTablePesertaModal"><i class="fa fa-search"></i></div>
      </div>
      <div class="error-message" v-for="(error, i) in errorMessage.peserta_id" :key="i">{{ error }}</div>
    </div>
    <!-- end search peserta -->

    <!-- detail peserta -->
    <template v-if="peserta.nama !== null">
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="alamat">Alamat</label>
        </div>
        <div class="col-sm-9">: {{ peserta.alamat }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="jenis kelamin">Jenis Kelamin</label>
        </div>
        <div class="col-sm-9">: {{ peserta.jenis_kelamin }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="tinggi">Tinggi</label>
        </div>
        <div class="col-sm-9">: {{ peserta.tinggi }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <label for="tempat lahir">Tempat dan Tanggal Lahir</label>
        </div>
        <div class="col-sm-9">: {{ peserta.tempat_lahir }}, {{ peserta.tanggal_lahir.substring(0, 10) }}</div>
      </div>
    </template>
    <!-- end detail peserta -->

    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="tanggal he" class="required">Tanggal He</label>
          <vue-datepicker v-model="data.tanggal_he" :class="getErrorMessage('tanggal_he')" />
          <div class="error-message" v-for="(error, i) in errorMessage.tanggal_he" :key="i">{{ error }}</div>
        </div>
      </div>
      <div class="col-sm-9">
        <label for="tempat he">Tempat He</label>
        <input type="text" class="form-control input-text" v-model="data.tempat_he">
      </div>
    </div>

    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div><b>Jenis Pemeriksaan</b></div></div>
      <div class="col-sm-3"><div class="text-center"><b>Hasil</b></div></div>
      <div class="col-sm-4"><div class="text-center"><b>Nilai Rujukan</b> (<span class="btn btn-link clickable" @click="editRujukanValue(true)"><i class="fa fa-pencil"></i> Edit</span>)</div></div>
    </div>

    <!-- Bab Setiap Hari -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Bab Setiap Hari</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.bab_setiap_hari">
          <div class="input-group-addon">/hari</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_bab_setiap_hari">
          <div class="input-group-addon">/hari</div>
        </div>
        <div class="text-center" v-else>{{ data.nilai_rujukan_bab_setiap_hari }} x/hari</div>
      </div>
    </div>
    <!-- Bab Setiap Hari -->

    <!-- Bak Malam Hari -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Bak Malam Hari</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <div class="input-group-addon">&le;</div>
          <input type="number" class="form-control input-text" v-model="data.bab_malam_hari">
          <div class="input-group-addon">/malam</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_bak_malam_hari">
          <div class="input-group-addon">kali</div>
        </div>
        <div class="text-center" v-else> &le; {{ data.nilai_rujukan_bak_malam_hari }} kali</div>
      </div>
    </div>
    <!-- Bak Malam Hari -->

    <!-- Tensi Sistol -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Tensi Sistol</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.tensi_sistol">
          <div class="input-group-addon">mmHg</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <div class="input-group-addon">S :</div>
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_tensi_sistol">
          <div class="input-group-addon">mmHg</div>
        </div>
        <div class="text-center" v-else>S: {{data.nilai_rujukan_tensi_sistol}} mmHg</div>
      </div>
    </div>
    <!-- Tensi Sistol -->

    <!-- Tensi Diastol -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Tensi Diastol</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.tensi_diastol">
          <div class="input-group-addon">mmHg</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <div class="input-group-addon">D :</div>
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_tensi_diastol">
          <div class="input-group-addon">mmHg</div>
        </div>
        <div class="text-center" v-else>D: {{ data.nilai_rujukan_tensi_diastol }} mmHg</div>
      </div>
    </div>
    <!-- Tensi Diastol -->

    <!-- Asam Urat -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Asam Urat</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.asam_urat">
          <div class="input-group-addon">mg/dl</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="row" v-if="isEditRujukan">
          <div class="col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">L : &#60; </div>
              <input type="number" class="form-control input-text" v-model="data.nilai_rujukan_asam_urat_l">
              <div class="input-group-addon">mg/dl</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">P : &#60; </div>
              <input type="number" class="form-control input-text" v-model="data.nilai_rujukan_asam_urat_p">
              <div class="input-group-addon">mg/dl</div>
            </div>
          </div>
        </div>
        <div class="text-center" v-else>L : &#60; {{data.nilai_rujukan_asam_urat_l}}; P : &#60; {{data.nilai_rujukan_asam_urat_p}} mg/dl</div>
      </div>
    </div>
    <!-- Asam Urat -->

    <!-- Gula Darah -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Gula Darah</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.gula_darah">
          <div class="input-group-addon">mg/dl</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="row" v-if="isEditRujukan">
          <div class="col-sm-6">
            <div class="input-group">
              <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_gula_darah_gdp">
              <div class="input-group-addon">mg/dl (GDP)</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="input-group">
              <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_gula_darah_gds">
              <div class="input-group-addon">mg/dl (GDS)</div>
            </div>
          </div>
        </div>
        <div class="text-center" v-else>{{data.nilai_rujukan_gula_darah_gdp}} mg/dl (GDP) Dibawah {{data.nilai_rujukan_gula_darah_gds}} mg/dl (GDS)</div>
      </div>
    </div>
    <!-- Gula Darah -->

    <!-- Kolestrol -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Kolestrol</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.kolestrol">
          <div class="input-group-addon">mg/dl</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <div class="input-group-addon">&#60;</div>
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_kolestrol">
          <div class="input-group-addon">mg/dl</div>
        </div>
        <div class="text-center" v-else>&#60; {{data.nilai_rujukan_kolestrol}} mg/dl</div>
      </div>
    </div>
    <!-- Kolestrol -->

    <!-- Lingkar Perut -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Lingkar Perut</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.hasil_lingkar_perut">
          <div class="input-group-addon">Cm</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group">
          <div class="input-group-addon">&#60;</div>
          <input type="number" class="form-control input-text" v-model="data.nilai_rujukan_lingkar_perut">
          <div class="input-group-addon">Cm</div>
        </div>
      </div>
    </div>
    <!-- Lingkar Perut -->

    <!-- Berat Badan -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5">
        <div>Berat Badan</div>
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.hasil_berat_badan">
          <div class="input-group-addon">Kg</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.nilai_rujukan_berat_badan">
          <div class="input-group-addon">Kg</div>
        </div>
      </div>
    </div>
    <!-- Berat Badan -->

    <!-- Lemak Tubuh -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Lemak Tubuh (Angka, +/-)</div></div>
      <div class="col-sm-3">
        <div class="row">
          <div class="col-sm-6">
            <div class="input-group">
              <input type="number" class="form-control input-text" v-model="data.angka_lemak_tubuh">
              <div class="input-group-addon">Kg</div>
            </div>
          </div>
          <div class="col-sm-6">
            <select class="form-control input-text" v-model="data.perbandingan_standar_lemak_tubuh">
              <option>-</option>
              <option>0</option>
              <option>+</option>
              <option>++</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="row" v-if="isEditRujukan">
          <div class="col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">L :</div>
              <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_lemak_tubuh_l">
              <div class="input-group-addon">%</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">P :</div>
              <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_lemak_tubuh_p">
              <div class="input-group-addon">%</div>
            </div>
          </div>
        </div>
        <div class="text-center" v-else>
          L : {{ data.nilai_rujukan_lemak_tubuh_l }}% P : {{ data.nilai_rujukan_lemak_tubuh_p }}%
        </div>
      </div>
    </div>
    <!-- Lemak Tubuh -->

    <!-- Indeks Massa Tubuh -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Indeks Massa Tubuh (BMI = BB/T<sup>2</sup>)</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.indeks_masa_tubuh">
          <div class="input-group-addon">Kg/m<sup>2</sup></div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_indeks_masa_tubuh">
          <div class="input-group-addon">Kg/m<sup>2</sup></div>
        </div>
        <div class="text-center" v-else>{{ data.nilai_rujukan_indeks_masa_tubuh }} Kg/m<sup>2</sup></div>
      </div>
    </div>
    <!-- Indeks Massa Tubuh -->

    <!-- Lemak Lapisan Organ -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Lemak Lapisan Organ (Angka, +/-)</div></div>
      <div class="col-sm-3">
        <div class="row">
          <div class="col-sm-6">
            <div class="input-group">
              <input type="number" class="form-control input-text" v-model="data.angka_lemak_lapisan_organ">
              <div class="input-group-addon">%</div>
            </div>
          </div>
          <div class="col-sm-6">
            <select class="form-control input-text" v-model="data.perbandingan_standar_lemak_lapisan_organ">
              <option>-</option>
              <option>0</option>
              <option>+</option>
              <option>++</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_lemak_lapisan_organ">
          <div class="input-group-addon">%</div>
        </div>
        <div class="text-center" v-else>{{data.nilai_rujukan_lemak_lapisan_organ}} %</div>
      </div>
    </div>
    <!-- Lemak Lapisan Organ -->

    <!-- Resting Metabolism -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Resting Metabolism</div></div>
      <div class="col-sm-3">
        <input type="number" class="form-control input-text" v-model="data.hasil_resting_metabolism">
      </div>
      <div class="col-sm-4">
        <input type="number" class="form-control input-text" v-model="data.nilai_rujukan_resting_metabolism">
      </div>
    </div>
    <!-- Resting Metabolism -->

    <!-- Usia Tubuh -->
    <div class="row row-form-kesehatan">
      <div class="col-sm-5"><div>Usia Tubuh</div></div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="number" class="form-control input-text" v-model="data.hasil_usia_tubuh">
          <div class="input-group-addon">Thn</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group" v-if="isEditRujukan">
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_usia_tubuh">
          <div class="input-group-addon">Thn</div>
        </div>
        <div class="text-center" v-else>{{ data.nilai_rujukan_usia_tubuh }} Thn</div>
      </div>
    </div>
    <!-- Usia Tubuh -->

    <!-- end form data kesehatan -->

    <div class="form-group" style="margin-top: 10px">
      <label for="keluhan">Keluhan</label>
      <textarea id="" cols="30" rows="5" class="form-control" v-model="data.keluhan"></textarea>
    </div>
    <div class="form-group">
      <label for="keluhan">Catatan Dokter</label>
      <textarea id="" cols="30" rows="5" class="form-control" v-model="data.catatan_dokter"></textarea>
    </div>
    
    <button class="btn btn-info" @click="createDataKesehatan">Save</button>

  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  components: {
    vueSelect
  },
  data () {
    return {
      data: {
        peserta_id: null,
        tempat_he: null,
        tanggal_he: null,
        bab_setiap_hari: null,
        bab_malam_hari: null,
        tensi_sistol: null,
        tensi_diastol: null,
        asam_urat: null,
        gula_darah: null,
        kolestrol: null,
        hasil_lingkar_perut: null,
        nilai_rujukan_lingkar_perut: null,
        hasil_berat_badan: null,
        nilai_rujukan_berat_badan: null,
        angka_lemak_tubuh: null,
        perbandingan_standar_lemak_tubuh: null,
        indeks_masa_tubuh: null,
        angka_lemak_lapisan_organ: null,
        perbandingan_standar_lemak_lapisan_organ: null,
        hasil_resting_metabolism: null,
        nilai_rujukan_resting_metabolism: null,
        hasil_usia_tubuh: null,
        nilai_rujukan_usia_tubuh: null,
        keluhan: null,
        catatan_dokter: null,
        nilai_rujukan_bab_setiap_hari: '1 - 2',
        nilai_rujukan_bak_malam_hari: '1',
        nilai_rujukan_tensi_sistol: '90 - 120',
        nilai_rujukan_tensi_diastol: '60 - 90',
        nilai_rujukan_asam_urat_l: '7',
        nilai_rujukan_asam_urat_p: '5.7',
        nilai_rujukan_gula_darah_gdp: '80/110',
        nilai_rujukan_gula_darah_gds: '140',
        nilai_rujukan_kolestrol: '200',
        nilai_rujukan_lemak_tubuh_l: '10 - 20',
        nilai_rujukan_lemak_tubuh_p: '20 - 30',
        nilai_rujukan_indeks_masa_tubuh: '18.5 - 23',
        nilai_rujukan_lemak_lapisan_organ: '1 - 9'
      },
      peserta: {
        nama: null,
        usia: null,
        jenis_kelamin: null,
        tinggi: null,
        tempat_lahir: null,
        tanggal_lahir: null,
        alamat: null
      },
      isEditRujukan: false,
      errorMessage: {},
      pesertas: []
    }
  },
  methods: {
    getErrorMessage (field) {
      if (this.errorMessage[field] && this.errorMessage[field].length > 0) {
        return 'error'
      }
    },
    searchPeserta (search, loading) {
      fetch ('/data-peserta/search?query=' + search)
      .then(res => {
        res.json()
        .then(json => (this.pesertas = json.data));
      })
    },
    selectPeserta (peserta) {
      this.$modal.hide('peserta-table-modal')
      this.peserta = peserta
      this.data.peserta_id = peserta.id
      this.data.nilai_rujukan_usia_tubuh = peserta.usia
    },
    showTablePesertaModal () {
      this.$modal.show('peserta-table-modal')
    },
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
    },
    editRujukanValue (status) {
      this.isEditRujukan = status
    },
    async createDataKesehatan () {
      this.$modal.show('loading-modal')
      let response = await axios({
        method: 'POST',
        url: process.env.MIX_BASE_URL + '/data-kesehatan/store',
        data: this.data
      })
      if (response.data.status === 200) {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.$modal.show('success-modal')
          setTimeout(() => {
            this.$modal.hide('success-modal')
            window.location = '/data-kesehatan/'
          }, 2000)
        }, 2000)
      } else {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.errorMessage = Object.assign({}, response.data.message)
        }, 2000)
      }
    }
  },
  mounted () {
    this.data.tanggal_he = new Date()
    this.data.tanggal_he = (this.formatDate(this.data.tanggal_he)).toString()
  }
}
</script>