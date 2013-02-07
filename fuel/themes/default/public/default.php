<?php 
$data = \Theme::instance()->get_info('data');
$template_values = $data['template_values'];
?>

<!DOCTYPE> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title><?php echo $template_values['subtitle'].' | '.$template_values['title']; ?></title> 

        <link rel="shortcut icon" href="<?php echo \Theme::instance()->asset->get_file('favicon.ico', 'img'); ?>" />
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $template_values['description']; ?>" />
        <meta name="keywords" content="<?php echo $template_values['keywords']; ?>" />

        <meta name="author" content="Marco Pace" />
        <meta name="url" content="http://www.marcopace.it" />

        <?php 
        echo \Theme::instance()->asset->css(array('bootstrap.css', 'bootstrap-responsive.css', 'style.css'));
        echo \Theme::instance()->asset->js(array('jquery.js', 'bootstrap.min.js',)); 
        echo \Theme::instance()->asset->render('public'); 
        ?>
    </head>

    <body>
        <div class="container-narrow">
            <?php echo $partials['header']; ?>
            <?php echo $partials['content']; ?>
            <?php echo $partials['footer']; ?> 
        </div>
    </body>
</html>
