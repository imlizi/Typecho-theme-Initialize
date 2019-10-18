<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div>
    </div>
    <footer id="footer">
        <div class="container">
            <?php if (!empty($this->options->ShowLinks) && in_array('footer', $this->options->ShowLinks)): ?>
                <ul class="links">
                    <?php Links($this->options->IndexLinksSort); ?>
                </ul>
            <?php endif; ?>
            <p>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>">FlyingSky</a>.
                Powered by <a href="http://www.typecho.org" target="_blank">Typecho</a> &amp; <a
                    href="http://www.offodd.com/17.html" target="_blank">Initial</a>.</p>
            <?php if (!empty($this->options->ButtomText)): ?>
                <?= $this->options->ButtomText ?>
            <?php endif; ?>
            <?php if ($this->options->SiteTime): ?>
                <p>已安稳运行<a id="runtime_span"></a>.</p>
                <script type="text/javascript">function show_runtime() {
                        X = new Date("<?=$this->options->SiteTime?>");
                        Y = new Date();
                        T = (Y.getTime() - X.getTime());
                        M = 24 * 60 * 60 * 1000;
                        a = T / M;
                        A = Math.floor(a);
                        runtime_span.innerHTML = "" + A + "天"
                    }
                    show_runtime();</script>
            <?php endif; ?>
            <p>
                <?php if ($this->options->ICPbeian): ?>
                    <a href="http://beian.miit.gov.cn" class="icpnum" target="_blank"
                       rel="nofollow"><?php $this->options->ICPbeian(); ?></a>
                <?php endif; ?>
                <?php if ($this->options->GAbeian): ?>
                    <img src="<?php $this->options->themeUrl('images/wab.png'); ?>">
                    <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php $this->options->GAbeian(); ?>"
                       class="icpnum" target="_blank"
                       rel="nofollow"><?php $this->options->GAbeian(); ?></a>
                <?php endif; ?>
            </p>
        </div>
    </footer>
<?php if ($this->options->scrollTop || ($this->options->MusicSet && $this->options->MusicUrl) || $this->options - DarkMode): ?>
    <div id="cornertool">
        <ul>
            <?php if ($this->options->scrollTop): ?>
                <li id="top" class="hidden">
                    <i class="fa fa-angle-double-up"></i>
                </li>
            <?php endif; ?>
            <?php if ($this->options->DarkMode): ?>
                <li id="darkmode" onclick="switchDarkMode()"><?php if ($_COOKIE['dark'] == '1') {
                        echo "亮";
                    } else {
                        echo "暗";
                    } ?></li>
            <?php endif; ?>
            <?php if ($this->options->MusicSet && $this->options->MusicUrl): ?>
                <li id="music" class="hidden">
                    <span><i></i></span>
                    <audio id="audio" preload="none"></audio>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div id="loading-wrap">
        <div class="loading">
            <div class="loading-bar">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
                <div class="bar4"></div>
            </div>
            <div class="loading-text">loading</div>
        </div>
    </div>
