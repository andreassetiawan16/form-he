<template>
  <div class="container-fluid">
    <!-- delete modal -->
    <delete-modal modalname="delete-event-modal" :width="500" :height="350" @doDelete="deleteEvent">
      <template slot="title">Apa anda yakin ingin menghapus event?</template>
    </delete-modal>
    <!-- end delete modal -->

    <!-- loading modal -->
    <loading-modal />
    <!-- end loading modal -->

    <!-- success modal -->
    <success-modal>
      Berhasil menghapus data event
    </success-modal>
    <!-- endsuccess modal -->

    <!-- table -->
    <!-- <div class="vuetable-search">
      <div class="input-group">
        <input type="text" class="form-control input-text" v-model="searchWord" @keyup.enter="doSearch">
        <div class="input-group-btn">
          <button class="btn btn-default vuetable-btn-search" @click="doSearch"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </div> -->
    <vuetable ref="event_table"
              :api-url="tempUrl"
              :fields="fields"
              :per-page="10"
              pagination-path=""
              @vuetable:pagination-data="onPaginationData"
    >
      <div slot="topik" slot-scope="props">
        <a :href="urlDetailEvent + '/event/' + props.rowData.id + '/detail'">{{ props.rowData.topik }}</a>
      </div>
      <div slot="action" slot-scope="props" class="vuetable-action">
        <span class="clickable delete" @click="showDeleteModal(props.rowData)"><i class="fa fa-trash"></i> Delete</span>
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
      urlTable: process.env.MIX_BASE_URL + '/tableEvents',
      tempUrl: process.env.MIX_BASE_URL + '/tableEvents',
      urlDetailEvent: process.env.MIX_BASE_URL,
      fields: [
        {
          name: '__slot:topik',
          title: 'topik'
        },
        {
          name: 'tanggal_event',
          title: 'Tanggal Event'
        },
        {
          name: 'pembicara',
          title: 'Pembicara'
        },
        {
          name: 'jumlah_peserta',
          title: 'Jumlah Peserta',
          sortField: 'jumlah_peserta'
        },
        {
          name: '__slot:action',
          title: 'Action',
          titleClass: 'text-center'
        }
      ],
      searchWord: '',
      event: {}
    }
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.event_table.changePage(page)
    },
    showDeleteModal (event) {
      this.$modal.show('delete-event-modal')
      this.event = Object.assign({}, event)
    },
    hideDeleteModal () {
      this.$modal.hide('delete-event-modal')
    },
    async deleteEvent () {
      this.hideDeleteModal()
      this.$modal.show('loading-modal')
      let response = await axios({
        method: 'POST',
        url: process.env.MIX_BASE_URL + '/event/delete',
        data: {id: this.event.id}
      })
      if (response.data.status === 200) {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.$modal.show('success-modal')
          setTimeout(() => {
            this.$modal.hide('success-modal')
            this.refreshTable()
          }, 2000)
        }, 2000)
      }
    },
    doSearch () {
      this.tempUrl = this.url + '?filter=' + this.searchWord
      this.refreshTable()
    },
    refreshTable () {
      this.$nextTick(function () {
        this.$refs.event_table.refresh()
      })
    }
  }
}
</script>
