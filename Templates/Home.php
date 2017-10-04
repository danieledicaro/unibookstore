<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="3600" />
    <meta name="revisit-after" content="2 days" />
    <meta name="robots" content="index,follow" />
    <meta name="distribution" content="global" />
    <meta name="description" content="Your container description here" />
    <meta name="keywords" content="Your keywords, keywords, keywords, here" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="templates/main/template/css/mf54_reset.css" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="templates/main/template/css/mf54_grid.css" />
    <link rel="stylesheet" type="text/css" media="screen,projection,print" href="templates/main/template/css/mf54_content.css" />
    <link rel="icon" type="image/x-icon" href="templates/main/template/img/favicon.ico" />
    <title>{$title}</title>
</head>
<!--slides del professore su smarty -->
<!-- Global IE fix to avoid layout crash when single word size wider than column width -->
<!-- Following line MUST remain as a comment to have the proper effect -->
{literal}<!--[if IE]><style type="text/css"> body {word-wrap: break-word;}</style><![endif]-->{/literal}

<body>
<!-- CONTAINER FOR ENTIRE PAGE -->
<div class="container">

    <!-- A. HEADER -->
    <div class="corner-page-top"></div>
    <div class="header">
        <div class="header-top">

            <!-- A.1 SITENAME -->
            <a class="sitelogo" href="index.php" title="Home"></a>
            <div class="sitename">
                <h1><BLINK><b><a href="index.php" title="Home">Unibookstore</a></b></BLINK></h1>
                <h2>Vetrina di annunci libri universitari</h2>
            </div>

            <!-- A.2 BUTTON NAVIGATION -->
            <div class="navbutton">
                <ul>
                    <li><a href="#" title="English"><img src="templates/main/template/img/icon_flag_us.gif" alt="Flag" /></a></li>
                    <li><a href="#" title="Deutsch"><img src="templates/main/template/img/icon_flag_de.gif" alt="Flag" /></a></li>
                    <li><a href="#" title="Svenska"><img src="templates/main/template/img/icon_flag_se.gif" alt="Flag" /></a></li>
                    <li><a href="#" title="RSS"><img src="templates/main/template/img/icon_rss.gif" alt="RSS-Button" /></a></li>
                </ul>
            </div>

            <!-- A.3 GLOBAL NAVIGATION -->
            <div class="navglobal">
                <ul>
                    <li><a href="#" title="">About</a></li>
                    <li><a href="#" title="">Contact</a></li>
                    <li><a href="#" title="">Sitemap</a></li>
                    <li><a href="#" title="">Links</a></li>
                </ul>
            </div>
        </div>

        <!-- A.4 BREADCRUMB and SEARCHFORM -->
        <div class="header-bottom">
            <!-- Search form -->
            <div class="searchform">
                <form action="index.php" method="get">
                    <fieldset>
                        <input name="stringa" class="field"  value="Inserisci una parola da cercare" />
                        <input type="hidden" name="controller" value="ricerca" />
                        <input type="submit" name="task" class="button" value="Cerca" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="corner-page-bottom"></div>

    <!-- B. NAVIGATION BAR -->
    <div class="corner-page-top"></div>
    <div class="navbar">

        <!-- Navigation item -->
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?controller=ricerca&task=lista">Libri</a></li>
            <li><a href="index.php?controller=ordine&task=contenuto">Carrello</a></li>
            {section name=i loop=$menu}
            <li><a href="{$menu[i].link}">{$menu[i].testo}</a>
                {if $menu[i].submenu !=false}
                <ul>
                    {section name=j loop=$menu[i].submenu}
                    <li><a href="{$menu[i].submenu[j].link}">{$menu[i].submenu[j].testo}</a></li>
                    {/section}
                </ul>
                {/if}
            </li>
            {/section}
        </ul>
    </div>

    <!-- C. MAIN SECTION -->
    <div class="main">
        <h1 class="pagetitle">{$content_title}</h1>

        <!-- C.1 CONTENT -->
        <div class="content">
            {$main_content}
        </div>


        <!-- **   4. SUBCONTENT                                                                              ** -->


        <!-- C.2 SUBCONTENT -->
        <div class="subcontent">
            {$right_content}
            {if $tasti_laterali!=false}
            <a id="anchor-sidemenu-4"></a>
            <div class="corner-subcontent-top"></div>
            <div class="subcontent-box">
                <h1 class="menu">Menu </h1>
                <div class="sidemenu1">
                    <ul>
                        {section name=i loop=$tasti_laterali}
                        <li><a href="{$tasti_laterali[i].link}">{$tasti_laterali[i].testo}</a>
                            {if $tasti_laterali[i].submenu !=false}
                            <ul>
                                {section name=j loop=$tasti_laterali[i].submenu}
                                <li><a href="{$tasti_laterali[i].submenu[j].link}">{$tasti_laterali[i].submenu[j].testo}</a></li>
                                {/section}
                            </ul>
                            {/if}
                        </li>
                        {/section}
                    </ul>
                </div>
            </div>
            <div class="corner-subcontent-bottom"></div>
            {/if}
        </div>

    </div>

    <!-- *******************************   END OF AVAILABLE CONTENT STYLES   ****************************** -->


    <!-- D. FOOTER -->
    <div class="footer">
        <p ></p>
    </div>
    <div class="corner-page-bottom"></div>
</div>

</body>

</html>