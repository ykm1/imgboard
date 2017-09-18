<?php
class Img{
	private $id;
	private $path;
	private $title;
	private $writer;
	private $wdate;
	private $reps;
	
	public function __construct($id, $path, $title, $writer, $wdate){
		$this->id = $id;
		$this->path = $path;
		$this->title = $title;
		$this->writer = $writer;
		$this->wdate = $wdate;
	}
	public function setReps($reps){
		$this->reps = $reps;
	}
	public function getReps(){
		return $this->reps;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function setPath($path){
		$this->path = $path;
	}
	public function getPath(){
		return $this->path;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function getTitle(){
		return $this->title;
	}
	public function setWriter($writer){
		$this->writer = $writer;
	}
	public function getWriter(){
		return $this->writer;
	}
	public function setWdate($wdate){
		$this->wdate = $wdate;
	}
	public function getWdate(){
		return $this->wdate;
	}
	public function __toString(){
		return "id:".$this->id.", path:".$this->path.", title:".$this->title.", writer:".$this->writer.", wdate:".$this->wdate."<br>";
	}
}
class FileUpload{
	private $path;
	private $dir;

	public function __construct(){
		$this->dir = "C:\\xampp\\htdocs\\myimg\\";
	}
	public function upload($path){
		$this->path = $path;
		$path2 = $this->dir.$this->path."\\";
		if(!is_dir($path2)){
			mkdir($path2);
		}
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $path2.$_FILES['uploadfile']['name']);
		return "/myimg/".$path."/".$_FILES['uploadfile']['name'];
	}
}
?>