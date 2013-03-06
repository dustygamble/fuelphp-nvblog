<?php 
$data = \Theme::instance()->get_info('data');
$page_values = $data['page_values'];
?>

<ul class="nav nav-list">
    <li class="nav-header">Pages</li>
    
    <?php foreach ($page_values['pages'] as $key => $page) { ?>
    <li><a href="<?php echo Uri::create('blog/page/' . $page->slug); ?>"><?php echo $page->title; ?></a></li>
    <?php } ?>
</ul>
