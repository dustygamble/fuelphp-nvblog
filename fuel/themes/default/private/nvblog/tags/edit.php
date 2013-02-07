<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?> 

<div>
    <?php echo \Form::open(); ?>
    	<div id="legend">
            <legend class=""><?php echo \Lang::get('nvblog.private.tags.edit.title'); ?></legend>
        </div>
            
        <fieldset class="left">
    		<?php foreach ($page_values['errors'] as $field => $text) { ?>
			<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">×</a><?php echo $text; ?>
			</div>
			<?php } ?>

    		<div class="control-group">
    			<label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
    			<div class="controls"><?php echo \Form::input('title', \Input::post('title', isset($page_values['tag']->title) ? $page_values['tag']->title : '' ), array('class' => 'medium :required')); ?></div>
    		</div>

    		<div class="control-group">
    			<div class="controls"><?php echo \Form::submit('send', \Lang::get('nvblog.shared.send'), array('class' => 'btn btn-success')); ?></div>
    		</div>
    	</fieldset>
    </form>
</div>