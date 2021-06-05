<?php
class delete_menu extends ACore_Admin {
	public function obr() {
		if($_GET['del']) {
			$id_menu = (int)$_GET['del'];
			
			$query = "DELETE FROM menu WHERE id_menu='$id_menu'";
			
			if(mysqli_query($this->db,$query)) {
				$_SESSION['res'] = "Удалено";
				header("Location:?option=edit_menu");
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