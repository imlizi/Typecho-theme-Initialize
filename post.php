<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
    <div id="main">
        <div class="main-container main">
            <header class="post-main">
                <?php if (!empty($this->options->Breadcrumbs) && in_array('Postshow', $this->options->Breadcrumbs)): ?>
                    <div class="breadcrumbs">
                        <a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo; <?php $this->category(); ?>
                        &raquo; <?php if (!empty($this->options->Breadcrumbs) && in_array('Text', $this->options->Breadcrumbs)): $this->title();?>&nbsp;正文<?php else: $this->title(); endif; ?>
                    </div>
                <?php endif; ?>
                <h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
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
                                <?php if (isset($_GET['_pjax'])) { ?>
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
                    <?php
                    $wx=$this->options->WeChat;
                    $ali = $this->options->Alipay;
                    if ( $wx || $ali): ?>
                        <div class="rewards">
                            <span>&curren;&nbsp;打赏：</span>
                            <?php if ($wx): ?>
                                <a><img src="<?php echo $wx; ?>" alt="微信收款二维码"/>微信</a>
                            <?php endif;
                            if ($ali): ?>
                                <a><img src="<?php echo $ali; ?>" alt="支付宝收款二维码"/>支付宝</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="tags-cloud">
                        <span><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M11.3,4.3C11.1,4.1,10.9,4,10.6,4H3C2.5,4,2,4.5,2,5v6c0,0.6,0.5,1,1,1h7.6c0.3,0,0.5-0.1,0.7-0.3L15,8L11.3,4.3z M10,9
	C9.5,9,9,8.5,9,8s0.5-1,1-1s1,0.5,1,1S10.5,9,10,9z"></path></svg>标签：</span>
                        <?php $this->tags(' ',true,'暂无标签'); ?>
                    </div>
                    <div class="copyright">
                        <span><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M8,13L2.9,8.2C1.8,7.1,1.7,5.2,2.7,4c1-1.2,2.8-1.3,4-0.2L8,5l1.3-1.2c1.2-1.1,3-1,4,0.2c1.1,1.2,1,3.1-0.2,4.2L8,13z"></path></svg>版权：</span>ぺぺ
                        如无特殊说明，文章均为 <b><a href="<?php $this->options->siteUrl() ?>"><?php $this->options->title() ?></a></b> 原创，转载请注明出处，并保证文章完整性，谢谢合作
                    </div>
                    <div class="postlink">
                        <span><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="icon-svg"><path d="M13,4h-3C8.9,4,8,4.9,8,6v0.8H7V6c0-1.1-0.9-2-2-2H2C0.9,4,0,4.9,0,6v3c0,1.1,0.9,2,2,2h3c1.1,0,2-0.9,2-2V8.2h1V9
	c0,1.1,0.9,2,2,2h3c1.1,0,2-0.9,2-2V6C15,4.9,14.1,4,13,4z M5.5,9c0,0.3-0.2,0.5-0.5,0.5H2C1.7,9.5,1.5,9.3,1.5,9V6
	c0-0.3,0.2-0.5,0.5-0.5h3c0.3,0,0.5,0.2,0.5,0.5v0.8H5c-0.4,0-0.8,0.3-0.8,0.8S4.6,8.2,5,8.2h0.5V9z M13.5,9c0,0.3-0.2,0.5-0.5,0.5
	h-3C9.7,9.5,9.5,9.3,9.5,9V8.2H10c0.4,0,0.8-0.3,0.8-0.8S10.4,6.8,10,6.8H9.5V6c0-0.3,0.2-0.5,0.5-0.5h3c0.3,0,0.5,0.2,0.5,0.5V9z"></path></svg>链接：</span>
                        <span id="post-link"><?php $this->permalink(); ?></span>
                        <a id="copy-link" title="点击复制">复制链接</a>
                    </div>
                </div>
            </article>
            <div class="post-navigation clearfix">
                <span>
                    <?php $this->thePrev('%s', '没有了', ['title'=>'上一篇']); ?>
                </span>
                <span>
                    <?php $this->theNext('%s', '没有了',['title'=>'下一篇']); ?>
                </span>
            </div>
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