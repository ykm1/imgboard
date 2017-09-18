<?php
require_once 'dto.php';

class ReplyDao{
	private $conn = null;
	public function connect() {
		try {
			$this->conn = new PDO ( 'mysql:host=localhost;dbname=mydb;charset=utf8', 'hr', 'hr' );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->conn->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
	}
	public function disconnect() {
		$this->conn = null;
	}
	public function insert($reply) {
		$this->connect();
		try{
			$sql = "insert into img_board values(null,?,?,now(),?)";
			$stm = $this->conn->prepare($sql);
			$stm->bindValue (1, $reply->getImg_id ());
			$stm->bindValue (2, $reply->getContent ());
			$stm->bindValue (3, $reply->getWriter ());
			$stm->execute();
		}catch (PDOException $e){
			print $e->getMessage();
		}
		$this->disconnect();
	}
	public function selectAll($img_id) {
		$arr = array ();
		$this->connect ();
		try {
			$sql = "select * from img_board where img_id=?";	
			$stm = $this->conn->prepare( $sql );
			$stm->bindValue (1, $img_id);
			$stm->execute();
			$cnt = $stm->rowCount ();
			if ($cnt > 0) {
				while ( $row = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Reply ( $row ['num'], $row ['img_id'], $row ['content'], $row ['wdate'], $row ['writer']);
				}
			}
		} catch ( Exception $e ) {
			print $e->getMessage ();
		}
		$this->disconnect ();
		return $arr;
	}
	public function delete($num){
		$this->connect();
		try{
			$sql = "delete from img_board where num=?";
			$stm = $this->conn->prepare ($sql);
			$stm->bindValue (1, $num);
			$flag = $stm->execute();
		}catch (PDOException $e){
			print $e->getMessage();
		}
		$this->disconnect();
	}
}

?>