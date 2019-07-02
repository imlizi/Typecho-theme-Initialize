<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
global $options;
$options = Helper::options();

if ($options->GravatarUrl) define('__TYPECHO_GRAVATAR_PREFIX__', $options->GravatarUrl);

function themeConfig($form)
{
    echo '<p style="font-size:14px;" id="use-intro">
    <span style="display: block;
    margin-bottom: 10px;
    margin-top: 10px;
    font-size: 16px;">感谢您使用 Initial - Fly 主题</span>
    <a href="https://blog.fsky7.com/archives/52/"  target="_blank">关于&帮助</a> &nbsp;
    <a href="https://www.offodd.com/17.html" target="_blank">原作&鸣谢</a> &nbsp;
    <code>10.0.1</code>
    </p>';

    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);

    $subTitle = new Typecho_Widget_Helper_Form_Element_Text('subTitle', NULL, NULL, _t('自定义站点副标题'), _t('浏览器副标题，仅在当前页面为首页时显示，显示格式为：<b>标题 - 副标题</b>，留空则不显示副标题'));
    $form->addInput($subTitle);

    $customTitle = new Typecho_Widget_Helper_Form_Element_Text('customTitle', NULL, NULL, _t('自定义头部站点标题'), _t('仅在页面头部标题位置显示，和Typecho后台设置的站点名称不冲突，留空则显示默认站点名称'));
    $form->addInput($customTitle);

    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('Favicon 地址'), _t('在这里填入一个图片 URL 地址, 以添加一个Favicon，留空则不单独设置Favicon'));
    $form->addInput($favicon);

    $AttUrlReplace = new Typecho_Widget_Helper_Form_Element_Textarea('AttUrlReplace', NULL, NULL, _t('文章内的链接地址替换（建议用在图片等静态资源的链接上）'), _t('按照格式输入你的CDN链接以替换原链接，格式：<br><b class="notice">原地址=替换地址</b><br>原地址与新地址之间用等号“=”分隔，例如：<br><b>http://www.example.com/usr/uploads/=http://cdn.example.com/usr/uploads/</b><br>支持绝大部分有镜像功能的CDN服务，可设置多个规则，换行即可，一行一个'));
    $form->addInput($AttUrlReplace);

    $Navset = new Typecho_Widget_Helper_Form_Element_Checkbox('Navset',
        array('ShowCategory' => _t('显示分类'),
            'AggCategory' => _t('↪合并分类'),
            'ShowPage' => _t('显示页面'),
            'AggPage' => _t('↪合并页面')),
        array('ShowCategory', 'AggCategory', 'ShowPage'), _t('导航栏显示'), _t('默认显示合并的分类，显示页面'));
    $form->addInput($Navset->multiMode());

    $CategoryText = new Typecho_Widget_Helper_Form_Element_Text('CategoryText', NULL, NULL, _t('导航栏-分类 下拉菜单显示名称（使用“导航栏显示-合并分类”时生效）'), _t('在这里输入导航栏<b>分类</b>下拉菜单的显示名称,留空则默认显示为“分类”'));
    $form->addInput($CategoryText);

    $PageText = new Typecho_Widget_Helper_Form_Element_Text('PageText', NULL, NULL, _t('导航栏-页面 下拉菜单显示名称（使用“导航栏显示-合并页面”时生效）'), _t('在这里输入导航栏<b>页面</b>下拉菜单的显示名称,留空则默认显示为“其他”'));
    $form->addInput($PageText);

    $MyLinks = new Typecho_Widget_Helper_Form_Element_Textarea('MyLinks', NULL, NULL, _t('自定义导航栏链接'), _t('格式为 <b class="notice">文字=链接</b>，一行一个，留空则没有'));
    $form->addInput($MyLinks);

    $Breadcrumbs = new Typecho_Widget_Helper_Form_Element_Checkbox('Breadcrumbs',
        array('Postshow' => _t('文章内显示'),
            'Text' => _t('↪文章标题替换为“正文”'),
            'Pageshow' => _t('页面内显示')),
        array('Postshow', 'Text', 'Pageshow'), _t('面包屑导航显示'), _t('默认在文章与页面内显示，并将文章标题替换为“正文”'));
    $form->addInput($Breadcrumbs->multiMode());

    $WeChat = new Typecho_Widget_Helper_Form_Element_Text('WeChat', NULL, NULL, _t('微信打赏二维码（建议图片尺寸不低于240*240）'), _t('在这里填入一个图片 URL 地址, 以添加一个微信打赏二维码，留空则不设置微信打赏'));
    $form->addInput($WeChat);

    $Alipay = new Typecho_Widget_Helper_Form_Element_Text('Alipay', NULL, NULL, _t('支付宝打赏二维码（建议图片尺寸不低于240*240）'), _t('在这里填入一个图片 URL 地址, 以添加一个支付宝打赏二维码，留空则不设置支付宝打赏'));
    $form->addInput($Alipay);

    $DarkMode = new Typecho_Widget_Helper_Form_Element_Radio('DarkMode',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        1, _t('黑暗模式总开关'), _t('默认开启'));
    $form->addInput($DarkMode);

    $DarkModeFD = new Typecho_Widget_Helper_Form_Element_Radio('DarkModeFD',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('黑暗模式跨域使用开关'), _t('默认关闭'));
    $form->addInput($DarkModeFD);

    $DarkModeDomain = new Typecho_Widget_Helper_Form_Element_Text('DarkModeDomain', NULL, NULL, _t('黑暗模式跨域使用总域名'));
    $DarkModeDomain->input->setAttribute('class', 'mini');
    $form->addInput($DarkModeDomain);

    $FlyStyle = new Typecho_Widget_Helper_Form_Element_Radio('FlyStyle',
        array(1 => _t('Fly 样式'),
            0 => _t('原版样式')),
        1, _t('网站样式选择'), _t('默认为 Fly 样式'));
    $form->addInput($FlyStyle);

    $TimeNotice = new Typecho_Widget_Helper_Form_Element_Radio('TimeNotice',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('久远文章提醒'), _t('默认关闭'));
    $form->addInput($TimeNotice);

    $TimeNoticeLock = new Typecho_Widget_Helper_Form_Element_Text('TimeNoticeLock', NULL, '30', _t('久远文章提醒阈值'), _t('单位：天，默认30天'));
    $TimeNoticeLock->input->setAttribute('class', 'mini');
    $form->addInput($TimeNoticeLock);

    $SiteTime = new Typecho_Widget_Helper_Form_Element_Text('SiteTime', NULL, NULL, _t('建站时间'), _t('格式：月/日/年 时:分:秒（示例：08/19/2018 10:00:00 为 2018年8月19日10点整），显示在网站底部，留空不显示'));
    $SiteTime->input->setAttribute('class', 'mini');
    $form->addInput($SiteTime);

    $WordCount = new Typecho_Widget_Helper_Form_Element_Radio('WordCount',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        1, _t('文章字数统计'), _t('默认开启'));
    $form->addInput($WordCount);

    $HeadFixed = new Typecho_Widget_Helper_Form_Element_Radio('HeadFixed',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('浮动显示头部'), _t('默认关闭'));
    $form->addInput($HeadFixed);

    $SidebarFixed = new Typecho_Widget_Helper_Form_Element_Radio('SidebarFixed',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('动态显示侧边栏'), _t('默认关闭'));
    $form->addInput($SidebarFixed);

    $cjCDN = new Typecho_Widget_Helper_Form_Element_Radio('cjCDN',
        array('bc' => _t('BootCDN'),
            'cf' => _t('CDNJS'),
            'jd' => _t('jsDelivr')),
        'bc', _t('公共静态资源来源'), _t('默认BootCDN，请根据需求选择合适来源'));
    $form->addInput($cjCDN);

    $GravatarUrl = new Typecho_Widget_Helper_Form_Element_Radio('GravatarUrl',
        array(false => _t('官方源'),
            'https://cn.gravatar.com/avatar/' => _t('国内源'),
            'https://cdn.v2ex.com/gravatar/' => _t('V2EX源')),
        false, _t('Gravatar头像源'), _t('默认官方源'));
    $form->addInput($GravatarUrl);

    $compressHtml = new Typecho_Widget_Helper_Form_Element_Radio('compressHtml',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('HTML压缩'), _t('默认关闭，启用则会对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情选择开启或者关闭'));
    $form->addInput($compressHtml);

    $PjaxOption = new Typecho_Widget_Helper_Form_Element_Radio('PjaxOption',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('全站Pjax'), _t('默认关闭，启用则会强制关闭“反垃圾保护”，强制“将较新的的评论显示在前面”'));
    $form->addInput($PjaxOption);

    $AjaxLoad = new Typecho_Widget_Helper_Form_Element_Radio('AjaxLoad',
        array('auto' => _t('自动'),
            'click' => _t('点击'),
            0 => _t('关闭')),
        0, _t('Ajax翻页'), _t('默认关闭，启用则会使用Ajax加载文章翻页'));
    $form->addInput($AjaxLoad);

    $scrollTop = new Typecho_Widget_Helper_Form_Element_Radio('scrollTop',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        1, _t('返回顶部'), _t('默认开启，启用将在右下角显示“返回顶部”按钮'));
    $form->addInput($scrollTop);

    $MusicSet = new Typecho_Widget_Helper_Form_Element_Radio('MusicSet',
        array('order' => _t('顺序播放'),
            'shuffle' => _t('随机播放'),
            0 => _t('关闭')),
        0, _t('背景音乐'), _t('默认关闭，启用后请填写音乐地址,否则开启无效'));
    $form->addInput($MusicSet);

    $MusicUrl = new Typecho_Widget_Helper_Form_Element_Textarea('MusicUrl', NULL, NULL, _t('背景音乐地址（建议使用mp3格式）'), _t('请输入完整的音频文件路径，例如：https://music.163.com/song/media/outer/url?id={MusicID}.mp3（好东西^_-）,可设置多个音频，换行即可，一行一个，留空则关闭背景音乐'));
    $form->addInput($MusicUrl);

    $MusicVol = new Typecho_Widget_Helper_Form_Element_Text('MusicVol', NULL, NULL, _t('背景音乐播放音量（输入范围：0~1）'), _t('请输入一个0到1之间的小数（0为静音  0.5为50%音量  1为100%最大音量）输入错误内容或留空则使用默认音量100%'));
    $MusicVol->input->setAttribute('class', 'mini');
    $form->addInput($MusicVol->addRule('isInteger', _t('请填入一个0~1内的数字')));

    $InsideLinksIcon = new Typecho_Widget_Helper_Form_Element_Radio('InsideLinksIcon',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('显示链接图标（内页）'), _t('默认关闭，启用后内页（链接模板）链接将显示链接图标'));
    $form->addInput($InsideLinksIcon);

    $IndexLinksSort = new Typecho_Widget_Helper_Form_Element_Text('IndexLinksSort', NULL, NULL, _t('首页显示的链接分类（支持多分类，请用英文逗号“,”分隔）'), _t('若只需显示某分类下的链接，请输入链接分类名（建议使用字母形式的分类名），留空则默认显示全部链接'));
    $form->addInput($IndexLinksSort);

    $InsideLinksSort = new Typecho_Widget_Helper_Form_Element_Text('InsideLinksSort', NULL, NULL, _t('内页（链接模板）显示的链接分类（支持多分类，请用英文逗号“,”分隔）'), _t('若只需显示某分类下的链接，请输入链接分类名（建议使用字母形式的分类名），留空则默认显示全部链接'));
    $form->addInput($InsideLinksSort);

    $ShowLinks = new Typecho_Widget_Helper_Form_Element_Checkbox('ShowLinks', array('footer' => _t('页脚'), 'sidebar' => _t('侧边栏')), NULL, _t('首页显示链接'));
    $form->addInput($ShowLinks->multiMode());

    $ShowWhisper = new Typecho_Widget_Helper_Form_Element_Checkbox('ShowWhisper', array('index' => _t('首页'), 'sidebar' => _t('侧边栏')), NULL, _t('显示最新的“轻语”'));
    $form->addInput($ShowWhisper->multiMode());

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock',
        array('ShowWaySit' => _t('显示导航位（下方自定义）'),
            'ShowEatFoodSit' => _t('显示广告位（下方自定义）'),
            'ShowHotPosts' => _t('显示热门文章（根据浏览量排序）'),
            'ShowRecentPosts' => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'IgnoreAuthor' => _t('↪不显示作者回复'),
            'ShowCategory' => _t('显示分类'),
            'ShowTag' => _t('显示标签'),
            'ShowArchive' => _t('显示归档'),
            'ShowStats' => _t('显示网站统计'),
            'ShowOther' => _t('显示其它杂项')),
        array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowTag', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    $form->addInput($sidebarBlock->multiMode());

    $WaySit = new Typecho_Widget_Helper_Form_Element_Textarea('WaySit', NULL, NULL, _t('导航位内容'));
    $form->addInput($WaySit);

    $EatFoodSit = new Typecho_Widget_Helper_Form_Element_Textarea('EatFoodSit', NULL, NULL, _t('广告位内容'));
    $form->addInput($EatFoodSit);

    $ICPbeian = new Typecho_Widget_Helper_Form_Element_Text('ICPbeian', NULL, NULL, _t('ICP备案号'), _t('在这里输入ICP备案号,留空则不显示'));
    $form->addInput($ICPbeian);

    $ButtomText = new Typecho_Widget_Helper_Form_Element_Textarea('ButtomText', NULL, NULL, _t('底部自定义内容'), _t('位于底部版权下方建站时间上方'));
    $form->addInput($ButtomText);

    $CustomContent = new Typecho_Widget_Helper_Form_Element_Textarea('CustomContent', NULL, NULL, _t('底部自定义内容'), _t('位于底部，footer之后body之前，适合放置一些JS内容，如网站统计代码等（若开启全站Pjax，目前支持Google和百度统计的回调，其余统计代码可能会不准确）'));
    $form->addInput($CustomContent);
}

