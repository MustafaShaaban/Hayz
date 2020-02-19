<?php
echo '<div class="list-html-content row">';
foreach ( $instance['list-html'] as $i => $list_html ) {
	echo '<div class="col-sm-6"><div class="item-content">';
	echo '<div class="title-list"><h5>' . ( $i + 1 ) . '. ' . $list_html['title'] . ' </h5></div>';
	echo '<div class="desc-list">' . $list_html['content'] . '</div>';

	echo '</div></div>';
}
echo '<span class="line-center"></span></div>';
?>