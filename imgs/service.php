<?php
require_once 'dao.php';
class ImgsService{
	private $dao;
	
	public function __construct(){
		$this->dao = new ImgDao();	
	}
	public function addImg($img){
		$this->dao->insert($img);
	}
	public function getAll($writer){
		return $this->dao->selectAll($writer);
	}
}
?>