function themeInit($archive)
{
    global $options;
    $options->commentsAntiSpam = false;
    if ($options->PjaxOption || FindContents('page-whisper.php', 'commentsNum', 'd')) {
        $options->commentsOrder = 'DESC';
        $options->commentsPageDisplay = 'first';
    }
    if ($archive->is('single')) {
        $archive->content = hrefOpen($archive->content);
        if ($options->AttUrlReplace) {
            $archive->content = UrlReplace($archive->content);
        }
        if ($archive->fields->catalog) {
            $archive->content = createCatalog($archive->content);
        }
    }
}

function hrefOpen($obj)
{
    global $options;
    return preg_replace('/<a\b([^>]+?)\bhref="((?!' . addcslashes($options->index, '/._-+=#?&') . ').*?)"([^>]*?)>/i', '<a\1href="\2"\3 target="_blank">', $obj);
}

function UrlReplace($obj)
{
    global $options;
    $list = explode("\r\n", $options->AttUrlReplace);
    foreach ($list as $tmp) {
        list($old, $new) = explode('=', $tmp);
        $obj = str_replace($old, $new, $obj);
    }
    return $obj;
}

function postThumb($obj)
{
    global $options;
    $thumb = $obj->fields->thumb;
    if (!$thumb) {
        return false;
    }
    if (is_numeric($thumb)) {
        preg_match_all('/<img.*?src="(.*?)".*?[\/]?>/i', $obj->content, $matches);
        if (isset($matches[1][$thumb - 1])) {
            $thumb = $matches[1][$thumb - 1];
        } else {
            return false;
        }
    }
    if ($options->AttUrlReplace) {
        $thumb = UrlReplace($thumb);
    }
    return '<img src="' . $thumb . '" />';
}

