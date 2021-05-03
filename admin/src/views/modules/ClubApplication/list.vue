<template>
  <div class="main-content">
    
  <div v-if="showFlag">
    <el-form :inline="true" :model="searchForm" class="form-content">
    <el-row :gutter="20" class="slt" :style="{justifyContent:contents.searchBoxPosition=='1'?'flex-start':contents.searchBoxPosition=='2'?'center':'flex-end'}">
    <el-form-item :label="contents.inputTitle == 1 ? 'Club' : ''">
    <el-input v-if="contents.inputIcon == 1 && contents.inputIconPosition == 1" prefix-icon="el-icon-search" v-model="searchForm.clubname" placeholder="Club" clearable></el-input>
    <el-input v-if="contents.inputIcon == 1 && contents.inputIconPosition == 2" suffix-icon="el-icon-search" v-model="searchForm.clubname" placeholder="Club" clearable></el-input>
    <el-input v-if="contents.inputIcon == 0" v-model="searchForm.clubname" placeholder="Club" clearable></el-input>
    </el-form-item>
    <el-form-item :label="contents.inputTitle == 1 ? 'Type' : ''">
    <el-input v-if="contents.inputIcon == 1 && contents.inputIconPosition == 1" prefix-icon="el-icon-search" v-model="searchForm.clubtype" placeholder="Type" clearable></el-input>
    <el-input v-if="contents.inputIcon == 1 && contents.inputIconPosition == 2" suffix-icon="el-icon-search" v-model="searchForm.clubtype" placeholder="Type" clearable></el-input>
    <el-input v-if="contents.inputIcon == 0" v-model="searchForm.clubtype" placeholder="Type" clearable></el-input>
    </el-form-item>                                                                                                  <el-form-item>
    <el-button v-if="contents.searchBtnIcon == 1 && contents.searchBtnIconPosition == 1" icon="el-icon-search" type="success" @click="search()">{{ contents.searchBtnFont == 1?'Search':'' }}</el-button>
    <el-button v-if="contents.searchBtnIcon == 1 && contents.searchBtnIconPosition == 2" type="success" @click="search()">{{ contents.searchBtnFont == 1?'Search':'' }}<i class="el-icon-search el-icon--right"/></el-button>
    <el-button v-if="contents.searchBtnIcon == 0" type="success" @click="search()">{{ contents.searchBtnFont == 1?'Search':'' }}</el-button>
    </el-form-item>
    </el-row>
       <el-row class="ad" :style="{justifyContent:contents.btnAdAllBoxPosition=='1'?'flex-start':contents.btnAdAllBoxPosition=='2'?'center':'flex-end'}">
          <el-form-item>
            <el-button
              v-if="isAuth('ClubApplication','Add') && contents.btnAdAllIcon == 1 && contents.btnAdAllIconPosition == 1"
              type="success"
              icon="el-icon-plus"
              @click="addOrUpdateHandler()"
            >{{ contents.btnAdAllFont == 1?'Add':'' }}</el-button>
            <el-button
              v-if="isAuth('ClubApplication','Add') && contents.btnAdAllIcon == 1 && contents.btnAdAllIconPosition == 2"
              type="success"
              @click="addOrUpdateHandler()"
            >{{ contents.btnAdAllFont == 1?'Add':'' }}<i class="el-icon-plus el-icon--right" /></el-button>
            <el-button
              v-if="isAuth('ClubApplication','Add') && contents.btnAdAllIcon == 0"
              type="success"
              @click="addOrUpdateHandler()"
            >{{ contents.btnAdAllFont == 1?'Add':'' }}</el-button>
            <el-button
              v-if="isAuth('ClubApplication','Delete') && contents.btnAdAllIcon == 1 && contents.btnAdAllIconPosition == 1 && contents.tableSelection"
              :disabled="dataListSelections.length <= 0"
              type="danger"
              icon="el-icon-delete"
              @click="deleteHandler()"
            >{{ contents.btnAdAllFont == 1?'Delete':'' }}</el-button>
            <el-button
              v-if="isAuth('ClubApplication','Delete') && contents.btnAdAllIcon == 1 && contents.btnAdAllIconPosition == 2 && contents.tableSelection"
              :disabled="dataListSelections.length <= 0"
              type="danger"
              @click="deleteHandler()"
            >{{ contents.btnAdAllFont == 1?'Delete':'' }}<i class="el-icon-delete el-icon--right" /></el-button>
            <el-button
              v-if="isAuth('ClubApplication','Delete') && contents.btnAdAllIcon == 0 && contents.tableSelection"
              :disabled="dataListSelections.length <= 0"
              type="danger"
              @click="deleteHandler()"
            >{{ contents.btnAdAllFont == 1?'Delete':'' }}</el-button>


            </el-form-item>
        </el-row>
      </el-form>
      <div class="table-content">
        <el-table class="tables" :size="contents.tableSize" :show-header="contents.tableShowHeader"
            :header-row-style="headerRowStyle" :header-cell-style="headerCellStyle"
            :border="contents.tableBorder"
            :fit="contents.tableFit"
            :stripe="contents.tableStripe"
            :row-style="rowStyle"
            :cell-style="cellStyle"
            :style="{width: '100%',fontSize:contents.tableContentFontSize,color:contents.tableContentFontColor}"
            v-if="isAuth('ClubApplication','View')"
            :data="dataList"
            v-loading="dataListLoading"
            @selection-change="selectionChangeHandler">
            <el-table-column  v-if="contents.tableSelection"
                type="selection"
                header-align="center"
                align="center"
                width="50">
            </el-table-column>
            <el-table-column label="Index" v-if="contents.tableIndex" type="index" width="50" />
            <el-table-column  :sortable="contents.tableSortable" :align="contents.tableAlign"
                    prop="clubaccount"
                    header-align="center"
		    label="Club Account">
		     <template slot-scope="scope">
                       {{scope.row.clubaccount}}
         </template>
        </el-table-column>
        <el-table-column  :sortable="contents.tableSortable" :align="contents.tableAlign"
                    prop="clubname"
                    header-align="center"
		    label="Club">
		     <template slot-scope="scope">
                       {{scope.row.clubname}}
         </template>
        </el-table-column>
        <el-table-column  :sortable="contents.tableSortable" :align="contents.tableAlign"
                    prop="clubtype"
                    header-align="center"
		    label="Type">
		     <template slot-scope="scope">
                       {{scope.row.clubtype}}
         </template>
        </el-table-column>
        <el-table-column  :sortable="contents.tableSortable" :align="contents.tableAlign"
                    prop="phone"
                    header-align="center"
		    label="Phone">
		     <template slot-scope="scope">
                       {{scope.row.phone}}
         </template>
        </el-table-column>
        <el-table-column  :sortable="contents.tableSortable" :align="contents.tableAlign"
                    prop="clubaddress"
                    header-align="center"
		    label="Address">
		     <template slot-scope="scope">
                       {{scope.row.clubaddress}}
         </template>
        </el-table-column>
        <el-table-column  :sortable="contents.tableSortable" :align="contents.tableAlign"
                    prop="ordinaryusername"
                    header-align="center"
		    label="User Name">
		     <template slot-scope="scope">
                       {{scope.row.ordinaryusername}}
         </template>
        </el-table-column>
        <el-table-column  :sortable="contents.tableSortable" :align="contents.tableAlign"
                    prop="name"
                    header-align="center"
		    label="Name">
		     <template slot-scope="scope">
                       {{scope.row.name}}
         </template>
        </el-table-column>                	                	                                    	                 <el-table-column :sortable="contents.tableSortable" :align="contents.tableAlign"
                  prop="shhf"
                  header-align="center"
                  label="Comment">
              </el-table-column>
              <el-table-column :sortable="contents.tableSortable" :align="contents.tableAlign"
                  prop="sfsh"
                  header-align="center"
                  label="Status">
                  <template slot-scope="scope">
                    <span style="margin-right:10px">{{scope.row.sfsh=='Yes'?'Approved':'Reject'}}</span>
                  </template>
              </el-table-column>
              <el-table-column :sortable="contents.tableSortable" :align="contents.tableAlign"
                  v-if="isAuth('ClubApplication','Approval')"
                  prop="sfsh"
                  header-align="center"
                  label="Approval">
                  <template slot-scope="scope">
                    <el-button  type="text" icon="el-icon-edit" size="small" @click="shDialog(scope.row)">Approval</el-button>
                  </template>
              </el-table-column>
              <el-table-column width="300" :align="contents.tableAlign"
                header-align="center"
                label="OK">
                <template slot-scope="scope">
                <el-button v-if="isAuth('ClubApplication','View') && contents.tableBtnIcon == 1 && contents.tableBtnIconPosition == 1" type="success" icon="el-icon-tickets" size="mini" @click="addOrUpdateHandler(scope.row.id,'info')">{{ contents.tableBtnFont == 1?'Detail':'' }}</el-button>
                <el-button v-if="isAuth('ClubApplication','View') && contents.tableBtnIcon == 1 && contents.tableBtnIconPosition == 2" type="success" size="mini" @click="addOrUpdateHandler(scope.row.id,'info')">{{ contents.tableBtnFont == 1?'Detail':'' }}<i class="el-icon-tickets el-icon--right" /></el-button>
                <el-button v-if="isAuth('ClubApplication','View') && contents.tableBtnIcon == 0" type="success" size="mini" @click="addOrUpdateHandler(scope.row.id,'info')">{{ contents.tableBtnFont == 1?'Detail':'' }}</el-button>
                <el-button v-if="isAuth('ClubApplication','Update') && contents.tableBtnIcon == 1 && contents.tableBtnIconPosition == 1" type="primary" icon="el-icon-edit" size="mini" @click="addOrUpdateHandler(scope.row.id)">{{ contents.tableBtnFont == 1?'Update':'' }}</el-button>
                <el-button v-if="isAuth('ClubApplication','Update') && contents.tableBtnIcon == 1 && contents.tableBtnIconPosition == 2" type="primary" size="mini" @click="addOrUpdateHandler(scope.row.id)">{{ contents.tableBtnFont == 1?'Update':'' }}<i class="el-icon-edit el-icon--right" /></el-button>
                <el-button v-if="isAuth('ClubApplication','Update') && contents.tableBtnIcon == 0" type="primary" size="mini" @click="addOrUpdateHandler(scope.row.id)">{{ contents.tableBtnFont == 1?'Update':'' }}</el-button>




                <el-button v-if="isAuth('ClubApplication','Delete') && contents.tableBtnIcon == 1 && contents.tableBtnIconPosition == 1" type="danger" icon="el-icon-delete" size="mini" @click="deleteHandler(scope.row.id)">{{ contents.tableBtnFont == 1?'Delete':'' }}</el-button>
                <el-button v-if="isAuth('ClubApplication','Delete') && contents.tableBtnIcon == 1 && contents.tableBtnIconPosition == 2" type="danger" size="mini" @click="deleteHandler(scope.row.id)">{{ contents.tableBtnFont == 1?'Delete':'' }}<i class="el-icon-delete el-icon--right" /></el-button>
                <el-button v-if="isAuth('ClubApplication','Delete') && contents.tableBtnIcon == 0" type="danger" size="mini" @click="deleteHandler(scope.row.id)">{{ contents.tableBtnFont == 1?'Delete':'' }}</el-button>
                </template>
            </el-table-column>
        </el-table>                                                                                                    <el-pagination
          clsss="pages"
          :layout="layouts"
          @size-change="sizeChangeHandle"
          @current-change="currentChangeHandle"
          :current-page="pageIndex"
          :page-sizes="[10, 20, 50, 100]"
          :page-size="Number(contents.pageEachNum)"
          :total="totalPage"
          :small="contents.pageStyle"
          class="pagination-content"
          :background="contents.pageBtnBG"
          :style="{textAlign:contents.pagePosition==1?'left':contents.pagePosition==2?'center':'right'}"
        ></el-pagination>
      </div>
    </div>
    
    <add-or-update v-if="addOrUpdateFlag" :parent="this" ref="addOrUpdate"></add-or-update>

    
        <el-dialog
      title="Approval"
      :visible.sync="sfshVisiable"
      width="50%">
      <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="Status">
          <el-select v-model="shForm.sfsh" placeholder="Status">
            <el-option label="Approved" value="Yes"></el-option>
            <el-option label="Reject" value="No"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Content">
          <el-input type="textarea" :rows="8" v-model="shForm.shhf"></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="shDialog">Cancel</el-button>
        <el-button type="primary" @click="shHandler">OK</el-button>
      </span>
    </el-dialog>
    
      </div>
