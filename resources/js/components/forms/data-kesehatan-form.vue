<template>
  <div class="container-fluid">
    <loading-modal />

    <success-modal>
      Berhasil membuat data kesehatan baru
    </success-modal>

    <peserta-table-modal @selectedPeserta="selectPeserta($event)" />
    
    <section v-if="isCreateStatus">
      <div class="head-content-section">
        <h3>{{ iscreate ? 'Tambah' : '' }} Data Peserta {{ peserta.name ? peserta.name : '' }}</h3>
      </div>
      <div class="form-group">
        <label for="nama" class="required">Nama Peserta</label>
        <div class="input-group">
          <template v-if="data.peserta && data.peserta.nama">
            <vue-select placeholder="Cari Peserta" :options="pesertas" label="nama" @search="searchPeserta" :clearable="false" :value="data.peserta.nama" @input="selectPeserta" :class="getErrorMessage('peserta_id')"></vue-select>
          </template>
          <template v-else>
            <vue-select placeholder="Cari Peserta" :options="pesertas" label="nama" @search="searchPeserta" :clearable="false" :value="peserta.nama"  @input="selectPeserta" :class="getErrorMessage('peserta_id')"></vue-select>
          </template>
          <div class="input-group-addon clickable" @click="showTablePesertaModal"><i class="fa fa-search"></i></div>
        </div>
        <div class="error-message" v-for="(error, i) in errorMessage.peserta_id" :key="i">{{ error }}</div>
      </div>
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
        <div class="col-sm-4"><div class="text-center"><b>Nilai Rujukan</b></div></div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Bab Setiap Hari</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.bab_setiap_hari">
            <div class="input-group-addon">/hari</div>
          </div>
        </div>
        <div class="col-sm-4"><div class="text-center">1 - 2 x/hari</div></div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Bab Malam Hari</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.bab_malam_hari">
            <div class="input-group-addon">/malam</div>
          </div>
        </div>
        <div class="col-sm-4"><div class="text-center"> &le; 1 kali</div></div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Tensi Sistol</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.tensi_sistol">
            <div class="input-group-addon">mmHg</div>
          </div>
        </div>
        <div class="col-sm-4"><div class="text-center">S: 90 - 120 mmHg</div></div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Tensi Diastol</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.tensi_diastol">
            <div class="input-group-addon">mmHg</div>
          </div>
        </div>
        <div class="col-sm-4"><div class="text-center">D: 60 - 90 mmHg</div></div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Asam Urat</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.asam_urat">
            <div class="input-group-addon">mg/dl</div>
          </div>
        </div>
        <div class="col-sm-4"><div class="text-center">L : &#60; 7; P : &#60; 5.7 mg/dl</div></div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Gula Darah</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.gula_darah">
            <div class="input-group-addon">mg/dl</div>
          </div>
        </div>
        <div class="col-sm-4"><div class="text-center">80/110 mg/dl (GDP) Dibawah 140mg/dl (GDS)</div></div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Kolestrol</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.kolestrol">
            <div class="input-group-addon">mg/dl</div>
          </div>
        </div>
        <div class="col-sm-4"><div class="text-center">&#60; 200 mg/dl</div></div>
      </div>
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
      <div class="row row-form-kesehatan">
        <div class="col-sm-5">
          <div>Berat Badan</div>
          <div style="display:flex; align-items: center">Status: <input type="text" class="form-control input-text" v-model="data.status_berat_badan" style="width: 100px; margin-left: 10px"></div>
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
          <div class="text-center">
            L: 10 - 20% P: 20 - 30%
          </div>
        </div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Indeks Massa Tubuh (BMI = BB/T<sup>2</sup>)</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.indeks_masa_tubuh">
            <div class="input-group-addon">Kg/m<sup>2</sup></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="text-center">18.5 - 23 Kg/m<sup>2</sup></div>
        </div>
      </div>
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
          <div class="text-center">1 - 9 %</div>
        </div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Resting Metabolism</div></div>
        <div class="col-sm-3">
          <input type="text" class="form-control input-text" v-model="data.hasil_resting_metabolism">
        </div>
        <div class="col-sm-4">
          <input type="text" class="form-control input-text" v-model="data.nilai_rujukan_resting_metabolism">
        </div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Usia Tubuh</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.hasil_usia_tubuh">
            <div class="input-group-addon">Thn</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="text-center">{{ data.nilai_rujukan_usia_tubuh }} Thn</div>
        </div>
      </div>
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
    </section>

    <!-- detail form -->
    <section v-else>
      <template v-if="data.peserta">
        <div class="head-content-section">
          <h3>Data Kesehatan {{ data.peserta.nama }}</h3>
          <button class="btn btn-info" @click="editForm"><i class="fa fa-pencil"></i> Edit</button>
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
        <div class="row form-group">
          <div class="col-sm-3">Tanggal He</div>
          <div class="col-sm-9">: {{ data.tanggal_he.substring(0, 10) }}</div>
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
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Bab Setiap Hari</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{data.bab_setiap_hari}} /hari</div>
          </div>
          <div class="col-sm-4"><div class="text-center">1 - 2 x/hari</div></div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Bab Malam Hari</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.bab_malam_hari }} /malam</div>
          </div>
          <div class="col-sm-4"><div class="text-center"> &le; 1 kali</div></div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Tensi Sistol</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.tensi_sistol }} mmHg</div>
          </div>
          <div class="col-sm-4"><div class="text-center">S: 90 - 120 mmHg</div></div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Tensi Diastol</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.tensi_diastol }} mmHg</div>
          </div>
          <div class="col-sm-4"><div class="text-center">D: 60 - 90 mmHg</div></div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Asam Urat</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.asam_urat }} mg/dl</div>
          </div>
          <div class="col-sm-4"><div class="text-center">L : &#60; 7; P : &#60; 5.7 mg/dl</div></div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Gula Darah</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.gula_darah }} mg/dl</div>
          </div>
          <div class="col-sm-4"><div class="text-center">80/110 mg/dl (GDP) Dibawah 140mg/dl (GDS)</div></div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Kolestrol</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.kolestrol }} mg/dl</div>
          </div>
          <div class="col-sm-4"><div class="text-center">&#60; 200 mg/dl</div></div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Lingkar Perut</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.hasil_lingkar_perut }} cm</div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">&#60; {{ data.nilai_rujukan_lingkar_perut }} cm</div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5">
            <div>Berat Badan</div>
            <div>Status: {{ data.status_berat_badan }}</div>
          </div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.hasil_berat_badan }} Kg</div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">{{ data.nilai_rujukan_berat_badan }} Kg</div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Lemak Tubuh (Angka)</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.angka_lemak_tubuh }} Kg</div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">
              L: 10 - 20% P: 20 - 30%
            </div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Lemak Tubuh (+/-)</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.perbandingan_standar_lemak_tubuh }}</div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">0</div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Indeks Massa Tubuh (BMI = BB/T<sup>2</sup>)</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.indeks_masa_tubuh }} Kg/m<sup>2</sup></div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">18.5 - 23 Kg/m<sup>2</sup></div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Lemak Lapisan Organ (Angka)</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.angka_lemak_lapisan_organ }} %</div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">1 - 9 %</div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Lemak Lapisan Organ (+/-)</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.perbandingan_standar_lemak_lapisan_organ }} </div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">0</div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Resting Metabolism</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.hasil_resting_metabolism }} </div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">{{ data.nilai_rujukan_resting_metabolism }} </div>
          </div>
        </div>
        <div class="row row-form-kesehatan">
          <div class="col-sm-5"><div>Usia Tubuh</div></div>
          <div class="col-sm-3">
            <div class="text-center">{{ data.hasil_usia_tubuh }} Thn</div>
          </div>
          <div class="col-sm-4">
            <div class="text-center">{{ data.nilai_rujukan_usia_tubuh }} Thn</div>
          </div>
        </div>

        <div class="form-group" style="margin-top: 10px">
          <label for="keluhan">Keluhan : </label>
          <p>{{ data.keluhan }}</p>
        </div>
        <div class="form-group">
          <label for="keluhan">Catatan Dokter : </label>
          <p>{{ data.catatan_dokter }}</p>
        </div>
      </template>
    </section>
    <!-- end detail form -->

  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  components: {
    vueSelect
  },
  props: ['propkesehatan', 'iscreate'],
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
        status_berat_badan: null,
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
      errorMessage: {},
      pesertas: [],
      isCreateStatus: false
    }
  },
  methods: {
    editForm () {
      this.isCreateStatus = true
    },
    getErrorMessage (field) {
      if (this.errorMessage[field] && this.errorMessage[field].length > 0) {
        return 'error'
      }
    },
    async createDataKesehatan () {
      let response = ''
      this.$modal.show('loading-modal')
      if (this.iscreate) {
        response = await axios({
          method: 'POST',
          url: process.env.MIX_BASE_URL + '/data-kesehatan/store',
          data: this.data
        })
      } else {
        let payload = Object.assign({}, this.data)
        delete payload.peserta
        response = await axios({
          method: 'POST',
          url: process.env.MIX_BASE_URL + '/data-kesehatan/' + payload.id + '/update',
          data: payload
        })
      }
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
      if (this.propkesehatan) {
        this.data.peserta.nama = peserta.nama
      }
    },
    showTablePesertaModal () {
      this.$modal.show('peserta-table-modal')
    }
  },
  mounted () {
    if (this.propkesehatan) {
      this.data = Object.assign({}, JSON.parse(this.propkesehatan))
      this.peserta = Object.assign({}, JSON.parse(this.propkesehatan).peserta)
    }
    this.isCreateStatus = this.iscreate
  }
}
</script>