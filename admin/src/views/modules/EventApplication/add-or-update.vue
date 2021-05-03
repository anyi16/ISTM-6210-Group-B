<template>
  <div class="addEdit-block">
    <el-form
      class="detail-form-content"
      ref="ruleForm"
      :model="ruleForm"
      :rules="rules"
      label-width="80px"
	  :style="{backgroundColor:addEditForm.addEditBoxColor}"
    >
    <el-row>
    <el-col :span="12">
    <el-form-item class="input" v-if="type!='info'"  label="Event" prop="eventname">
    <el-input v-model="ruleForm.eventname" 
              placeholder="Event" clearable  :readonly="ro.eventname"></el-input>
    </el-form-item>
    <div v-else>
    <el-form-item class="input" label="Event" prop="eventname">
    <el-input v-model="ruleForm.eventname" 
                placeholder="Event" readonly></el-input>
    </el-form-item>
    </div>
    </el-col>
    <el-col :span="12">
    <el-form-item class="input" v-if="type!='info'"  label="Type" prop="eventstype">
    <el-input v-model="ruleForm.eventstype" 
              placeholder="Type" clearable  :readonly="ro.eventstype"></el-input>
    </el-form-item>
    <div v-else>
    <el-form-item class="input" label="Type" prop="eventstype">
    <el-input v-model="ruleForm.eventstype" 
                placeholder="Type" readonly></el-input>
    </el-form-item>
    </div>
    </el-col>
    <el-col :span="24">  
    <el-form-item class="upload" v-if="type!='info' && !ro.image" label="Image" prop="image">
         <file-upload
          tip="Upload"
          action="file/upload"
          :limit="3"
          :multiple="true"
          :fileUrls="ruleForm.image?ruleForm.image:''"
          @change="imageUploadChange"
          ></file-upload>
        </el-form-item>
        <div v-else>
          <el-form-item v-if="ruleForm.image" label="Image" prop="image">
            <img style="margin-right:20px;" v-bind:key="index" v-for="(item,index) in ruleForm.image.split(',')" :src="item" width="100" height="100">
          </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Address" prop="eventaddress">
        <el-input v-model="ruleForm.eventaddress" 
              placeholder="Address" clearable  :readonly="ro.eventaddress"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Address" prop="eventaddress">
        <el-input v-model="ruleForm.eventaddress" 
                placeholder="Address" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Time" prop="eventstime">
        <el-input v-model="ruleForm.eventstime" 
              placeholder="Time" clearable  :readonly="ro.eventstime"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Time" prop="eventstime">
        <el-input v-model="ruleForm.eventstime" 
                placeholder="Time" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Participants" prop="participants">
        <el-input v-model="ruleForm.participants" 
              placeholder="Participants" clearable  :readonly="ro.participants"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Participants" prop="participants">
        <el-input v-model="ruleForm.participants" 
                placeholder="Participants" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Club Account" prop="clubaccount">
        <el-input v-model="ruleForm.clubaccount" 
              placeholder="Club Account" clearable  :readonly="ro.clubaccount"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Club Account" prop="clubaccount">
        <el-input v-model="ruleForm.clubaccount" 
                placeholder="Club Account" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Club" prop="clubname">
        <el-input v-model="ruleForm.clubname" 
              placeholder="Club" clearable  :readonly="ro.clubname"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Club" prop="clubname">
        <el-input v-model="ruleForm.clubname" 
                placeholder="Club" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Contacts" prop="contacts">
          <el-input v-model="ruleForm.contacts" 
              placeholder="Contacts" clearable  :readonly="ro.contacts"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Contacts" prop="contacts">
        <el-input v-model="ruleForm.contacts" 
                placeholder="Contacts" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Phone" prop="phone">
        <el-input v-model="ruleForm.phone" 
              placeholder="Phone" clearable  :readonly="ro.phone"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Phone" prop="phone">
        <el-input v-model="ruleForm.phone" 
                placeholder="Phone" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="User Name" prop="ordinaryusername">
        <el-input v-model="ruleForm.ordinaryusername" 
              placeholder="User Name" clearable  :readonly="ro.ordinaryusername"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="User Name" prop="ordinaryusername">
        <el-input v-model="ruleForm.ordinaryusername" 
                placeholder="User Name" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
        <el-col :span="12">
        <el-form-item class="input" v-if="type!='info'"  label="Name" prop="name">
        <el-input v-model="ruleForm.name" 
              placeholder="Name" clearable  :readonly="ro.name"></el-input>
        </el-form-item>
        <div v-else>
        <el-form-item class="input" label="Name" prop="name">
        <el-input v-model="ruleForm.name" 
                placeholder="Name" readonly></el-input>
        </el-form-item>
        </div>
      </el-col>
      </el-row>                                                                                                                                                                                                                       <el-form-item class="btn">
        <el-button v-if="type!='info'" type="primary" class="btn-success" @click="onSubmit">Submit</el-button>
        <el-button v-if="type!='info'" class="btn-close" @click="back()">Cancel</el-button>
        <el-button v-if="type=='info'" class="btn-close" @click="back()">Back</el-button>
      </el-form-item>
    </el-form>
    
    
  </div>