</template>
<script>
import AddOrUpdate from "./add-or-update";
export default {
  data() {
    return {                                                                                                                  searchForm: {
        key: ""
      },
      dataList: [],
      pageIndex: 1,
      pageSize: 10,
      totalPage: 0,
      dataListLoading: false,
      dataListSelections: [],
      showFlag: true,
      sfshVisiable: false,
      shForm: {},
      chartVisiable: false,
      addOrUpdateFlag:false,
            contents:{"searchBtnFontColor":"rgba(252, 250, 250, 1)","pagePosition":"1","inputFontSize":"14px","inputBorderRadius":"4px","tableBtnDelFontColor":"rgba(255, 255, 255, 1)","tableBtnIconPosition":"1","searchBtnHeight":"40px","inputIconColor":"rgba(7, 82, 232, 1)","searchBtnBorderRadius":"4px","tableStripe":true,"tableBtnDelBgColor":"rgba(245, 194, 61, 1)","btnAdAllWarnFontColor":"rgba(252, 252, 252, 1)","searchBtnIcon":"1","tableSize":"medium","searchBtnBorderStyle":"solid","tableSelection":true,"searchBtnBorderWidth":"1px","tableContentFontSize":"15px","searchBtnBgColor":"rgba(13, 142, 235, 1)","inputTitleSize":"14px","btnAdAllBorderColor":"#DCDFE6","pageJumper":true,"btnAdAllIconPosition":"1","searchBoxPosition":"1","tableBtnDetailFontColor":"rgba(255, 255, 255, 1)","tableBtnHeight":"40px","pagePager":true,"searchBtnBorderColor":"#DCDFE6","tableHeaderFontColor":"#909399","inputTitle":"1","tableBtnBorderRadius":"4px","btnAdAllFont":"1","btnAdAllDelFontColor":"rgba(252, 252, 252, 1)","tableBtnIcon":"1","btnAdAllHeight":"40px","btnAdAllWarnBgColor":"rgba(245, 194, 61, 1)","btnAdAllBorderWidth":"0px","tableStripeFontColor":"#606266","tableBtnBorderStyle":"solid","inputHeight":"40px","btnAdAllBorderRadius":"4px","btnAdAllDelBgColor":"rgba(255, 87, 87, 1)","pagePrevNext":true,"btnAdAllAddBgColor":"rgba(13, 142, 235, 1)","searchBtnFont":"1","tableIndex":true,"btnAdAllIcon":"1","tableSortable":true,"pageSizes":true,"tableFit":true,"pageBtnBG":true,"searchBtnFontSize":"16px","tableBtnEditBgColor":"rgba(255, 87, 87, 1)","inputBorderWidth":"1px","inputFontPosition":"1","inputFontColor":"#333","pageEachNum":10,"tableHeaderBgColor":"#fff","inputTitleColor":"#333","btnAdAllBoxPosition":"1","tableBtnDetailBgColor":"rgba(13, 142, 235, 1)","inputIcon":"0","searchBtnIconPosition":"1","btnAdAllFontSize":"15px","inputBorderStyle":"solid","inputBgColor":"rgba(245, 241, 241, 1)","pageStyle":false,"pageTotal":true,"btnAdAllAddFontColor":"rgba(252, 252, 252, 1)","tableBtnFont":"1","tableContentFontColor":"#606266","inputBorderColor":"#DCDFE6","tableShowHeader":true,"tableBtnFontSize":"15px","tableBtnBorderColor":"#DCDFE6","inputIconPosition":"1","tableBorder":true,"btnAdAllBorderStyle":"solid","tableBtnBorderWidth":"0px","tableStripeBgColor":"#F5F7FA","tableBtnEditFontColor":"rgba(255, 255, 255, 1)","tableAlign":"center"},
      layouts: '',


    };
  },
  created() {
    this.init();
    this.getDataList();
    this.contentStyleChange()
  },
  mounted() {

  },
  filters: {
    htmlfilter: function (val) {
      return val.replace(/<[^>]*>/g).replace(/undefined/g,'');
    }
  },
  components: {
    AddOrUpdate,
      },
  methods: {
    contentStyleChange() {
      this.contentSearchStyleChange()
      this.contentBtnAdAllStyleChange()
      this.contentSearchBtnStyleChange()
      this.contentTableBtnStyleChange()
      this.contentPageStyleChange()
    },
    contentSearchStyleChange() {
      this.$nextTick(()=>{
        document.querySelectorAll('.form-content .slt .el-input__inner').forEach(el=>{
          let textAlign = 'left'
          if(this.contents.inputFontPosition == 2) textAlign = 'center'
          if(this.contents.inputFontPosition == 3) textAlign = 'right'
          el.style.textAlign = textAlign
          el.style.height = this.contents.inputHeight
          el.style.lineHeight = this.contents.inputHeight
          el.style.color = this.contents.inputFontColor
          el.style.fontSize = this.contents.inputFontSize
          el.style.borderWidth = this.contents.inputBorderWidth
          el.style.borderStyle = this.contents.inputBorderStyle
          el.style.borderColor = this.contents.inputBorderColor
          el.style.borderRadius = this.contents.inputBorderRadius
          el.style.backgroundColor = this.contents.inputBgColor
        })
        if(this.contents.inputTitle) {
          document.querySelectorAll('.form-content .slt .el-form-item__label').forEach(el=>{
            el.style.color = this.contents.inputTitleColor
            el.style.fontSize = this.contents.inputTitleSize
            el.style.lineHeight = this.contents.inputHeight
          })
        }
        setTimeout(()=>{
          document.querySelectorAll('.form-content .slt .el-input__prefix').forEach(el=>{
            el.style.color = this.contents.inputIconColor
            el.style.lineHeight = this.contents.inputHeight
          })
          document.querySelectorAll('.form-content .slt .el-input__suffix').forEach(el=>{
            el.style.color = this.contents.inputIconColor
            el.style.lineHeight = this.contents.inputHeight
          })
          document.querySelectorAll('.form-content .slt .el-input__icon').forEach(el=>{
            el.style.lineHeight = this.contents.inputHeight
          })
        },10)

      })
    },
    // 
    contentSearchBtnStyleChange() {
      this.$nextTick(()=>{
        document.querySelectorAll('.form-content .slt .el-button--success').forEach(el=>{
          el.style.height = this.contents.searchBtnHeight
          el.style.color = this.contents.searchBtnFontColor
          el.style.fontSize = this.contents.searchBtnFontSize
          el.style.borderWidth = this.contents.searchBtnBorderWidth
          el.style.borderStyle = this.contents.searchBtnBorderStyle
          el.style.borderColor = this.contents.searchBtnBorderColor
          el.style.borderRadius = this.contents.searchBtnBorderRadius
          el.style.backgroundColor = this.contents.searchBtnBgColor
        })
      })
    },
    // 
    contentBtnAdAllStyleChange() {
      this.$nextTick(()=>{
        document.querySelectorAll('.form-content .ad .el-button--success').forEach(el=>{
          el.style.height = this.contents.btnAdAllHeight
          el.style.color = this.contents.btnAdAllAddFontColor
          el.style.fontSize = this.contents.btnAdAllFontSize
          el.style.borderWidth = this.contents.btnAdAllBorderWidth
          el.style.borderStyle = this.contents.btnAdAllBorderStyle
          el.style.borderColor = this.contents.btnAdAllBorderColor
          el.style.borderRadius = this.contents.btnAdAllBorderRadius
          el.style.backgroundColor = this.contents.btnAdAllAddBgColor
        })
        document.querySelectorAll('.form-content .ad .el-button--danger').forEach(el=>{
          el.style.height = this.contents.btnAdAllHeight
          el.style.color = this.contents.btnAdAllDelFontColor
          el.style.fontSize = this.contents.btnAdAllFontSize
          el.style.borderWidth = this.contents.btnAdAllBorderWidth
          el.style.borderStyle = this.contents.btnAdAllBorderStyle
          el.style.borderColor = this.contents.btnAdAllBorderColor
          el.style.borderRadius = this.contents.btnAdAllBorderRadius
          el.style.backgroundColor = this.contents.btnAdAllDelBgColor
        })
        document.querySelectorAll('.form-content .ad .el-button--warning').forEach(el=>{
          el.style.height = this.contents.btnAdAllHeight
          el.style.color = this.contents.btnAdAllWarnFontColor
          el.style.fontSize = this.contents.btnAdAllFontSize
          el.style.borderWidth = this.contents.btnAdAllBorderWidth
          el.style.borderStyle = this.contents.btnAdAllBorderStyle
          el.style.borderColor = this.contents.btnAdAllBorderColor
          el.style.borderRadius = this.contents.btnAdAllBorderRadius
          el.style.backgroundColor = this.contents.btnAdAllWarnBgColor
        })
      })
    },
    // 
    rowStyle({ row, rowIndex}) {
      if (rowIndex % 2 == 1) {
        if(this.contents.tableStripe) {
          return {color:this.contents.tableStripeFontColor}
        }
      } else {
        return ''
      }
    },
    cellStyle({ row, rowIndex}){
      if (rowIndex % 2 == 1) {
        if(this.contents.tableStripe) {
          return {backgroundColor:this.contents.tableStripeBgColor}
        }
      } else {
        return ''
      }
    },
    headerRowStyle({ row, rowIndex}){
      return {color: this.contents.tableHeaderFontColor}
    },
    headerCellStyle({ row, rowIndex}){
      return {backgroundColor: this.contents.tableHeaderBgColor}
    },
    // 
    contentTableBtnStyleChange(){
      // this.$nextTick(()=>{
      //   setTimeout(()=>{
      //     document.querySelectorAll('.table-content .tables .el-table__body .el-button--success').forEach(el=>{
      //       el.style.height = this.contents.tableBtnHeight
      //       el.style.color = this.contents.tableBtnDetailFontColor
      //       el.style.fontSize = this.contents.tableBtnFontSize
      //       el.style.borderWidth = this.contents.tableBtnBorderWidth
      //       el.style.borderStyle = this.contents.tableBtnBorderStyle
      //       el.style.borderColor = this.contents.tableBtnBorderColor
      //       el.style.borderRadius = this.contents.tableBtnBorderRadius
      //       el.style.backgroundColor = this.contents.tableBtnDetailBgColor
      //     })
      //     document.querySelectorAll('.table-content .tables .el-table__body .el-button--primary').forEach(el=>{
      //       el.style.height = this.contents.tableBtnHeight
      //       el.style.color = this.contents.tableBtnEditFontColor
      //       el.style.fontSize = this.contents.tableBtnFontSize
      //       el.style.borderWidth = this.contents.tableBtnBorderWidth
      //       el.style.borderStyle = this.contents.tableBtnBorderStyle
      //       el.style.borderColor = this.contents.tableBtnBorderColor
      //       el.style.borderRadius = this.contents.tableBtnBorderRadius
      //       el.style.backgroundColor = this.contents.tableBtnEditBgColor
      //     })
      //     document.querySelectorAll('.table-content .tables .el-table__body .el-button--danger').forEach(el=>{
      //       el.style.height = this.contents.tableBtnHeight
      //       el.style.color = this.contents.tableBtnDelFontColor
      //       el.style.fontSize = this.contents.tableBtnFontSize
      //       el.style.borderWidth = this.contents.tableBtnBorderWidth
      //       el.style.borderStyle = this.contents.tableBtnBorderStyle
      //       el.style.borderColor = this.contents.tableBtnBorderColor
      //       el.style.borderRadius = this.contents.tableBtnBorderRadius
      //       el.style.backgroundColor = this.contents.tableBtnDelBgColor
      //     })

      //   }, 50)
      // })
    },
    // 
    contentPageStyleChange(){
      let arr = []

      if(this.contents.pageTotal) arr.push('total')
      if(this.contents.pageSizes) arr.push('sizes')
      if(this.contents.pagePrevNext){
        arr.push('prev')
        if(this.contents.pagePager) arr.push('pager')
        arr.push('next')
      }
      if(this.contents.pageJumper) arr.push('jumper')
      this.layouts = arr.join()
      this.contents.pageEachNum = 10
    },

    init () {                                                                                                                                                                                                                                                                                      },
    search() {
      this.pageIndex = 1;
      this.getDataList();
    },
    // 
    getDataList() {
      this.dataListLoading = true;
      let params = {
        page: this.pageIndex,
        limit: this.pageSize,
        sort: 'id',
      }
      if(this.searchForm.clubname!='' && this.searchForm.clubname!=undefined){
            params['clubname'] = '%' + this.searchForm.clubname + '%'
          }
      if(this.searchForm.clubtype!='' && this.searchForm.clubtype!=undefined){
            params['clubtype'] = '%' + this.searchForm.clubtype + '%'
          }                                                                                                           this.$http({
        url: "ClubApplication/page",
        method: "get",
        params: params
      }).then(({ data }) => {
        if (data && data.code === 0) {
          this.dataList = data.data.list;
          this.totalPage = data.data.total;
        } else {
          this.dataList = [];
          this.totalPage = 0;
        }
        this.dataListLoading = false;
      });
    },
    // 
    sizeChangeHandle(val) {
      this.pageSize = val;
      this.pageIndex = 1;
      this.getDataList();
    },
    // 
    currentChangeHandle(val) {
      this.pageIndex = val;
      this.getDataList();
    },
    // 
    selectionChangeHandler(val) {
      this.dataListSelections = val;
    },
    // 
    addOrUpdateHandler(id,type) {
      this.showFlag = false;
      this.addOrUpdateFlag = true;
      this.crossAddOrUpdateFlag = false;
      if(type!='info'){
        type = 'else';
      }
      this.$nextTick(() => {
        this.$refs.addOrUpdate.init(id,type);
      });
    },
    // 
        // 
    shDialog(row){
      this.sfshVisiable = !this.sfshVisiable;
      if(row){
        this.shForm = {
                    clubaccount: row.clubaccount,
                    clubname: row.clubname,
                    clubtype: row.clubtype,
                    phone: row.phone,
                    clubaddress: row.clubaddress,
                    ordinaryusername: row.ordinaryusername,
                    name: row.name,
                    sfsh: row.sfsh,
                    shhf: row.shhf,
                    id: row.id
        }
      }
    },
    // 
    shHandler(){
      this.$confirm(`Confirm?`, "Tips", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning"
      }).then(() => {
        this.$http({
          url: "ClubApplication/update",
          method: "post",
          data: this.shForm
        }).then(({ data }) => {
          if (data && data.code === 0) {
            this.$message({
              message: "Done",
              type: "success",
              duration: 1500,
              onClose: () => {
                this.getDataList();
                this.shDialog()
              }
            });
          } else {
            this.$message.error(data.msg);
          }
        });
      });
    },
        // 
    download(file){
      window.open(`${file}`)
    },
    // 
    deleteHandler(id) {
      var ids = id
        ? [Number(id)]
        : this.dataListSelections.map(item => {
            return Number(item.id);
          });
      this.$confirm(`Confirm[${id ? "Delete" : "Delete All"}]?`, "Tips", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning"
      }).then(() => {
        this.$http({
          url: "ClubApplication/delete",
          method: "post",
          data: ids
        }).then(({ data }) => {
          if (data && data.code === 0) {
            this.$message({
              message: "Done",
              type: "success",
              duration: 1500,
              onClose: () => {
                this.search();
              }
            });
          } else {
            this.$message.error(data.msg);
          }
        });
      });
    },
  }

};
</script>
<style lang="scss" scoped>
  .slt {
    margin: 0 !important;
    display: flex;
  }

  .ad {
    margin: 0 !important;
    display: flex;
  }

  .pages {
    & /deep/ el-pagination__sizes{
      & /deep/ el-input__inner {
        height: 22px;
        line-height: 22px;
      }
    }
  }
  

  .el-button+.el-button {
    margin:0;
  } 

  .tables {
	& /deep/ .el-button--success {
		height: 40px;
		color: rgba(255, 255, 255, 1);
		font-size: 15px;
		border-width: 0px;
		border-style: solid;
		border-color: #DCDFE6;
		border-radius: 4px;
		background-color: rgba(13, 142, 235, 1);
	}
	
	& /deep/ .el-button--primary {
		height: 40px;
		color: rgba(255, 255, 255, 1);
		font-size: 15px;
		border-width: 0px;
		border-style: solid;
		border-color: #DCDFE6;
		border-radius: 4px;
		background-color: rgba(255, 87, 87, 1);
	}
	
	& /deep/ .el-button--danger {
		height: 40px;
		color: rgba(255, 255, 255, 1);
		font-size: 15px;
		border-width: 0px;
		border-style: solid;
		border-color: #DCDFE6;
		border-radius: 4px;
		background-color: rgba(245, 194, 61, 1);
	}

    & /deep/ .el-button {
      margin: 4px;
    }
  }

</style>
