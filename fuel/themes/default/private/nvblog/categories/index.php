<?php 
$data = \Theme::instance()->get_info('data');
$template_values = $data['template_values'];
$partials = $data['partials'];
$page_values = $data['page_values'];
?>

<div>
	<div id="legend">
		<legend class=""><?php echo \Lang::get('nvblog.private.categories.index.title'); ?></legend>
	</div>

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
					<td class="fixed-width90"><?php echo \Lang::get('nvblog.private.shared.action'); ?></td>
					<td class="fixed-width90"><?php echo \Lang::get('nvblog.private.shared.contents'); ?></td>
					<td><?php echo \Lang::get('nvblog.private.shared.title'); ?></td>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 0;
				foreach ($page_values['categories'] as $key => $category) 
				{ 
					$i++;	
				?>
				<tr class="<?php echo !($i%2==0) ? 'odd' : 'even'; ?>">
					<td class="fixed-icon">
						<a href="<?php echo \Uri::create('admin/blog/categories/view/'.$category->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view'); ?>" class="icon-file"><a>
						<a href="<?php echo \Uri::create('admin/blog/categories/edit/'.$category->id); ?>" title="<?php echo \Lang::get('nvblog.shared.edit'); ?>" class="icon-pencil"><a>
						<a href="<?php echo \Uri::create('admin/blog/categories/delete/'.$category->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvblog.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvadmin.shared.delete'); ?>" class="icon-trash"><a>
					</td>
					<td><?php echo count($category->contents); ?></a></td>
					<td><a href="<?php echo \Uri::create('admin/blog/categories/view/'.$category->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view'); ?>"><?php echo $category->title; ?></a></td>
				</tr>
				<?php } ?>
			</tbody>
	</table>
</div>
<div class="pagination"><?php echo \Pagination::create_links(); ?></div>

<div class="btn-toolbar">
	<a href="<?php echo \Uri::create('admin/blog/categories/create'); ?>"><button class="btn btn-primary"><?php echo \Lang::get('nvblog.shared.add'); ?></button></a>
</div>

