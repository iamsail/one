<template>
    <div class="p-info">
        <template>
            <el-table
                    :data="tableData"
                    stripe
                    style="width: 100%">
                <el-table-column
                        prop="id"
                        align="center"
                        label="挂号号码"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="name"
                        align="center"
                        label="病人姓名"
                        width="180">
                </el-table-column>
                <el-table-column
                        align="center"
                        prop="cer_num"
                        label="身份证号码">
                </el-table-column>
            </el-table>
        </template>
    </div>
</template>

<script>
    export default {
        name: "PatientInfo",
        data() {
            return {
                tableData: []
            }
        },
        methods: {
            getPatientInfo() {
                axios.get(`/nurse/PatientInfo`).then((response) => {
                   let data = response.data;
                    console.log(data);
                    data.forEach((ele)=> {
                        let temp = {};
                        temp.id = ele.id;
                        temp.name = ele.name;
                        temp.cer_num = ele.cer_num;
                        this.tableData.push(temp);
                    })
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getPatientInfo();
        }
    }
</script>

<style scoped>

</style>