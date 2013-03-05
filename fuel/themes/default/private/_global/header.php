<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="brand" href="<?php echo \Uri::create('admin/dashboard'); ?>" name="top">NVBlog</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="<?php echo \Uri::create('admin/dashboard'); ?>"><i class="icon-home icon-white"></i> Dashboard</a></li>
                    <li><a href="<?php echo \Uri::create('admin/users'); ?>"><i class="icon-user icon-white"></i> Users</a></li>
                    <li class="dropdown">  
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file icon-white"></i> Blog <b class="caret"></b></a>  
                        <ul class="dropdown-menu">  
                            <li><a href="<?php echo \Uri::create('admin/blog/pages'); ?>">Pages</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/categories'); ?>">Categories</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/contents'); ?>">Contents</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/images'); ?>">Images</a></li>
                            <li><a href="<?php echo \Uri::create('admin/blog/tags'); ?>">Tag</a></li>
                        </ul>  
                    </li>
                </ul>

                <div class="pull-right">
                    <ul class="nav pull-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $site_values['global_user']->username; ?>!<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo \Uri::create('admin/logout'); ?>"><i class="icon-share"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