function Postviews($archive)
{
    $db = Typecho_Db::get();
    $cid = $archive->cid;
//    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
//        $db->query('ALTER TABLE `' . $db->getPrefix() . 'contents` ADD `views` INT(10) DEFAULT 0;');
//    }
    $exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
    if ($archive->is('single')) {
        $cookie = Typecho_Cookie::get('contents_views');
        $cookie = $cookie ? explode(',', $cookie) : array();
        if (!in_array($cid, $cookie)) {
            $db->query($db->update('table.contents')
                ->rows(array('views' => (int)$exist + 1))
                ->where('cid = ?', $cid));
            $exist = (int)$exist + 1;
            array_push($cookie, $cid);
            $cookie = implode(',', $cookie);
            Typecho_Cookie::set('contents_views', $cookie);
        }
    }
    echo $exist == 0 ? '暂无阅读' : $exist . ' 次阅读';
}

function createCatalog($obj)
{
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function ($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        $text = trim(strip_tags($obj[3]));
        return '<h' . $obj[1] . $obj[2] . '><a class="cl-offset" id="dl-' . $text . '" name="cl-' . $catalog_count . '"></a>' . $text . '</h' . $obj[1] . '>';
    }, $obj);
    return $obj . "\n" . getCatalog();
}

function getCatalog()
{
    global $catalog;
    $index = '';
    if ($catalog) {
        $index = '<ul>' . "\n";
        $prev_depth = '';
        $to_depth = 0;
        foreach ($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>' . "\n";
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= "\n" . '<ul>' . "\n";
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i = 0; $i < $to_depth2; $i++) {
                            $index .= '</li>' . "\n" . '</ul>' . "\n";
                            $to_depth--;
                        }
                    }
                    $index .= '</li>' . "\n";
                }
            }
            $index .= '<li><a href="#cl-' . $catalog_item['count'] . '" onclick="Catalogswith()">' . $catalog_item['text'] . '</a>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i = 0; $i <= $to_depth; $i++) {
            $index .= '</li>' . "\n" . '</ul>' . "\n";
        }
        $index = '<div id="catalog-col">' . "\n" . '<b>文章目录</b>' . "\n" . $index . '<script>function Catalogswith(){document.getElementById("catalog-col").classList.toggle("catalog");document.getElementById("catalog").classList.toggle("catalog")}</script>' . "\n" . '</div>' . "\n";
    }
    return $index;
}

