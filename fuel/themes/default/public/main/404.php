<?php 
$data = \Theme::instance()->get_info('data');
$page_values = $data['page_values'];
?>

<div class="jumbotron">
	<h2><?php echo e($page_values['title']); ?></h2>
	<p class="lead">It seems that something went terribly wrong... </p>
	<p class="lead">We cannot find the page you are looking for, please click <?php print html_tag('a', array('href' => Uri::base(false)), 'here'); ?> to go to the homepage.</p>
</div>
<hr>