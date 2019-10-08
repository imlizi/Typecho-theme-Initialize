<?php
/**
 * 归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
    <div id="main">
        <div class="main-container main">
            <header class="post-main">
                <div class="breadcrumbs">
                    <a href="<?php $this->options->siteUrl(); ?>">首页</a>&raquo; <?php $this->title(); ?>
                </div>
                <h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
            </header>
            <article class="post">
                <div class="post-content">
                    <?php
                    $stat = Typecho_Widget::widget('Widget_Stat');
                    $this->widget('Widget_Contents_Post_Recent', 'pageSize=' . $stat->publishedPostsNum)->to($archives);
                    $year = 0;
                    $mon = 0;
                    $i = 0;
                    $j = 0;
                    $output = '<div id="archives" class="post-content">';
                    while ($archives->next()) {
                        $year_tmp = date('Y', $archives->created);
                        if ($year > $year_tmp) {
                            $output .= '</ul>';
                        }
                        if ($year != $year_tmp) {
                            $year = $year_tmp;
                            $output .= '<h3>' . date('Y 年', $archives->created) . '</h3><ul>';
                        }
                        if ($this->options->PjaxOption && $archives->hidden) {
                            $output .= '<li>' . date('m/d：', $archives->created) . '<a>' . $archives->title . '</a></li>';
                        } else {
                            $output .= '<li>' . date('m/d：', $archives->created) . '<a href="' . $archives->permalink . '">' . $archives->title . '</a></li>';
                        }
                    }
                    $output .= '</ul></div>';
                    echo $output;
                    ?>
                </div>
            </article>
        </div>
    </div>
<?php
if ($this->request->isAjax() && $this->request->get('_pjax') === '#main'):
    if ($this->options->compressHtml):
        $html_source = ob_get_contents();
        ob_clean();
        echo compressHtml($html_source);
        ob_end_flush();
    endif;
else:
    $this->need('sidebar.php');
    $this->need('footer.php');
endif;
?>