function CommentAuthor($obj, $autoLink = NULL, $noFollow = NULL)
{
    global $options;
    $autoLink = $autoLink ? $autoLink : $options->commentsShowUrl;
    $noFollow = $noFollow ? $noFollow : $options->commentsUrlNofollow;
    if ($obj->url && $autoLink) {
        echo '<a href="' . $obj->url . '"' . ($noFollow ? ' rel="external nofollow"' : NULL) . (strstr($obj->url, $options->index) == $obj->url ? NULL : ' target="_blank"') . '>' . $obj->author . '</a>';
    } else {
        echo $obj->author;
    }
}

function Contents_Post_Initial($limit = 10, $order = 'created')
{
    $db = Typecho_Db::get();
    global $options;
    $posts = $db->fetchAll($db->select()->from('table.contents')
        ->where('type = ? AND status = ? AND created < ?', 'post', 'publish', $options->time)
        ->order($order, Typecho_Db::SORT_DESC)
        ->limit($limit), array(Typecho_Widget::widget('Widget_Abstract_Contents'), 'filter'));
    if ($posts) {
        foreach ($posts as $post) {
            echo '<li><a title="查看文章'.$post['title'].'" ' . ($post['hidden'] && $options->PjaxOption ? '' : ' href="' . $post['permalink'] . '"') . '>' . htmlspecialchars($post['title']) . '</a></li>' . "\n";
        }
    } else {
        echo '<li>暂无文章</li>' . "\n";
    }
}

