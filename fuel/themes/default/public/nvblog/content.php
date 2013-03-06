<?php 
$data = \Theme::instance()->get_info('data');
$partials = $data['partials'];
$page_values = $data['page_values'];
?>

<div class="row">
    <div class="span7">
        <?php
        $date = explode('.', date('j.M', $page_values['content']->created_at));
        ?>   

        <h3><?php echo $page_values['content']->title ?></h3>
        <p>
            <i class="icon-user"></i> <a href="#"><?php echo $page_values['content']->user->username; ?></a> 
            | <i class="icon-calendar"></i> <?php echo date('F jS, Y \a\t H:i', $page_values['content']->created_at); ?>
            | <i class="icon-comment"></i> <a href="<?php echo \Uri::current(); ?>#disqus_thread">No Comments</a>
        </p>
        <p>Categories: <?php echo \NVUtility\NVString::print_array($page_values['content']->categories, true, 'blog/categories', 'title', '<span class="label label-info">', '</span>'); ?></p>
        <p>Tags: <?php echo \NVUtility\NVString::print_array($page_values['content']->tags, true, 'blog/tags', 'title', '<span class="label label-info">', '</span>'); ?></p>
        <br />

        <p><?php echo $page_values['content']->preview ?></p>
        <p><?php echo $page_values['content']->text ?></p>

        <!--
        <div id="disqus_thread"></div>
        <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = ''; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        -->
    </div>

    <div class="span3">
        <?php echo $partials['search']; ?>

        <div class="sidebar-nav">
            <div class="well well-sidebar">
                <?php
                echo $partials['pages'];
                echo $partials['categories'];
                ?>
            </div>
        </div>
    </div>
</div>
