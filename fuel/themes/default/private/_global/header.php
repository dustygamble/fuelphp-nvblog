<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>

    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="<?php echo \Uri::create('admin/dashboard'); ?>" name="top">NVBlog</a>
                <ul class="nav">  
                    <li><a href="<?php echo \Uri::create('admin/dashboard'); ?>"><i class="icon-home"></i> Dashboard</a></li>
                    <li><a href="<?php echo \Uri::create('admin/users'); ?>"><i class="icon-user"></i> Users</a></li>
                    <li class="dropdown">  
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file"></i> Blog <b class="caret"></b></a>  
                        <ul class="dropdown-menu">  
                            <li><a href="<?php echo \Uri::create('admin/blog/pages'); ?>">Pages</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/categories'); ?>">Categories</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/contents'); ?>">Contents</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/images'); ?>">Images</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/tags'); ?>">Tag</a></li>
                        </ul>  
                    </li>
                </ul> 

                <div class="btn-group pull-right">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user"></i> <?php echo $site_values['global_user']->username; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo \Uri::create('admin/logout'); ?>"><i class="icon-share"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>