<?php endif; ?>
    <script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script src="https://cdn.bootcss.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src='<?php $this->options->themeUrl('js/notie.js') ?>'></script>
    <script>
        function tongji() {
            // $.get('https://hm.baidu.com/hm.js?3151f2e3f5d1cea4df1df8450049e071', {}, {}, 'jsonp');
        }
        var cornertool = true;

        function copyCode(num) {
            var clipboard = new ClipboardJS("#copyCode" + num, {
                text: function () {
                    return $("#code-" + num + " code").text();
                }
            });
            clipboard.on("success", function () {
                var txt = $("#copyCode" + num);
                txt.text('复制成功!');
                setTimeout(function () {
                    txt.text('复制');
                }, 2000);
            });
            clipboard.on("error", function () {
                console.log('err')
            });
        }

        function tooltip() {
            $("a,div,li,h3,h4,img,i,span").each(function () {
                $("#tooltip").remove();
                if (this.title) {
                    var a = this.title;
                    $(this).mouseover(function (b) {
                        this.title = "";
                        $("body").append('<div id="tooltip">' + a + "</div>");
                        $("#tooltip").css({
                            left: b.pageX - 15 + "px",
                            top: b.pageY + 30 + "px",
                            opacity: "0.8"
                        }).fadeIn(250)
                    }).mouseout(function () {
                        this.title = a;
                        $("#tooltip").remove()
                    }).mousemove(function (b) {
                        $("#tooltip").css({
                            left: b.pageX - 15 + "px",
                            top: b.pageY + 30 + "px"
                        })
                    })
                }
            });
        }
        
        function sidebarAutoHeight() {
            $("#secondary").removeAttr("style").css("height", $("#body .container").height() + "px");
        }

        function cl() {
            var a = document.getElementById("catalog-col"), b = document.getElementById("catalog"),
                c = document.getElementById("cornertool"), d;
            if (a && !b) {
                if (c) {
                    c = c.getElementsByTagName("ul")[0];
                    d = document.createElement("li");
                    d.setAttribute("id", "catalog");
                    d.setAttribute("onclick", "Catalogswith()");
                    d.appendChild(document.createElement("span"));
                    c.appendChild(d)
                } else {
                    cornertool = false;
                    c = document.createElement("div");
                    c.setAttribute("id", "cornertool");
                    c.innerHTML = '<ul><li id="catalog" onclick="Catalogswith()"><span></span></li></ul>';
                    document.body.appendChild(c)
                }
            }
            if (!a && b) {
                cornertool ? c.getElementsByTagName("ul")[0].removeChild(b) : document.body.removeChild(c)
            }
            if (a && b) {
                b.className = a.className
            }
        }

        function fancybox() {
            $(".post-content img:not('.no-lightbox')").each(function () {
                var href = $(this).parent("a").attr("href");
                if (href && href != 'javascript:void();') {
                    $(this).parent("a").attr('data-fancybox', 'gallery');
                    $(this).parent("a").attr("data-caption", $(this).attr("title"));
                } else {
                    $(this).wrap("<a data-fancybox='gallery' href='" + $(this).attr("src") + "' data-caption='" + $(this).attr("title") + "'></a>");
                }
            });
            $('[data-fancybox="gallery"]').fancybox();
        }

        cl();
        console.log("%c Initial By JIElive %c http://www.offodd.com %c Fly By FlyingSKy %chttps://fsky7.com/ %cImabsn By imabsn.com %c https://imabsn.com/", "color:#fff;background:#444;padding:5px 0;border: 1px solid #444;", "color:#fff;background:#fff;padding:5px 0;border: 1px solid #444;", "color:#fff;background:#444;padding:5px 0;border: 1px solid #444;", "color:#fff;background:#fff;padding:5px 0;border: 1px solid #444;", "color:#fff;background:#444;padding:5px 0;border: 1px solid #444;", "color:#fff;background:#fff;padding:5px 0;border: 1px solid #444;",);
        console.log("%c <?php $this->options->title(); ?>%c 欢迎您 %c Copyright © 2012-%s",
            'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:50px;color:#0c0;-webkit-text-fill-color:#0c0;-webkit-text-stroke: 1px #0c0;',
            "font-size:20px;color:#ccc", "font-size:12px;color:#999999;", (new Date).getFullYear());
        console.log("%c 发现Bug请到留言页面给我反馈(・ω・)\n 谢谢(●￣(ｴ)￣●) " + +"", "color:#333;font-size:16px;");
        $(document).ready(function () {
            $(".post-content pre").each(function (numecode) {
                $(this).attr("id", "code-" + numecode);
                // $(this).parent("div").append('<div class="toolbar"><div class="toolbar-item"><a id="copyCode' + numecode + '" onclick="copyCode(' + numecode + ')">复制</a></div></div>');
                $(this).append('<a id="copyCode'+numecode+'" class="copy-btn" onclick="copyCode('+numecode+')">复制</a>');
            });
            var clipboardLink = new ClipboardJS("#copy-link", {
                text: function () {
                    return $("#post-link").text();
                }
            });
            clipboardLink.on("success", function () {
                notie('复制成功', {type: 'success', autoHide: true, timeout: 3000, width: 120});
            });
            clipboardLink.on("error", function () {
                notie('复制失败，请手动Ctrl+C', {type: 'error', autoHide: true, timeout: 3000, width: 120});
            });
            tooltip();
            fancybox();
            tongji();
            sidebarAutoHeight();
        })

    </script>
