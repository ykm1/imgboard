<?php
require_once 'service.php';
require_once '../../dbmember_class/service.php';	//멤버폴더의 서비스 
require_once '../img_board/service.php';			//이미지보드의 서비스
class ImgsController{
	private $action;
	private $data;
	private $view;
	private $service;
	
	private $writer;			//현재 사진방의 주인의 아이디 저장할 변수
	private $ids;				//사진방을 제외한 나머지 아이디를 배열로 저장할 변수
	private $mService;			//멤버폴더에서 가져온 멤버서비스
	
	private $bService;
	private $img_id;
	
	public function __construct($action){
		$this->action = $action;
		$this->service = new ImgsService();
		
		$this->mService = new MemberService();	//멤버서비스 생성
		
		$this->bService = new ReplyService();	//이미지보드 서비스 생성
	}
	public function run(){
		switch($this->action){
			case "add":
				$this->add();
				return ;
			case "list":
				$this->boardlist();
				break;
			case "addReply":					// <----이미지보드 추가 액션
				$this->addReply();
				return;
			case "listReply":
				$this->listReply();
				break;
			case "delReply"://구현안함
				$this->delReply();
				break;
		}
		require 'view/'.$this->view;
	}
	public function add(){
		$fileUpload = new FileUpload();
		$path = $fileUpload->upload($_POST['writer']);
		$a = new Img(0, $path, $_POST['title'], $_POST['writer'], '');
		$this->service->addImg($a);
		$this->action="list";
		$this->run();
	}
	public function boardlist(){
		$this->writer = $_REQUEST['writer'];
		$this->data = $this->service->getAll($this->writer);
		$this->ids = $this->mService->getIds($this->writer);	//이전에서 추가된 것
		foreach ($this->data as $i){							// <----이미지보드 추가 액션
			$i->setReps($this->bService->getAll($i->getId()));
		}
		$this->view = "list.php";
		
// 		$this->data = $this->service->getAll($_REQUEST['writer']);		//파도타기 기능 하기 전.
// 		$this->view = "list.php";
	}
	
	public function addReply(){
		$this->bService->addReply(new Reply(0, $_POST['img_id'], $_POST['content'], '', $_POST['writer']));
		$this->img_id = $_POST['img_id'];
		$this->action = "listReply";
		$this->run();
	}
	public function listReply(){
		$this->data = $this->bService->getAll($this->img_id);
		$this->view = "rList.php";
	}
}
?>