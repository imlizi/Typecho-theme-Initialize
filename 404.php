<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
    <style>
        .post-title sub {
            font-size: 60%;
            color: #acacac;
        }

        .post-content li {
            padding-left: 20px;
        }

        .post-content li a {
            font-size: 18px;
        }
    </style>
    <div id="main">
        <div class="main-container main">
            <header class="post-main">
                <h1 class="post-title">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJAAAACQAQMAAADdiHD7AAAABlBMVEUAAABTU1OoaSf/AAAAAXRSTlMAQObYZgAAAFJJREFUeF7t0cENgDAMQ9FwYgxG6WjpaIzCCAxQxVggFuDiCvlLOeRdHR9yzjncHVoq3npu+wQUrUuJHylSTmBaespJyJQoObUeyxDQb3bEm5Au81c0pSCD8HYAAAAASUVORK5CYII=" class="no-lightbox" style="width: 32px;"> Sorry , Lost ! <sub>去火星了！</sub>
                </h1>
            </header>
            <article class="post">
                <div class="post-content">
                    <p>随便看看？也许有意想不到的收获喔？！</p>
                    <?php Contents_Post_Initial(10, 'rand()'); ?>
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