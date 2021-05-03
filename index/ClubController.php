<?php
session_start();
class ClubController extends CommonController {

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    public $columData = [
		'id','addtime'
                ,'clubaccount'
                ,'password'
                ,'image'
                ,'clubname'
                ,'clubtype'
                ,'contacts'
                ,'phone'
            ];

    public function login(){
        $username = isset($_REQUEST['username'])?$_REQUEST['username']:"";
        $password = isset($_REQUEST['password'])?$_REQUEST['password']:"";
        $sql = "select * from `Club` where `clubaccount` = '".$username."' and `password` = '".$password."'";        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $token_array = [
                    "iat" => time(), 
                    "exp" => time()+7200, 
                    'tablename'=> 'Club',
                    'columData' => $this->columData,
                    'id' => $row['id'],
                    'isAdmin' => 0,
                    "success" => $row,
                ];
                $tokens = base64_encode(json_encode($token_array));
                $_SESSION[$tokens] = $row["id"];
                                                $colum = "clubaccount";
                $md5 = md5($row["id"]."+10086");
                $_SESSION[$md5] = $row[$colum];
                                                                                                                                                                                                                                				
                $data = ['code' => 0, 'token' => $tokens];
                exit(json_encode($data));
            }
        } else {
            exit(json_encode(['code'=>500,'msg'=>"Wrong account or password"]));
        }
    }

    public function logout(){
        $token = $this->token();
        unset($token);
        exit(json_encode(['code'=>0,'msg'=>'Exit successful']));
    }

    public function register(){
        $tmpData = strval(file_get_contents("php://input"));
        $postData = json_decode($tmpData,true);
                        $colum = "clubaccount";
        $trues = "select * from `Club` where `clubaccount` = '".$postData[$colum]."'";                               $result = table_sql($trues);
        if($result->num_rows<1){
			$keyArr = $valArr = array();
			foreach ($postData as $key => $value){
                if (in_array($key, $this->columData)){
                    array_push($keyArr,"`".$key."`");
                    array_push($valArr,"'".$value."'");
                }
            }
			$key = implode(',',$keyArr);
			$v = implode(',',$valArr);
                        $sql = "INSERT INTO `Club` (`id`,".$key.") VALUES (".time().",".$v.")";
                        $result = table_sql($sql);
            if (!$result) exit(json_encode(['code'=>500,'msg'=>'Registration failed']));
            exit(json_encode(['code'=>0]));
        }
        exit(json_encode(['code'=>500,'msg'=>"The account already exists"]));
    }

    public function session(){
        $token = $this->token();
        $data = json_decode(base64_decode($token),true);
        $dbname = $data['tablename'];
		$uid = $data['id'];
		$sql = "select * from ".$dbname." where id=".$uid;
		$result = table_sql($sql);
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
				$arrayData = $row;
			}
		}
        exit(json_encode(['code'=>0,'data'=>$arrayData]));
    }

    public function resetPass(){
        $username = input('post.username');
                        $counts = "select * from `Club` where clubaccount = '".$username."'";
        $cotte = table_sql($counts);
        if($cotte->num_rows<1){
            exit(json_encode(['code'=>500,'msg'=>"Wrong account"]));
        }
        $sql = "update Club set password = '123456' where clubaccount = '".$username."'";                            $result = table_sql($sql);
        if($result) exit(json_encode(['code'=>500,'msg'=>"Reset password error"]));
        exit(json_encode(['code'=>0,'msg'=>"Password reset to：123456"]));
    }

    public function page(){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"You are not logged in yet"]));
        $userid = $tokens['id'];
		$where = " where 1 ";
				
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:"1";
        $limt = isset($_REQUEST['limit'])?$_REQUEST['limit']:"10";
        $sort = isset($_REQUEST['sort'])?$_REQUEST['sort']:"id";
        $order = isset($_REQUEST['order'])?$_REQUEST['order']:"asc";
        foreach ($_REQUEST as $k => $val){
			if(in_array($k, $this->columData)){
                if ($val != ''){
                    $where.= " and ".$k." like '".$val."'";
                }
			}
        }
        $base = json_decode(base64_decode($token),true);
        if ($base['isAdmin']!=1){
            $md5 = md5($userid."+10086");
            $colum = "clubaccount";
            $columData = $base['columData'];
            if (isset($_SESSION[$md5]) && in_array($colum, $columData)){
                if($base['tablename'] == '${column.authTable}'){
                    $where .= " and `clubaccount` = '".$_SESSION[$md5]."'";
                }
            }
        }
                                                                                                                        		        
        $sql = "select * from `Club` ".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 0;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);
        $startCount = ($page-1)*$limt;
                $lists = "select * from `Club` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
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
                $page = isset($_REQUEST['page'])?$_REQUEST['page']:"1";
        $limt = isset($_REQUEST['limit'])?$_REQUEST['limit']:"10";
        $sort = isset($_REQUEST['sort'])?$_REQUEST['sort']:"id";
        $order = isset($_REQUEST['order'])?$_REQUEST['order']:"asc";
        $refid = isset($_REQUEST['refid']) ? $_REQUEST['refid'] : "0";
		$where = " where 1 ";
				foreach ($_REQUEST as $k => $val){
			if(in_array($k, $this->columData)){
				$where.= " and ".$k." like '".$val."'";
			}
        }
		                                $token = $this->token();
        $base = json_decode(base64_decode($token),true);
        $userid = $base['id'];
        if ($base['isAdmin']!=1){
            $md5 = md5($userid."+10086");
            $colum = "clubaccount";
            $columData = $base['columData'];
            if (isset($base['success'][$colum]) && in_array($colum, $columData)){
                $where .= " and `clubaccount` = '".$base['success'][$colum]."'";
            }
        }                                                                                                                        		 $sql = "select * from `julebu`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 0;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);
        $startCount = ($page-1)*$limt;
        $lists = "select * from `Club` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
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
        $uid = $tokens['id'];
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
                        $sql = "INSERT INTO `Club` (`id`,".$k.") VALUES (".time().",".$v.")";
                $result = table_sql($sql);
		        exit(json_encode(['code'=>0]));
    }

    public function add(){
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
                $sql = "INSERT INTO `Club` (".$k.") VALUES (".$v.")";
        $result = table_sql($sql);
		        exit(json_encode(['code'=>0]));
    }

    public function update(){
        $tmpData = strval(file_get_contents("php://input"));
        $postData = json_decode($tmpData,true);
        $v = array();
        foreach ($postData as $key => $value){
            if (in_array($key, $this->columData)){
                if ($key == "id"){
                    $id = $value;
                }
                if(!empty($value) || $value === 0) {
                    array_push($v,$key." = '".$value."'");
                }
            }
        }
        $value = implode(',',$v);
         $sql = "UPDATE Club SET ".$value." where id = ".$id;
        $result = table_sql($sql);
        exit(json_encode(['code'=>0]));
    }

    public function delete(){
        $ids = strval(file_get_contents("php://input"));
        preg_match_all('/\d+/',$ids,$arr);
        $str = implode(',',$arr[0]);
        $sql = "delete from Club WHERE id in({$str})";
        $result = table_sql($sql);
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
                        $sql = "select * from `Club` where ".$where;
        $result = table_sql($sql);
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

    public function detail($id=false){
                $name = isset($_REQUEST['name'])? $_REQUEST['name']:"";
        if ($id){
            $where = "`id` = ".$id;
        }else{
            $where = "`name` = ".$name;
        }
                        $sql = "select * from `Club` where ".$where;
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"There was an error querying the data"]));
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
            
    

    public function remind($columnName,$type){
        $remindStart = isset($_GET['remindStart'])?$_GET['remindStart']:"";
        $remindEnd = isset($_GET['remindEnd'])?$_GET['remindEnd']:"";
        if ($type == 1){
            $sql = "select * from `Club` where ".$columnName."<='".$remindEnd."' and ".$columnName.">='".$remindStart."'";
        }else{
            $sql = "select * from `Club` where ".$columnName."<='".date("Y-m-d",strtotime("+".$remindStart." day"))."' and ".$columnName.">='".date("Y-m-d",strtotime("+".$remindStart." day"))."'";
        }
        $result = table_sql($sql);
        exit(json_encode(['code'=> 0 ,'count' => $result->num_rows]));
    }
}

