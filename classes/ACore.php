<?php
$mysqli = false;
abstract class ACore {
	
	
	protected $db;
	
	public function __construct() {
		$this->db = mysqli_connect(HOST,USER,PASSWORD);
		if(!$this->db) {
			exit("Ошибка соединения с базой данных<br>".mysqli_error($this->db));
		}
		if(!mysqli_select_db($this->db,DB)) {
			exit("Нет такой базы данных<br>".mysqli_error($this->db));
		}
		if (!$this->db->set_charset("utf8")) {
    printf("Ошибка при загрузке набора символов utf8: %s\n", $this->db->error);
		}
		
	}
	
	
	protected function get_header() {
		include "header.php";
	}
	
	protected function get_left_bar() {
		$query = "SELECT id_category,name_category FROM category";
		
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
		$row = array();
		echo '
					<div class="quick-bg">
							<div id="spacer" style="margin-bottom:15px;">
								<div id="rc-bg"> <input class="button10" type="button" value="Вход" onClick=location.href="../minicms/?option=login">  <input class="button10" type="button" value="Выход" onClick=location.href="http://localhost/minicms/?option=main">.</div>
							</div>';
		for($i = 0;$i < mysqli_num_rows($result); $i++) {
			$row = mysqli_fetch_assoc($result);
			printf("<div class='quick-links'>
					» <a href='?option=category&id_cat=%s'>%s</a>
					</div>",$row['id_category'],$row['name_category']);
		}
		echo "</div>";		
		
	}
	
	protected function get_menu() {
		$row = $this->menu_array();
		
		echo '<div id="mainarea">
			<div class="heading">';
			
		echo '<div class="toplinks" style="padding-left:30px;">
					<a href="?option=main">Главная</a></div>
				<div class="sap2">::</div>';
		$i = 1;
		foreach($row as $item) {
			printf("<div class='toplinks'><a href='?option=menu&id_menu=%s'>%s</a></div>
					",$item['id_menu'],$item['name_menu']);
				
				if($i != count($row)) {
					echo "<div class='sap2'>::</div>";
				}
				$i++;
		}
		echo "</div>";			
	}
	
	protected function menu_array() {
		$query = "SELECT id_menu,name_menu FROM menu";
		
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
		$row = array();
		
		for($i = 0;$i < mysqli_num_rows($result); $i++) {
			$row[] = mysqli_fetch_assoc($result);
		}
		return $row;
	}
	
	protected function get_footer() {
		$row = $this->menu_array();
		
		echo "<div id='bottom'>";
		echo '<div class="toplinks" style="padding-left:127px;">
					<a href="?option=main">Главная</a></div>
				<div class="sap2">::</div>';
		$i = 1;
		foreach($row as $item) {
			printf("<div class='toplinks'><a href='?option=menu&id_menu=%s'>%s</a></div>
					",$item['id_menu'],$item['name_menu']);
				
				if($i != count($row)) {
					echo "<div class='sap2'>::</div>";
				}
				$i++;
		}
		echo '</div>
		            <div class="copy"><span class="style1"> Шестёркин Владимир A-08-17 (2020) </span>

		</div>
	</div>
</center></body></html>';
	}
	
	
	public function get_body() {
	
		if($_POST) {
			$this->obr();
		}
		$this->get_header();
		$this->get_left_bar();
		$this->get_menu();
		$this->get_content();
		$this->get_footer();
	}
	
	 abstract function get_content();
	
}

?>