<?php
/**
 * 链接
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
    <div id="main">
        <div class="main-container main">
            <header class="post-main">
                <?php if (!empty($this->options->Breadcrumbs)): ?>
                    <div class="breadcrumbs">
                        <a href="<?php $this->options->siteUrl(); ?>">首页</a>&raquo;<?php $this->title();?>
                    </div>
                <?php endif; ?>
                <h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                <ul class="post-meta">
                    <li>更新于&nbsp;<?php echo smartDateTime($this->date->timeStamp); ?></li>
                    <li><?php Postviews($this); ?></li>
                </ul>
            </header>
            <article class="post">
                <div class="post-content">
                    <?php $this->content(); ?>
                    <ul class="links">
                        <?php if ($this->options->InsideLinksIcon): ?>
                            <script>function erroricon(obj) {
                                    var a = obj.parentNode, i = document.createElement("i");
                                    i.appendChild(document.createTextNode("★"));
                                    a.removeChild(obj);
                                    a.insertBefore(i, a.childNodes[0])
                                }</script>
                        <?php endif; ?>
                        <?php Links($this->options->InsideLinksSort, $this->options->InsideLinksIcon ? 1 : 0); ?>
                    </ul>
                </div>
            </article>
            <?php $this->need('comments.php'); ?>
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