<?php
print '[';
for ($i=0; $i<count($this->data); $i++){
	if($i>0){
		print ",";
	}
	print '{"num":'.$this->data[$i]->getNum().', "img_id":'.$this->data[$i]->getImg_id().', "content":"'.$this->data[$i]->getContent().'", "wdate":"'.$this->data[$i]->getWdate().'", "writer":"'.$this->data[$i]->getWriter().'"}';
}
print ']';
?>