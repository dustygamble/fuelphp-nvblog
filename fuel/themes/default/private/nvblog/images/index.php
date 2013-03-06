<?php 
$data = \Theme::instance()->get_info('data');
$template_values = $data['template_values'];
$partials = $data['partials'];
$page_values = $data['page_values'];
?>

<div id="list">
    <?php if(\Session::get_flash('error')) { ?>
    <div class="alert alert-error">
        <a class="close" data-dismiss="alert" href="#">×</a><?php echo \Session::get_flash('error'); ?>
    </div>
    <?php } ?>

    <?php if(\Session::get_flash('success')) { ?>
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert" href="#">×</a><?php echo \Session::get_flash('success'); ?>
    </div>
    <?php } ?>

    <table class="table">
        <thead>
            <tr>
                <th class="fixed-small"><?php echo \Lang::get('nvblog.private.images.shared.name_singular'); ?></th>
                <th class="fixed-small"><?php echo \Lang::get('nvblog.private.shared.action'); ?></th>
                <th><?php echo \Lang::get('nvblog.private.shared.title'); ?></th>
            </tr>
        </thead>
        
        <tbody>
            <?php 
            $i = 0;
            foreach ($page_values['images'] as $key => $image)
            { 
                $i++;	
                ?>
                <tr class="<?php echo !($i%2==0) ? 'odd' : 'even'; ?>">
                    <td><?php print \Theme::instance()->asset->img('blog/80x80/' . $image->filename, array('class' => 'fixed-thumbnail')); ?></td>
                    <td>
                        <a href="<?php echo \Uri::create('admin/blog/images/view/'.$image->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view'); ?>" class="icon-file"><a>
                        <a href="<?php echo \Uri::create('admin/blog/images/edit/'.$image->id); ?>" title="<?php echo \Lang::get('nvblog.shared.edit'); ?>" class="icon-pencil"><a>
                        <a href="<?php echo \Uri::create('admin/blog/images/delete/'.$image->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvblog.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvadmin.shared.delete'); ?>" class="icon-trash"><a>
                    </td>
                    <td><a href="<?php echo \Uri::create('admin/blog/images/view/'.$image->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view'); ?>"><?php echo $image->title; ?></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="pagination"><?php echo \Pagination::create_links(); ?></div>

    <div class="btn-toolbar">
        <a href="<?php echo \Uri::create('admin/blog/images/create'); ?>"><button class="btn btn-primary"><?php echo \Lang::get('nvblog.shared.add'); ?></button></a>
    </div>
</div>
