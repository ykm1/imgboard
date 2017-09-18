<?php
class Reply{
	private $num;
	private $img_id;
	private $content;
	private $wdate;
	private $writer;
	
	
	public function __construct($num, $img_id, $content, $wdate, $writer){
		$this->num = $num;
		$this->img_id = $img_id;
		$this->content = $content;
		$this->writer = $writer;
		$this->wdate = $wdate;
	}
	public function setNum($num){
		$this->num = $num;
	}
	public function getNum(){
		return $this->num;
	}
	public function setImg_id($img_id){
		$this->img_id = $img_id;
	}
	public function getImg_id(){
		return $this->img_id;
	}
	public function setContent($content){
		$this->content = $content;
	}
	public function getContent(){
		return $this->content;
	}
	public function setWdate($wdate){
		$this->wdate = $wdate;
	}
	public function getWdate(){
		return $this->wdate;
	}
	public function setWriter($writer){
		$this->writer = $writer;
	}
	public function getWriter(){
		return $this->writer;
	}

	public function __toString(){
		return "num:".$this->num.", img_id:".$this->img_id.", content:".$this->content.", wdate:".$this->wdate.", writer:".$this->writer."<br>";
	}
		
}