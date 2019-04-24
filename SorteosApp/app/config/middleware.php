<?php
# Validate and clean form field
function validar_campo($campo){
    $campo = trim($campo);
    $campo = stripcslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

# Validate Username form
function is_username($username) {
	if (strlen($username) < 3 || strlen($username) > 50 || !preg_match('/^[a-zA-Z0-9\s]+$/', $username)) {
		$nameError = 'Invalid Username. Name can only contain letters, numbers and white spaces.';
	}else{
		$username = preg_match('/^[a-zA-Z0-9\s]+$/', $username);
		return $username;
	}	
}

# Validate Email form
function is_email($email){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailError = 'Invalid Email.';
	}else{
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		return $email;
	}	
}

# Validate Password form
function is_password($password){
	if (strlen($password) < 4 || strlen($password) > 20 || !preg_match("/^[a-zA-Z0-9_-]+$/", $password)){
		$passwordError = 'Invalid Password. Password can only contain letters and numbers.';
	}else{
		$password = preg_match('/^[a-zA-Z0-9\s]+$/', $password);
		return $password;
	}	
}

# Generate Random Token
function is_token(){
	$token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789';
	$token = str_shuffle($token);
	$token = substr($token,0,10);
	return $token;
}

# Validate number form
function is_number($number){
	return (preg_replace('[^ 0-9]', '', $number));
}

# Validate SQL form
function antisql($sql){
	$sql = preg_replace("/(from|select|insert|delete|where|drop|table|show tables|#|\*|--|\\\\)/i","",$sql);
	$sql = trim($sql);
	$sql = trim($sql, "'/");
	$sql = trim($sql, '"');
	$sql = strip_tags($sql);
	return $sql;
}