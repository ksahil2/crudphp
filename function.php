<?php 

class functions{
    private $con;
    public function __construct(){
        $this->con = mysqli_connect('localhost','root','Root@123','training_project');
        if(mysqli_connect_error()){
            echo "mysqli_connect_error()";
        }   
        
    }

    
    public function insert($table=NULL , $column=NULL , $value=NULL){
       try{
            if(empty($table) || empty($column) || empty($value)){
                return false;
            }
            $insert = "INSERT into " . $table . '('.$column .') VALUES'.$value .';';
            // print_r($insert);die;
            if ($this->con->query($insert)){
                return true;
            }
            return false;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function select($table=NULL,$table2=Null,$table3=null , $conditions=[],$first = 0){
        try{
            if(empty($table)){
                return false;
            }
            $return = [];
            if($table2!=null && $table3!=null){
                $sql = "SELECT ". $table.".*,".$table2.".name,".$table3.".class_name from ". $table ." LEFT JOIN ". $table2 ." on ". $table.".user_type_id=".$table2.".id LEFT JOIN ".$table3 ." on ".$table.".class_id=".$table3.".id;"; 
                // print_r($sql);die;
            }
            else{
            $sql = "SELECT * FROM ". $table;
            if(!empty($conditions)){
                $sql .=' WHERE ' .$this->setcondition($conditions);
                }
            } 
            $result = $this->con->query($sql);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $return[] = $row;
                }
                if($first==1){
                    return $return[0];
                }
            }
            return $return;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function update($table , $parameters=[] , $conditions=[]){
      try{
            $updateArray = [];
            foreach($parameters as $key => $value){
                $updateArray[] = $key. ' ="'.$value.'"';    
            }
            $sql = 'UPDATE '.$table.' SET ' . implode(',', $updateArray) . " WHERE ".$this->setcondition($conditions).';';
            return $this->con->query($sql);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function delete($table,$conditions = []){
        try{
            return $this->con->query('DELETE FROM '.$table.'  WHERE '.$this->setCondition($conditions).';');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function setcondition($conditions){
        if(empty($conditions)){
            return false;
        }
        $conditionArray=[];
        foreach($conditions as $key => $value){
            $conditionArray[] =  $key.'"'.$value.'"';
            // print_r($conditionArray);die;
        }
        return implode(' AND ',$conditionArray);
    }
}
