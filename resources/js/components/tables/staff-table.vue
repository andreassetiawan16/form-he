<template>
  <div>
    <vuetable :ref="posisi + '_table'"
              :api-url="url"
              :fields="fields"
              :per-page="10"
              pagination-path=""
              @vuetable:pagination-data="onPaginationData"
    >
      <template slot="nama" slot-scope="props">
        <a :href="urlDetailStaff + '/staff/' + props.rowData.id + '/detail'">{{ props.rowData.nama }}</a>
      </template>
    </vuetable>
    <div class="vuetable-pagination">

      <vuetable-pagination-info :ref="posisi + 'PaginationInfo'"
                                info-class="pagination-info"
      >
      </vuetable-pagination-info>

      <vuetable-pagination :ref="posisi + 'Pagination'"
                            :css="css.pagination"
                          @vuetable-pagination:change-page="onChangePage"
      >
      </vuetable-pagination>

    </div>
  </div>
</template>
<script>
import axios from 'axios'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
export default {
  props: ['posisi'],
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
            prev: 'fa fa-chevron-left prev',
            next: 'fa fa-chevron-right next'
          }
        }
      },
      fields: [
        {
          name: '__slot:nama',
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
        }
      ],
      url: process.env.MIX_BASE_URL + '/staff-table?posisi=',
      tempUrl: process.env.MIX_BASE_URL + '/staff-table?posisi=',
      urlAddStaff: process.env.MIX_BASE_URL + '/staff/create',
      urlDetailStaff: process.env.MIX_BASE_URL
    }
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs[this.posisi + 'Pagination'].setPaginationData(paginationData)
      this.$refs[this.posisi + 'PaginationInfo'].setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs[this.posisi + '_table'].changePage(page)
    },
    refreshTable () {
      this.$nextTick(function () {
        this.$refs[this.posisi + '_table'].refresh()
      })
    }
  },
  beforeMount () {
    this.url = this.tempUrl + this.posisi
  },
  beforeUpdate () {
    this.url = this.tempUrl + this.posisi
    this.refreshTable()
  },
}
</script>