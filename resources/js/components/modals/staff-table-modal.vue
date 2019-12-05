<template>
  <modal :name="modalname + '-table-modal'" :min-width="800" :adaptive="true">
    <div class="head-content-section">
      <h3>Table Staff {{ modalname }}</h3>
    </div>
    <vuetable :ref="modalname + '_table'"
              :api-url="url"
              :fields="fields"
              :per-page="10"
              pagination-path=""
              @vuetable:pagination-data="onPaginationData"
    >
      <div class="vuetable-action" slot="action" slot-scope="props">
        <span class="clickable" @click="chooseStaff(props.rowData)">Pilih {{ modalname }}</span>
      </div>
    </vuetable>
    <div class="vuetable-pagination">

      <vuetable-pagination-info :ref="modalname + 'PaginationInfo'"
                                info-class="pagination-info"
      >
      </vuetable-pagination-info>

      <vuetable-pagination :ref="modalname + 'Pagination'"
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
  props: ['modalname'],
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
      fields: [
        {
          name: 'nama',
          title: 'Nama'
        },
        {
          name: 'posisi',
          title: 'Posisi'
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
        },
      ],
      url: process.env.MIX_BASE_URL + '/staff-table?posisi=',
      tempUrl: process.env.MIX_BASE_URL + '/staff-table?posisi=',
    }
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs[this.modalname + 'Pagination'].setPaginationData(paginationData)
      this.$refs[this.modalname + 'PaginationInfo'].setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs[this.modalname + '_table'].changePage(page)
    },
    hideModal () {
      this.$modal.hide(this.modalname + '-table-modal')
    },
    chooseStaff (staff) {
      this.$emit('selectedStaff', staff)
    }
  },
  created () {
    this.url = this.tempUrl + this.modalname
  }
}
</script>