<template>
    <div class="dean">
        <Header v-bind:showLogout="true"></Header>
        <main>
            <section class="left">
                <el-tabs v-model="activeName3" >
                    <el-tab-pane label="管理药品信息" name="first">

                        <el-tabs v-model="activeName4" type="card">
                            <el-tab-pane label="添加药品信息" name="first">
                                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                                    <el-form-item label="药品名字" prop="name">
                                        <el-input v-model="ruleForm.name"></el-input>
                                    </el-form-item>

                                    <el-form-item label="药品价格" prop="age">
                                        <el-input v-model="ruleForm.price"></el-input>
                                    </el-form-item>

                                    <el-form-item label="药品库存" prop="cer_num">
                                        <el-input v-model="ruleForm.count"></el-input>
                                    </el-form-item>

                                    <el-form-item>
                                        <el-button type="primary" @click="submitForm()">确认添加药品</el-button>
                                    </el-form-item>

                                </el-form>


                            </el-tab-pane>
                            <el-tab-pane label="查看药品信息" name="second">
                                <Drugs></Drugs>
                            </el-tab-pane>
                        </el-tabs>




                    </el-tab-pane>
                    <el-tab-pane label="病人信息管理" name="second">
                        <PatientInfo></PatientInfo>
                    </el-tab-pane>


                    <el-tab-pane label="备份数据库" name="third">
                        <el-button type="primary" @click="copyDB()">备份数据库</el-button>
                    </el-tab-pane>
                </el-tabs>
            </section>
        </main>
    </div>
</template>

<script>
    import Header from './common/Header'
    import PatientInfo from './PatientInfo'
    import Drugs from './Drugs'
    export default {
        name: "Dean",
        data() {
            return {
                activeName3: 'first',
                activeName4: 'first',
                ruleForm: {
                    name: '',
                    price: '',
                    count: ''
                },
                rules: {

                },
            }
        },
        components: {
            Header,
            PatientInfo,
            Drugs
        },
        methods: {
            submitForm() {
                axios.post(`/dean/drug`, this.ruleForm).then((response) => {
                    console.log(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },

            copyDB() {
                axios.get(`/dean/copyDB`, this.ruleForm).then((response) => {
                    if(response.data === 0) {
                        this.$message({
                            message: '备份成功',
                            type: 'success'
                        });
                    }　else {
                        this.$message({
                            message: '备份失败',
                            type: 'error'
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>