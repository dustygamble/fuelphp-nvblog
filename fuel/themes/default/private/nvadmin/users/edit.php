<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?> 

<div>
    <?php echo \Form::open(); ?>
    	<fieldset>
    		<div id="legend">
    			<legend class=""><?php echo \Lang::get('nvadmin.private.users.edit.title'); ?></legend>
    		</div>
    		
    		<?php foreach ($page_values['errors'] as $field => $text) { ?>
			<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">×</a><?php echo $text; ?>
			</div>
			<?php } ?>

    		<div class="control-group">
    			<label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.username'); ?></label>
    			<div class="controls"><?php echo $page_values['user']->username; ?></div>
    		</div>

    		<div class="control-group">
    			<label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.email'); ?></label>
    			<div class="controls"><?php echo \Form::input('email', \Input::post('email', isset($page_values['user']->email) ? $page_values['user']->email : '' ), array('class' => 'medium :required :email :wait;2000')); ?></div>
    		</div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.password_old'); ?></label>
                <div class="controls"><?php echo \Form::password('old_password', '', array('class' => 'medium :min_length;5')); ?></div>
            </div>

    		<div class="control-group">
    			<label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.password_new'); ?></label>
    			<div class="controls"><?php echo \Form::password('new_password', '', array('class' => 'medium :min_length;5')); ?></div>
    		</div>

    		<div class="control-group">
    			<label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.confirm'); ?></label>
    			<div class="controls"><?php echo \Form::password('confirm_password', '', array('class' => 'medium :same_as;form_new_password :wait;2000')); ?></div>
    		</div>

    		<div class="control-group">
    			<div class="controls"><?php echo \Form::submit('send', \Lang::get('nvadmin.shared.send'), array('class' => 'btn btn-success')); ?></div>
    		</div>
    	</fieldset>
    </form>
</div>