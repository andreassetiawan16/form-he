<template>
  <div class="container-fluid">

    <modal name="loading-modal" :width="500">
      <sweetalert-icon icon="loading" />
      <h4 class="text-center">Loading</h4>
    </modal>

    <template v-if="isShow">
      <div class="row form-group">
        <div class="col-sm-4">
          <div>Tempat & Tanggal Health Expo</div>
        </div>
        <div class="col-sm-8">
          : {{data.tempat_tanggal_he}}
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

    <template v-else>
      <div class="form-group">
        <label for="tempat_tanggal_he">Tempat & Tanggal Health Expo</label>
        <input type="text" class="form-control input-text" v-model="data.tempat_tanggal_he">
      </div>
      <!-- data peserta -->
      <div class="form-group">
        <label for="nama">Nama Peserta</label>
        <vue-select :options="pesertas" label="nama" @search="searchPeserta" :clearable="false" @input="selectPeserta"></vue-select>
      </div>
      <template v-if="peserta.nama !== null">
        <div class="row form-group">
          <div class="col-sm-4">
            <label for="alamat">Alamat</label>
          </div>
          <div class="col-sm-8">: {{ peserta.alamat }}</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4">
            <label for="jenis kelamin">Jenis Kelamin</label>
          </div>
          <div class="col-sm-8">: {{ peserta.jenis_kelamin }}</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4">
            <label for="tinggi">Tinggi</label>
          </div>
          <div class="col-sm-8">: {{ peserta.tinggi }}</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4">
            <label for="tempat lahir">Tempat dan Tanggal Lahir</label>
          </div>
          <div class="col-sm-8">: {{ peserta.tempat_lahir }}, {{ peserta.tanggal_lahir.substring(0, 10) }}</div>
        </div>
      </template>
      <!-- end data peserta -->

      <!-- form data kesehatan -->
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
          <div style="display:flex; align-items: center">Status: <input type="text" class="form-control input-text" v-model="data.status_berat_badan" style="width: 100px"></div>
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
        <div class="col-sm-5"><div>Lemak Tubuh (Angka)</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.angka_lemak_tubuh">
            <div class="input-group-addon">Kg</div>
          </div>
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
          <select class="form-control input-text" v-model="data.perbandingan_standar_lemak_tubuh">
            <option>-</option>
            <option>0</option>
            <option>+</option>
            <option>++</option>
          </select>
        </div>
        <div class="col-sm-4">
          <div class="text-center">0</div>
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
        <div class="col-sm-5"><div>Lemak Lapisan Organ (Angka)</div></div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="number" class="form-control input-text" v-model="data.angka_lemak_lapisan_organ">
            <div class="input-group-addon">%</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="text-center">1 - 9 %</div>
        </div>
      </div>
      <div class="row row-form-kesehatan">
        <div class="col-sm-5"><div>Lemak Lapisan Organ (+/-)</div></div>
        <div class="col-sm-3">
          <select class="form-control input-text" v-model="data.perbandingan_standar_lemak_lapisan_organ">
            <option>-</option>
            <option>0</option>
            <option>+</option>
            <option>++</option>
          </select>
        </div>
        <div class="col-sm-4">
          <div class="text-center">0</div>
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
      
      <button class="btn btn-primary" @click="crateDataKesehatan">Save</button>
    </template>
  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  components: {
    vueSelect
  },
  props: ['propkesehatan', 'isedit'],
  data () {
    return {
      data: {
        peserta_id: '',
        tempat_tanggal_he: '',
        bab_setiap_hari: '',
        bab_malam_hari: '',
        tensi_sistol: '',
        tensi_diastol: '',
        asam_urat: '',
        gula_darah: '',
        kolestrol: '',
        hasil_lingkar_perut: '',
        nilai_rujukan_lingkar_perut: '',
        status_berat_badan: '',
        hasil_berat_badan: '',
        nilai_rujukan_berat_badan: '',
        angka_lemak_tubuh: '',
        perbandingan_standar_lemak_tubuh: '',
        indeks_masa_tubuh: '',
        angka_lemak_lapisan_organ: '',
        perbandingan_standar_lemak_lapisan_organ: '',
        hasil_resting_metabolism: '',
        nilai_rujukan_resting_metabolism: '',
        hasil_usia_tubuh: '',
        nilai_rujukan_usia_tubuh: '',
        keluhan: '',
        catatan_dokter: '',
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
      isShow: true
    }
  },
  methods: {
    async crateDataKesehatan () {
      this.$modal.show('loading-modal')
      let response = await axios({
          method: 'POST',
          url: 'store',
          data: this.data
      })
      if (response.data.status === 200) {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          window.location = '/data-kesehatan/'
        })
      } else {
        this.errorMessage = Object.assign({}, response.data.message)
      }
      console.log('pserta : ', response)
    },
    searchPeserta (search, loading) {
      fetch ('/data-peserta/search?query=' + search)
      .then(res => {
        res.json()
        .then(json => (this.pesertas = json.data));
      })
    },
    selectPeserta (peserta) {
      this.data.peserta_id = peserta.id
      this.data.nilai_rujukan_usia_tubuh = peserta.usia
    }
  },
  mounted () {
    if(this.propkesehatan) {
      this.data = Object.assign({}, JSON.parse(this.propkesehatan))
    }
    if (!this.isedit) {
      this.isShow = false
    }
    this.searchPeserta('', true)
  }
}
</script>