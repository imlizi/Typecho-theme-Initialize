<?php
/**
 * 文章目录
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
                <div class="post-content post-list-page">
                    <?php $this->widget('Widget_Archive@index', 'pageSize=10000&type=index')->to($posts); ?>
                    <table class="table">
                        <thead>
                        <tr class="small">
                            <th>时间</th>
                            <th>标题</th>
                            <th>评论</th>
                            <th>阅读</th>
                        </tr>
                        </thead>
                        <?php while ($posts->next()): ?>
                            <tr>
                                <td>
                                    <span class="small" title="发表时间"><?php $posts->date('Y/m/d'); ?><span>
                                </td>
                                <td>
                                    <a class="post-url" href="<?php $posts->permalink() ?>" title="<?php $posts->title() ?>">
                                        <?php $posts->title() ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge" title="评论量"><?php $posts->commentsNum(); ?></span>
                                </td>
                                <td>
                                    <span class="badge" title="阅读量"><?php $posts->viewsNum(); ?></span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
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