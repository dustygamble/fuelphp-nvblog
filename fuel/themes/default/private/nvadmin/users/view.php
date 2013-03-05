<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?> 

<div>
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

    <fieldset>
        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.username'); ?></label>
            <div class="controls"><?php echo $page_values['user']->username; ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.email'); ?></label>
            <div class="controls"><?php echo $page_values['user']->email; ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.password'); ?></label>
            <div class="controls"><?php echo ($page_values['user']->last_login != 0) ? date('d/m/Y, g:i a', $page_values['user']->last_login) : '-'; ?></div>
        </div>

        <div class="btn-toolbar">
            <a href="<?php echo \Uri::create('admin/users/create'); ?>"><button class="btn btn-success"><?php echo \Lang::get('nvadmin.shared.add'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/users/edit/'.$page_values['user']->id); ?>" title="<?php echo \Lang::get('nvadmin.shared.edit'); ?>"><button class="btn btn-warning" type="button"><?php echo \Lang::get('nvadmin.shared.edit'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/users/delete/'.$page_values['user']->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvadmin.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvadmin.shared.delete'); ?>"><button class="btn btn-danger" type="button"><?php echo \Lang::get('nvadmin.shared.delete'); ?></button></a>
        </div>
    </fieldset>
</div>