</template>
<script>
// 
import { isNumber,isIntNumer,isEmail,isPhone, isMobile,isURL,checkIdCard } from "@/utils/validate";
export default {
  data() {
    let self = this
    var validateIdCard = (rule, value, callback) => {
      if(!value){
        callback();
      } else if (!checkIdCard(value)) {
        callback(new Error(""));
      } else {
        callback();
      }
    };
    var validateUrl = (rule, value, callback) => {
      if(!value){
        callback();
      } else if (!isURL(value)) {
        callback(new Error("Please enter the correct URL address"));
      } else {
        callback();
      }
    };
    var validateMobile = (rule, value, callback) => {
      if(!value){
        callback();
      } else if (!isMobile(value)) {
        callback(new Error("Please enter the correct mobile phone number"));
      } else {
        callback();
      }
    };
    var validatePhone = (rule, value, callback) => {
      if(!value){
        callback();
      } else if (!isPhone(value)) {
        callback(new Error("Please enter the correct phone number"));
      } else {
        callback();
      }
    };
    var validateEmail = (rule, value, callback) => {
      if(!value){
        callback();
      } else if (!isEmail(value)) {
        callback(new Error("Please enter the correct email address"));
      } else {
        callback();
      }
    };
    var validateNumber = (rule, value, callback) => {
      if(!value){
        callback();
      } else if (!isNumber(value)) {
        callback(new Error("Please enter a number"));
      } else {
        callback();
      }
    };
    var validateIntNumber = (rule, value, callback) => {
      if(!value){
        callback();
      } else if (!isIntNumer(value)) {
        callback(new Error("Please enter an integer"));
      } else {
        callback();
      }
    };
    return {
	  addEditForm: {"btnSaveFontColor":"#fff","selectFontSize":"14px","btnCancelBorderColor":"#DCDFE6","inputBorderRadius":"4px","inputFontSize":"14px","textareaBgColor":"#fff","btnSaveFontSize":"14px","textareaBorderRadius":"4px","uploadBgColor":"#fff","textareaBorderStyle":"solid","btnCancelWidth":"88px","textareaHeight":"120px","dateBgColor":"#fff","btnSaveBorderRadius":"4px","uploadLableFontSize":"14px","textareaBorderWidth":"1px","inputLableColor":"#606266","addEditBoxColor":"rgba(251, 249, 249, 1)","dateIconFontSize":"14px","btnSaveBgColor":"#409EFF","uploadIconFontColor":"#8c939d","textareaBorderColor":"#DCDFE6","btnCancelBgColor":"#ecf5ff","selectLableColor":"#606266","btnSaveBorderStyle":"solid","dateBorderWidth":"1px","dateLableFontSize":"14px","dateBorderRadius":"4px","btnCancelBorderStyle":"solid","selectLableFontSize":"14px","selectBorderStyle":"solid","selectIconFontColor":"#C0C4CC","btnCancelHeight":"44px","inputHeight":"40px","btnCancelFontColor":"#606266","dateBorderColor":"#DCDFE6","dateIconFontColor":"#C0C4CC","uploadBorderStyle":"solid","dateBorderStyle":"solid","dateLableColor":"#606266","dateFontSize":"14px","inputBorderWidth":"1px","uploadIconFontSize":"28px","selectHeight":"40px","inputFontColor":"#606266","uploadHeight":"148px","textareaLableColor":"#606266","textareaLableFontSize":"14px","btnCancelFontSize":"14px","inputBorderStyle":"solid","btnCancelBorderRadius":"4px","inputBgColor":"#fff","inputLableFontSize":"14px","uploadLableColor":"#606266","uploadBorderRadius":"4px","btnSaveHeight":"44px","selectBgColor":"#fff","btnSaveWidth":"88px","selectIconFontSize":"14px","dateHeight":"40px","selectBorderColor":"#DCDFE6","inputBorderColor":"#DCDFE6","uploadBorderColor":"#DCDFE6","textareaFontColor":"#606266","selectBorderWidth":"1px","dateFontColor":"#606266","btnCancelBorderWidth":"1px","uploadBorderWidth":"1px","textareaFontSize":"14px","selectBorderRadius":"4px","selectFontColor":"#606266","btnSaveBorderColor":"#409EFF","btnSaveBorderWidth":"1px"},
      id: '',
      type: '',
      ro:{
	eventname : false,
	eventstype : false,
	image : false,
	eventaddress : false,
	eventstime : false,
	participants : false,
	clubaccount : false,
	clubname : false,
	contacts : false,
	phone : false,
	ordinaryusername : false,
	name : false,
	sfsh : false,
	shhf : false,
      },
        ruleForm: {
                	 eventname: '',
	                 eventstype: '',
	                 image: '',
	                 eventaddress: '',
	                 eventstime: '',
	                 participants: '',
	                 clubaccount: '',
	                 clubname: '',
	                 contacts: '',
	                 phone: '',
	                 ordinaryusername: '',
	                 name: '',
	                 shhf: '',
	                      },                                                                                                                                                                                          rules: {
                  eventname: [
                                    	                                                              ],
                  eventstype: [
                                    	                                                              ],
                  image: [
                                    	                                                              ],
                  eventaddress: [
                                    	                                                              ],
                  eventstime: [
                                    	                                                              ],
                  participants: [
                                        { validator: validateIntNumber, trigger: 'blur' },
                        	                                                              ],
                  clubaccount: [
                                    	                                                              ],
                  clubname: [
                                    	                                                              ],
                  contacts: [
                                    	                                                              ],
                  phone: [
                                    	                                                              ],
                  ordinaryusername: [
                                    	                                                              ],
                  name: [
                                    	                                                              ],
                  sfsh: [
                                    	                                                              ],
                  shhf: [
                                    	                                                              ],
              }
    };
  },
  props: ["parent"],
  computed: {                                                                                                                                                                              },
  created() {
	this.addEditStyleChange()
	this.addEditUploadStyleChange()
  },
  methods: {
        // 
    download(file){
      window.open(`${file}`)
    },
    // 
    init(id,type) {
      if (id) {
        this.id = id;
        this.type = type;
      }
      if(this.type=='info'||this.type=='else'){
        this.info(id);
      }else if(this.type=='cross'){
        var obj = this.$storage.getObj('crossObj');
        for (var o in obj){
      if(o=='eventname'){
            this.ruleForm.eventname = obj[o];
	    this.ro.eventname = true;
            continue;
          }
	    if(o=='eventstype'){
            this.ruleForm.eventstype = obj[o];
	    this.ro.eventstype = true;
            continue;
          }
	    if(o=='image'){
            this.ruleForm.image = obj[o];
	    this.ro.image = true;
            continue;
          }
	    if(o=='eventaddress'){
            this.ruleForm.eventaddress = obj[o];
	    this.ro.eventaddress = true;
            continue;
          }
	    if(o=='eventstime'){
            this.ruleForm.eventstime = obj[o];
	    this.ro.eventstime = true;
            continue;
          }
	    if(o=='participants'){
            this.ruleForm.participants = obj[o];
	    this.ro.participants = true;
            continue;
          }
	    if(o=='clubaccount'){
            this.ruleForm.clubaccount = obj[o];
	    this.ro.clubaccount = true;
            continue;
          }
	    if(o=='clubname'){
            this.ruleForm.clubname = obj[o];
	    this.ro.clubname = true;
            continue;
          }
	    if(o=='contacts'){
            this.ruleForm.contacts = obj[o];
	    this.ro.contacts = true;
            continue;
          }
	    if(o=='phone'){
            this.ruleForm.phone = obj[o];
	    this.ro.phone = true;
            continue;
          }
	    if(o=='ordinaryusername'){
            this.ruleForm.ordinaryusername = obj[o];
	    this.ro.ordinaryusername = true;
            continue;
          }
	    if(o=='name'){
            this.ruleForm.name = obj[o];
	    this.ro.name = true;
            continue;
          }
	            	            	                    }
                                                                                                                                                                                                                                              }
            // 
      this.$http({
        url: `${this.$storage.get('sessionTable')}/session`,
        method: "get"
      }).then(({ data }) => {
        if (data && data.code === 0) {
          var json = data.data;                                                                                                                                                                                                 if(json.ordinaryusername!=''&&json.ordinaryusername){
              		this.ruleForm.ordinaryusername = json.ordinaryusername
		}
          if(json.name!=''&&json.name){
              		this.ruleForm.name = json.name
		}
              } else {
          this.$message.error(data.msg);
        }
      });                                                                                                                                                                                                                                                                                          },                                                                                                                       //                                                                                                                                                         info(id) {
      this.$http({
        url: `EventApplication/info/${id}`,
        method: "get"
      }).then(({ data }) => {
        if (data && data.code === 0) {
          this.ruleForm = data.data;
        } else {
          this.$message.error(data.msg);
        }
      });
    },
        // 
    onSubmit() {
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}
                  // ${column.compare}                                                                                                                                                                                                                                                        this.$refs["ruleForm"].validate(valid => {
        if (valid) {
          this.$http({
            url: `EventApplication/${!this.ruleForm.id ? "save" : "update"}`,
            method: "post",
            data: this.ruleForm
          }).then(({ data }) => {
            if (data && data.code === 0) {
              this.$message({
                message: "Done",
                type: "success",
                duration: 1500,
                onClose: () => {
                  this.parent.showFlag = true;
                  this.parent.addOrUpdateFlag = false;
                  this.parent.EventApplicationCrossAddOrUpdateFlag = false;
                  this.parent.search();
                  this.parent.contentStyleChange();
                }
              });
            } else {
              this.$message.error(data.msg);
            }
          });
        }
      });
    },
    // 
    getUUID () {
      return new Date().getTime();
    },
    // 
    back() {
      this.parent.showFlag = true;
      this.parent.addOrUpdateFlag = false;
      this.parent.EventApplicationCrossAddOrUpdateFlag = false;
      this.parent.contentStyleChange();
    },
      imageUploadChange(fileUrls) {
                this.ruleForm.image = fileUrls;
				this.addEditUploadStyleChange()
            },                                                                                                                  addEditStyleChange() {
	  this.$nextTick(()=>{
	    // input
	    document.querySelectorAll('.addEdit-block .input .el-input__inner').forEach(el=>{
	      el.style.height = this.addEditForm.inputHeight
	      el.style.color = this.addEditForm.inputFontColor
	      el.style.fontSize = this.addEditForm.inputFontSize
	      el.style.borderWidth = this.addEditForm.inputBorderWidth
	      el.style.borderStyle = this.addEditForm.inputBorderStyle
	      el.style.borderColor = this.addEditForm.inputBorderColor
	      el.style.borderRadius = this.addEditForm.inputBorderRadius
	      el.style.backgroundColor = this.addEditForm.inputBgColor
	    })
	    document.querySelectorAll('.addEdit-block .input .el-form-item__label').forEach(el=>{
	      el.style.lineHeight = this.addEditForm.inputHeight
	      el.style.color = this.addEditForm.inputLableColor
	      el.style.fontSize = this.addEditForm.inputLableFontSize
	    })
	    // select
	    document.querySelectorAll('.addEdit-block .select .el-input__inner').forEach(el=>{
	      el.style.height = this.addEditForm.selectHeight
	      el.style.color = this.addEditForm.selectFontColor
	      el.style.fontSize = this.addEditForm.selectFontSize
	      el.style.borderWidth = this.addEditForm.selectBorderWidth
	      el.style.borderStyle = this.addEditForm.selectBorderStyle
	      el.style.borderColor = this.addEditForm.selectBorderColor
	      el.style.borderRadius = this.addEditForm.selectBorderRadius
	      el.style.backgroundColor = this.addEditForm.selectBgColor
	    })
	    document.querySelectorAll('.addEdit-block .select .el-form-item__label').forEach(el=>{
	      el.style.lineHeight = this.addEditForm.selectHeight
	      el.style.color = this.addEditForm.selectLableColor
	      el.style.fontSize = this.addEditForm.selectLableFontSize
	    })
	    document.querySelectorAll('.addEdit-block .select .el-select__caret').forEach(el=>{
	      el.style.color = this.addEditForm.selectIconFontColor
	      el.style.fontSize = this.addEditForm.selectIconFontSize
	    })
	    // date
	    document.querySelectorAll('.addEdit-block .date .el-input__inner').forEach(el=>{
	      el.style.height = this.addEditForm.dateHeight
	      el.style.color = this.addEditForm.dateFontColor
	      el.style.fontSize = this.addEditForm.dateFontSize
	      el.style.borderWidth = this.addEditForm.dateBorderWidth
	      el.style.borderStyle = this.addEditForm.dateBorderStyle
	      el.style.borderColor = this.addEditForm.dateBorderColor
	      el.style.borderRadius = this.addEditForm.dateBorderRadius
	      el.style.backgroundColor = this.addEditForm.dateBgColor
	    })
	    document.querySelectorAll('.addEdit-block .date .el-form-item__label').forEach(el=>{
	      el.style.lineHeight = this.addEditForm.dateHeight
	      el.style.color = this.addEditForm.dateLableColor
	      el.style.fontSize = this.addEditForm.dateLableFontSize
	    })
	    document.querySelectorAll('.addEdit-block .date .el-input__icon').forEach(el=>{
	      el.style.color = this.addEditForm.dateIconFontColor
	      el.style.fontSize = this.addEditForm.dateIconFontSize
	      el.style.lineHeight = this.addEditForm.dateHeight
	    })
	    // upload
	    let iconLineHeight = parseInt(this.addEditForm.uploadHeight) - parseInt(this.addEditForm.uploadBorderWidth) * 2 + 'px'
	    document.querySelectorAll('.addEdit-block .upload .el-upload--picture-card').forEach(el=>{
	      el.style.width = this.addEditForm.uploadHeight
	      el.style.height = this.addEditForm.uploadHeight
	      el.style.borderWidth = this.addEditForm.uploadBorderWidth
	      el.style.borderStyle = this.addEditForm.uploadBorderStyle
	      el.style.borderColor = this.addEditForm.uploadBorderColor
	      el.style.borderRadius = this.addEditForm.uploadBorderRadius
	      el.style.backgroundColor = this.addEditForm.uploadBgColor
	    })
	    document.querySelectorAll('.addEdit-block .upload .el-form-item__label').forEach(el=>{
	      el.style.lineHeight = this.addEditForm.uploadHeight
	      el.style.color = this.addEditForm.uploadLableColor
	      el.style.fontSize = this.addEditForm.uploadLableFontSize
	    })
	    document.querySelectorAll('.addEdit-block .upload .el-icon-plus').forEach(el=>{
	      el.style.color = this.addEditForm.uploadIconFontColor
	      el.style.fontSize = this.addEditForm.uploadIconFontSize
	      el.style.lineHeight = iconLineHeight
	      el.style.display = 'block'
	    })
	    // 
	    document.querySelectorAll('.addEdit-block .textarea .el-textarea__inner').forEach(el=>{
	      el.style.height = this.addEditForm.textareaHeight
	      el.style.color = this.addEditForm.textareaFontColor
	      el.style.fontSize = this.addEditForm.textareaFontSize
	      el.style.borderWidth = this.addEditForm.textareaBorderWidth
	      el.style.borderStyle = this.addEditForm.textareaBorderStyle
	      el.style.borderColor = this.addEditForm.textareaBorderColor
	      el.style.borderRadius = this.addEditForm.textareaBorderRadius
	      el.style.backgroundColor = this.addEditForm.textareaBgColor
	    })
	    document.querySelectorAll('.addEdit-block .textarea .el-form-item__label').forEach(el=>{
	      // el.style.lineHeight = this.addEditForm.textareaHeight
	      el.style.color = this.addEditForm.textareaLableColor
	      el.style.fontSize = this.addEditForm.textareaLableFontSize
	    })
	    // 
	    document.querySelectorAll('.addEdit-block .btn .btn-success').forEach(el=>{
	      el.style.width = this.addEditForm.btnSaveWidth
	      el.style.height = this.addEditForm.btnSaveHeight
	      el.style.color = this.addEditForm.btnSaveFontColor
	      el.style.fontSize = this.addEditForm.btnSaveFontSize
	      el.style.borderWidth = this.addEditForm.btnSaveBorderWidth
	      el.style.borderStyle = this.addEditForm.btnSaveBorderStyle
	      el.style.borderColor = this.addEditForm.btnSaveBorderColor
	      el.style.borderRadius = this.addEditForm.btnSaveBorderRadius
	      el.style.backgroundColor = this.addEditForm.btnSaveBgColor
	    })
	    // 
	    document.querySelectorAll('.addEdit-block .btn .btn-close').forEach(el=>{
	      el.style.width = this.addEditForm.btnCancelWidth
	      el.style.height = this.addEditForm.btnCancelHeight
	      el.style.color = this.addEditForm.btnCancelFontColor
	      el.style.fontSize = this.addEditForm.btnCancelFontSize
	      el.style.borderWidth = this.addEditForm.btnCancelBorderWidth
	      el.style.borderStyle = this.addEditForm.btnCancelBorderStyle
	      el.style.borderColor = this.addEditForm.btnCancelBorderColor
	      el.style.borderRadius = this.addEditForm.btnCancelBorderRadius
	      el.style.backgroundColor = this.addEditForm.btnCancelBgColor
	    })
	  })
	},
	addEditUploadStyleChange() {
		this.$nextTick(()=>{
		  document.querySelectorAll('.addEdit-block .upload .el-upload-list--picture-card .el-upload-list__item').forEach(el=>{
			el.style.width = this.addEditForm.uploadHeight
			el.style.height = this.addEditForm.uploadHeight
			el.style.borderWidth = this.addEditForm.uploadBorderWidth
			el.style.borderStyle = this.addEditForm.uploadBorderStyle
			el.style.borderColor = this.addEditForm.uploadBorderColor
			el.style.borderRadius = this.addEditForm.uploadBorderRadius
			el.style.backgroundColor = this.addEditForm.uploadBgColor
		  })
	  })
	},
  }
};
</script>
<style lang="scss">
.editor{
  height: 500px;
  
  & /deep/ .ql-container {
	  height: 310px;
  }
}
.amap-wrapper {
  width: 100%;
  height: 500px;
}
.search-box {
  position: absolute;
}
.addEdit-block {
	margin: -10px;
}
.detail-form-content {
	padding: 12px;
}
.btn .el-button {
  padding: 0;
}
</style>
