<?php
require_once 'dao.php';
class ReplyService{
	private $dao;
	public function __construct(){
		$this->dao = new ReplyDao();
	}
	public function addReply($reply){
		$this->dao->insert($reply);
	}
	public function getAll($img_id){
		return $this->dao->selectAll($img_id);
	}
	public function delReply($num){
		$this->dao->delete($num);
	}
}
?>