<?php
if ($this->options->PjaxOption): ?>
    <script
        src="https://<?php if ($this->options->cjCDN == 'bc'): ?>cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.min.js<?php elseif ($this->options->cjCDN == 'cf'): ?>cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js<?php else: ?>cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.min.js<?php endif; ?>"></script>
    <script>jQuery.fn.Shake = function (n, d) {
            this.each(function () {
                var jSelf = $(this);
                jSelf.css({position: 'relative'});
                for (var x = 1; x <= n; x++) {
                    jSelf.animate({left: (-d)}, 50).animate({left: d}, 50).animate({left: 0}, 50)
                }
            });
            return this
        };
        $(document).pjax('a:not(a[target="_blank"], a[no-pjax])', {
            container: '#main',
            fragment: '#main',
            timeout: 10000
        }).on('submit', 'form[id=search], form[id=comment-form]', function (event) {
            $.pjax.submit(event, {container: '#main', fragment: '#main', timeout: 10000})
        }).on('pjax:send', function () {
            $("#header").prepend("<div id='bar'></div>");
            $("#loading-wrap").css("opacity", 1).css("height", "100%");
            $("#loading-wrap .loading").show();
        }).on('pjax:complete', function () {
            $("#loading-wrap").css("opacity", 0).css("height", 0);
            $("#loading-wrap .loading").hide();
            // $(".post-content pre").each(function (numecode) {
            //     $(this).wrap('<div class="code-toolbar"></div>').attr("id", "code-" + numecode);
            //     $(this).parent("div").append('<div class="toolbar"><div class="toolbar-item"><a id="copyCode' + numecode + '" onclick="copyCode(' + numecode + ')">复制</a></div></div>');
            // });
            $(".post-content pre").each(function (numecode) {
                $(this).attr("id", "code-" + numecode);
                // $(this).parent("div").append('<div class="toolbar"><div class="toolbar-item"><a id="copyCode' + numecode + '" onclick="copyCode(' + numecode + ')">复制</a></div></div>');
                $(this).append('<a id="copyCode'+numecode+'" class="copy-btn" onclick="copyCode('+numecode+')">复制</a>');
            });
            tooltip();
            fancybox();
            sidebarAutoHeight();
            tongji();
            setTimeout(function () {
                $("#bar").remove()
            }, 300);
            $('#header').removeClass("on");
            $('#s').val("");
            <?php if ($this->options->SidebarFixed): ?>$("#secondary").removeAttr("style");<?php endif; ?>}).on('pjax:end', function () {
            <?php if ($this->options->AjaxLoad): ?>al();
            <?php endif; ?>cl();
            ac();
            ap();
            <?php if ($this->options->CustomContent): ?>if (typeof _hmt !== 'undefined') {
                _hmt.push(['_trackPageview', location.pathname + location.search])
            }
            if (typeof ga !== 'undefined') {
                ga('send', 'pageview', location.pathname + location.search)
            }<?php endif; ?>});

        function ac() {
            $body = $('html,body');
            var g = '.comment-list', h = '.comment-num', i = '.comment-reply a', j = '#textarea', k = '', l = '';
            c();
            $('#comment-form').submit(function () {
                notie('评论正在发送中...', {type: 'info', autoHide: true, timeout: 5000, width: 200});
                $.ajax({
                    url: $(this).attr('action'), type: 'post', data: $(this).serializeArray(), error: function () {
                        notie('提交失败，请检查网络并重试或者联系管理员。', {type: 'error', autoHide: true, timeout: 5000, width: 200});
                        return false
                    }, success: function (d) {
                        if (!$(g, d).length) {
                            notie('您输入的内容不符合规则或者回复太频繁，请修改内容或者稍等片刻。', {
                                type: 'error',
                                autoHide: true,
                                timeout: 5000,
                                width: 200
                            });
                            return false
                        } else {
                            k = $(g, d).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function (a, b) {
                                return a - b
                            }).pop();
                            if ($('.page-navigator .prev').length && l == "") {
                                k = ''
                            }
                            if (l) {
                                d = $('#comment-' + k, d).hide();
                                if ($('#' + l).find(".comment-children").length <= 0) {
                                    $('#' + l).append("<div class='comment-children'><ol class='comment-list'><\/ol><\/div>")
                                }
                                if (k) $('#' + l + " .comment-children .comment-list").prepend(d);
                                l = ''
                            } else {
                                d = $('#comment-' + k, d).hide();
                                if (!$(g).length) $('#comments').prepend("<h3>已有 <span class='comment-num'>0<\/span> 条评论<\/h3><ol class='comment-list'><\/ol>");
                                $(g).prepend(d)
                            }
                            $('#comment-' + k).fadeIn();
                            var f;
                            $(h).length ? (f = parseInt($(h).text().match(/\d+/)), $(h).html($(h).html().replace(f, f + 1))) : 0;
                            TypechoComment.cancelReply();
                            $(j).val('');
                            $(i + ', #cancel-comment-reply-link').unbind('click');
                            c();
                            notie('评论已发送。', {type: 'info', autoHide: true, timeout: 5000, width: 200});
                            if (k) {
                                $body.animate({scrollTop: $('#comment-' + k).offset().top - 50}, 300)
                            } else {
                                $body.animate({scrollTop: $('#comments').offset().top - 50}, 300)
                            }
                        }
                    }
                });
                return false
            });

            function c() {
                $(i).click(function () {
                    l = $(this).parent().parent().parent().attr("id");
                    $(j).focus()
                });
                $('#cancel-comment-reply-link').click(function () {
                    l = ''
                })
            }
        }

        ac();
        var protoken = '<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl('Token'); ?>'.replace('Token', "");

        function ap() {
            $('.protected .post-title a, .protected .more a').click(function () {
                var a = $(this).parent().parent();
                a.find('.word').text("请输入密码访问").css('color', 'red').Shake(2, 10);
                a.find(':password').focus();
                return false
            });
            $('.protected form').submit(function () {
                ap_btn = $(this);
                ap_m = ap_btn.parent().find('.more a');
                ap_n = ap_btn.find('.word');
                $(ap_m).addClass('loading').text("请稍等");
                <?php if ($this->options->AjaxLoad): ?>apt();
                <?php else: ?>aps();
                <?php endif; ?>return false
            })
        }

        ap();

        <?php if (!$this->options->AjaxLoad): ?>function apt() {
            var b = $('.protected .post-title a').attr("href");
            if ($('h1.post-title').length) {
                aps()
            } else {
                $.ajax({
                    url: window.location.href, success: function (d) {
                        protoken = $('.protected form[action^="' + b + '"]', d).attr("action").replace(b, "");
                        if (protoken) {
                            aps()
                        } else {
                            $(ap_m).removeAttr("class").text("- 阅读全文 -");
                            notie('提交失败，请检查网络并重试或者联系管理员。', {
                                type: 'warning',
                                autoHide: true,
                                timeout: 3000,
                                width: 200
                            });
                            ap_n.text("提交失败，请检查网络并重试或者联系管理员。").css('color', 'red').Shake(2, 10);
                            return false
                        }
                    }
                })
            }
        }

        <?php endif; ?>function aps() {
            var c = ap_btn.parent().parent().find('.post-title a').attr("href");
            $.ajax({
                url: c + protoken, type: 'post', data: ap_btn.serializeArray(), error: function () {
                    $(ap_m).removeAttr("class").text("- 阅读全文 -");
                    notie('提交失败，请检查网络并重试或者联系管理员。', {type: 'warning', autoHide: true, timeout: 3000, width: 200});
                    ap_n.text("提交失败，请检查网络并重试或者联系管理员。").css('color', 'red').Shake(2, 10);
                    return false
                }, success: function (d) {
                    if (!$('h1.post-title', d).length) {
                        $(ap_m).removeAttr("class").text("- 阅读全文 -");
                        notie('对不起,您输入的密码错误。', {type: 'error', autoHide: true, timeout: 3000, width: 200});
                        ap_n.text("对不起,您输入的密码错误。").css('color', 'red').Shake(2, 10);
                        $(":password").val("");
                        return false
                    } else {
                        $(ap_m).removeAttr("class").text("- 阅读全文 -");
                        $('h1.post-title').length ? $.pjax.reload({
                            container: '#main',
                            fragment: '#main',
                            timeout: 10000
                        }) : $.pjax({url: c, container: '#main', fragment: '#main', timeout: 10000})
                    }
                }
            })
        }</script>
