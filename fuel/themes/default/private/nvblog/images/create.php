<?php 
$data = \Theme::instance()->get_info('data');
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?>

<div>
    <?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>
    	<div id="legend">
            <legend class=""><?php echo \Lang::get('nvblog.private.images.add.title'); ?></legend>
        </div>
        
        <fieldset class="left">
    		<?php foreach ($page_values['errors'] as $field => $text) { ?>
			<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">×</a><?php echo $text; ?>
			</div>
			<?php } ?>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
                <div class="controls"><?php echo \Form::input('title', \Input::post('title'), array('class' => 'medium :required')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.tag'); ?></label>
                <div class="controls">
                    <?php echo \Form::input('tag', \Input::post('tag'), array('class' => 'medium :required')); ?>
                    <p class="instruction"><?php echo \Lang::get('nvblog.private.contents.shared.tag_instruction'); ?></p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.images.shared.name_singular'); ?></label>
                <div class="controls"><?php echo Form::input(array('name'=>'file_url', 'type'=>'file')); ?></div>
            </div>

    		<div class="control-group">
    			<label class="control-label"><?php echo \Lang::get('nvblog.private.shared.text'); ?></label>
    			<div class="controls"><?php echo \Form::textarea('text', \Input::post('text'), array('rows' => 20, 'cols' => 90)); ?></div>
                <script type="text/javascript">CKEDITOR.replace('form_text');</script>
    		</div>

    		<div class="control-group">
    			<div class="controls"><?php echo \Form::submit('send', \Lang::get('nvblog.shared.send'), array('class' => 'btn btn-success')); ?></div>
    		</div>
    	</fieldset>
    </form>
</div>