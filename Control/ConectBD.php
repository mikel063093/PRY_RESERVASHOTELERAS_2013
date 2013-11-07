<?php
/**
 * Created by PhpStorm.
 * User: mikel063093
 * Date: 11/6/13
 * Time: 10:13 PM
 */

class connect{
    private $direccion = "";
    private $usuario = "";
    private $password = "";
    private $nombre_db = "";
    private $db;
    public function __construct(){
        $this->db = @mysqli_connect($this->direccion,$this->usuario,$this->password,$this->nombre_db);
        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }
    }
    public function query($consulta){
        if ($result = mysqli_query($this->db, $consulta)) {
            print_r(mysqli_error($this->db));
        }

        if(!$result){
            return NULL;
        }
        return $result;
    }
    public function query_id($consulta){
        if ($result = mysqli_query($this->db, $consulta)) {
            print_r(mysqli_error($this->db));
        }

        if(!$result){
            return NULL;
        }
        return mysqli_insert_id($this->db);
    }
    public function select($columns,$table,$condition){
        if(!empty($condition)){
            $condition = "WHERE ".$condition;
        }
        $sql = "SELECT $columns FROM $table $condition";
        return $this -> query($sql);
    }
    public function return_array($result){
        while ($row = mysqli_fetch_assoc($result)) {
            $array [] = $row;
        }
        return $array;
    }
    public function return_row($result){
        while ($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
    }
    public function __get($var)
    {
        $temp = strtolower($var);
        if($temp=="index")
            if (property_exists('select', $temp))
            {
                return $this->$temp;
            }
        return NULL;
    }
}