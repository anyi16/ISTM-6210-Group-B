<?php
session_start();
class ConfigController extends CommonController {
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    public $columData = [
        'id','name','value'
    ];

    public function page(){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"You are not logged in yet"]));
        $userid = $tokens['id'];
        $page = isset($_GET['page'])?$_GET['page']:"1";
        $limt = isset($_GET['limit'])?$_GET['limit']:"10";
        $sort = isset($_GET['sort'])?$_GET['sort']:"id";
        $order = isset($_GET['order'])?$_GET['order']:"asc";
        $where = "";
        $sql = "select * from `config`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 1;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);
        $startCount = ($page-1)*10;
        $lists = "select * from `config` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
        $result = table_sql($lists);
        $arrayData = array();
        if ($result->num_rows > 0) {
            while ($datas = $result->fetch_assoc()){
                array_push($arrayData,$datas);
            }
        }
        exit(json_encode([
            'code'=>0,
            'data' => [
                "total" => $numberCount,
                "pageSize" => $limt,
                "totalPage" => $page_count,
                "currPage" => $page,
                "list" => $arrayData
            ]
        ]));
    }

    public function lists(){
        $page = isset($_GET['page'])?$_GET['page']:"1";
        $limt = isset($_GET['limit'])?$_GET['limit']:"10";
        $sort = isset($_GET['sort'])?$_GET['sort']:"id";
        $order = isset($_GET['order'])?$_GET['order']:"asc";
        $where = " where 1 ";
        $sql = "select * from `config`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 1;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);
        $startCount = ($page-1)*10;
        $lists = "select * from `config` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
        $result = table_sql($lists);
        $arrayData = array();
        if ($result->num_rows > 0) {
            while ($datas = $result->fetch_assoc()){
                array_push($arrayData,$datas);
            }
        }
        exit(json_encode([
            'code'=>0,
            'data' => [
                "total" => $numberCount,
                "pageSize" => $limt,
                "totalPage" => $page_count,
                "currPage" => $page,
                "list" => $arrayData
            ]
        ]));
    }

    public function save(){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"You are not logged in yet"]));
        $userid = $tokens['id'];
        $keyArr = $valArr = array();
        $tmpData = strval(file_get_contents("php://input"));
        if (!empty($tmpData)&& isset($tmpData)){
            $postData = json_decode($tmpData,true);
            foreach ($postData as $key => $value){
                if (in_array($key, $this->columData)){
                    if(!empty($value) || $value === 0) {
                        array_push($keyArr,"`".$key."`");
                        array_push($valArr,"'".$value."'");
                    }
                }
            }
        }
        $k = implode(',',$keyArr);
        $v = implode(',',$valArr);
        $sql = "INSERT INTO `config` (".$k.") VALUES (".$v.")";
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"Add failed"]));
        exit(json_encode(['code'=>0]));
    }


    public function update(){
        $tmpData = strval(file_get_contents("php://input"));
        $postData = json_decode($tmpData,true);
        $length = count($postData);
        $v = array();
        $i=0;
        foreach ($postData as $key => $value){
            if (in_array($key, $this->columData)){

                if ($key == "id"){
                    $id = $value;
                }
                array_push($v,$key." = '".$value."'");
            }

        }
        $value = implode(',',$v);
         $sql = "UPDATE config SET ".$value." where id = ".$id;
        $result = table_sql($sql);
        if (!$result) echo json_encode(['code'=>500,'msg'=>"Modification failed"]);
        exit(json_encode(['code'=>0]));
    }

    public function info($id=false){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"You are not logged in yet"]));
        $userid = $tokens['id'];
        $name = isset($_REQUEST['name'])? $_REQUEST['name']:"";
        if (!empty($id)){
            $where = "`id` = ".$id;
        }else{
            $where = "`name` = ".$name;
        }
        $sql = "select * from `config` where ".$where;
        $result = table_sql($sql);
        if (!$result) echo json_encode(['code'=>500,'msg'=>"There was an error querying the data"]);
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $lists = $row;
            }
        }
        exit(json_encode([
            'code'=>0,
            'data'=> $lists
        ]));
    }

}

