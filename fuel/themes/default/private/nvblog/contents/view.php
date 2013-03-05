<?php 
$data = \Theme::instance()->get_info('data');
$template_values = $data['template_values'];
$page_values = $data['page_values'];

$date = explode('.', date('j.n.M.Y', $page_values['content']->created_at));
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
            <div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['content']->created_at); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.updated_at'); ?></label>
            <div class="controls"><?php echo date('d/m/Y, g:i a', $page_values['content']->updated_at); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.shared.status'); ?></label>
            <div class="controls"><?php echo \NVUtility\NVString::published_status_to_text($page_values['content']->published); ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
            <div class="controls"><?php echo $page_values['content']->title; ?></div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.categories'); ?></label>
            <div class="controls"><?php echo \NVUtility\NVString::print_array($page_values['content']->categories, true, 'admin/blog/categories/view'); ?>&nbsp;</div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.tag'); ?></label>
            <div class="controls"><?php echo \NVUtility\NVString::print_array($page_values['content']->tags, true, 'admin/blog/tags/view'); ?></div>
        </div>

        <div class="btn-toolbar">
            <a href="<?php echo \Uri::create('blog/' . $date[3] . '/' . $date[1] . '/' . $page_values['content']->slug); ?>" title="<?php echo \Lang::get('nvblog.shared.add'); ?>"><button class="btn btn-success" type="button"><?php echo \Lang::get('nvblog.shared.add'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/blog/contents/edit/'.$page_values['content']->id); ?>" title="<?php echo \Lang::get('nvblog.shared.edit'); ?>"><button class="btn btn-warning" type="button"><?php echo \Lang::get('nvblog.shared.edit'); ?></button></a>
            <a href="<?php echo \Uri::create('admin/blog/contents/delete/'.$page_values['content']->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvblog.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvblog.shared.delete'); ?>"><button class="btn btn-danger" type="button"><?php echo \Lang::get('nvblog.shared.delete'); ?></button></a>
        </div>
    </fieldset>
</div>