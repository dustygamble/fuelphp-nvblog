<?php 
$data = \Theme::instance()->get_info('data');
$template_values = $data['template_values'];
$partials = $data['partials'];
$page_values = $data['page_values'];
?>

<div>
	<div id="legend">
		<legend class=""><?php echo \Lang::get('nvblog.private.pages.index.title'); ?></legend>
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
					<td><?php echo \Lang::get('nvblog.private.shared.title'); ?></td>
					<td class="fixed-width160"><?php echo \Lang::get('nvblog.private.shared.author'); ?></td>
					<td class="fixed-width90"><?php echo \Lang::get('nvblog.shared.status'); ?></td>
					<td class="fixed-width160"><?php echo \Lang::get('nvblog.private.shared.created_at'); ?></td>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 0;
				foreach ($page_values['pages'] as $key => $page) 
				{ 
					$i++;	
				?>
				<tr class="<?php echo !($i%2==0) ? 'odd' : 'even'; ?>">
					<td class="fixed-icon">
						<a href="<?php echo \Uri::create('blog/page/' . $page->slug); ?>" title="<?php echo \Lang::get('nvblog.shared.preview'); ?>" class="icon-eye-open"><a>
						<a href="<?php echo \Uri::create('admin/blog/pages/view/'.$page->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view'); ?>" class="icon-file"><a>
						<a href="<?php echo \Uri::create('admin/blog/pages/edit/'.$page->id); ?>" title="<?php echo \Lang::get('nvblog.shared.edit'); ?>" class="icon-pencil"><a>
						<a href="<?php echo \Uri::create('admin/blog/pages/delete/'.$page->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvblog.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvadmin.shared.delete'); ?>" class="icon-trash"><a>
					</td>
					<td><a href="<?php echo \Uri::create('admin/blog/pages/view/'.$page->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view'); ?>"><?php echo $page->title; ?></a></td>
					<td><a href="<?php echo \Uri::create('admin/users/view/'.$page->user->id); ?>" title="<?php echo \Lang::get('nvblog.shared.view').' '.$page->user->username; ?>"><?php echo $page->user->username; ?></a></td>
					<td><?php echo \NVUtility\NVString::published_status_to_text($page->published); ?></td>
					<td><?php echo date('d/m/Y, g:i a', $page->created_at); ?></td>
				</tr>
				<?php } ?>
			</tbody>
	</table>
</div>
<div class="pagination"><?php echo \Pagination::create_links(); ?></div>

<div class="btn-toolbar">
	<a href="<?php echo \Uri::create('admin/blog/pages/create'); ?>"><button class="btn btn-primary"><?php echo \Lang::get('nvblog.shared.add'); ?></button></a>
</div>

