<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!$this->request->isAjax() || $this->request->get('_pjax') !== '#main'):
    $this->need('header.php');
endif; ?>
    <div id="main">
        <div class="main-container main">
            <header class="post-main">
                <?php if (!empty($this->options->Breadcrumbs) && in_array('Postshow', $this->options->Breadcrumbs)): ?>
                    <div class="breadcrumbs">
                        <a href="<?php $this->options->siteUrl(); ?>">首页</a>&raquo; <?php if (!empty($this->options->Breadcrumbs) && in_array('Text', $this->options->Breadcrumbs)): $this->title(); ?><?php else: $this->title(); endif; ?>
                    </div>
                <?php endif; ?>
                <h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                <ul class="post-meta">
                    <li><?php $this->date(); ?></li>
                    <li><?php $this->category(','); ?></li>
                    <li>
                        <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('暂无评论', '%d 条评论'); ?></a>
                    </li>
                    <li><?php Postviews($this); ?></li>
                    <?php if ($this->options->WordCount): ?>
                        <li><?php WordCount($this->content); ?></li>
                    <?php endif; ?>
                </ul>
            </header>
            <article class="post<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>">
                <div class="post-content">
                    <?php if ($this->options->TimeNotice): ?>
                        <?php
                        $time = time() - $this->modified;
                        $lock = $this->options->TimeNoticeLock;
                        $lock = $lock * 24 * 60 * 60;
                        if ($time >= $lock) {
                            ?>
                            <script defer>
                                <?php if ($_GET['_pjax']) { ?>
                                notie('此文章最后修订于 <?php echo date('Y年m月d日', $this->modified);?>，其中的信息可能已经有所发展或是发生改变。', {
                                    type: 'warning',
                                    autoHide: true,
                                    timeout: 5000,
                                    width: 200
                                });
                                <?php } else { ?>
                                window.onload = function () {
                                    notie('此文章最后修订于 <?php echo date('Y年m月d日', $this->modified);?>，其中的信息可能已经有所发展或是发生改变。', {
                                        type: 'warning',
                                        autoHide: true,
                                        timeout: 5000,
                                        width: 200
                                    });
                                };
                                <?php } ?>
                            </script>
                        <?php } ?>
                    <?php endif; ?>
                    <?php $this->content(); ?>
                </div>
                <div class="postinfo">
                    <div class="tags-cloud">
                        <span>&curren;&nbsp;标签：</span>
                        <?php $this->tags(' ', true, '暂无标签'); ?>
                    </div>
                    <div class="copyright">
                        <span>&curren;&nbsp;版权：</span>
                        如无特殊说明，文章均为 <b><a href="<?php $this->options->siteUrl() ?>"><?php $this->options->title() ?></a></b>
                        原创，转载请注明出处，并保证文章完整性，谢谢合作
                    </div>
                    <div class="postlink">
                        <span>&curren;&nbsp;链接：</span>
                        <span id="post-link"><?php $this->permalink(); ?></span>
                        <a id="copy-link" title="点击复制">复制链接</a>
                    </div>
                </div>
            </article>
            <?php if ($this->options->WeChat || $this->options->Alipay): ?>
                <p class="rewards">打赏: <?php if ($this->options->WeChat): ?>
                        <a><img src="<?php $this->options->WeChat(); ?>" alt="微信收款二维码"/>微信</a><?php endif;
                    if ($this->options->WeChat && $this->options->Alipay): ?>, <?php endif;
                    if ($this->options->Alipay): ?>
                        <a><img src="<?php $this->options->Alipay(); ?>" alt="支付宝收款二维码"/>支付宝</a><?php endif; ?>
                </p>
            <?php endif; ?>
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