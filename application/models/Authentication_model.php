<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication_model extends CI_Model {
  	public function validate_credentials($username, $password) {
		$result = $this->db->query("SELECT * FROM useraccounts WHERE username='$username' AND password='$password'");
		if($result->num_rows() > 0){
			$row = $result->row_array();        
			$query = $this->db->query("SELECT profile_imagepath from userprofile where uid = " . $row['srno']);
			$d = $query->row_array();
			$row['profile_imagepath'] = $d['profile_imagepath'];
			return $row;
		}
		return false;
  	}

  	public function signup($data) {
		$this->db->query("INSERT into useraccounts(username, password, email, fname, lname) VALUES('" . $data['username'] . "','" . $data['password'] . "','" . $data['email'] . "','" . $data['fname'] . "','" . $data['lname'] . "')");
		$result = $this->db->query("SELECT srno FROM useraccounts WHERE username = '" . $data['username'] . "'");
		$row = $result->row_array();      
		return $row['srno'];
  	}

  	public function usernameExists($username) {
		$result = $this->db->query("SELECT * from useraccounts WHERE username='$username'");
		if($result->num_rows() > 0) {
			return true;
		} 
		return false;
  	}
	public function emailExists($email) {
		$result = $this->db->query("SELECT * from useraccounts WHERE email='$email'");
		if($result->num_rows() > 0) {
			return true;
		} 
		return false;
  	}
}
