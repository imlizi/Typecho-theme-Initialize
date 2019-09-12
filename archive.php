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
                                <li>
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M12,3h-1V2H9v1H7V2H5v1H4C2.9,3,2,3.9,2,5v6c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V5C14,3.9,13.1,3,12,3z M9,11H8V6.2L7.2,6.5
	L6.8,5.5L9,4.8V11z"></path></svg>
                                    <?php $this->date(); ?></li>
                                <li><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M13,5H8L7.3,3.6C7.1,3.2,6.8,3,6.4,3H3C2.5,3,2,3.5,2,4v2v6c0,0.6,0.5,1,1,1h10c0.6,0,1-0.4,1-1V6C14,5.4,13.6,5,13,5z"></path></svg><?php $this->category(',', true); ?></li>
                                <li>
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M12,4H4C2.9,4,2,4.9,2,6v8l2.4-2.4C4.8,11.2,5.3,11,5.8,11H12c1.1,0,2-0.9,2-2V6C14,4.9,13.1,4,12,4z"></path></svg>
                                    <?php $this->commentsNum('暂无评论', '%d 条评论'); ?></li>
                                <li>
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M14.8,7.6c-1.4-2.4-4-3.9-6.8-3.9c-2.8,0-5.4,1.5-6.8,3.9L1,8l0.2,0.4c1.4,2.4,4,3.9,6.8,3.9c2.8,0,5.4-1.5,6.8-3.9L15,8
	L14.8,7.6z M8,10.8c-2.1,0-4-1.1-5.2-2.8c0.9-1.4,2.3-2.3,3.9-2.6C6,5.8,5.5,6.6,5.5,7.5C5.5,8.9,6.6,10,8,10s2.5-1.1,2.5-2.5
	c0-0.9-0.5-1.7-1.2-2.1c1.6,0.3,3,1.3,3.9,2.6C12,9.7,10.1,10.8,8,10.8z"></path></svg>
                                    <?php Postviews($this); ?></li>
                                <?php if ($this->options->WordCount): ?>
                                    <li><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M8,2C4.7,2,2,4.7,2,8s2.7,6,6,6c3.3,0,6-2.7,6-6S11.3,2,8,2z M8,4c0.6,0,1,0.4,1,1S8.6,6,8,6C7.4,6,7,5.6,7,5S7.4,4,8,4z
	 M10,12H6v-1h1.2V8h-1V7h2.5v4H10V12z"></path></svg><?php echo WordCount($this->content); ?></li>
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