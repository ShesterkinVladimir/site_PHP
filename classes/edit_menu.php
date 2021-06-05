<?php
class edit_menu extends ACore_Admin {
	
	public function get_content() {
		
		$query = "SELECT id_menu,name_menu FROM menu";
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
		echo "<div id='main'>";
		echo "<a style='color:red' href='?option=add_menu'>Добавить новый пункт меню</a><hr>";
		if(isset($_SESSION['res'])) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysqli_num_rows($result);$i++) {
			$row = mysqli_fetch_assoc($result);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='?option=update_menu&id_text=%s'>%s</a> |
						<a style='color:red' href='?option=delete_menu&del=%s'>Удалить</a>
					</p>",$row['id_menu'],$row['name_menu'],$row['id_menu']);
		}
		
		echo '</div>
			</div>';
	}
}
?>