function permaLink($obj)
{
    $db = Typecho_Db::get();
    global $options;
    $parentContent = FindContent($obj['cid']);
    if ($options->commentsPageBreak && 'approved' == $obj['status']) {
        $coid = $obj['coid'];
        $parent = $obj['parent'];
        while ($parent > 0 && $options->commentsThreaded) {
            $parentRows = $db->fetchRow($db->select('parent')->from('table.comments')
                ->where('coid = ? AND status = ?', $parent, 'approved')->limit(1));
            if (!empty($parentRows)) {
                $coid = $parent;
                $parent = $parentRows['parent'];
            } else {
                break;
            }
        }
        $select = $db->select('coid', 'parent')->from('table.comments')
            ->where('cid = ? AND status = ?', $parentContent['cid'], 'approved')
            ->where('coid ' . ('DESC' == $options->commentsOrder ? '>=' : '<=') . ' ?', $coid)
            ->order('coid', Typecho_Db::SORT_ASC);
        if ($options->commentsShowCommentOnly) {
            $select->where('type = ?', 'comment');
        }
        $comments = $db->fetchAll($select);
        $commentsMap = array();
        $total = 0;
        foreach ($comments as $comment) {
            $commentsMap[$comment['coid']] = $comment['parent'];
            if (0 == $comment['parent'] || !isset($commentsMap[$comment['parent']])) {
                $total++;
            }
        }
        $currentPage = ceil($total / $options->commentsPageSize);
        $pageRow = array('permalink' => $parentContent['pathinfo'], 'commentPage' => $currentPage);
        return Typecho_Router::url('comment_page', $pageRow, $options->index) . '#' . $obj['type'] . '-' . $obj['coid'];
    }
    return $parentContent['permalink'] . '#' . $obj['type'] . '-' . $obj['coid'];
}

