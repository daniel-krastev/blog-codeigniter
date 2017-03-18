<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }		
		
		/*Check if the given user and pass exists in the table
		and returns a boolean resutl */
        public function checkLogin($user,$pass)
        {
			$this -> db -> select('username, password');
			$this -> db -> from('Users');
			$this -> db -> where('username', $user);
			$this -> db -> where('password', sha1($pass));
			$this -> db -> limit(1);			   
			$query = $this -> db -> get();
			
			if($query -> num_rows() == 1) {
				 return $query->result();
			}
			else {
				 return false;
			}
		}
		
		/*Check if a user follows another user from the database. */
		public function isFollowing($follower, $followed) {
			$this -> db -> select('*');
			$this -> db -> from('User_Follows');
			$this -> db -> where('follower_username', $follower);
			$this -> db -> where('followed_username', $followed);
			$this -> db -> limit(1);			   
			$query = $this -> db -> get();
			
			if($query -> num_rows() == 1) {
				 return true;
			}
			else {
				 return false;
			}
		}
		
		// Adds a follow relationship to the User_Follows table.
		public function follow($followed) {
			$sql = "INSERT INTO User_Follows (follower_username, followed_username) VALUES ('".$this->session->userdata('user')."', '"
			.$this->db->escape_str($followed)."')";
			
			$this->db->query($sql);
		}
		
		
		public function checkUsername($username) {
			$this->db->where('username', $username);
			$query = $this->db->get('Users');
			if ($query->num_rows() > 0){
				return 0;
			}
			else{
				return 1;
			}
		}
}
?>