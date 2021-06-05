<?php
class delete_statti extends ACore_Admin {
	public function obr() {
		if($_GET['del']) {
			$id_text = (int)$_GET['del'];
		$query1 = "DELETE FROM category WHERE name_category = (select title FROM statti WHERE id='$id_text')";
			mysqli_query($this->db,$query1);

			$query = "DELETE FROM statti WHERE id='$id_text'";
			if(mysqli_query($this->db,$query)) {
				$_SESSION['res'] = "Удалено";
				header("Location:?option=admin");
				exit();
			}
			else {
				exit("Ошибка удаления");
			}
		}
		else {
			exit("Не верные данные для этой страницы");
		}


	}
	
	public function get_content() {
		
	}
}
?>