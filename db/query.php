<?php

/**
 *
 *
 */
class dbFunctions
{

  private $server="localhost";
  private $user="root";
  private $password="123";
  private $db="quiz";
  private $conn;

  function __construct()
  {
    $this->conn= mysqli_connect($this->server, $this->user, $this->password, $this->db);
  }

  function select($table, $columns="*", $statement="none"){
    $sql="SELECT ";
    if($columns!="*"){
      for($i=0; $i<count($columns); $i++){
        if($i!=(count($columns)-1)){

          $sql.=mysqli_real_escape_string($this->conn,$columns[$i]).", ";
        }else{
          $sql.=mysqli_real_escape_string($this->conn,$columns[$i])." ";
        }
      }
    }else{
      $sql.=$columns." ";
    }

    $sql.="FROM ".mysqli_real_escape_string($this->conn,$table);

    if($statement!="none"){
      $sql.=" WHERE ";
      foreach($statement as $key => $value) {
        $sql.=mysqli_real_escape_string($this->conn,$key)."="."'".mysqli_real_escape_string($this->conn,$value)."' AND ";
      }

      $sql=substr($sql, 0, -5);

    }
    $res= array();
    $index=0;
    if($result=mysqli_query($this->conn, $sql)){
      if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
          $res[$index]=$row;
          $index++;
        }
      }
    }

    return $res;

  }

  function insert($table, $columns){
    $sql="INSET INTO ".mysqli_real_escape_string($this->conn,$table).  " (";
    foreach($columns as $key => $value) {
      $sql.=mysqli_real_escape_string($this->conn,$key).", ";
    }

    $sql=substr($sql, 0, -2);

    $sql.=") VALUES (";
    foreach($columns as $key => $value) {
      $sql.=mysqli_real_escape_string($this->conn,$value).", ";
    }

    $sql=substr($sql, 0, -2);

    $sql.=")";

    if(mysqli_query($conn, $sql)){
      return 'ok';
    }else{
      return mysqli_error($conn);
    }

  }


  function update($table, $columns, $statements="none"){
    $sql="UPDATE ".mysqli_real_escape_string($this->conn,$table). " SET ";
    foreach($columns as $key => $value) {
      $sql.=mysqli_real_escape_string($this->conn,$key)."="."'".mysqli_real_escape_string($this->conn,$value)."', ";
    }

    $sql=substr($sql, 0, -2);


    if($statements!="none"){
      $sql.=" WHERE ";
      foreach($statements as $key => $value) {
        $sql.=mysqli_real_escape_string($this->conn,$key)."="."'".mysqli_real_escape_string($this->conn,$value)."' AND ";
      }

      $sql=substr($sql, 0, -5);
    }

    if(mysqli_query($conn, $sql)){
      return 'ok';
    }else{
      return mysqli_error($conn);
    }



  }


  function delete($table, $statements="none"){

    $sql="DELETE FROM ".mysqli_real_escape_string($this->conn,$table);

    if($statements!="none"){
      $sql.=" WHERE ";
      foreach($statements as $key => $value) {
        $sql.=mysqli_real_escape_string($this->conn,$key)."="."'".mysqli_real_escape_string($this->conn,$value)."' AND ";
      }

      $sql=substr($sql, 0, -5);
    }

    if(mysqli_query($conn, $sql)){
      return 'ok';
    }else{
      return mysqli_error($conn);
    }
  }



  function __destruct(){
    mysqli_close($this->conn);
  }



}

$dbCall=new dbFunctions();



 ?>
