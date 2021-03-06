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
                <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.username'); ?></label>
                <div class="controls"><?php echo \Form::input('username', \Input::post('username'), array('class' => 'input-xlarge')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.email'); ?></label>
                <div class="controls"><?php echo \Form::input('email', \Input::post('email'), array('class' => 'input-xlarge')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.password'); ?></label>
                <div class="controls"><?php echo \Form::password('password', '', array('class' => 'input-xlarge')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvadmin.private.shared.confirm'); ?></label>
                <div class="controls"><?php echo \Form::password('confirm_password', '', array('class' => 'input-xlarge')); ?></div>
            </div>

            <div class="control-group">
                <div class="controls"><?php echo \Form::submit('send', \Lang::get('nvadmin.shared.send'), array('class' => 'btn btn-success')); ?></div>
            </div>
        </fieldset>
    </form>
</div>
