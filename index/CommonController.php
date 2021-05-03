<?php
require_once("./config.php");
class CommonController{
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }

    public function token(){
        $token = $_SERVER['HTTP_TOKEN'];
        if (!$token){
            return false;
        }
        return $token;
    }

    public function checkToken(){
        $token = $this->token();
        $uid = $_SESSION[$token];
        if (empty($uid)) return false;
        return $uid;
    }

    public function request_post($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$postUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

    public function andone($tables,$id,$column,$num=1){
        $sqlcheck = "select `id`,`".$column."` from  `".$tables."` where `id` =".$id;
        $dataCheck = table_sql($sqlcheck);
        $rows = 0;
        while($row = $dataCheck->fetch_assoc()) {
            $rows = $row[$column];
        }
        $sum = round($rows+$num);
        $sql = "update `".$tables."` set ".$column." = ".$sum." where `id` =".$id;
        table_sql($sql);
        return true;
    }
}
