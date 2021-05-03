<template>
  <div>
    <el-form
      class="detail-form-content"
      ref="ruleForm"
      :model="ruleForm"
      label-width="80px"
    >  
     <el-row>
        <el-col :span="12">
        <el-form-item   v-if="flag=='Club'"  label="Club Account" prop="clubaccount">
          <el-input v-model="ruleForm.clubaccount" readonly              placeholder="Club Account" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-col :span="24">  
        <el-form-item v-if="flag=='Club'" label="Image" prop="image">
          <file-upload
          tip="Upload"
          action="file/upload"
          :limit="3"
          :multiple="true"
          :fileUrls="ruleForm.image?ruleForm.image:''"
          @change="clubimageUploadChange"
          ></file-upload>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item   v-if="flag=='Club'"  label="Club" prop="clubname">
          <el-input v-model="ruleForm.clubname"               placeholder="Club" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item   v-if="flag=='Club'"  label="Type" prop="clubtype">
          <el-input v-model="ruleForm.clubtype"               placeholder="Type" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item   v-if="flag=='Club'"  label="Contacts" prop="contacts">
          <el-input v-model="ruleForm.contacts"               placeholder="Contacts" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item   v-if="flag=='Club'"  label="Phone" prop="phone">
          <el-input v-model="ruleForm.phone"               placeholder="Phone" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item   v-if="flag=='OrdinaryUser'"  label="User Name" prop="ordinaryusername">
          <el-input v-model="ruleForm.ordinaryusername" readonly              placeholder="User Name" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item   v-if="flag=='OrdinaryUser'"  label="Name" prop="name">
          <el-input v-model="ruleForm.name"               placeholder="Name" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item v-if="flag=='OrdinaryUser'"  label="Gender" prop="gender">
          <el-select v-model="ruleForm.gender" placeholder="Select Gender">
            <el-option
                v-for="(item,index) in usergenderOptions"
                v-bind:key="index"
                :label="item"
                :value="item">
            </el-option>
          </el-select>
        </el-form-item>
      </el-col>
        <el-col :span="24">  
        <el-form-item v-if="flag=='OrdinaryUser'" label="Profile Photo" prop="profilephoto">
          <file-upload
          tip="Upload"
          action="file/upload"
          :limit="3"
          :multiple="true"
          :fileUrls="ruleForm.profilephoto?ruleForm.profilephoto:''"
          @change="userprofilephotoUploadChange"
          ></file-upload>
        </el-form-item>
      </el-col>
        <el-col :span="12">
        <el-form-item   v-if="flag=='OrdinaryUser'"  label="Email" prop="email">
          <el-input v-model="ruleForm.email"               placeholder="Email" clearable></el-input>
        </el-form-item>
      </el-col>
        <el-form-item v-if="flag=='users'" label="User Name" prop="username">
        <el-input v-model="ruleForm.username" 
        placeholder="User Name"></el-input>
      </el-form-item>
      <el-col :span="24">
      <el-form-item>
        <el-button type="primary" @click="onUpdateHandler">Update</el-button>
      </el-form-item>
      </el-col>
      </el-row>
    </el-form>
  </div>
</template>
<script>
import { isNumber,isIntNumer,isEmail,isMobile,isPhone,isURL,checkIdCard } from "@/utils/validate";

export default {
  data() {
    return {
      ruleForm: {},
      flag: '',
      usersFlag: false,                                                                                                                                                                                                                 usergenderOptions: [],
                                                                                                    };
  },
  mounted() {
    var table = this.$storage.get("sessionTable");
    this.flag = table;
    this.$http({
      url: `${this.$storage.get("sessionTable")}/session`,
      method: "get"
    }).then(({ data }) => {
      if (data && data.code === 0) {
        this.ruleForm = data.data;
      } else {
        this.$message.error(data.msg);
      }
    });                                                                                                                                          this.usergenderOptions = "Male,Female".split(',')
                                                                  },
  methods: {                                                                                                                                                                                                                                        clubimageUploadChange(fileUrls) {
        this.ruleForm.image = fileUrls;
    },                                                                                                                      userprofilephotoUploadChange(fileUrls) {
        this.ruleForm.profilephoto = fileUrls;
    },
                                                            onUpdateHandler() {
                              if((!this.ruleForm.clubaccount)&& 'Club'==this.flag){
        this.$message.error('Club Account Cannot be Empty');
        return
      }
        if((!this.ruleForm.password)&& 'Club'==this.flag){
        this.$message.error('Password Cannot be Empty');
        return
      }                                                                                                                        if((!this.ruleForm.clubname)&& 'Club'==this.flag){
        this.$message.error('Club Cannot be Empty');
        return
      }                                                                                                                if( 'Club' ==this.flag && this.ruleForm.phone&&(!isMobile(this.ruleForm.phone))){
        this.$message.error(`Phone Number Format Must be Correct`);
        return
      }
        if((!this.ruleForm.ordinaryusername)&& 'OrdinaryUser'==this.flag){
        this.$message.error('User Name Cannot be Empty');
        return
      }
        if((!this.ruleForm.password)&& 'OrdinaryUser'==this.flag){
        this.$message.error('Password Cannot be Empty');
        return
      }
        if((!this.ruleForm.name)&& 'OrdinaryUser'==this.flag){
        this.$message.error('Name Cannot be Empty');
        return
      }                                                                                                                if( 'OrdinaryUser' ==this.flag && this.ruleForm.email&&(!isEmail(this.ruleForm.email))){
        this.$message.error(`Email Format Must be Correct`);
        return
      }
        this.$http({
        url: `${this.$storage.get("sessionTable")}/update`,
        method: "post",
        data: this.ruleForm
      }).then(({ data }) => {
        if (data && data.code === 0) {
          this.$message({
            message: "Update Successfully",
            type: "success",
            duration: 1500,
            onClose: () => {
            }
          });
        } else {
          this.$message.error(data.msg);
        }
      });
    }
  }
};
</script>
<style lang="scss" scoped>
</style>
