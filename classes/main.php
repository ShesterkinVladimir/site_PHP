<?php
class main extends ACore {
	
	public function get_content() {
		
		$query = "SELECT id,title,text,date,img_src FROM statti ORDER BY date asc";
		$result = mysqli_query($this->db,$query);
		if(!$result) {
			exit(mysqli_error($this->db));
		}
		
	echo '<div id="main">';
		
		$row = array();
		for($i = 0; $i < mysqli_num_rows($result);$i++) {
			$row = mysqli_fetch_assoc($result);
			printf("<div style='margin:10px;border-bottom:2px solid #c2c2c2'>
						<p style='font-size:18px'>%s</p>
						<p>%s</p>
						<p><img style='margin-right:100px' width='550px' align='left' src='%s'></p>
						<p style='color:red'><a href='?option=view&id_text=%s'>Посмотреть код...</a></p>
					
					</div>
					",$row['title'],$row['date'],$row['img_src'],$row['id']);
		}
    echo '</div>
	    </div>';
	 }
}
?>