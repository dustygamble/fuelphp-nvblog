<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?> 

<div id="form">
    <?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>
        <?php if(count($page_values['errors'])>0) { ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <ul>
                <?php foreach ($page_values['errors'] as $field => $text) { ?>
                    <li><?php echo $text; ?></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>

        <fieldset>
            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
                <div class="controls"><?php echo \Form::input('title', \Input::post('title'), array('class' => 'input-xlarge')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.tag'); ?></label>
                <div class="controls">
                    <?php echo \Form::input('tag', \Input::post('tag'), array('class' => 'input-xlarge')); ?>
                    <p class="instruction"><?php echo \Lang::get('nvblog.private.contents.shared.tag_instruction'); ?></p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.images.shared.name_singular'); ?></label>
                <div class="controls"><?php echo Form::input(array('name'=>'file_url', 'type'=>'file', 'class' => 'input-xlarge')); ?></div>
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