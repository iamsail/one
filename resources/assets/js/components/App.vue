<template>
    <div class="app">
        <Header v-bind:showLogout="true"></Header>
        <main>
            <section class="left">

                <el-tabs v-model="activeName" type="card" @tab-click="handleClick">
                    <el-tab-pane label="挂号" name="first">
                        <Nurse
                                v-bind:gua_hao="gua_hao_if"
                                v-bind:patient_info="patient_info_if"
                        ></Nurse>
                    </el-tab-pane>
                    <el-tab-pane label="病人信息管理" name="second">
                        <PatientInfo></PatientInfo>
                    </el-tab-pane>
                </el-tabs>

            </section>
        </main>
    </div>
</template>

<script>
    import Header from './common/Header'
    import Nurse from './Nurse'
    import PatientInfo from './PatientInfo'
    export default {
        name: "App",
        data() {
            return {
                flag: false,
                compareHeight: null,
                gua_hao_if: true,
                patient_info_if: false,
                activeName: 'first'
            }
        },
        components: {
            Header,
            Nurse,
            PatientInfo
        },
        methods: {
            handleScroll() {
                let scrollTop = document.body.scrollTop + document.documentElement.scrollTop;
                this.fixed(scrollTop);
            },

            setCompareHeight() {
                let header = document.querySelector('#header');
                this.compareHeight = parseInt(window.getComputedStyle(header).getPropertyValue("height"));
            },

            fixed(scrollTop) {
                console.log(this.compareHeight);
                if (scrollTop > this.compareHeight) {
                    console.log(scrollTop);
                    this.flag = true;
                } else {
                    this.flag = false;
                }
            },

            handleClick(tab, event) {
                // console.log(tab, event);
            }
        },
        mounted(){
            this.setCompareHeight();
            window.addEventListener('scroll', this.handleScroll); // 添加滚动事件
        }
    }
</script>

<style scoped>
    .app {}
    .app .left{
        display: inline-block;
        width: 80%;
    }

    .app .right{
        width: 20%;
        min-height: 900px;
        height: 100%;
        border: 2px solid red;

    }

    .app .fixed {
        position: fixed;
        top: 0px;
        right: 0;
    }

    .app .normal{
        position: static;
        float: right;
    }
</style>