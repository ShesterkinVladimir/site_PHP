<?php
class admin extends ACore_Admin {
	
	public function get_content() {
		
		$query = "SELECT id,title FROM statti";
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
		echo "<div id='main'>";
		echo "<a style='color:red' href='?option=add_statti'>Добавить новую статью</a><hr>";
		if(isset($_SESSION['res'])) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysqli_num_rows($result);$i++) {
			$row = mysqli_fetch_assoc($result);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='?option=update_statti&id_text=%s'>%s</a> |
						<a style='color:red' href='?option=delete_statti&del=%s'>Удалить</a>
					</p>",$row['id'],$row['title'],$row['id']);
		}
		echo '</div>
			</div>';
	}
}
?>