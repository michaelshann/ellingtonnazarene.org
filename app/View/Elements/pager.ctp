<?php
	echo "<div id='pager'>";
	echo $this->Paginator->prev(
		  '<',
		  array('tag' => 'div'),
		  null,
		  array('class' => 'disabled')
		);
	echo $this->Paginator->numbers(array('separator' => '', 'class' => 'pagenumbers', 'tag' => 'div', 'currentTag' => 'span'));
	echo $this->Paginator->next(
		  '>',
		  array('tag' => 'div'),
		  null,
		  array('class' => 'disabled')
		);
	echo "</div>";
?>