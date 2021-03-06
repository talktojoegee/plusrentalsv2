        <footer class="footer-part">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-content">
                            <h3>Contact Us</h3>
                            <ul class="footer-address">
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {!! config('app.address') !!}
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    {!! config('app.email') !!}
                                </li>
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    {!! config('app.phone') !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-content">
                            <h3>Business</h3>
                            <ul class="footer-widget">
                                <li>
                                    <a href="{{route('terms')}}">Terms</a>
                                </li>
                                <li>
                                    <a href="{{route('policies')}}">Policy</a>
                                </li>
                                <li>
                                    <a href="{{route('tips')}}">Tips</a>
                                </li>
                                <li>
                                    <a href="{{route('faqs')}}">FAQs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-content">
                            <h3>Information</h3>
                            <ul class="footer-widget">
                                <li>
                                    <a href="#">About Us</a>
                                </li>
                                <li>
                                    <a href="#">Delivery System</a>
                                </li>
                                <li>
                                    <a href="#">Secure Payment</a>
                                </li>
                                <li>
                                    <a href="#">Contact Us</a>
                                </li>
                                <li>
                                    <a href="#">Sitemap</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-info">
                            <a href="#">
                                <img src="/images/logo.png" alt="logo">
                            </a>
                            <ul class="footer-count">
                                <li>
                                    <h5>929,238</h5>
                                    <p>Registered Users</p>
                                </li>
                                <li>
                                    <h5>242,789</h5>
                                    <p>Community Ads</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-card-content">
                            <div class="footer-app">
                                <a href="#">
                                    <img src="/images/play-store.png" alt="play-store">
                                </a>
                                <a href="#">
                                    <img src="/images/app-store.png" alt="app-store">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-end">
                <div class="container">
                    <div class="footer-end-content">
                        <p>All Copyrights Reserved &copy; {{date('Y')}} - Developed by
                            <a href="#">{{config('app.name')}}</a>
                        </p>
                        <ul class="social-transparent footer-social">
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
