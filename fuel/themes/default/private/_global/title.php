<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>    

<div id="section">
    <div class="container">
        <h1><?php echo $template_values["subtitle"]; ?></h1>
    </div>
</div>
