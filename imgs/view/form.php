<?php 
if(session_status()!=PHP_SESSION_ACTIVE){
	session_start();
}
?>
<html>
<body>
<h3>사진업로드</h3>
<form action="/web1/imgboard/imgs/index.php?action=add" method="post" enctype="multipart/form-data">
제목:<input type="text" name="title"><br>
사진:<input type="file" name="uploadfile"><br>
작성자:<input type="text" name="writer" value="<?php print $_SESSION['id']?>" readonly><br>
<input type="submit" value="업로드">
</form>
</body>
</html>