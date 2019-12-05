<template>
  <div class="container-fluid">

    <div class="head-content-section">
      <h3>Data Staff {{ staff.nama }}</h3>
      <a :href="urlEditStaff + staff.id + '/edit'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Nama</div>
      </div>
      <div class="col-sm-9">: {{ staff.nama }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Posiisi</div>
      </div>
      <div class="col-sm-9">: {{ staff.posisi }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Email</div>
      </div>
      <div class="col-sm-9">: {{ staff.email }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Nomor Telepon</div>
      </div>
      <div class="col-sm-9">: {{ staff.no_telepon }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Nomor Whatsapp</div>
      </div>
      <div class="col-sm-9">: {{ staff.no_wa ? staff.no_wa : '-' }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Usia</div>
      </div>
      <div class="col-sm-9">: {{ staff.usia }} Tahun</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Jenis Kelamin</div>
      </div>
      <div class="col-sm-9">: {{ staff.jenis_kelamin }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Tinggi</div>
      </div>
      <div class="col-sm-9">: {{ staff.tinggi }} cm</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Tempat Lahir</div>
      </div>
      <div class="col-sm-9">: {{ staff.tempat_lahir }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Tanggal Lahir</div>
      </div>
      <div class="col-sm-9">: {{ staff.tanggal_lahir }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Alamat</div>
      </div>
      <div class="col-sm-9">: {{ staff.alamat }}</div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['datastaff'],
  data () {
    return {
      staff: {},
      urlEditStaff: process.env.MIX_BASE_URL + '/staff/'
    }
  },
  mounted () {
    this.staff = Object.assign({}, JSON.parse(this.datastaff))
    this.staff.tanggal_lahir = this.staff.tanggal_lahir.substring(0, 10)
  }
}
</script>