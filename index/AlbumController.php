<?php
session_start();
class AlbumController extends CommonController {

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    public $columData = [
		'id','addtime'
                ,'albumtitle'
                ,'clubaccount'
                ,'clubname'
                ,'clubtype'
                ,'coverphoto'
                ,'albumcontent'
                ,'albumaddtime'
            ];

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
                if($base['tablename'] == 'Club'){
                    $where .= " and `clubaccount` = '".$_SESSION[$md5]."'";
                }
            }
        }
                                                                                                        		        
        $sql = "select * from `Album` ".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 0;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);
        $startCount = ($page-1)*$limt;
                $lists = "select * from `Album` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
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
        }	                                                                                                          $sql = "select * from `Album`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 0;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);
        $startCount = ($page-1)*$limt;
        $lists = "select * from `Album` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
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
                        $sql = "INSERT INTO `Album` (".$k.") VALUES (".$v.")";
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
                $sql = "INSERT INTO `Album` (".$k.") VALUES (".$v.")";
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
         $sql = "UPDATE Album SET ".$value." where id = ".$id;
        $result = table_sql($sql);
        exit(json_encode(['code'=>0]));
    }

    public function delete(){
        $ids = strval(file_get_contents("php://input"));
        preg_match_all('/\d+/',$ids,$arr);
        $str = implode(',',$arr[0]);
        $sql = "delete from Album WHERE id in({$str})";
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
                        $sql = "select * from `Album` where ".$where;
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
                        $sql = "select * from `Album` where ".$where;
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
            $sql = "select * from `Album` where ".$columnName."<='".$remindEnd."' and ".$columnName.">='".$remindStart."'";
        }else{
            $sql = "select * from `Album` where ".$columnName."<='".date("Y-m-d",strtotime("+".$remindStart." day"))."' and ".$columnName.">='".date("Y-m-d",strtotime("+".$remindStart." day"))."'";
        }
        $result = table_sql($sql);
        exit(json_encode(['code'=> 0 ,'count' => $result->num_rows]));
    }
}