function FindContent($cid)
{
    $db = Typecho_Db::get();
    return $db->fetchRow($db->select()->from('table.contents')
        ->where('cid = ?', $cid)
        ->limit(1), array(Typecho_Widget::widget('Widget_Abstract_Contents'), 'filter'));
}

function FindContents($val = NULL, $order = 'order', $sort = 'a', $publish = NULL)
{
    global $options;
    $db = Typecho_Db::get();
    $sort = ($sort == 'a') ? Typecho_Db::SORT_ASC : Typecho_Db::SORT_DESC;
    $select = $db->select()->from('table.contents')
        ->where('created < ?', $options->time)
        ->order($order, $sort);
    if ($val) {
        $select->where('template = ?', $val);
    }
    if ($publish) {
        $select->where('status = ?', 'publish');
    }
    return $db->fetchAll($select, array(Typecho_Widget::widget('Widget_Abstract_Contents'), 'filter'));
}

function Whisper($sidebar = NULL)
{
    $db = Typecho_Db::get();
    global $options;
    $page = FindContents('page-whisper.php', 'commentsNum', 'd');
    $p = $sidebar ? 'li' : 'p';
    if (isset($page)) {
        $page = $page[0];
        $title = $sidebar ? '' : '<h2 class="post-title"><a href="' . $page['permalink'] . '">' . $page['title'] . '<span class="more">···</span></a></h2>' . "\n";
        $comment = $db->fetchAll($db->select()->from('table.comments')
            ->where('cid = ? AND status = ? AND parent = ?', $page['cid'], 'approved', '0')
            ->order('coid', Typecho_Db::SORT_DESC)
            ->limit(1));
        if ($comment) {
            $content = hrefOpen(Markdown::convert($comment[0]['text']));
            if ($options->AttUrlReplace) {
                $content = UrlReplace($content);
            }
            if ($sidebar) {
                echo $title . '<a href="'.$page['permalink'].'">'.strip_tags($content, '<p><br><strong><a><img><pre><code>' . $options->commentsHTMLTagAllowed) . '</a>';
            } else {
                echo $title . strip_tags($content, '<p><br><strong><a><img><pre><code>' . $options->commentsHTMLTagAllowed) . "\n" . ($sidebar ? '<li class="more"><a href="' . $page['permalink'] . '">查看更多...</a></li>' . "\n" : '');
            }
        } else {
            echo $title . '<' . $p . '>暂无内容</' . $p . '>' . "\n";
        }
    } else {
        echo ($sidebar ? '' : '<h2 class="post-title"><a>轻语</a></h2>' . "\n") . '<' . $p . '>暂无内容</' . $p . '>' . "\n";
    }
}

function Links_list()
{
    global $options;
    $db = Typecho_Db::get();
    $list = $options->Links ? $options->Links : '';
    $page_links = FindContents('page-links.php', 'order', 'a')[0];
    if (isset($page_links)) {
        $exist = $db->fetchRow($db->select()->from('table.fields')
            ->where('cid = ? AND name = ?', $page_links['cid'], 'links'));
        if (empty($exist)) {
            $db->query($db->insert('table.fields')
                ->rows(array(
                    'cid' => $page_links['cid'],
                    'name' => 'links',
                    'type' => 'str',
                    'str_value' => $list,
                    'int_value' => 0,
                    'float_value' => 0
                )));
            return $list;
        }
        if (empty($exist['str_value'])) {
            $db->query($db->update('table.fields')
                ->rows(array('str_value' => $list))
                ->where('cid = ? AND name = ?', $page_links['cid'], 'links'));
            return $list;
        }
        $list = $exist['str_value'];
    }
    return $list;
}

