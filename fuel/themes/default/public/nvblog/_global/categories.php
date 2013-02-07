<?php 
$data = \Theme::instance()->get_info('data');
$page_values = $data['page_values'];
?>

<li class="nav-header">Categories</li>
<?php foreach ($page_values['categories'] as $key => $category) { ?>
	<li><a href="<?php echo Uri::create('blog/categories/' . $category->title); ?>"><?php echo $category->title; ?></a></li>
<?php } ?>