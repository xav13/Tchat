<?php
class Message extends Model
{
    public function find($id){
        
    }
    
    public function fetchAll(){
        
    }
    public function validates($data){
    	// si les donnes ne sont pas vides, renvoie true
    	if (!empty($data->login) && !empty($data->password)) {
    		return true;
    	}else{	
	    	$messageerr = array();
	    	if (empty($data->login)){
	    		$messageerr['login'] = 'Login non saisi';
	    	}	
	    	if (empty($data->password)){
	    		$messageerr['password'] = 'Password non saisi';
	    	}
	    return $messageerr;
    	}	
    }
    public function messagesUser($iduser) {
    
    	$query = "SELECT * FROM `messages` JOIN users ON messages.user_id_exp = users.id WHERE user_id_dest =" . $iduser. " ORDER BY create_date DESC LIMIT 10" ;
    
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    
    	return $statement->fetchAll();
    }
    public function fetchAllByCondition($condition) {
    
    	$query = "SELECT * FROM `messages` WHERE " . $condition;
    
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    
    	return $statement->fetchAll();
    }
    public function sendMessage($idDest,$idSend,$message)
    {
    	$query = "INSERT INTO `messages` (user_id_dest,user_id_exp,message,create_date) VALUES ('$idDest','$idSend','$message',now())";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    	
    }
    public function messageConvers($idlog,$iddest)
    {
    	$query = "SELECT message,create_date,login,messages.id AS id 
FROM messages
JOIN users ON messages.user_id_exp = users.id
WHERE messages.user_id_exp = $idlog
AND messages.user_id_dest = $iddest
OR messages.user_id_dest = $idlog
AND messages.user_id_exp = $iddest
ORDER BY messages.create_date DESC
LIMIT 0 , 8" ;
    	
    	print_r($query);
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    	
    	return $statement->fetchAll();
    	
    }
    public function messageConversLast($idlog,$iddest,$idlast)
    {
    	$query = "SELECT *
    	FROM messages
    	JOIN users ON messages.user_id_exp = users.id
    	WHERE (messages.user_id_exp = $idlog
    	AND messages.user_id_dest = $iddest
    	OR messages.user_id_dest = $idlog
    	AND messages.user_id_exp = $iddest )
    	AND (messages.id > $idlast)
    	ORDER BY messages.create_date DESC
    	LIMIT 0 , 8" ;
    	 
   	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    	 
    	return $statement->fetchAll();
    	 
    }
    
}