function Links($sorts = NULL, $icon = 0, $siderbar = 0)
{
    $link = NULL;
    $list = Links_list();
    if ($list) {
        $list = explode("\r\n", $list);
        foreach ($list as $val) {
            list($name, $url, $description, $logo, $sort) = explode(',', $val);
            if ($sorts) {
                $arr = explode(',', $sorts);
                if ($sort && in_array($sort, $arr)) {
                    $link .= '<li><a' . ($url ? ' href="' . $url . '"' : '') . ($icon == 1 && $url ? ' class="l_logo"' : '') . ' title="' . $description . '" target="_blank">' . ($icon == 1 && $url ? '<img src="' . ($logo ? $logo : rtrim($url, '/') . '/favicon.ico') . '" onerror="erroricon(this)" class="no-lightbox">' : '') . '<span>' . ($url ? $name : '<del>' . $name . '</del>') . '</span></a></li>' . "\n";
                }
            } else {
                $link .= '<li><a' . ($url ? ' href="' . $url . '"' : '') . ($icon == 1 && $url ? ' class="l_logo"' : '') . ' title="' . $description . '" target="_blank">' . ($icon == 1 && $url ? '<img src="' . ($logo ? $logo : rtrim($url, '/') . '/favicon.ico') . '" onerror="erroricon(this)" class="no-lightbox">' : '') . '<span>' . ($url ? $name : '<del>' . $name . '</del>') . '</span></a></li>' . "\n";
            }
        }
    }
    echo $link ? $link : '<li>暂无链接</li>' . "\n";
}

function Playlist()
{
    global $options;
    $arr = explode("\r\n", $options->MusicUrl);
    if ($options->MusicSet == 'shuffle') {
        shuffle($arr);
    }
    echo '["' . implode('","', $arr) . '"]';
}

function compressHtml($html_source)
{
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
            $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
            $c = '';
            foreach ($tmps as $tmp) {
                if (strpos($tmp, '//') !== false) {
                    if (substr(trim($tmp), 0, 2) == '//') {
                        continue;
                    }
                    $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                    $is_quot = $is_apos = false;
                    foreach ($chars as $key => $char) {
                        if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                            $is_quot = !$is_quot;
                        } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                            $is_apos = !$is_apos;
                        } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                            $tmp = substr($tmp, 0, $key);
                            break;
                        }
                    }
                }
                $c .= $tmp;
            }
        }
        $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '> <', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress;
}

//加载时间
function timer_start()
{
    global $timestart;
    $mtime = explode(' ', microtime());
    $timestart = $mtime[1] + $mtime[0];
    return true;
}

timer_start();
function timer_stop($display = 0, $precision = 3)
{
    global $timestart, $timeend;
    $mtime = explode(' ', microtime());
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = number_format($timeend - $timestart, $precision);
    $loadtime = $timetotal < 1 ? $timetotal * 1000 . ' ms' : $timetotal . ' s';
    if ($display) {
        echo $loadtime;
    }
    return $loadtime;
}

//总访问量
function theAllViews()
{
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $row = $db->fetchAll('SELECT SUM(VIEWS) FROM `' . $prefix . 'contents`');
    return number_format($row[0]['SUM(VIEWS)']);
}

function themeFields($layout)
{
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('在这里填入一个图片 URL 地址, 以添加本文的缩略图，若填入纯数字，例如 <b>3</b> ，则使用文章第三张图片作为缩略图（对应位置无图则不显示缩略图），留空则默认不显示缩略图'));
    $thumb->input->setAttribute('class', 'w-100');
    $layout->addItem($thumb);

    $catalog = new Typecho_Widget_Helper_Form_Element_Radio('catalog',
        array(true => _t('启用'),
            false => _t('关闭')),
        false, _t('文章目录'), _t('默认关闭，启用则会在文章内显示“文章目录”（若文章内无任何标题，则不显示目录）'));
    $layout->addItem($catalog);
}

function MyLinks($links)
{
    $link = explode("\n", $links);
    $num = count($link);
    for ($i = 0; $i < $num; $i++) {
        $links = trim($link[$i]);
        if ($links) {
            $obj = explode("=", $links);
            echo '<li><a href="' . $obj['1'] . '" target="_blank">' . $obj['0'] . '</a></li>';
        }
    }
}

function WordCount($content)
{
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $content);
    $num = mb_strlen($text, 'UTF-8');
    if ($num) {
        echo $num . '字';
    }else {
        echo '';
    }
}

function smartDateTime($time)
{
    $etime = time() - $time;
    if ($etime < 1) {
        return '刚刚';
    }

    $interval = array(
        12 * 30 * 24 * 60 * 60 => '年前 (' . date('Y-m-d', $time) . ')',
        30 * 24 * 60 * 60 => '个月前 (' . date('m-d', $time) . ')',
        7 * 24 * 60 * 60 => '周前 (' . date('m-d', $time) . ')',
        24 * 60 * 60 => '天前',
        60 * 60 => '小时前',
        60 => '分钟前',
        1 => '秒前',
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
    return '';
}

function randomPost($limit = 10)
{

}