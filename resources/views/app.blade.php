<!DOCTYPE html>
<!--[if IE 8]>
<html lang="tr" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="tr" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="tr">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Stok Takip ve Raporlama Sistemi </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Stok Takip ve Raporlama Sistemi" name="description"/>
    <meta content="Ahmet Emin ŞİT" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/backend/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="/backend/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/backend/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="/backend/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    @yield("css")
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="/">
                    <img src="/backend/assets/layouts/layout/img/logo.png" alt="logo" class="logo-default"/> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default"> {{ \App\Talep::where('firma_id',  \Illuminate\Support\Facades\Auth::user()->firma_id)->where('onay', 0)->count() }} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    Eklenen <span class="bold">Son 5</span> Talep</h3>
                                <a href="/talepler">Tümünü Gör</a>
                            </li>

                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                    data-handle-color="#637283">
                                    @foreach(\App\Talep::where('firma_id',  \Illuminate\Support\Facades\Auth::user()->firma_id)->where('onay', 0)->latest()->take(5)->get() as $talep)
                                        <li>
                                            <a title="Detaylar" href="/talepler/detay-talep/{{ $talep->id }}">
                                                @php($zaman =  $talep->created_at)
                                                @php($zaman->setLocale('tr'))
                                                <span class="time">{{ $zaman->diffForHumans()}}</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-primary">
                                                    <i class="fa fa-bell-o"></i>
                                                    </span> {{ $talep->aciklama }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle" src="/backend/assets/layouts/layout/img/avatar.png"/>
                            <span class="username username-hide-on-mobile">
                                {{ \Illuminate\Support\Facades\Auth::user()->name . ' ' . \Illuminate\Support\Facades\Auth::user()->lastname  . ' - ' }}
                                @if(isset(\Illuminate\Support\Facades\Auth::user()->birim->ad) &&  isset(\Illuminate\Support\Facades\Auth::user()->birim->birimTuru->ad))
                                    {{  \Illuminate\Support\Facades\Auth::user()->birim->ad }}
                                    -
                                    {{ \Illuminate\Support\Facades\Auth::user()->birim->birimTuru->ad }}
                                @else
                                    <i class="fa fa-user-secret"></i> Super Admin
                                @endif
                            </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="/logout">
                                    <i class="icon-key"></i> Çıkış Yap
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="200" style="padding-top: 20px">
                    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                    <li class="sidebar-search-wrapper">
                        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                        <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                        <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                        <form class="sidebar-search  sidebar-search-bordered" action="" method="POST">
                            <a href="javascript:;" class="remove">
                                <i class="icon-close"></i>
                            </a>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Ara...">
                                <span class="input-group-btn">
                                    <a href="javascript:;" class="btn submit">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </span>
                            </div>
                        </form>
                        <!-- END RESPONSIVE QUICK SEARCH FORM -->
                    </li>

                    <li class="nav-item start ">
                        <a href="/" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">Anasayfa</span>
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <li class="heading">
                        <h3 class="uppercase">Sistem</h3>
                    </li>
                    @if( \Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin')
                        <li class="nav-item start ">
                            <a href="/firmalar" class="nav-link nav-toggle">
                                <i class="fa fa-university"></i>
                                <span class="title">Firma</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' || \Illuminate\Support\Facades\Auth::user()->yetkiler->birim == 1)
                        <li class="nav-item {{ (strpos(url()->full(),'sube') ? 'active open' : ( strpos(url()->full(),'ekle-birim') ? 'active open' : ' ' ))  }} ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-table"></i>
                                <span class="title">Firma Birimleri</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="/subeler" class="nav-link">
                                        <span class="title">Birimler</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ekle-birim-turu" class="nav-link ">
                                        <span class="title">Birim Türleri</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' || \Illuminate\Support\Facades\Auth::user()->yetkiler->urun == 1)
                        <li class="nav-item  {{ (strpos(url()->full(),'urun') ? 'active open' : ( strpos(url()->full(),'ekle-urun-birimleri') ? 'active open' : ' ' ))  }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-gavel"></i>
                                <span class="title">Ürün Bilgileri</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="/urunler" class="nav-link ">
                                        <span class="title">Ürünler</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ekle-urun-kategori" class="nav-link ">
                                        <span class="title">Ürün Kategorileri</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ekle-urun-birimleri" class="nav-link ">
                                        <span class="title">Ürün Birimleri</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' || \Illuminate\Support\Facades\Auth::user()->yetkiler->talep == 1)
                        <li class="nav-item  {{ (strpos(url()->full(),'talep') ? 'active open' : '')  }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-arrow-circle-down"></i>
                                <span class="title">Talep Sistemi</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="/talepler" class="nav-link ">
                                        <span class="title">Talepler</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/onaylanan-talepler" class="nav-link ">
                                        <span class="title">Onaylanan Talepler</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' || \Illuminate\Support\Facades\Auth::user()->yetkiler->hareket == 1)
                        <li class="nav-item start ">
                            <a href="/transferler" class="nav-link nav-toggle">
                                <i class="fa fa-truck"></i>
                                <span class="title">Transfer Yönetimi</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' || \Illuminate\Support\Facades\Auth::user()->yetkiler->proje == 1)
                        <li class="nav-item start ">
                            <a href="/ekle-proje" class="nav-link nav-toggle">
                                <i class="fa fa-paste"></i>
                                <span class="title">Projeler</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin')
                        <li class="nav-item start ">
                            <a href="/calisanlar" class="nav-link nav-toggle">
                                <i class="fa fa-group"></i>
                                <span class="title">Çalışanlar</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' || \Illuminate\Support\Facades\Auth::user()->yetkiler->musteri == 1)
                        <li class="nav-item start ">
                            <a href="/musteriler" class="nav-link nav-toggle">
                                <i class="fa fa-black-tie"></i>
                                <span class="title">Müşteriler</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->yetki == 'admin' || \Illuminate\Support\Facades\Auth::user()->yetki == 'superAdmin' )
                        <li class="nav-item start ">
                            <a href="/raporlar" class="nav-link nav-toggle">
                                <i class="fa fa-print"></i>
                                <span class="title">Raporlar</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- END SIDEBAR MENU -->
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="/">Anasayfaya Dön</a>
                            <i class="fa fa-circle"></i>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                                    data-toggle="dropdown"> Transfer Talepleri
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="/talepler/ekle-talep">
                                        <i class="fa fa-arrow-circle-down"></i> Talep Oluştur</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h1 class="page-title"> Şirket Yönetim Paneli</h1>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                @yield("content")
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
            2017 &copy; BeeCorp Yazılım -
            @if(isset(\Illuminate\Support\Facades\Auth::user()->firma->ad))
                {{ \Illuminate\Support\Facades\Auth::user()->firma->ad }}
            @else
                <label class="label label-info">{{ session()->get('firma_id') }}</label>
            @endif
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
</div>
<!--[if lt IE 9]>
<script src="/backend/assets/global/plugins/respond.min.js"></script>
<script src="/backend/assets/global/plugins/excanvas.min.js"></script>
<script src="/backend/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/backend/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/backend/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/backend/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/backend/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/backend/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/backend/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="/backend/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="/backend/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/backend/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $(document).ready(function () {
        $('#clickmewow').click(function () {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>
@yield("js")
</body>

</html>