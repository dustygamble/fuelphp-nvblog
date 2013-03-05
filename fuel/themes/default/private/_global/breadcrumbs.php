<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>

<ul class="breadcrumb">
    <li><a href="<?php echo Uri::create('admin/dashboard'); ?>">Dashboard</a></li>  

    <?php 
    foreach ($page_values['breadcrumbs'] as $name => $link) 
    { 
        if($link === '')
        {
            echo " » <li>$name</li>";
        }
        else 
        {
            echo " » <li><a href='".\Uri::create($link)."'>$name</a></li>";
        }
    } 
    ?> 
</ul>
