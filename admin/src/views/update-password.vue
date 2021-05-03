<template>
  <div>
    <el-form
      class="detail-form-content"
      ref="ruleForm"
      :rules="rules"
      :model="ruleForm"
      label-width="80px"
    >
      <el-form-item label="Old Password" prop="password">
        <el-input v-model="ruleForm.password"></el-input>
      </el-form-item>
      <el-form-item label="New Password" prop="newpassword">
        <el-input v-model="ruleForm.newpassword"></el-input>
      </el-form-item>
      <el-form-item label="Confirm Password" prop="repassword">
        <el-input v-model="ruleForm.repassword"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onUpdateHandler">OK</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dialogVisible: false,
      ruleForm: {},
      user: {},
      rules: {
        password: [
          {
            required: true,
            message: "Old Password Cannot be Empty",
            trigger: "blur"
          }
        ],
        newpassword: [
          {
            required: true,
            message: "New Password Cannot be Empty",
            trigger: "blur"
          }
        ],
        repassword: [
          {
            required: true,
            message: "Confirm Password Cannot be Empty",
            trigger: "blur"
          }
        ]
      }
    };
  },
  mounted() {
    this.$http({
      url: `${this.$storage.get("sessionTable")}/session`,
      method: "get"
    }).then(({ data }) => {
      if (data && data.code === 0) {
        this.user = data.data;
      } else {
        this.$message.error(data.msg);
      }
    });
  },
  methods: {
    onLogout() {
      this.$storage.remove("Token");
      this.$router.replace({ name: "login" });
    },
    // 
    onUpdateHandler() {
      this.$refs["ruleForm"].validate(valid => {
        if (valid) {
          var password = "";
          if (this.user.password) {
            password = this.user.password;
          } else if (this.user.password) {
            password = this.user.password;
          }
          if (this.ruleForm.password != password) {
            this.$message.error("Old Password Wrong");
            return;
          }
          if (this.ruleForm.newpassword != this.ruleForm.repassword) {
            this.$message.error("New Password not same");
            return;
          }
          this.user.password = this.ruleForm.newpassword;
          this.user.password = this.ruleForm.newpassword;
          this.$http({
            url: `${this.$storage.get("sessionTable")}/update`,
            method: "post",
            data: this.user
          }).then(({ data }) => {
            if (data && data.code === 0) {
              this.$message({
                message: "Done!",
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
      });
    }
  }
};
</script>
<style lang="scss" scoped>
</style>
