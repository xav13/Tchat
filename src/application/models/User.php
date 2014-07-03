<?php
class User extends Model
{
    public function find($id){
    	$query = "SELECT * FROM `users` WHERE id=:id";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $id);
    	
    	$statement->execute();
    	
    	return $statement->fetch();    	
        
    }
    
    public function fetchAll(){
    	$query = "SELECT `id`, `login`, `role` FROM `users`";
    	
    	$statement = $this->getDb()->prepare($query);
    	
    	$statement->execute();
    	
    	return $statement->fetchAll();    	
        
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
    public function findByLoginAndPassword($login, $password){
    	 
    	$query = "SELECT * FROM `users` WHERE login=:login AND password=:password;";
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':login', $login);
    	$statement->bindParam(':password', $password);
    	 
    	$statement->execute();
    
    	return $statement->fetch();
    }
    public function getUsersToSend($login){
    	$query = "SELECT * FROM `users` WHERE login != '$login'";
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    	 
    	return $statement->fetchAll();
    }
    public function infosUser($login){
    	$query = "SELECT * FROM `users` WHERE login = " . $login;
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    	
    	return $statement->fetchAll();
    }
    public function infosUserById($id){
    	$query = "SELECT * FROM `users` WHERE id = " . $id;
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    	 
    	return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function fetchAllByCondition($condition) {
    
    	$query = "SELECT * FROM `users` WHERE " . $condition;
    
    	$statement = $this->getDb()->prepare($query);
    	$statement->execute();
    
    	return $statement->fetchAll();
    }
    public function deleteUser($iduser)
    {
    	$query = "DELETE FROM users WHERE id= " .$iduser;
    	$statement = $this->getDb()->prepare($query);
    	
    	return $statement->execute();
    }
    
}