<template>
  <div>
    <vuetable :ref="vuetable_ref"
              :api-url="url"
              :fields="fields"
              pagination-path=""
              @vuetable:pagination-data="onPaginationData"
    >
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
  </div>
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
  props: {
    vuetable_ref: {
      default: 'vuetable',
      type: String
    },
    url: {
      type: String
    }
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
      fields: []
    }
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs[this.vuetable_ref].changePage(page)
    }
  },
  created () {
    if (this.vuetable_ref === 'pesertaTable') {
      this.fields = [
        {
          name: '__checkbox'
        },
        {
          name: 'nama',
          title: 'Nama',
          sortField: 'nama'
        },
        {
          name: 'usia',
          title: 'Usia',
          sortField: 'usia'
        },
        {
          name: 'jenis_kelamin',
          title: 'Jenis Kelamin',
          sortField: 'jenis_kelamin'
        },
        {
          name: 'alamat',
          title: 'Alamat',
          sortField: 'alamat'
        }
      ]
    }
  }
}
</script>
