<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Messages_model extends CI_Model {
        public function __construct() {
                // Call the CI_Model constructor
                parent::__construct();
        }		
		
		//Return the messages from a given user.
        public function getMessagesByPoster($name) {
			$query = $this->db->order_by('posted_at', 'DESC')
				->get_where('Messages', array('user_username' => $name));
			return $query;
        }
		
		//Returns the messages from a given search string.
		public function searchMessages($string) {
			$this->db->order_by('posted_at', 'DESC')->select('*')
				 ->from('Messages')
				 ->like('text', $string, 'both');					 
			$query = $this->db->get();			
			return $query;
        }
		
		//Insert message to the Messages table in the database.
		public function insertMessage($poster, $string) {
			$this->db->select_max('id');
			$query = $this->db->get('Messages');
			$res = $query->result_array();
			
			//build a unique id for the message
			$id = $res[0]['id'] + 1;
			$sql = "INSERT INTO Messages (user_username, text, posted_at, id) VALUES('".$poster."', '"
			.$this->db->escape_str($string)."', now(), '".$id. "')";
			
			$this->db->query($sql);
		}
		
		//Returns all the messages from all the users, that are followed from the given user.
		public function getFollowedMessages($name) {
			
			//check if the user exists in the database
			$query = $this->db->get_where('Users', array('username' => $name), 1);
			if($query -> num_rows() == 1) {
				
				//Get the followed users.
				$query = $this->db->get_where('User_Follows', array('follower_username' => $name));
				if($query -> num_rows() == 0) {
					return 0;
				}
				$array = null;
				$i = 0;
				foreach ($query->result_array() as $row) {
					$array[$i] = $row['followed_username'];
					$i++;
				}
				
				//Get all the messages from the followed users.
				$this->db->order_by('posted_at', 'DESC')->where_in('user_username', $array);
				$query = $this->db->get('Messages');
				return $query;
			} else {
				return 0;
			}
		}
}
?>