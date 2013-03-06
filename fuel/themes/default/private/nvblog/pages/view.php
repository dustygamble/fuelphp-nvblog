<?php 
$data = \Theme::instance()->get_info('data');
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

    <fieldset class="left">
        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.created_at'); ?></label>
            <div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['page']->created_at); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.updated_at'); ?></label>
            <div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['page']->updated_at); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.shared.status'); ?></label>
            <div class="controls"><?php echo \NVUtility\NVString::published_status_to_text($page_values['page']->published); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
            <div class="controls"><?php echo $page_values['page']->title; ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.author'); ?></label>
            <div class="controls"><a href="<?php echo \Uri::create('admin/users/view/'.$page_values['page']->user->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view').' '.$page_values['page']->user->username; ?>"><?php echo $page_values['page']->user->username; ?></a></div>
        </div>

        <div class="btn-toolbar">
            <a href="<?php echo \Uri::create('blog/page/' . $page_values['page']->slug); ?>" title="<?php echo \Lang::get('nvblog.shared.view'); ?>"><button class="btn btn-success" type="button"><?php echo \Lang::get('nvblog.shared.view'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/blog/pages/edit/'.$page_values['page']->id); ?>" title="<?php echo \Lang::get('nvblog.shared.edit'); ?>"><button class="btn btn-warning" type="button"><?php echo \Lang::get('nvblog.shared.edit'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/blog/pages/delete/'.$page_values['page']->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvblog.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvblog.shared.delete'); ?>"><button class="btn btn-danger" type="button"><?php echo \Lang::get('nvblog.shared.delete'); ?></button></a>
        </div>
    </fieldset>
</div>
