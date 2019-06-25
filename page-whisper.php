<?php
/**
 * 轻语
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!$this->request->isAjax() || $this->request->get('_pjax') !== '#main'):
    $this->need('header.php');
endif;
function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    ?>
    <li id="<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
    } else {
        echo ' comment-parent';
    }
    echo $commentClass;
    ?>">
        <?php if ($comments->levels == 0) { ?>
            <div class="comment-author">
                <?php $comments->gravatar('32'); ?>
                <cite><?php CommentAuthor($comments); ?></cite>
                <?php if ($comments->status == 'waiting') { ?>
                    <em class="comment-awaiting-moderation">您的评论正等待审核！</em>
                <?php } ?>
            </div>
            <div class="comment-content">
                <?php echo strip_tags(hrefOpen(Markdown::convert($comments->text)), '<p><br><strong><a><img><pre><code>' . Helper::options()->commentsHTMLTagAllowed); ?>
            </div>
            <div class="comment-meta comment-reply">
                <time><?php $comments->dateWord(); ?></time>
                <?php if (Typecho_Widget::widget('Widget_Archive')->allow('comment') && Helper::options()->commentsThreaded) { ?>
                    <span><?php $comments->reply('评论'); ?></span>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="comment-author comment-content">
                <?php $comments->gravatar('16'); ?>
                <cite><?php CommentAuthor($comments); ?>: </cite>
                <span><?php echo strip_tags($comments->text, '<br>'); ?></span>
                <?php if ($comments->status == 'waiting') { ?>
                    <em>您的评论正等待审核！</em>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ($comments->children) { ?>
            <div class="comment-children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php } ?>
    </li>
<?php } ?>
    <div id="main">
        <div class="main-container main">
            <header class="post-main">
                <?php if (!empty($this->options->Breadcrumbs) && in_array('Pageshow', $this->options->Breadcrumbs)): ?>
                    <div class="breadcrumbs">
                        <a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo; <?php $this->title() ?>
                    </div>
                <?php endif; ?>
                <h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                <ul class="post-meta">
                    <li><?php $this->date(); ?></li>
                    <li><?php Postviews($this); ?></li>
                </ul>
            </header>
            <article class="post">
                <div class="post-content">
                    <div class="post-content">
                        <?php $this->content(); ?>
                        <p><img src="<?php $this->options->themeUrl('images/sakurais.png');?>"></p>
                    </div>
                </div>
                <div id="comments" class="whisper<?php if ($this->user->pass('editor', true)): ?> permission<?php endif; ?>">
                    <?php $this->comments()->to($comments); ?>
                    <?php if ($comments->have()): ?>
                        <?php $comments->listComments(); ?>
                        <?php $comments->pageNav('上一页', '下一页', 0, '..'); ?>
                    <?php endif; ?>
                    <?php if ($this->allow('comment')): ?>
                        <div id="<?php $this->respondId(); ?>" class="respond">
                            <div class="cancel-comment-reply">
                                <?php $comments->cancelReply('取消评论'); ?>
                            </div>
                            <h3 id="response">发表<?php echo $this->user->pass('editor', true) ? '轻语' : '评论' ?></h3>
                            <form
                                method="post"<?php if ($this->user->pass('editor', true)): ?> action="<?php $this->commentUrl() ?>"<?php endif; ?>
                                id="comment-form"<?php if (!$this->user->hasLogin()): ?> class="comment-form clearfix"<?php endif; ?>>
                                <p <?php if (!$this->user->hasLogin()): ?>class="textarea"<?php endif; ?>>
                                <textarea name="text" id="textarea" placeholder="说点什么..."
                                          required><?php $this->remember('text'); ?></textarea>
                                </p>
                                <p <?php if (!$this->user->hasLogin()): ?>class="textbutton"<?php endif; ?>>
                                    <?php if (!$this->user->hasLogin()): ?>
                                        <input type="text" name="author" id="author" class="text" placeholder="称呼 *"
                                               value="<?php $this->remember('author'); ?>" required/>
                                        <input type="email" name="mail" id="mail" class="text"
                                               placeholder="邮箱<?php if ($this->options->commentsRequireMail): ?> *<?php endif; ?>"
                                               value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                                        <input type="url" name="url" id="url" class="text"
                                               placeholder="http://<?php if ($this->options->commentsRequireURL): ?> *<?php endif; ?>"
                                               value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                                    <?php endif; ?>
                                    <button type="submit" class="submit">提交</button>
                                </p>
                            </form>
                        </div>
                    <?php if ($this->options->commentsThreaded): ?>
                        <script>(function () {
                                window.TypechoComment = {
                                    dom: function (id) {
                                        return document.getElementById(id)
                                    }, create: function (tag, attr) {
                                        var el = document.createElement(tag);
                                        for (var key in attr) {
                                            el.setAttribute(key, attr[key])
                                        }
                                        return el
                                    }, reply: function (cid, coid) {
                                        var comment = this.dom(cid), parent = comment.parentNode,
                                            response = this.dom('<?php $this->respondId(); ?>'),
                                            input = this.dom('comment-parent'),
                                            form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                                            textarea = response.getElementsByTagName('textarea')[0];
                                        if (null == input) {
                                            input = this.create('input', {
                                                'type': 'hidden',
                                                'name': 'parent',
                                                'id': 'comment-parent'
                                            });
                                            form.appendChild(input)
                                        }
                                        input.setAttribute('value', coid);
                                        if (null == this.dom('comment-form-place-holder')) {
                                            var holder = this.create('div', {'id': 'comment-form-place-holder'});
                                            response.parentNode.insertBefore(holder, response)
                                        }
                                        form.setAttribute('action', '<?php $this->commentUrl() ?>');
                                        <?php if($this->user->pass('editor', true)): ?>this.dom('response').innerHTML = '发表评论';
                                        <?php endif; ?>comment.appendChild(response);
                                        this.dom('cancel-comment-reply-link').style.display = '';
                                        if (null != textarea && 'text' == textarea.name) {
                                            textarea.focus()
                                        }
                                        return false
                                    }, cancelReply: function () {
                                        var response = this.dom('<?php $this->respondId(); ?>'),
                                            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent'),
                                            form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0];
                                        if (null != input) {
                                            input.parentNode.removeChild(input)
                                        }
                                        if (null == holder) {
                                            return true
                                        }
                                        this.dom('cancel-comment-reply-link').style.display = 'none';
                                        form.removeAttribute('action');
                                        <?php if($this->user->pass('editor', true)): ?>this.dom('response').innerHTML = '发表轻语';
                                        <?php endif; ?>holder.parentNode.insertBefore(response, holder);
                                        return false
                                    }
                                }
                            })();</script>
                    <?php endif; ?>
                    <?php endif; ?>
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