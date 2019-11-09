<template>
  <div>
    <div class="vuetable-search">
      <div class="input-group">
        <input type="text" class="form-control input-text" v-model="searchWord" @keyup.enter="doSearch">
        <div class="input-group-btn">
          <button class="btn btn-default vuetable-btn-search" @click="doSearch"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </div>
    <vuetable :ref="vuetable_ref"
              :api-url="tempUrl"
              :fields="fields"
              pagination-path=""
              @vuetable:pagination-data="onPaginationData"
    >
    <div slot="action" slot-scope="props" class="vuetable-action">
      <span><i class="fa fa-pencil" @click="editPeserta(props.rowData.id)"></i> Edit</span>
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
      tempUrl: '',
      fields: [],
      searchWord: ''
    }
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs[this.vuetable_ref].changePage(page)
    },
    editPeserta (id) {
      window.location = '/data-peserta/' + id + '/edit'
    },
    doSearch () {
      this.tempUrl = this.url + '?filter=' + this.searchWord
      this.$nextTick(function () {
        this.$refs[this.vuetable_ref].refresh()
      })
    }
  },
  created () {
    this.tempUrl = this.url
    if (this.vuetable_ref === 'pesertaTable') {
      this.fields = [
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
        },
        {
          name: '__slot:action',
          title: 'Action',
          titleClass: 'text-center'
        }
      ]
    }
  }
}
</script>
