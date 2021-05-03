<template>
  <div>
    <div class="container">
      <div class="login-form" style="backgroundColor:rgba(229, 238, 229, 0.07);borderRadius:10px">
        <h1 class="h1" style="color:rgba(24, 103, 228, 1);fontSize:28px;">Club Registration</h1>
		<el-form ref="rgsForm" class="rgs-form" :model="rgsForm" label-width="120px">
				<!-- <div v-if="tableName=='Club'" class="input-group">
			   <div class="label">Club Account</div>
			   <div class="input-container">
			     <input v-model="ruleForm.clubaccount" class="input" type="text" placeholder="Club Account">
			   </div>
			 </div> -->
			<el-form-item label="Club Account" class="input" v-if="tableName=='Club'">
			  <el-input v-model="ruleForm.clubaccount" autocomplete="off" placeholder="Club Account" type="text" />
			</el-form-item>
				<!-- <div v-if="tableName=='Club'" class="input-group">
			   <div class="label">Password</div>
			   <div class="input-container">
			     <input v-model="ruleForm.password" class="input" type="text" placeholder="Password">
			   </div>
			 </div> -->
			<el-form-item label="Password" class="input" v-if="tableName=='Club'">
			  <el-input v-model="ruleForm.password" autocomplete="off" placeholder="Password" type="text" />
			</el-form-item>
				<!-- <div v-if="tableName=='Club'" class="input-group">
			   <div class="label">Club</div>
			   <div class="input-container">
			     <input v-model="ruleForm.clubname" class="input" type="text" placeholder="Club">
			   </div>
			 </div> -->
			<el-form-item label="Club" class="input" v-if="tableName=='Club'">
			  <el-input v-model="ruleForm.clubname" autocomplete="off" placeholder="Club" type="text" />
			</el-form-item>
				<!-- <div v-if="tableName=='Club'" class="input-group">
			   <div class="label">Type</div>
			   <div class="input-container">
			     <input v-model="ruleForm.clubtype" class="input" type="text" placeholder="Type">
			   </div>
			 </div> -->
			<el-form-item label="Type" class="input" v-if="tableName=='Club'">
			  <el-input v-model="ruleForm.clubtype" autocomplete="off" placeholder="Type" type="text" />
			</el-form-item>
				<!-- <div v-if="tableName=='Club'" class="input-group">
			   <div class="label">Contacts</div>
			   <div class="input-container">
			     <input v-model="ruleForm.contacts" class="input" type="text" placeholder="Contacts">
			   </div>
			 </div> -->
			<el-form-item label="Contacts" class="input" v-if="tableName=='Club'">
			  <el-input v-model="ruleForm.contacts" autocomplete="off" placeholder="Contacts" type="text" />
			</el-form-item>
				<!-- <div v-if="tableName=='Club'" class="input-group">
			   <div class="label">Phone</div>
			   <div class="input-container">
			     <input v-model="ruleForm.phone" class="input" type="text" placeholder="Phone">
			   </div>
			 </div> -->
			<el-form-item label="Phone" class="input" v-if="tableName=='Club'">
			  <el-input v-model="ruleForm.phone" autocomplete="off" placeholder="Phone" type="text" />
			</el-form-item>																							<!-- <div v-if="tableName=='OrdinaryUser'" class="input-group">
			   <div class="label">User Name</div>
			   <div class="input-container">
			     <input v-model="ruleForm.ordinaryusername" class="input" type="text" placeholder="User Name">
			   </div>
			 </div> -->
			<el-form-item label="User Name" class="input" v-if="tableName=='OrdinaryUser'">
			  <el-input v-model="ruleForm.ordinaryusername" autocomplete="off" placeholder="User Name" type="text" />
			</el-form-item>
				<!-- <div v-if="tableName=='OrdinaryUser'" class="input-group">
			   <div class="label">Password</div>
			   <div class="input-container">
			     <input v-model="ruleForm.password" class="input" type="text" placeholder="Password">
			   </div>
			 </div> -->
			<el-form-item label="Password" class="input" v-if="tableName=='OrdinaryUser'">
			  <el-input v-model="ruleForm.password" autocomplete="off" placeholder="Password" type="text" />
			</el-form-item>
				<!-- <div v-if="tableName=='OrdinaryUser'" class="input-group">
			   <div class="label">Name</div>
			   <div class="input-container">
			     <input v-model="ruleForm.name" class="input" type="text" placeholder="Name">
			   </div>
			 </div> -->
			<el-form-item label="Name" class="input" v-if="tableName=='OrdinaryUser'">
			  <el-input v-model="ruleForm.name" autocomplete="off" placeholder="Name" type="text" />
			</el-form-item>																							<!-- <div v-if="tableName=='OrdinaryUser'" class="input-group">
			   <div class="label">Email</div>
			   <div class="input-container">
			     <input v-model="ruleForm.email" class="input" type="text" placeholder="Email">
			   </div>
			 </div> -->
			<el-form-item label="Email" class="input" v-if="tableName=='OrdinaryUser'">
			  <el-input v-model="ruleForm.email" autocomplete="off" placeholder="Email" type="text" />
			</el-form-item>																							 <el-button class="btn" type="primary" @click="login()">registration</el-button>
		</el-form>
      </div>
      <!-- <div class="nk-navigation">
        <a href="#">
          <div @click="login()">Register</div>
        </a>
      </div> -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      ruleForm: {
              },
      tableName:"",
      rules: {}
    };
  },
  mounted(){
    let table = this.$storage.get("loginTable");
    this.tableName = table;
  },
  methods: {
    // 
    getUUID () {
      return new Date().getTime();
    },
    // 
    login() {
        if((!this.ruleForm.clubaccount) && `Club` == this.tableName){
        this.$message.error(`Club Account Cannot be Empty`);
        return
      }
        if((!this.ruleForm.password) && `Club` == this.tableName){
        this.$message.error(`Password Cannot be Empty`);
        return
      }                                                                                                                if((!this.ruleForm.clubname) && `Club` == this.tableName){
        this.$message.error(`Club Cannot be Empty`);
        return
      }                                                                                                                if(`julebu` == this.tableName && this.ruleForm.phone&&(!this.$validate.isMobile(this.ruleForm.phone))){
        this.$message.error(`Phone Number Format Must be Correct`);
        return
      }
        if((!this.ruleForm.ordinaryusername) && `OrdinaryUser` == this.tableName){
        this.$message.error(`User Name Cannot be Empty`);
        return
      }
        if((!this.ruleForm.password) && `OrdinaryUser` == this.tableName){
        this.$message.error(`Password Cannot be Empty`);
        return
      }
        if((!this.ruleForm.name) && `OrdinaryUser` == this.tableName){
        this.$message.error(`Name Cannot be Empty`);
        return
      }                                                                                                                                                                                                            if(`OrdinaryUser` == this.tableName && this.ruleForm.email&&(!this.$validate.isEmail(this.ruleForm.email))){
        this.$message.error(`Email Format Must be Correct`);
        return
      }
        this.$http({
        url: `${this.tableName}/register`,
        method: "post",
        data:this.ruleForm
      }).then(({ data }) => {
        if (data && data.code === 0) {
          this.$message({
            message: "Registration Successfully",
            type: "success",
            duration: 1500,
            onClose: () => {
              this.$router.replace({ path: "/login" });
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
	.el-radio__input.is-checked .el-radio__inner {
		border-color: #00c292;
		background: #00c292;
	}

	.el-radio__input.is-checked .el-radio__inner {
		border-color: #00c292;
		background: #00c292;
	}

	.el-radio__input.is-checked .el-radio__inner {
		border-color: #00c292;
		background: #00c292;
	}

	.el-radio__input.is-checked+.el-radio__label {
		color: #00c292;
	}

	.el-radio__input.is-checked+.el-radio__label {
		color: #00c292;
	}

	.el-radio__input.is-checked+.el-radio__label {
		color: #00c292;
	}

	.h1 {
		margin-top: 10px;
	}

	body {
		padding: 0;
		margin: 0;
	}

	// .container {
 //    min-height: 100vh;
 //    text-align: center;
 //    // background-color: #00c292;
 //    padding-top: 20vh;
 //    background-image: url(../assets/img/bg.jpg);
 //    background-size: 100% 100%;
 //    opacity: 0.9;
 //  }

	// .login-form:before {
	// 	vertical-align: middle;
	// 	display: inline-block;
	// }

	// .login-form {
	// 	max-width: 500px;
	// 	padding: 20px 0;
	// 	width: 80%;
	// 	position: relative;
	// 	margin: 0 auto;

	// 	.label {
	// 		min-width: 60px;
	// 	}

	// 	.input-group {
	// 		max-width: 500px;
	// 		padding: 20px 0;
	// 		width: 80%;
	// 		position: relative;
	// 		margin: 0 auto;
	// 		display: flex;
	// 		align-items: center;

	// 		.input-container {
	// 			display: inline-block;
	// 			width: 100%;
	// 			text-align: left;
	// 			margin-left: 10px;
	// 		}

	// 		.icon {
	// 			width: 30px;
	// 			height: 30px;
	// 		}

	// 		.input {
	// 			position: relative;
	// 			z-index: 2;
	// 			float: left;
	// 			width: 100%;
	// 			margin-bottom: 0;
	// 			box-shadow: none;
	// 			border-top: 0px solid #ccc;
	// 			border-left: 0px solid #ccc;
	// 			border-right: 0px solid #ccc;
	// 			border-bottom: 1px solid #ccc;
	// 			padding: 0px;
	// 			resize: none;
	// 			border-radius: 0px;
	// 			display: block;
	// 			width: 100%;
	// 			height: 34px;
	// 			padding: 6px 12px;
	// 			font-size: 14px;
	// 			line-height: 1.42857143;
	// 			color: #555;
	// 			background-color: #fff;
	// 		}

	// 	}
	// }

	.nk-navigation {
		margin-top: 15px;

		a {
			display: inline-block;
			color: #fff;
			background: rgba(255, 255, 255, .2);
			width: 100px;
			height: 50px;
			border-radius: 30px;
			text-align: center;
			display: flex;
			align-items: center;
			margin: 0 auto;
			justify-content: center;
			padding: 0 20px;
		}

		.icon {
			margin-left: 10px;
			width: 30px;
			height: 30px;
		}
	}

	.register-container {
		margin-top: 10px;

		a {
			display: inline-block;
			color: #fff;
			max-width: 500px;
			height: 50px;
			border-radius: 30px;
			text-align: center;
			display: flex;
			align-items: center;
			margin: 0 auto;
			justify-content: center;
			padding: 0 20px;

			div {
				margin-left: 10px;
			}
		}
	}
	
	.container {
		background-image: url("/ClubPlus/upload/GWU.JFIF");
		height: 100vh;
		background-position: center center;
		background-size: cover;
		background-repeat: no-repeat;
	
		.login-form {
			right: 50%;
			top: 50%;
			height: auto;
			transform: translate3d(50%, -50%, 0);
			border-radius: 10px;
			background-color: rgba(255,255,255,.5);
			width: 420px;
			padding: 30px 30px 40px 30px;
			font-size: 14px;
			font-weight: 500;
			
			.h1 {
				margin: 0;
				text-align: center;
				line-height: 54px;
			    font-size: 24px;
			    color: #000;
			}
				
			.rgs-form {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				
				.input {
					width: 100%;
					
					& /deep/ .el-form-item__label {
						line-height: 40px;
						color: rgba(30, 144, 255, 1);
						font-size: #606266;
					}
					
					& /deep/ .el-input__inner {
						height: 40px;
						color: rgba(42, 102, 221, 1);
						font-size: 14px;
						border-width: 1px;
						border-style: solid;
						border-color: #606266;
						border-radius: 4px;
						background-color: #fff;
					}
				}
				
				.btn {
					width: 88px;
					height: 44px;
					color: #fff;
					font-size: 14px;
					border-width: 0px;
					border-style: solid;
					border-color: #409EFF;
					border-radius: 4px;
					background-color: rgba(24, 144, 255, 1);
				}
			}
		}
	}
</style>
