<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="secondary">
    <div class="siderbar">
        <?php if (!empty($this->options->ShowWhisper) && in_array('sidebar', $this->options->ShowWhisper)):$whisper = FindContents('page-whisper.php'); ?>
            <section class="widget">
                <h3 class="widget-title"><?php echo $whisper ? FindContents('page-whisper.php', 'commentsNum', 'd')[0]['title'] : '轻语' ?></h3>
                <?php Whisper(1); ?>
                <?php if ($this->user->pass('editor', true) && (!$whisper || isset($whisper[1]))): ?>
                    <li class="notice">
                        <b>仅管理员可见: </b><br><?php echo $whisper ? '发现多个"轻语"模板页面，已自动选取内容最多的页面作为展示，请删除多余模板页面。' : '未找到"轻语"模板页面，请检查是否创建模板页面。' ?>
                    </li>
                <?php endif; ?>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowWaySit', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <?= $this->options->WaySit ?>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowEatFoodSit', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <?= $this->options->EatFoodSit ?>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowHotPosts', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">热门文章</h3>
                <ul class="widget-list">
                    <?php Contents_Post_Initial($this->options->postsListSize, 'views'); ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">最新文章</h3>
                <ul class="widget-list">
                    <?php $this->widget('Widget_Contents_Post_Recent')
                        ->parse('<li><a href="{permalink}" title="点击查看{title}">{title}</a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">最近回复</h3>
                <ul class="widget-list">
                    <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true')->to($comments); ?>
                    <?php while($comments->next()): ?>
                        <li><a href="<?php $comments->permalink(); ?>" title="<?php $comments->title(); ?>"><?php $comments->author(false); ?>: <?php $comments->excerpt(35, '...'); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">分类</h3>
                <ul class="widget-list">
                    <?php $this->widget('Widget_Metas_Category_List')
                        ->parse('<li><a href="{permalink}">{name}</a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowTag', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">标签</h3>
                <div class="tags-cloud">
                    <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=0&limit=30')->to($tags); ?>
                    <?php if ($tags->have()): ?>
                        <?php while ($tags->next()): ?>
                            <a href="<?php $tags->permalink(); ?>" title="共<?php $tags->count(); ?>篇文章"><?php $tags->name(); ?></a>
                        <?php endwhile; ?>
                    <?php else: ?>
                            <a>暂无标签</a>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">归档</h3>
                <ul class="widget-list">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 n 月')
                        ->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->ShowLinks) && in_array('sidebar', $this->options->ShowLinks)): ?>
            <section class="widget">
                <h3 class="widget-title">链接</h3>
                <div class="widget-list links">
                    <?php Links($this->options->IndexLinksSort); ?>
                </div>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowStats', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">网站统计</h3>
                <ul class="widget-list" id="stat">
                    <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
                    <li>
                        <a>文章总数： <?php $stat->publishedPostsNum() ?> 篇</a>
                    </li>
                    <li>
                        <a>评论总数： <?php $stat->publishedCommentsNum() ?> 条</a>
                    </li>
                    <li>
                        <a>总访问量： <?php echo theAllViews() ?> ( PV )</a>
                    </li>
                </ul>
            </section>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title">其它</h3>
                <ul class="widget-list">
                    <li><a href="<?php $this->options->feedUrl(); ?>" target="_blank">文章 RSS</a></li>
                    <li><a href="<?php $this->options->commentsFeedUrl(); ?>" target="_blank">评论 RSS</a></li>
                    <?php if ($this->user->hasLogin()): ?>
                        <li><a href="<?php $this->options->adminUrl(); ?>" target="_blank">进入后台
                                (<?php $this->user->screenName(); ?>)</a></li>
                        <li>
                            <a href="<?php $this->options->logoutUrl(); ?>"<?php if ($this->options->PjaxOption): ?> no-pjax <?php endif; ?>>退出</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </section>
        <?php endif; ?>
    </div>
</div>
