<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?>藥要看</title><?php
        $trailDesc = '藥要看提供簡單的介面檢索國內有註冊登記的藥品資訊';
        if (!isset($desc_for_layout)) {
            $desc_for_layout = $trailDesc;
        } else {
            $desc_for_layout .= $trailDesc;
        }
        echo $this->Html->meta('description', $desc_for_layout);
        $imageBaseUrl = $this->Html->url('/img');
        if (!isset($ogImage)) {
            $ogImage = $imageBaseUrl . '/drug.png';
        } else {
            $ogImage = $this->Html->url('/') . $ogImage;
        }
        ?>
        <link rel="icon" type="image/png" href="<?php echo $imageBaseUrl; ?>/drug_32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php echo $imageBaseUrl; ?>/drug_16.png" sizes="16x16" />
        <meta property="og:image" content="<?php echo $ogImage; ?>" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
        <?php
        echo $this->Html->css('jquery-tagit');
        echo $this->Html->css('AdminLTE');
        echo $this->Html->css('default');
        ?>
        <style type="text/css">
            .table>tbody>tr>td { vertical-align:middle; }
            .dl-horizontal>dt {padding-top:6.5px}
        </style>
        <script>
            var baseUrl = '<?php echo $this->Html->url('/'); ?>';
        </script>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <?php echo $this->Html->link('藥要看', '/', array('class' => 'logo')); ?>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    &nbsp;
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form" id="keywordForm">
                        <div class="input-group">
                            <input type="text" id="keyword" value="<?php echo isset($keyword) ? $keyword : ''; ?>" class="form-control" placeholder="搜尋藥物..."  style="width:198px;" />
                        </div>
                        <div class="divider" style="height: 1px; background-color: #dbdbdb;"></div>
                        <div class="btn-group-justified">
                            <a href="#" class="btn btn-default btn-find">一般搜尋</a>
                            <a href="#" class="btn btn-default btn-outward">外觀搜尋</a>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="https://docs.google.com/forms/d/12VbriUzkqsiAHMw0KxZ7Uv9I2jqAG0cydSnKCvim5RA/viewform" target="_blank">
                                <i class="fa fa-photo"></i>
                                <span>網站發展調查</span>
                                <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="<?php echo $this->Html->url('/drugs/index'); ?>">
                                <i class="fa fa-newspaper-o"></i> <span>藥物證書</span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo $this->Html->url('/drugs/index/sort:License.submitted/direction:desc'); ?>"><i class="fa fa-angle-double-right"></i> 藥證更新</a></li>
                                <li><a href="<?php echo $this->Html->url('/drugs/index/sort:License.license_date/direction:desc'); ?>"><i class="fa fa-angle-double-right"></i> 新藥發證</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url('/drugs/outward'); ?>">
                                <i class="fa fa-photo"></i>
                                <span>藥物外觀</span>
                                <i class="fa pull-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url('/ingredients'); ?>">
                                <i class="fa fa-cogs"></i>
                                <span>藥物成份</span>
                                <i class="fa pull-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url('/vendors'); ?>">
                                <i class="fa fa-truck"></i>
                                <span>藥物廠商</span>
                                <i class="fa pull-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url('/points'); ?>">
                                <i class="fa fa-hospital-o"></i>
                                <span>醫事機構</span>
                                <i class="fa pull-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url('/articles'); ?>">
                                <i class="fa fa-book"></i>
                                <span>醫事新知</span>
                                <i class="fa pull-right"></i>
                            </a>
                        </li>
                        <?php
                        switch (Configure::read('loginMember.group_id')) {
                            case '0':
                                ?><li>
                                    <a href="<?php echo $this->Html->url('/members/login'); ?>">
                                        <i class="fa fa-user"></i>
                                        <span>會員登入</span>
                                        <i class="fa pull-right"></i>
                                    </a>
                                </li><?php
                                break;
                            case '1':
                                ?>
                                <li>
                                    <a href="<?php echo $this->Html->url('/accounts'); ?>">
                                        <i class="fa fa-book"></i>
                                        <span>健康存摺</span>
                                        <i class="fa pull-right"></i>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-newspaper-o"></i> <span>文章管理</span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?php echo $this->Html->url('/admin/articles/tasks'); ?>"><i class="fa fa-angle-double-right"></i> 暫存連結</a></li>
                                        <li><a href="<?php echo $this->Html->url('/admin/articles/index'); ?>"><i class="fa fa-angle-double-right"></i> 列表</a></li>
                                        <li><a href="<?php echo $this->Html->url('/admin/articles/add'); ?>"><i class="fa fa-angle-double-right"></i> 新增</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-newspaper-o"></i> <span>醫事機構管理</span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?php echo $this->Html->url('/admin/points/index'); ?>"><i class="fa fa-angle-double-right"></i> 列表</a></li>
                                        <li><a href="<?php echo $this->Html->url('/admin/points/add'); ?>"><i class="fa fa-angle-double-right"></i> 新增</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-newspaper-o"></i> <span>會員管理</span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?php echo $this->Html->url('/admin/members/index'); ?>"><i class="fa fa-angle-double-right"></i> 會員</a></li>
                                        <li><a href="<?php echo $this->Html->url('/admin/groups/index'); ?>"><i class="fa fa-angle-double-right"></i> 群組</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url('/members/logout'); ?>">
                                        <i class="fa fa-sign-out"></i>
                                        <span>會員登出</span>
                                        <i class="fa pull-right"></i>
                                    </a>
                                </li>
                                <?php
                                break;
                            case '2':
                                ?>
                                <li>
                                    <a href="<?php echo $this->Html->url('/accounts'); ?>">
                                        <i class="fa fa-book"></i>
                                        <span>健康存摺</span>
                                        <i class="fa pull-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url('/members/logout'); ?>">
                                        <i class="fa fa-sign-out"></i>
                                        <span>會員登出</span>
                                        <i class="fa pull-right"></i>
                                    </a>
                                </li>
                                <?php
                                break;
                        }
                        ?>
                    </ul>
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:160px;height:600px"
                         data-ad-client="ca-pub-5571465503362954"
                         data-ad-slot="8707051624"></ins>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <?php echo $this->Session->flash(); ?>
                <?php
                echo $content_for_layout;
                ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <footer class="footer" style="margin-left: auto;margin-right: auto; margin-bottom: 15px;">
            <div class="row" align="center">
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-5571465503362954"
                     data-ad-slot="3985487224"></ins>
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-5571465503362954"
                     data-ad-slot="3985487224"></ins>
                <hr />
                <?php
                switch ("{$this->request->params['controller']}/{$this->request->params['action']}") {
                    case 'drugs/view':
                    case 'ingredients/view':
                    case 'vendors/view':
                    case 'points/view':
                    case 'articles/view':
                        ?>
                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                            var disqus_shortname = 'drugs-tw';
                            var disqus_config = function () {
                                this.language = "zh_TW";
                            };

                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function () {
                                var dsq = document.createElement('script');
                                dsq.type = 'text/javascript';
                                dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script><?php
                        break;
                }
                ?>
                <?php echo $this->Html->link('信雲國際股份有限公司', 'http://syi.tw/', array('target' => '_blank')); ?> 建置
                / <?php echo $this->Html->link('關於本站', '/pages/about'); ?>
                <?php
                if (isset($apiRoute)) {
                    echo ' / ' . $this->Html->link('本頁 API', $apiRoute, array('target' => '_blank'));
                }
                ?>
                <hr />
                <img src="<?php echo $imageBaseUrl; ?>/drugs_olc_tw.png" />
            </div>
        </footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <?php
        echo $this->Html->script('app');
        echo $this->Html->script('tag-it');
        echo $this->element('sql_dump');
        ?>
        <script type="text/javascript">
                    //<![CDATA[
                    $(function () {
                        $('a.btn-find').click(function () {
                            var keyword = $('input#keyword').val();
                            if (keyword !== '') {
                                location.href = '<?php echo $this->Html->url('/drugs/index/'); ?>' + encodeURIComponent(keyword);
                            } else {
                                alert('您尚未輸入關鍵字！');
                            }
                            return false;
                        });
                        $('a.btn-outward').click(function () {
                            var keyword = $('input#keyword').val();
                            if (keyword !== '') {
                                location.href = '<?php echo $this->Html->url('/drugs/outward/'); ?>' + encodeURIComponent(keyword);
                            } else {
                                alert('您尚未輸入關鍵字！');
                            }
                            return false;
                        });
                        $('form#keywordForm').submit(function () {
                            var keyword = $('input#keyword').val();
                            if (keyword !== '') {
                                location.href = '<?php echo $this->Html->url('/drugs/index/'); ?>' + encodeURIComponent(keyword);
                            } else {
                                alert('您尚未輸入關鍵字！');
                            }
                        });
                    });
                    //]]>
        </script>
        <?php if (Configure::read('debug') === 0 && Configure::read('loginMember.group_id') !== '1') { ?>
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-40055059-4', 'auto');
                ga('send', 'pageview');
                (adsbygoogle = window.adsbygoogle || []).push({});

            </script>
        <?php } ?>
        <?php echo $this->fetch('script'); ?>
    </body>
</html>