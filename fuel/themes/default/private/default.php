<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>

<!DOCTYPE> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title><?php echo $template_values['title'].' | '.$template_values['subtitle']; ?></title> 

        <link rel="shortcut icon" href="<?php echo \Theme::instance()->asset->get_file('favicon.ico', 'img'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="author" content="Marco Pace" />
        <meta name="url" content="http://www.marcopace.it" />

        <?php 
        echo \Theme::instance()->asset->css(array('bootstrap.css', 'bootstrap-responsive.css', 'style.css'));
        echo \Theme::instance()->asset->js(array('jquery.js', 'bootstrap.min.js', 'ckeditor/ckeditor.js', 'site-config.js')); 
        echo \Theme::instance()->asset->render('public'); 
        ?>
    </head>

    <body>
        <?php echo $partials['header']; ?>


        <div class="container">
            <?php echo $partials['breadcrumbs']; ?>
            <?php echo $partials['content']; ?>
            <?php echo $partials['footer']; ?>
        </div>
    </body>
</html>