<?php 
$data = \Theme::instance()->get_info('data');
$partials = $data['partials'];
$page_values = $data['page_values'];
?>

<div class="row">
    <div class="span7">
        <h1>Category: <?php echo $page_values['title']; ?></h1>
        <hr>

        <?php
        if(empty($page_values['contents']))
        {
            echo "<p>No contents available.</p>";
        }
        else 
        {
            foreach ($page_values['contents'] as $key => $content) 
            {
                $date = explode('.', date('j.n.M.Y', $content->created_at));
                ?>
                <h3><a href="<?php echo \Uri::create('blog/' . $date[3] . '/' . $date[1] . '/' . $content->slug); ?>"><?php echo $content->title ?></a></h3>
                <p>
                    <i class="icon-user"></i> <a href="#"><?php echo $content->user->username; ?></a> 
                    | <i class="icon-calendar"></i> <?php echo date('F jS, Y \a\t H:i', $content->created_at); ?>
                    | <i class="icon-comment"></i> <a href="<?php echo \Uri::create('blog/' . $date[3] . '/' . $date[1] . '/' . $content->slug); ?>#disqus_thread">No Comments</a>
                </p>
                <p>Categories: <?php echo \NVUtility\NVString::print_array($content->categories, true, 'blog/categories', 'title', '<span class="label label-info">', '</span>'); ?></p>

                <p><?php echo $content->preview ?></p>
                <hr>
                <?php 
            } 
            ?>

            <div id="navigation"><?php echo $partials['pagination']; ?></div>
        <?php } ?>
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