<?php endif;
if ($this->options->AjaxLoad): ?>
    <script>var isbool = true;
        <?php if ($this->options->AjaxLoad == 'auto'): ?>$(window).scroll(function () {
            if (isbool && $('.ajaxload .next a').attr("href") && ($(this).scrollTop() + $(window).height() + 20) >= $(document).height()) {
                isbool = false;
                aln()
            }
        });

        <?php endif; ?>function al() {
            $('.ajaxload li[class!="next"]').remove();
            $('.ajaxload .next a').click(function () {
                if (isbool) {
                    aln()
                }
                return false
            })
        }

        al();

        function aln() {
            var a = '.ajaxload .next a', b = $(a).attr("href");
            $(a).addClass('loading').text("正在加载");
            if (b) {
                $.ajax({
                    url: b, error: function () {
                        notie('请求失败，请检查网络并重试或者联系管理员。', {type: 'warning', autoHide: true, timeout: 3000, width: 200});
                        $(a).removeAttr("class").text("查看更多");
                        return false
                    }, success: function (d) {
                        var c = $(d).find("#main .post"), e = $(d).find(a).attr("href");
                        if (c) {
                            $('.ajaxload').before(c)
                        }
                        $(a).removeAttr("class");
                        if (e) {
                            $(a).text("查看更多").attr("href", e)
                        } else {
                            $(a).remove();
                            $('.ajaxload .next').text('没有更多文章了')
                        }
                        if ($('.protected', d).length) {
                            $('.protected *').unbind();
                            ap()
                        }
                        isbool = true;
                        return false
                    }
                })
            }
        }</script>
