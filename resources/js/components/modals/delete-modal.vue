<template>
  <div>
    <modal :name="modalname" :width="width" :height="height">
      <sweetalert-icon icon="warning" />
      <h4 class="text-center"><slot name="title"></slot></h4>
      <p class="modal-description text-center"><slot name="description"></slot></p>
      <div class="modal-action">
        <span class="btn-cancel" @click="doCancel()">Cancel</span>
        <button class="btn btn-danger" @click="doDelete()">Hapus</button>
      </div>
    </modal>
  </div>
</template>
<script>
export default {
  props: ['modalname', 'width', 'height'],
  methods: {
    doCancel () {
      this.$modal.hide(this.modalname)
    },
    doDelete () {
      this.$emit('doDelete')
    }
  }
}
</script>