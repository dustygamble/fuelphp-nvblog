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
    echo \Theme::instance()->asset->js(array('jquery.js', 'bootstrap.min.js',)); 
    echo \Theme::instance()->asset->render('public'); 
    ?>
</head>

<body id="admin">
    <div class="container">

        <div class="row">
            <div id="login" class="span4 offset4 well">
                <legend>Login</legend>

                <?php if(!empty($page_values['errors'])) { ?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo print_r($page_values['errors'], true); ?>
                </div>
                <?php } ?>

                <?php if(Session::get_flash('error')) { ?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo Session::get_flash('error'); ?>
                </div>
                <?php } ?>

                <?php if(Session::get_flash('success')) { ?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert" href="#">×</a><?php echo Session::get_flash('success'); ?>
                </div>
                <?php } ?>

                <?php echo Form::open(array('action' => 'admin/login', 'id' => 'form')); ?>
                    <?php echo \Form::input('username', \Input::post('username'), array('class' => 'span4', 'placeholder' => 'Username')); ?>
                    <input type="password" name="password" class="span4" placeholder="Password" />
                    <button class="btn btn-medium btn-primary" type="submit">Login</button>
                <?php echo Form::close(); ?>
            </div>
        </div>

    </div>
</body>
</html>
