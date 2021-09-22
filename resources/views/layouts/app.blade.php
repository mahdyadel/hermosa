<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="description" content="Latest updates and statistic charts"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', __('messages.home') )</title>

  <!--begin::Web font -->
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
      active: function() {
          sessionStorage.fonts = true;
      }
    });
  </script>
  <!--end::Web font -->

  <!--begin::Base Styles -->
  @if(app()->isLocale('en'))
  <link href="/assets/css/vendors.bundle.css" rel="stylesheet" type="text/css" />
  <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  @else
  <link href="/assets/css/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
  <link href="/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
  <link href="/css/font-ar.css" rel="stylesheet" type="text/css" />
  @endif
  <!--end::Base Styles -->

  <!--begin Styles -->
  <link href="/css/style.css" rel="stylesheet" type="text/css" />
  <!--end::Styles -->
  
  <link rel="shortcut icon" href="/images/icon.png" /> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<!-- end::Head -->
 
<!-- begin::Body -->
<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
   
  <!-- begin:: Page -->
  <div class="m-grid m-grid--hor m-grid--root m-page">
      
  <!-- BEGIN: Header -->
  <header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200">
      <div class="m-container m-container--fluid m-container--full-height">
          <div class="m-stack m-stack--ver m-stack--desktop">
              <!-- BEGIN: Brand -->
              <div class="m-stack__item m-brand  m-brand--skin-dark ">
                  <div class="m-stack m-stack--ver m-stack--general">
                      <div class="m-stack__item m-stack__item--middle m-brand__logo">
                          <a href="/home" class="m-brand__logo-wrapper">
                              <img alt="Hermosa" src="/images/logo.png" style="width:100%; height:100%;"/>
                          </a>  
                      </div>
                      <div class="m-stack__item m-stack__item--middle m-brand__tools">

                          <!-- BEGIN: Left Aside Minimize Toggle -->
                          <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                              <span></span>
                          </a>
                          <!-- END -->

                          <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                          <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                              <span></span>
                          </a>
                          <!-- END -->

                          <!-- BEGIN: Topbar Toggler -->
                          <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                              <i class="flaticon-more"></i>
                          </a>
                          <!-- BEGIN: Topbar Toggler -->
                      </div>
                  </div>
              </div>
              <!-- END: Brand -->
              <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                  <!-- BEGIN: Topbar -->
                  <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">


                      <div class="m-stack__item m-topbar__nav-wrapper">
                        <div class="switch-language">
                            <form class="" action="{{url('/locale')}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @if(app()->isLocale('ar'))
                                <input type="hidden" name="locale" value="en">
                                <button type="submit">
                                    <img src="/images/united-kingdom.svg" width="40px" height="40px" style="border-radius: 50%;" />
                                </button>
                                @else
                                <input type="hidden" name="locale" value="ar">
                                <button type="submit">
                                    <img src="/images/saudi-arabia.svg" width="40px" height="40px" style="border-radius: 50%;" />
                                </button>
                                @endif
                                
                            </form>
                        </div>
                          
                          <ul class="m-topbar__nav m-nav m-nav--inline">
                              <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                  <a href="#" class="m-nav__link m-dropdown__toggle">
                                      <span class="m-topbar__userpic">
                                          <img src="/images/user.png" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                      </span>
                                      <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                                          <span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
                                      </span>
                                      <span class="m-topbar__username m--hide">Nick</span>                    
                                  </a>
                                  <div class="m-dropdown__wrapper">
                                      <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                      <div class="m-dropdown__inner">
                                          <div class="m-dropdown__header m--align-center">
                                              <div class="m-card-user m-card-user--skin-light">
                                                  <div class="m-card-user__pic">
                                                      <img src="/images/user.png" class="m--img-rounded m--marginless" alt=""/>
                                                  </div>
                                                  <div class="m-card-user__details">
                                                      <span class="m-card-user__name m--font-weight-500">{{ auth()->user()->name }}</span>
                                                      <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ auth()->user()->email }}</a>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="m-dropdown__body">
                                              <div class="m-dropdown__content">
                                                  <ul class="m-nav m-nav--skin-light">
                                                      <li class="m-nav__item">
                                                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">{{ __('messages.logout') }}</a>
                                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                              {{ csrf_field() }}
                                                          </form>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>

                  </div>
                  <!-- END: Topbar -->
              </div>
          </div>
      </div>
  </header>
  <!-- END: Header -->        

  <!-- begin::Body -->
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">  

      <!-- BEGIN: Left Aside -->
      <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
      <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">    
          <!-- BEGIN: Aside Menu -->
          <div id="m_ver_menu" 
              class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
              m-menu-vertical="1"
              m-menu-scrollable="0" m-menu-dropdown-timeout="500"  
              >       
              <ul class="m-menu__nav ">

                  <li class="m-menu__section m-menu__section--first">
                      <i class="m-menu__section-icon flaticon-more-v2"></i>
                      <h4 class="m-menu__section-text">{{ __('messages.menu.sections') }}</h4>
                  </li>


                  @if(auth()->user()->can('READ_SALONS'))
                    @if(auth()->user()->type === "ADMIN")
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/salons/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/salons" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-home"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.salons') }}</span>
                        </a>
                    </li>
                    @else
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/salons/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/salons/{{ auth()->user()->salon_id }}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-home"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.salon') }}</span>
                        </a>
                    </li>
                    @endif
                  @endif

                  @if(auth()->user()->can('READ_PROMOCODES'))
                  <li class="m-menu__item  m-menu__item{{ preg_match("/^\/promocodes/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                      <a  href="/promocodes" class="m-menu__link ">
                          <i class="m-menu__link-icon flaticon-gift"></i>
                          <span class="m-menu__link-text">{{ __('messages.menu.promocodes') }}</span>
                      </a>
                  </li>
                  @endif

                  @if(auth()->user()->can('READ_ADMINS'))
                        @if(auth()->user()->type === "ADMIN")
                        <li class="m-menu__item  m-menu__item{{ preg_match("/^\/admins/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                            <a  href="/admins" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-user-settings"></i>
                                <span class="m-menu__link-text">{{ __('messages.menu.admins') }}</span>
                            </a>
                        </li>
                        @else
                        <li class="m-menu__item  m-menu__item{{ preg_match("/^\/admins/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                            <a  href="/admins?salonId={{ auth()->user()->salon_id }}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-user-settings"></i>
                                <span class="m-menu__link-text">{{ __('messages.menu.admins') }}</span>
                            </a>
                        </li>
                        @endif
                  @endif


                  @if(auth()->user()->type === "ADMIN")

                    @if(auth()->user()->can('READ_SERVICES'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/services/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/services" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-cart"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.services') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_PACKAGES'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/packages/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/packages" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-coins"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.packages') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_USERS'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/users/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/users" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-users"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.users') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_COUNTRIES'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/countries/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/countries" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-location"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.countries') }}</span>
                        </a>
                    </li>
                    @endif
                  @endif

                @if(in_array(auth()->user()->type, ["SALON_ADMIN", "SALON_OWNER"]))
                    @if(auth()->user()->can('READ_SALON_SERVICES'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/services/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/salons/{{ auth()->user()->salon_id }}/services" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-cart"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.services') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_RESERVATIONS'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/reservations/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/salons/{{ auth()->user()->salon_id }}/reservations" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-list-1"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.reservations') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_OFFERS'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/offers/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/salons/{{ auth()->user()->salon_id }}/offers" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-coins"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.offers') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_EMPLOYEES'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/employees/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/salons/{{ auth()->user()->salon_id }}/employees" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-users"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.employees') }}</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_SALON_RATES'))
                    <li class="m-menu__item  m-menu__item{{ preg_match("/^\/rates/",$_SERVER['REQUEST_URI']) ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/salons/{{ auth()->user()->salon_id }}/rates" class="m-menu__link ">
                            <i class="m-menu__link-icon la la-star-half-full"></i>
                            <span class="m-menu__link-text">{{ __('messages.menu.salonRates') }}</span>
                        </a>
                    </li>
                    @endif
                @endif

              </ul>
          </div>
          <!-- END: Aside Menu -->
      </div>
      <!-- END: Left Aside --> 

      <div class="m-grid__item m-grid__item--fluid m-wrapper">
                          
          <!-- BEGIN: Subheader -->
          <div class="m-subheader ">
              <div class="d-flex align-items-center">
                  <div class="mr-auto">
                      <h3 class="m-subheader__title ">@yield('title')</h3>          
                  </div>
                  
                  <div>
                      
                  </div>
              </div>
          </div>
          <!-- END: Subheader --> 
                      
          <div class="m-content">
          @yield('content')
          </div>

      </div>
              

  </div>
  <!-- end:: Body -->

  <!-- begin::Footer -->
  <footer class="m-grid__item m-footer ">
      <div class="m-container m-container--fluid m-container--full-height m-page__container">
          <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
              <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                  <span class="m-footer__copyright">
                      <?php echo date("Y"); ?> &copy <a href="#" class="m-link">{{ config('app.name') }}</a>
                  </span>
              </div>  
              <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                  
              </div>
          </div>
      </div>
  </footer>
  <!-- end::Footer -->        
</div>
<!-- end:: Page -->

        
<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
  <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<!--begin::Base Scripts -->        
<script src="/assets/js/vendors.bundle.js" type="text/javascript"></script>
<script src="/assets/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->   
        
<!--begin::Page Snippets --> 
<script src="/assets/js/dashboard.js" type="text/javascript"></script>
<!--end::Page Snippets -->   

<script src="/assets/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

@yield('scripts')
                
</body>
<!-- end::Body -->
</html>