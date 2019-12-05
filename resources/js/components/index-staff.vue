<template>
  <div class="box box-info">
    <div class="container-fluid">
      <div class="head-content-section">
        <h3>Data Staff</h3>
        <a class="btn btn-info" :href="urlAddStaff">Tambah</a>
      </div>
      <div class="tab-container">
        <ul>
          <li :class="isDokter ? 'active': ''" @click="changeTab(true)">Dokter</li>
          <li :class="!isDokter ? 'active': ''" @click="changeTab(false)">Petugas</li>
        </ul>
        <div class="slider" :style="animateSlider()">
          <div class="indicator"></div>
        </div>
      </div>
      <transition name="fade">
        <section v-if="isDokter">
          <staff-table posisi="dokter"></staff-table>
        </section>
        <section v-else>
          <staff-table posisi="petugas"></staff-table>
        </section>
      </transition>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      isDokter: true,
      urlAddStaff: process.env.MIX_BASE_URL + '/staff/create'
    }
  },
  methods: {
    changeTab (value) {
      this.isDokter = value
    },
    animateSlider () {
      let transition = ''
      if (this.isDokter) {
        transition = 'transform: translateX(0%)'
      } else {
        transition = 'transform: translateX(100%)'
      }
      return transition
    }
  }
}
</script>