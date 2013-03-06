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

        <fieldset class="left">
            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.title'); ?></label>
                <div class="controls"><?php echo \Form::input('title', \Input::post('title', isset($page_values['page']->title) ? $page_values['page']->title : '' ), array('class' => 'input-xlarge')); ?></div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.shared.status'); ?></label>
                <div class="controls">
                    <select name="published" class="input-xlarge">
                        <option selected="selected" value="<?php echo $page_values['page']->published; ?>"><?php echo \NVUtility\NVString::published_status_to_text($page_values['page']->published); ?></option>
                        <option value="0">---</option>
                        <option value="0"><?php echo \NVUtility\NVString::published_status_to_text(0); ?></option>
                        <option value="1"><?php echo \NVUtility\NVString::published_status_to_text(1); ?></option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"><?php echo \Lang::get('nvblog.private.shared.text'); ?></label>
                <div class="controls"><?php echo \Form::textarea('text', \Input::post('text', isset($page_values['page']->text) ? $page_values['page']->text : '' ), array('rows' => 14, 'cols' => 100)); ?></div>
                <script type="text/javascript">CKEDITOR.replace('form_text');</script>
            </div>

            <div class="control-group">
                <div class="controls"><?php echo \Form::submit('send', \Lang::get('nvblog.shared.send'), array('class' => 'btn btn-success')); ?></div>
            </div>
        </fieldset>

        <div id="sidebar" class="sidebar-nav right">
            <div class="well">
                <ul class="nav nav-list categories">
                    <li class="nav-header"><?php echo \Lang::get('nvblog.private.shared.options'); ?></li>
                    <li><a data-toggle="modal" href="#images-list"><?php echo \Lang::get('nvblog.private.shared.addimages'); ?></a></li>
                </ul>
            </div>
        </div>

        <div id="images-list" class="modal hide fade in" style="display: none;">  
            <div class="modal-header">  
                <a class="close" data-dismiss="modal">×</a>  
                <h3><?php echo \Lang::get('nvblog.private.shared.addimages'); ?></h3>  
            </div>  

            <div class="modal-body">
                <?php foreach ($page_values['images'] as $key => $image) { ?>
                <a class="images-list-child" href="#" onclick="addHtmlToFCKEditorForImage('<?php echo \Theme::instance()->asset->get_file('blog/original/'.$image->filename, 'img'); ?>', '<?php echo $image->title; ?>');">
                    <?php print \Theme::instance()->asset->img('blog/80x80/' . $image->filename, array('title' => $image->title)); ?>
                </a>
                <?php } ?>    
            </div>  

            <div class="modal-footer">   
                <a href="#" class="btn" data-dismiss="modal">Close</a>  
            </div>  
        </div>
    </form>
</div>
