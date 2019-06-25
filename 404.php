<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!$this->request->isAjax() || $this->request->get('_pjax') !== '#main'):
    $this->need('header.php');
endif;?>
    <div id="main">
        <div class="error-page">
            <h2 class="post-title">404 - 页面没找到</h2>
            <p>你想查看的页面已被转移或删除了</p>
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