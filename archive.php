<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
    <div id="main">
        <div class="main-container main">
            <header class="post-main">
                <div class="breadcrumbs"><a href="<?php $this->options->siteUrl(); ?>">首页</a>&raquo;
                    <?php
                    if ($this->is('category')) {
                        echo '分类文章';
                    } elseif ($this->is('search')) {
                        echo '搜索结果';
                    } elseif ($this->is('tag')) {
                        echo '标签文章';
                    } elseif ($this->is('date')) {
                        echo '日期归档';
                    } else {
                        echo '作者文章';
                    }
                    ?>
                </div>
                <h1 class="post-title">
                    <?php $this->archiveTitle(array(
                        'category' => _t('分类 %s 下的文章'),
                        'search' => _t('包含关键字 %s 的文章'),
                        'tag' => _t('与 %s 有关的文章'),
                        'date' => _t('在 %s 发布的文章'),
                        'author' => _t('作者 %s 发布的文章')
                    ), '', ''); ?>
                </h1>
            </header>

            <?php if ($this->have()): ?>
                <?php while ($this->next()): ?>
                    <article
                        class="post<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>">
                        <div class="post-list">
                            <h2 class="post-title index"><a
                                    href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                            <ul class="post-meta">
                                <li><?php $this->date(); ?></li>
                                <li><?php $this->category(',', false); ?></li>
                                <li><?php $this->commentsNum('暂无评论', '%d 条评论'); ?></li>
                                <li><?php Postviews($this); ?></li>
                                <?php if ($this->options->WordCount): ?>
                                    <li><?php WordCount($this->content); ?></li>
                                <?php endif; ?>
                            </ul>
                            <div class="post-content">
                                <?php if ($this->options->PjaxOption && $this->hidden): ?>
                                    <form method="post">
                                        <p class="word">请输入密码访问</p>
                                        <p>
                                            <input type="password" class="text" name="protectPassword"/>
                                            <input type="submit" class="submit" value="提交"/>
                                        </p>
                                    </form>
                                <?php else: ?>
                                    <?php if (postThumb($this)): ?>
                                        <p class="thumb"><?php echo postThumb($this); ?></p>
                                    <?php endif; ?>
                                    <p><?php $this->excerpt(200, ''); ?></p>
                                <?php endif; ?>
                                <p class="more"><a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">-
                                        阅读全文
                                        -</a></p>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <article class="post">
                    <div class="post-content">
                        <h3>没有找到内容</h3>
                        <p>你想找的东西可能被吃了(￣▽￣)~*</p>
                        <p>随便看看？也许有意想不到的收获喔？！</p>
                        <?php Contents_Post_Initial(10, 'rand()'); ?>
                    </div>
                </article>
            <?php endif; ?>
            <?php $this->pageNav('上一页', $this->options->AjaxLoad ? '查看更多' : '下一页', 0, '..', $this->options->AjaxLoad ? array('wrapClass' => 'page-navigator ajaxload') : ''); ?>
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