<template>
    <div class="nurse">
        <section class="gua-hao">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                <el-form-item label="姓名" prop="name">
                    <el-input v-model="ruleForm.name"></el-input>
                </el-form-item>

                <el-form-item label="年龄" prop="age">
                    <el-input v-model="ruleForm.age"></el-input>
                </el-form-item>

                <el-form-item label="身份证号码" prop="cer_num">
                    <el-input v-model="ruleForm.cer_num"></el-input>
                </el-form-item>

                <el-form-item label="性别">
                    <el-radio-group v-model="ruleForm.sex">
                        <el-radio label="男"></el-radio>
                        <el-radio label="女"></el-radio>
                    </el-radio-group>
                </el-form-item>


                <el-form-item>
                    <el-button type="primary" @click="submitForm()">确认挂号</el-button>
                </el-form-item>

            </el-form>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Nurse",
        data() {
            return {
                ruleForm: {
                    name: '',
                    age: '',
                    cer_num: '',
                    sex: ''
                },
                rules: {
                    name: [
                        { required: true, message: '请输入姓名', trigger: 'blur' },
                        { min: 2, max: 10, message: '长度在 2 到 10 个字符', trigger: 'blur' }
                    ],
                    age: [
                        { required: true, message: '请输入年龄', trigger: 'blur' },
                    ],
                    cer_num: [
                        { required: true, message: '请输入身份证号码', trigger: 'blur' },
                    ]
                },
                gua_hao_if: null,
                patient_info_if: null
            };
        },
        methods: {
            submitForm() {
                axios.post(`/nurse/guahao`, this.ruleForm).then((response) => {
                    if(response.data){
                        this.$message({
                            message: '挂号成功',
                            type: 'success'
                        });
                    } else {
                        this.$message({
                            message: '挂号失败',
                            type: 'error'
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>