<?php endif; ?>
<?php $this->footer(); ?>
<?php if ($this->options->scrollTop || $this->options->HeadFixed || $this->options->SidebarFixed): ?>
    <script>window.onscroll = function () {
            var a = document.documentElement.scrollTop || document.body.scrollTop;
                <?php if ($this->options->scrollTop): ?>var b = document.getElementById("top");
            if (a >= 200) {
                b.removeAttribute("class")
            } else {
                b.setAttribute("class", "hidden")
            }
            b.onclick = function totop() {
                var a = document.documentElement.scrollTop || document.body.scrollTop;
                if (a > 0) {
                    requestAnimationFrame(totop);
                    window.scrollTo(0, a - (a / 5))
                } else {
                    cancelAnimationFrame(totop)
                }
            };
                <?php endif; if ($this->options->HeadFixed): ?>var d = document.getElementById("header");
            if (a > 0 && a < 30) {
                d.style.padding = (15 - a / 2) + "px 0";
            } else if (a >= 30) {
                d.style.padding = 0;
            } else {
                d.removeAttribute("style");
            }
                <?php endif; if ($this->options->SidebarFixed): ?>var e = document.getElementById("main");
            var f = document.getElementById("secondary");
            var g = document.documentElement.clientHeight;
            var h =<?php echo $this->options->HeadFixed ? 0 : 41 ?>;
            if (e.offsetHeight > f.offsetHeight) {
                if (f.offsetHeight > g - 71 && a > f.offsetHeight + 101 - g) {
                    if (a < e.offsetHeight + 101 - g) {
                        f.style.marginTop = (a - f.offsetHeight - 101 + g) + "px"
                    } else {
                        f.style.marginTop = (e.offsetHeight - f.offsetHeight) + "px"
                    }
                } else if (f.offsetHeight <= g - 71 && a > 30 + h) {
                    if (a < e.offsetHeight - f.offsetHeight + h) {
                        f.style.marginTop = (a - 30 - h) + "px"
                    } else {
                        f.style.marginTop = (e.offsetHeight - f.offsetHeight - 30) + "px"
                    }
                } else {
                    f.removeAttribute("style")
                }
            }<?php endif; ?>}</script>
