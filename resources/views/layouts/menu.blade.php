 <!-- BEGIN: Main Menu-->
 <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{asset('/')}}html/ltr/vertical-menu-template-semi-dark/index.html">
                    <div class="brand-logo"><img class="logo" src="{{asset('/')}}app-assets/images/logo/logo.png" /></div>
                    <h2 class="brand-text mb-0">ABC</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" nav-item"><a href="{{asset('/')}}html/ltr/vertical-menu-template-semi-dark/index.html"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge-light-danger badge-pill badge-round float-right mr-2">2</span></a>
                <ul class="menu-content">
                    <li class="active"><a href="dashboard-ecommerce.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Business</span></a>
                    </li>
                    <li><a href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>Applications</span>
            </li>
            <li class=" nav-item"><a href="{{url('/deposits')}}"><i class="menu-livicon" data-icon="bank"></i><span class="menu-title" data-i18n="Email">Deposits</span></a>
                <li class=" nav-item"><a href="{{url('/withdrawals')}}"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Email">Withdrawal </span></a>
            

            <li class=" nav-item"><a href="{{url('/show-savings')}}"><i class="menu-livicon" data-icon="settings"></i><span class="menu-title" data-i18n="Invoice">Settings</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/customers')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Customers</span></a></li>
                    <li><a href="{{url('/accounts')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Account Setup</span></a></li>
                </ul>
            </li>
            
            
        </ul>
    </div>
</div>
<!-- END: Main Menu-->