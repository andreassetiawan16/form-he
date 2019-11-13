<template>
  <modal name="peserta-table-modal" :min-width="800" :min-height="300" :adaptive="true">
    <div class="head-content-section">
      <h3>Table Data Peserta</h3>
      <i class="fa fa-times-circle clickable close-icon-modal" @click="hideModal()"></i> 
    </div>
    <vuetable ref="peserta_table"
              :api-url="tempUrl"
              :fields="fields"
              :per-page="10"
              pagination-path=""
              @vuetable:pagination-data="onPaginationData"
    >
      <div class="vuetable-action" slot="action" slot-scope="props">
        <span class="clickable" @click="choosePeserta(props.rowData)">Pilih Peserta</span>
      </div>
    </vuetable>
    <div class="vuetable-pagination">

      <vuetable-pagination-info ref="paginationInfo"
                                info-class="pagination-info"
      >
      </vuetable-pagination-info>

      <vuetable-pagination ref="pagination"
                            :css="css.pagination"
                          @vuetable-pagination:change-page="onChangePage"
      >
      </vuetable-pagination>

    </div>
  </modal>
</template>
<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
  },
  data () {
    return {
      css: {
        pagination: {
          wrapperClass: 'vuetable-pagination',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'link-pagination',
          linkClass: '',
          icons: {
            first: 'fa fa-angle-double-left',
            prev: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            last: 'fa fa-angle-double-right',
          }
        }
      },
      url: process.env.MIX_BASE_URL + '/tablePeserta',
      tempUrl: '',
      fields: [
        {
          name: 'nama',
          title: 'Nama'
        },
        {
          name: 'email',
          title: 'Email'
        },
        {
          name: 'no_telepon',
          title: 'Nomor Telepon'
        },
        {
          name: 'alamat',
          title: 'Alamat',
          sortField: 'alamat'
        },
        {
          name: '__slot:action',
          title: 'Action',
          titleClass: 'text-center'
        }
      ]
    }
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.peserta_table.changePage(page)
    },
    hideModal () {
      this.$modal.hide('peserta-table-modal')
    },
    choosePeserta (peserta) {
      this.$emit('selectedPeserta', peserta)
    }
  },
  created () {
    this.tempUrl = this.url
  }
}
</script>