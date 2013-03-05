<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?> 

<div>
    <fieldset class="left">
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

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.created_at'); ?></label>
            <div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['category']->created_at); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.updated_at'); ?></label>
            <div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['category']->updated_at); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
            <div class="controls"><?php echo $page_values['category']->title; ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.contents'); ?></label>
            <div class="controls"><?php echo count($page_values['category']->contents); ?></div>
        </div>

        <div class="btn-toolbar">
            <a href="<?php echo \Uri::create('admin/blog/categories/create'); ?>"><button class="btn btn-success"><?php echo \Lang::get('nvblog.shared.add'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/blog/categories/edit/'.$page_values['category']->id); ?>" title="<?php echo \Lang::get('nvblog.shared.edit'); ?>"><button class="btn btn-warning" type="button"><?php echo \Lang::get('nvblog.shared.edit'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/blog/categories/delete/'.$page_values['category']->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvblog.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvblog.shared.delete'); ?>"><button class="btn btn-danger" type="button"><?php echo \Lang::get('nvblog.shared.delete'); ?></button></a>
        </div>
    </fieldset>
</div>
