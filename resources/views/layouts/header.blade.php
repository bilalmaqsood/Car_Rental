<div class="nav_wrapper">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <img src="/images/white_logo.png" alt="" class="default_logo"/>
                <img src="/images/logo.png" alt="" class="hover_logo"/>
            </a>
        </div>
        <div id="navbar" class="customize_nav">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="settings.html">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cog_setting"></use>
                            </svg>
                            settings</a>
                    </li>
                    <li class="active" ><a href="payment.html">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                            </svg>
                            payment</a>
                    </li>
                    <li><a href="bookings.html">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon svg-icon-booking">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                            </svg>
                            bookings</a></li>
                    <li><a href="search.html">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search_icon"></use>
                            </svg>
                            search</a>
                    </li>
                    <li><a href="profile.html" >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                            </svg>
                            profile</a></li>
                    @else
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cog_setting"></use>
                        </svg>
                        about us
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                        </svg>
                        contact us
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:;" @click="loginSection = !loginSection">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                        </svg>
                        Login
                    </a>
                    <transition name="slide-fade">
                        <div class="login-section" v-show="loginSection">
                            <div class="button_box">
                                <button class="secodery_btn" @click="doLogin">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                    </svg>
                                    Login
                                </button>
                                <button class="primary_btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                                    </svg>
                                    Signup
                                </button>
                            </div>
                            <div class="login_form">
                                <form class="form-inline" id="frmLogin">
                                    <div class="form-group">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                        </svg>
                                        <input class="form-control" placeholder="email" name="email" type="email">
                                    </div>
                                    <div class="form-group">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                        </svg>
                                        <input class="form-control" placeholder="password" name="password" type="password">
                                    </div>
                                    <p><a href="#">forgot your password? click the <span>padlock</span> icon to recover</a></p>
                                </form>
                            </div>
                        </div>
                    </transition>
                </li>
            @endif
            </ul>
        </div>
    </nav>
</div>