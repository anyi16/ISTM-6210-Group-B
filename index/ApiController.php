<?php
session_start();
class ApiController extends CommonController
{
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }

    public function upload(){
        

        header('Content-Type:application/json');
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);     
		
        if ($_FILES["file"]["error"] > 0) {
            exit("Wrong: " . $_FILES["file"]["error"] . "<br>");
        }else{
            if (file_exists("upload/" . $_FILES["file"]["name"]))
            {
                exit($_FILES["file"]["name"] . " The file already exists ");
            }else{
                
                $fileNames = time().".".$extension;
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $fileNames);
            }
                exit(json_encode(['code'=>0,'file'=>$fileNames,'msg'=>"Upload success!"]));
        }

    }

    public function download()
    {
        $fileName = $_GET['fileName'];
        header('location:http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $fileName);
    }

    public function option($tablesName,$columnName,$level=false,$parent=false){
            $where = "";
            if ($level!=false){
                $where = "`level=`".$level." and `parent` = ".$parent;
            }
            $sql = "select `".$columnName."` from `".$tablesName."`".$where;
            $result = table_sql($sql);
            $arrays = array();
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    array_push($arrays,$row);
                }
                $array = array_column($arrays,$columnName);
            } else {
                $array = 0;
            }
            exit(json_encode(['code'=>0,'data'=>$array]));
        }

    public function follow($tablesName,$columnName){
        $columnValue = isset($_GET['columnValue'])?$_GET['columnValue']:"";
        $sql = "select * from `".$tablesName."` where ".$columnName." = '".$columnValue."'";
        $result = table_sql($sql);
        $arrays = "";
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $arrays = $row;
            }
        } else {
            $arrays = 0;
        }
        exit(json_encode(['code'=>0,'data'=>$arrays]));
    }

    public function sh($tablesName){
        $id = isset($_POST['id'])?$_POST['id']:"";
        $sfsh = isset($_POST['sfsh'])?$_POST['sfsh']:"";
        if ($sfsh=="Yes"){
            $vlaue = "No";
        }else{
            $vlaue = "Yes";
        }
        $sql = "update `".$tablesName."` SET `sfsh`=".$vlaue." where (`id`=".$id.")";
        $result = table_sql($sql);
        exit(json_encode(['code'=>0]));
    }

    public function remind($tablesName,$columnName,$type){
        $remindStart = isset($_GET['remindStart'])?$_GET['remindStart']:"";
        $remindEnd = isset($_GET['remindEnd'])?$_GET['remindEnd']:"";
        if ($type == 1){
            $sql = "select * from ".$tablesName." where ".$columnName."<='".$remindEnd."' and ".$columnName.">='".$remindStart."'";
        }else{
            $sql = "select * from ".$tablesName." where ".$columnName."<='".date("Y-m-d",strtotime("+".$remindStart." day"))."' and ".$columnName.">='".date("Y-m-d",strtotime("+".$remindStart." day"))."'";
        }
        $result = table_sql($sql);
        exit(json_encode(['code'=> 0 ,'count' => $result->num_rows]));
    }

    public function cal($tablesName,$columnName){
        $sql = "select max(".$columnName.") as max,min(".$columnName.") as min,avg(".$columnName.") as avg,sum(".$columnName.") as sum from `".$tablesName."`";
        $result = table_sql($sql);
        $sum = $max = $avg = $min = "";
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $max = $row['max'];
                $min = $row['min'];
                $avg = $row['avg'];
                $sum = $row['sum'];
            }
        } else {
            $max = 0;
            $min = 0;
            $avg = 0;
            $sum = 0;
        }
        exit(json_encode([
            'code'=>0,
            'data'=>[
                'max'=>$max,
                'min'=>$min,
                'avg'=>$avg,
                'sum'=>$sum,
            ]
        ]));
    }

    public function group($tablesName,$columnName){
        $sql = "SELECT ".$columnName.",count(".$columnName.") as total FROM ".$tablesName." GROUP BY ".$columnName." ORDER BY total desc";
        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            
            $total = array();
            while($row = $result->fetch_assoc()) {
                array_push($total,array('total' => $row['total'],$columnName => $row[$columnName]));
            }
        }
        exit(json_encode(['code'=>0,'data'=>$total]));
    }

    public function value($tableName,$xColumnName,$yColumnName){
        $sql = "SELECT ".$xColumnName.",sum(".$yColumnName.") total FROM ".$tableName." group by ".$xColumnName;
        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            
            $total = array();
            while($row = $result->fetch_assoc()) {
                array_push($total,array('total' => $row['total'],$xColumnName => $row[$xColumnName]));
            }
        }
        exit(json_encode(['code'=>0,'data'=>$total]));
    }
        }