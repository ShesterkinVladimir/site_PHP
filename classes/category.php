<?php
class category extends ACore {
	
	public function get_content() {
		
		echo '<div id="main">';
		
		if(!$_GET['id_cat']) {
			echo 'Не правильные данные для вывода статьи';
		}
		else {
			$id_cat = (int)$_GET['id_cat'];
			if(!$id_cat) {
				echo 'Не правильные данные для вывода статьи';
			}
			else {
				$query = "SELECT id,title,text,date,img_src FROM statti JOIN category ON category.name_category = statti.title WHERE category.id_category = '$id_cat'";
							
				$result = mysqli_query($this->db,$query);
				if(!$result) {
					exit(mysqli_error($this->db));
				}
				
				if(mysqli_num_rows($result) > 0) {
					$row = array();
					for($i = 0; $i < mysqli_num_rows($result);$i++) {
						$row = mysqli_fetch_assoc($result);
				printf("<link rel='stylesheet'href='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/styles/tomorrow.min.css'>
					<script src='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js'></script>
					<script>hljs.initHighlightingOnLoad();</script>
					<p style='font-size:18px'>%s</p>
						<p>%s</p>
						<p><img style='margin-right:50px' width='550px' align='left' src='%s' ></p>
						<p><pre><code class='html' style='font-size: 6pt'> %s</code></pre></p>"
						,$row['title'],$row['date'],$row['img_src'],$row['text']);
					}
				}
				else {
					echo 'В данной категории нет статей';
				}
			}
		}
		echo '</div>
					</div>';
	}
}
?>