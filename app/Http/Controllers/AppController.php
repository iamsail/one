<?php
/**
 * Created by PhpStorm.
 * User: sail
 * Date: 18-6-25
 * Time: 上午12:48
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class AppController
{

    /**
     * 获取所有QA对
     *
     * @param  {Request} $request 用户请求
     * @return {array}　$arr  QA对
     */
    public function getQA(Request $request) {
        $input = $request->all();
        $arr = DB::table('all_QA')->paginate($input["pageSize"]);
        return $arr;
    }


    /**
     * 用户登录
     *　
     * @param  {Request} $request 用户请求
     * @return {number}　$final  状态码　0 用户不存在; 1　登录成功; 2　密码错误;3 用户已经登录;
     */
    public function login(Request $request) {
        $input = $request->all();
        $result = DB::select('select * from admin where name = ?', [$input['name']]);
        $final = null;
        if ($this->isUserLogin()) {
            $final = 3;
        } else {
            if ($result == null) {
                $final = 0;
            } elseif ($result[0] -> password == $input['password']) {
                session(['name' => $input['name']]);
                $role = $result[0] -> role;
                $power = $result[0] -> power;
                session(['role' => $role]);
                session(['power'=> $power]);
                if ($role == 'nurse') {
                    $final  = 1;
                } elseif($role == 'dean') {
                    $final  = 4;
                } elseif($role == 'doctor') {
                    $final  = 5;
                }

            } else {
                $final  = 2;
            }
        }

        return $final;
    }


    /**
     * 用户是否已经登录
     *　
     * @return boolean
     */
    protected function isUserLogin() {
        $sessionName = session('name');
        if ($sessionName) {
            return true;
        }
        return false;
    }

    /**
     * 获取用户名
     *　
     * @return {String} $username　用户名
     */
    public function getUsername() {
        $username = session('name');
        if (!$username) {
            $username = '游客';
        }
        return $username;
    }

    /**
     * 用户登出
     *　
     * @param  {Request} $request 用户请求
     */
    public function logout(Request $request) {
        $request->session()->flush();
        return $this->getUsername();
    }

    /**
     * 清空所有QA对
     *
     * @return $deleted 删除的数量
     */
    public function clearAllQA() {
        $deleted = DB::delete('delete from all_QA');
        return $deleted;
    }

    /**
     * 添加QA对
     *
     * @param  {Request} $request 用户请求
     */
    public function addQA(Request $request) {
        $QA = $request->all();
        $add = DB::insert('insert into all_QA(question, theme, answer, answer_link, extend_question) values(?, ?, ?, ?, ?)', [$QA['question'], $QA['theme'], $QA['answer'], $QA['answer_link'], $QA['extend_question']]);
        return ($add)?(1):(0);
    }

    public function guaHao(Request $request) {
        $patient = $request->all();
        $add = DB::insert('insert into patient(name, cer_num, sex, age) values(?, ?, ?, ?)', [$patient['name'], base64_encode($patient['cer_num']), $patient['sex'], $patient['age']]);
        return ($add)?(1):(0);
    }

    public function PatientInfo() {
        $result = DB::select('select * from patient');
        foreach ($result as $key => $value) {
            $value->cer_num = base64_decode($value->cer_num);
        }
        return $result;
    }


    public function addDrug(Request $request) {
        $drug = $request->all();
        $add = DB::insert('insert into drugs(name, price, count) values(?, ?, ?)', [$drug['name'], $drug['price'], $drug['count']]);
        return ($add)?(1):(0);

    }

    public function copyDB() {
        $time = date('Y-m-d-h-i-s', time());
        $c = exec("mysqldump -h 127.0.0.1 -u root -psail hehe > /home/sail/hacker/cumt/db-bak/".$time.".sql   ",$out,$res);
        return $res;
    }
}