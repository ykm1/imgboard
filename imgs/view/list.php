<?php 
if(session_status()!=PHP_SESSION_ACTIVE){
	session_start();
}
?>
<html>
<head>
<script type="text/javascript" src="/web1/imgboard/imgs/view/request.js"></script>
<script type="text/javascript">
function a(f, img_id){
	var param = "content="+f.content.value;
	param += "&writer="+f.writer.value;
	param += "&img_id="+img_id;
	var uri = "/web1/imgboard/imgs/index.php?action=addReply";
	var callback = aResult;
	request("post", uri, callback, param);
}
function aResult(){
	if(httpRequest.readyState == 4){
		if(httpRequest.status == 200){
			var txt = httpRequest.responseText;
			var reply = eval('('+txt+')');
			var img_id = reply[0].img_id;
			var listDiv = document.getElementById("td_"+img_id);
			var html="";
			for(i=0; i<reply.length; i++){
				html += "content:"+reply[i].content;
				html += "/wdate:"+reply[i].wdate;
				html += "/writer:"+reply[i].writer+"<br>";
			}
			listDiv.innerHTML = html;
		}
	}
}

</script>
</head>
<body>
<!--  <h3><?php print $_SESSION['id']?>님의 사진 목록</h3>  -->

<h3><?php print $this->writer?>님의 사진 목록</h3>
<?php if($this->writer==$_SESSION['id']){?>
<a href='/web1/imgboard/imgs/view/form.php'>사진올리기</a><br>
<?php }?>
<?php 
	foreach ($this->data as $i){
		print "<table border='1'>";
		print "<tr>";
		print "<td colspan='2'>Title:".$i->getTitle()."</td>";
		print "</tr>";
		print "<tr>";
		print "<td>Writer:".$i->getWriter()."</td>";
		print "<td>Wdate:".$i->getWdate()."</td>";
		print "</tr>";
		print "<tr>";
		print "<td colspan='2'><img src='".$i->getPath()."' width='200' height='150'></td>";
		print "</tr>";
		
		print "<tr>";
		print "<td colspan='2'><form><input type='text' name='content'>";
		print "<input type='button' value='댓글작성' onclick='a(this.form, ".$i->getId().")'>";
		print "<input type='hidden' name='writer' value='".$_SESSION['id']."'>";
		print "</form></td></tr>";
		print "<tr>";
		print "<td colspan='2' id='td_".$i->getId()."'>";
		foreach ($i->getReps() as $r){
			print "content:".$r->getContent()."/wdate:".$r->getWdate()."/writer:".$r->getWriter()."<br>";
		}
		print "</td>";
		print "</tr>";
		print "</table>";
	}
?>
<div id ="ids" style="position:absolute;top:100;left:300;">
<h4>이웃 사진방 가기</h4>
<?php 
foreach ($this->ids as $id){
	print "<a href='/web1/imgboard/imgs/index.php?action=list&writer=".$id."'>".$id."</a><br>";
}
?>
</div>
</body>
</html>