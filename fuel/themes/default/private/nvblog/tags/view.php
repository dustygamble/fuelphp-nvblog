<?php 
$data = \Theme::instance()->get_info('data');
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>

<div>
	<div id="legend">
		<legend class=""><?php echo \Lang::get('nvblog.private.tags.view.title'); ?></legend>
	</div>

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
		
	<fieldset class="left">
		<div class="control-group">
			<label class="control-label"><?php echo \Lang::get('nvblog.private.shared.created_at'); ?></label>
			<div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['tag']->created_at); ?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo \Lang::get('nvblog.private.shared.updated_at'); ?></label>
			<div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['tag']->updated_at); ?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
			<div class="controls"><?php echo $page_values['tag']->title; ?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo \Lang::get('nvblog.private.shared.contents'); ?></label>
			<div class="controls"><?php echo count($page_values['tag']->contents); ?></div>
		</div>

		<div class="control-group buttons">
			<div class="controls">
                <a href="<?php echo \Uri::create('admin/blog/tags/edit/'.$page_values['tag']->id); ?>" title="<?php echo \Lang::get('nvblog.shared.edit'); ?>"><button class="btn btn-warning" type="button"><?php echo \Lang::get('nvblog.shared.edit'); ?></button></a>
                <a href="<?php echo \Uri::create('admin/blog/tags/delete/'.$page_values['tag']->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvblog.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvblog.shared.delete'); ?>"><button class="btn btn-danger" type="button"><?php echo \Lang::get('nvblog.shared.delete'); ?></button></a>
            </div>
		</div>
	</fieldset>
</div>