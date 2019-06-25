<?php
/**
 * Initial - Imabsn
 *
 * @package Initial - Sky
 * @author <a href="http://www.offodd.com/">JIElive</a> & <a href="https://fsky7.com/">FlyingSky</a> & <a href="https://imabsn.com/">Imabsn.com</a>
 * @version 1.0.1
 * @link https://imabsn.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!$this->request->isAjax() || $this->request->get('_pjax') !== '#main'):
    $this->need('header.php');
endif;?>
    <div id="main">
        <div class="main-container">
            <?php if ($this->_currentPage == 1 && !empty($this->options->ShowWhisper) && in_array('index', $this->options->ShowWhisper)): ?>
                <article class="post whisper">
                    <div class="post-content">
                        <?php Whisper(); ?>
                        <?php if ($this->user->pass('editor', true) && (!FindContents('page-whisper.php') || isset(FindContents('page-whisper.php')[1]))): ?>
                            <p class="notice">
                                <b>仅管理员可见: </b><br><?php echo FindContents('page-whisper.php') ? '发现多个"轻语"模板页面，已自动选取内容最多的页面作为展示，请删除多余模板页面。' : '未找到"轻语"模板页面，请检查是否创建模板页面。' ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endif; ?>
            <?php while ($this->next()): ?>
                <article class="post<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>">
                    <div class="post-list">
                        <h2 class="post-title index"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
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
                                        <input type="hidden" class="text" name="protectCID"
                                               value="<?php echo $this->cid; ?>"/>
                                        <input type="submit" class="submit" value="提交"/>
                                    </p>
                                </form>
                            <?php else: ?>
                                <?php if (postThumb($this)): ?>
                                    <p class="thumb"><?php echo postThumb($this); ?></p>
                                <?php endif; ?>
                                <p><?php $this->excerpt(200, ''); ?></p>
                            <?php endif; ?>
                            <p class="more"><a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">- 阅读全文
                                    -</a>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
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