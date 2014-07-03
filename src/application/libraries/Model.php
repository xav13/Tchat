<?php

/**
 * Model abstract qui nécessite une surcharge
 * @author Formateur
 *
 */
abstract Class Model
{
    public static $pdo = null;
    public $table = false;
    public $primaryKey = 'id';
    public $id;
    public $db;
    
    /**
     * Constructeur qui crée la connection à la BDD
     */
    public function __construct(){
        
        if(self::$pdo === null){
            $dsn = "mysql:host=127.0.0.1;dbname=tchat";
            $username = "root";
            $passwd = "0000";
            $options = array();
            
            self::$pdo = new PDO($dsn, $username, $passwd, $options);
        }
        
    }
    public function getDb(){
    	return self::$pdo;
    }
    
    abstract public function find($id);
    
    abstract public function fetchAll();
    
    public function save($data)
    {
    	$key = $this->primaryKey;
    	$fields =  array();
    	$d = array();
    	foreach($data as $k=>$v){
    		if($k!=$this->primaryKey){
    			$fields[] = "$k=:$k";
    			$d["$k"] = $v;
    		}elseif(!empty($v)){
    			$d[":$k"] = $v;
    		}
    	}
    	if(isset($data->$key) && !empty($data->$key)){
    		$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key;
    		$this->id = $data->$key;
    		$action = 'update';
    	}else{
    		$sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
    		$action = 'insert';
    	}
    	$pre = self::$pdo->prepare($sql);
    	$pre->execute($d);
    	if($action == 'insert'){
    		$this->id = self::$pdo->lastInsertId();
    	}
    }
}