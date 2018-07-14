<template>
    <div class=".doctor">
        <Header v-bind:showLogout="true"></Header>
        <main>
            <section class="left">
                <el-tabs v-model="activeName2" type="card">
                    <el-tab-pane label="查看药品信息" name="first">
                    </el-tab-pane>
                    <el-tab-pane label="病人信息管理" name="second">
                        <PatientInfo></PatientInfo>
                    </el-tab-pane>
                    <el-tab-pane label="查看自己信息" name="third">

                    </el-tab-pane>
                    <el-tab-pane label="查看医药费" name="fourth">

                    </el-tab-pane>
                </el-tabs>

            </section>
        </main>
    </div>
</template>

<script>
    import Header from './common/Header'
    import PatientInfo from './PatientInfo'

    export default {
        name: "Doctor",
        data() {
            return {
                activeName2: 'first'
            }
        },
        components: {
            Header,
            PatientInfo
        },
    }
</script>

<style scoped>

</style>