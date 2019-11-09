<template>
  <div>
    <!-- delete modal -->
    <modal name="delete-peserta-modal" :width="500" :height="350">
      <sweetalert-icon icon="warning" />
      <h4 class="text-center">Apa anda yakin ingin menghapus data peserta {{ peserta.nama }}?</h4>
      <p class="modal-description text-center">Seluruh data kesehatan {{ peserta.nama }} juga akan dihapus</p>
      <div class="modal-action">
        <span class="btn-cancel" @click="hideDeleteModal">Cancel</span>
        <button class="btn btn-danger" @click="deletePeserta">Hapus</button>
      </div>
    </modal>
    <!-- end delete modal -->

    <!-- loading modal -->
     <modal name="loading-modal" :width="500">
      <sweetalert-icon icon="loading" />
      <h4 class="text-center">Loading</h4>
    </modal>
    <!-- end loading modal -->

    <!-- table -->
    <!-- <div class="vuetable-search">
      <div class="input-group">
        <input type="text" class="form-control input-text" v-model="searchWord" @keyup.enter="doSearch">
        <div class="input-group-btn">
          <button class="btn btn-default vuetable-btn-search" @click="doSearch"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </div> -->
    <vuetable ref="peserta_table"
              :api-url="tempUrl"
              :fields="fields"
              pagination-path=""
              @vuetable:pagination-data="onPaginationData"
    >
      <div slot="nama" slot-scope="props">
        <a :href="'/data-peserta/' + props.rowData.id + '/edit'">{{ props.rowData.nama }}</a>
      </div>
      <div slot="action" slot-scope="props" class="vuetable-action">
        <span class="clickable" @click="showDeleteModal(props.rowData)"><i class="fa fa-trash"></i> Delete</span>
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
    <!-- end table -->

  </div>
</template>
<script>
import axios from 'axios'
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
      fields: [
        {
          name: '__slot:nama',
          title: 'Nama'
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
      ],
      searchWord: '',
      peserta: {}
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
    showDeleteModal (peserta) {
      this.$modal.show('delete-peserta-modal')
      this.peserta = Object.assign({}, peserta)
    },
    hideDeleteModal () {
      this.$modal.hide('delete-peserta-modal')
    },
    async deletePeserta () {
      this.hideDeleteModal()
      this.$modal.show('loading-modal')
      let response = await axios ({
        method: 'POST',
        url: 'delete',
        data: {id: this.peserta.id}
      })
      if (response.data.status === 200) {
        setTimeout(() => {
          this.refreshTable()
          this.$modal.hide('loading-modal')
        }, 2000)
      }
    },
    doSearch () {
      this.tempUrl = this.url + '?filter=' + this.searchWord
      this.refreshTable()
    },
    refreshTable () {
      this.$nextTick(function () {
        this.$refs.peserta_table.refresh()
      })
    }
  },
  created () {
    this.tempUrl = this.url
  }
}
</script>
