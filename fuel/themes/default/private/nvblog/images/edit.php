<?php 
$data = \Theme::instance()->get_info('data');
$site_values = $data['site_values'];
$template_values = $data['template_values'];
$page_values = $data['page_values'];
?> 

<div id="form">
    <?php echo \Form::open(); ?>
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
                <div class="controls"><?php echo \Form::input('title', \Input::post('title', isset($page_values['image']->title) ? $page_values['image']->title : '' ), array('class' => 'medium :required')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.tag'); ?></label>
                <div class="controls"><?php echo Form::input('tag', \Input::post('tag', isset($page_values['image']->tags) ? \NVUtility\NVString::print_array($page_values['image']->tags) : ''), array('class' => 'medium :min_length;3')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.text'); ?></label>
                <div class="controls"><?php echo \Form::textarea('text', \Input::post('text', isset($page_values['image']->text) ? $page_values['image']->text : '' ), array('rows' => 14, 'cols' => 100)); ?></div>
                <script type="text/javascript">CKEDITOR.replace('form_text');</script>
            </div>

            <div class="control-group">
                <div class="controls"><?php echo \Form::submit('send', \Lang::get('nvblog.shared.send'), array('class' => 'btn btn-success')); ?></div>
            </div>
        </fieldset>
    </form>
</div>
