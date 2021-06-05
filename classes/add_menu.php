<?php
class add_menu extends ACore_Admin {
	
	protected function obr() {
		
		$title = $_POST['title'];
		$text = $_POST['text'];
		
		if(empty($title) || empty($text)) {
			exit("Не заполнены обязательные поля");
		}
		
		$query = " INSERT INTO menu
						(name_menu,text_menu)
					VALUES ('$title','$text')";
		if(!mysqli_query($this->db,$query)) {
			exit(mysql_error($this->db));
		}
		else {
			$_SESSION['res'] = "Изменения сохранены";
			header("Location:?option=add_menu");
			exit;
		}			
	}
	
	public function get_content() {
		echo "<div id='main'>";
		if(isset($_SESSION['res'])) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
print <<<HEREDOC
<form action='' method='POST'>
<p>Заголовок меню:<br />
<input type='text' name='title' style='width:420px;'>
</p>
<p>Текст:<br />
<textarea name='text' cols='50' rows='7'></textarea>
</p>
<p><input type='submit' name='button' value='Сохранить'></p></form></div></div>
HEREDOC;
	}
}
?>