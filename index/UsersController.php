<?php
session_start();
class UsersController extends CommonController {
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    public $columData = [
        'id','addtime','username','password','role'
    ];

    public function login(){
        $username = isset($_REQUEST['username'])?$_REQUEST['username']:"";
        $password = isset($_REQUEST['password'])?$_REQUEST['password']:"";
        $sql = "select * from `users` where username = '".$username."' and password = '".$password."'";
        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $token_array = [
                    "iat" => time(), 
                    "exp" => time()+7200,  
                    'tablename'=> 'users',
					'isAdmin' => 1,
                    'id' => $row["id"],
                    "success" => $row,
                ];
                $tokens = base64_encode(json_encode($token_array));
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

    public function session(){
        $token = $this->token();
        $data = json_decode(base64_decode($token),true);
        $arrayData = $data['success'];
        exit(json_encode(['code'=>0,'data'=>$arrayData]));
    }

    public function resetPass(){
        $username = input('post.username');
        $counts = "select * from `users` where username = '".$username."'";
        $cotte = table_sql($counts);
        if($cotte->num_rows<1){
            exit(json_encode(['code'=>500,'msg'=>"Wrong username"]));
        }
        $sql = "update users set password = '123456' where username = '".$username."'";
        $result = table_sql($sql);
        if($result) exit(json_encode(['code'=>500,'msg'=>"Reset password error"]));
        exit(json_encode(['code'=>0,'msg'=>"Password reset to：123456"]));
    }

    public function page(){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"You haven't signed in yet"]));
        $userid = $tokens['id'];
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:"1";
        $limt = isset($_REQUEST['limit'])?$_REQUEST['limit']:"10";
        $sort = isset($_REQUEST['sort'])?$_REQUEST['sort']:"id";
        $order = isset($_REQUEST['order'])?$_REQUEST['order']:"asc";
        $where = "";
        $sql = "select * from `users`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 1;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);
        $startCount = ($page-1)*10;
        $lists = "select * from `users` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
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
                "total" => $count,
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
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"You haven't signed in yet"]));
        $userid = $tokens['id'];
        $keyArr = $valArr = array();
        $tmpData = strval(file_get_contents("php://input"));
        if (!empty($tmpData)&& isset($tmpData)){
            $postData = json_decode($tmpData,true);
            foreach ($postData as $key => $value){
                if (in_array($key, $this->columData)){
                    array_push($keyArr,"`".$key."`");
                    array_push($valArr,"'".$value."'");
                }
            }
        }
        $k = implode(',',$keyArr);
        $v = implode(',',$valArr);
        $sql = "INSERT INTO `users` (".$k.") VALUES (".$v.")";
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"Add failed"]));
        exit(json_encode(['code'=>0]));
    }


    public function update(){
        $tmpData = strval(file_get_contents("php://input"));
        $postData = json_decode($tmpData,true);
        $v = array();
        foreach ($postData as $key => $value){
            if (in_array($key, $this->columData)){
                array_push($v,$key." = '".$value."'");
            }
        }
        $value = implode(',',$v);
         $sql = "UPDATE users SET ".$value;
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"Modification failed"]));
        exit(json_encode(['code'=>0]));
    }

    public function delete(){
        $ids = strval(file_get_contents("php://input"));
        preg_match_all('/\d+/',$ids,$arr);
        $str = implode(',',$arr[0]);
        $sql = "delete from users WHERE id in({$str})";
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"Deletion failed"]));
        exit(json_encode(['code'=>0]));
    }

    public function info($id=false){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"You haven't signed in yet"]));
        $userid = $tokens['id'];
        $name = isset($_REQUEST['name'])? $_REQUEST['name']:"";
        if (!empty($id)){
            $where = "`id` = ".$id;
        }else{
            $where = "`name` = ".$name;
        }
        $sql = "select * from `users` where ".$where;
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
}

