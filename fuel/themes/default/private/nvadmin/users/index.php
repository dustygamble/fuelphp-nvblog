<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>    

<div>
	<div id="legend">
		<legend class=""><?php echo \Lang::get('nvadmin.private.users.index.title'); ?></legend>
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
                    <td><?php echo \Lang::get('nvadmin.private.shared.action'); ?></td>
					<td><?php echo \Lang::get('nvadmin.private.shared.username'); ?></td>
					<td><?php echo \Lang::get('nvadmin.private.shared.email'); ?></td>
					<td><?php echo \Lang::get('nvadmin.private.shared.last_login'); ?></td>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 0;
				foreach ($page_values['users'] as $key => $user) 
				{ 
					$i++;	
				?>
				<tr class="<?php echo !($i%2==0) ? 'odd' : 'even'; ?>">
					<td class="fixed-icon">
						<a href="<?php echo \Uri::create('admin/users/view/'.$user->id); ?>" title="<?php echo \Lang::get('nvadmin.shared.view'); ?>" class="icon-file"><a>
						<?php if(true || $site_values['global_user']['id'] == $user->id || $site_values['global_user']['groups'][0][1]==100) { ?>
							<a href="<?php echo \Uri::create('admin/users/edit/'.$user->id); ?>" title="<?php echo \Lang::get('nvadmin.shared.edit'); ?>" class="icon-pencil"><a>
							<a href="<?php echo \Uri::create('admin/users/delete/'.$user->id); ?>" onclick="return confirm('<?php echo \Lang::get('nvadmin.shared.confirm'); ?>')" title="<?php echo \Lang::get('nvadmin.shared.delete'); ?>" class="icon-trash"><a>
						<?php } ?>
					</td>
					<td><a href="<?php echo \Uri::create('admin/users/view/'.$user->id); ?>" title="Visualizza"><?php echo $user->username; ?></a></td>
					<td><?php echo $user->email; ?></td>
					<td class="fixed-date"><?php echo ($user->last_login != 0) ? date('d/m/Y, g:i a', $user->last_login) : '-'; ?></td>
				</tr>
				<?php } ?>
			</tbody>
	</table>
</div>
<div class="pagination"><?php echo \Pagination::create_links(); ?></div>

<div class="btn-toolbar">
	<a href="<?php echo \Uri::create('admin/users/create'); ?>"><button class="btn btn-primary"><?php echo \Lang::get('nvadmin.shared.add'); ?></button></a>
</div>

