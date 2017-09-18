<?php
require_once 'dto.php';
class ImgDao{
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
	public function insert($img) {
		$this->connect();
		try{
			$sql = "insert into imgs values(null,?,?,?,now())";
			$stm = $this->conn->prepare($sql);
			$stm->bindValue (1, $img->getPath ());
			$stm->bindValue (2, $img->getTitle ());
			$stm->bindValue (3, $img->getWriter ());
			$stm->execute();
		}catch (PDOException $e){
			print $e->getMessage();
		}
		$this->disconnect();
	}
	public function selectAll($writer) {
		$imgs = array ();
		$this->connect ();
		try {
			$sql = "select * from imgs where writer=?";			//로그인한 해당 아이디가 올린 목록만 출력
			$stm = $this->conn->prepare( $sql );				//모든 아이디가 올린 목록을 보고싶으면 where절 생략,
			$stm->bindValue(1, $writer);						//<- 현재 줄 생략 + selecAll관련 $writer 파라미터 삭제
			$stm->execute();
			$cnt = $stm->rowCount ();
			if ($cnt > 0) {
				while ( $row = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
					$imgs [] = new Img ( $row ['id'], $row ['path'], $row ['title'], $row ['writer'], $row ['wdate']);
				}
			}
		} catch ( Exception $e ) {
			print $e->getMessage ();
		}
		$this->disconnect ();
		return $imgs;
	}
}
?>