<?php endif;
if ($this->options->MusicSet && $this->options->MusicUrl): ?>
    <script>(function () {
            var a = document.getElementById("audio");
            var b = document.getElementById("music");
            var c =<?php Playlist() ?>;
                <?php if ($this->options->MusicVol): ?>var d =<?php $this->options->MusicVol(); ?>;
            if (d >= 0 && d <= 1) {
                a.volume = d
            }
            <?php endif; ?>a.src = c.shift();
            a.addEventListener('play', g);
            a.addEventListener('pause', h);
            a.addEventListener('ended', f);
            a.addEventListener('error', f);
            a.addEventListener('canplay', j);

            function f() {
                if (!c.length) {
                    a.removeEventListener('play', g);
                    a.removeEventListener('pause', h);
                    a.removeEventListener('ended', f);
                    a.removeEventListener('error', f);
                    a.removeEventListener('canplay', j);
                    b.style.display = "none";
                    notie('本站的背景音乐好像有问题了，希望您可以通过留言等方式通知管理员，谢谢您的帮助。', {
                        type: 'error',
                        autoHide: true,
                        timeout: 5000,
                        width: 200
                    });
                } else {
                    a.src = c.shift();
                    a.play()
                }
            }

            function g() {
                b.setAttribute("class", "play");
                a.addEventListener('timeupdate', k)
            }

            function h() {
                b.removeAttribute("class");
                a.removeEventListener('timeupdate', k)
            }

            function j() {
                c.push(a.src)
            }

            function k() {
                b.getElementsByTagName("i")[0].style.width = (a.currentTime / a.duration * 100).toFixed(1) + "%"
            }

            b.onclick = function () {
                if (a.canPlayType('audio/mpeg') != "" || a.canPlayType('audio/ogg;codes="vorbis"') != "" || a.canPlayType('audio/mp4;codes="mp4a.40.5"') != "") {
                    if (a.paused) {
                        if (a.error) {
                            f()
                        } else {
                            a.play()
                        }
                    } else {
                        a.pause()
                    }
                } else {
                    notie('对不起，您的浏览器不支持HTML5音频播放，请升级您的浏览器。', {
                        type: 'warning',
                        autoHide: true,
                        timeout: 3000,
                        width: 200
                    });
                }
            };
            b.removeAttribute("class")
        })();</script>
<?php endif;
if ($this->options->CustomContent): $this->options->CustomContent();endif; ?>
<?php if ($this->options->DarkMode): ?>
    <?php
    if ($this->options->DarkModeFD && $this->options->DarkModeDomain) {
        $DarkModeFD = "domain=" . $this->options->DarkModeDomain;
    } else {
        $DarkModeFD = "";
    }
    ?>
    <script>
        function switchDarkMode() {
            var night = document.cookie.replace(/(?:(?:^|.*;\s*)dark\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
            if (night == '0') {
                document.body.classList.add('dark');
                document.cookie = "dark=1;path=/;<?=$DarkModeFD?>";
                console.log('Dark mode on');
                notie('已开启 Dark Mode ，早 6 点之前保持开启。', {type: 'info', autoHide: true, timeout: 3000, width: 200});
                document.getElementById("darkmode").innerHTML = "亮";
            } else {
                document.body.classList.remove('dark');
                document.cookie = "dark=0;path=/;<?=$DarkModeFD?>";
                console.log('Dark mode off');
                notie('已关闭 Dark Mode ', {type: 'info', autoHide: true, timeout: 1000, width: 200});
                document.getElementById("darkmode").innerHTML = "暗";
            }
        }

        (function () {
            if (document.cookie.replace(/(?:(?:^|.*;\s*)dark\s*\=\s*([^;]*).*$)|^.*$/, "$1") === '') {
                if (new Date().getHours() > 22 || new Date().getHours() < 6) {
                    document.body.classList.add('dark');
                    document.cookie = "dark=1;path=/;<?=$DarkModeFD?>";
                    console.log('Dark mode on');
                    notie('已开启 Dark Mode，早 6 点之前保持开启。 ', {type: 'info', autoHide: true, timeout: 3000, width: 200});
                    document.getElementById("darkmode").innerHTML = "亮";
                } else {
                    document.body.classList.remove('dark');
                    document.cookie = "dark=0;path=/;<?=$DarkModeFD?>";
                    console.log('Dark mode off');
                    notie('已关闭 Dark Mode ', {type: 'info', autoHide: true, timeout: 1000, width: 200});
                    document.getElementById("darkmode").innerHTML = "暗";
                }
            } else {
                var dark = document.cookie.replace(/(?:(?:^|.*;\s*)dark\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
                if (dark == '0') {
                    document.body.classList.remove('dark');
                } else if (dark == '1') {
                    document.body.classList.add('dark');
                }
            }
        })();
        document.addEventListener('visibilitychange', function () {
            var dark = document.cookie.replace(/(?:(?:^|.*;\s*)dark\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
            if (dark == '0') {
                document.body.classList.remove('dark');
                document.getElementById("darkmode").innerHTML = "暗";
            } else if (dark == '1') {
                document.body.classList.add('dark');
                document.getElementById("darkmode").innerHTML = "亮";
            }
        });
    </script>
<?php endif; ?>
    </body>
    </html><?php if ($this->options->compressHtml): $html_source = ob_get_contents();
    ob_clean();
    echo compressHtml($html_source);
    ob_end_flush(); endif; ?>