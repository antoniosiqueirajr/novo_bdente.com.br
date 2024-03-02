        </main>

        <!-- Footer -->
        <footer class="footer pt-lg-5 pt-4 pb-5">
            <div class="container pt-3 mt-md-2 mt-lg-3">
                <div class="row gy-md-5 gy-4 mb-md-5 mb-4 pb-lg-2">
                    <div class="col-lg-3">
                        <a class="navbar-brand d-inline-flex align-items-center mb-lg-4 mb-3" href="index-2.html">
                            <img width="40%" src="/custom/img/logo.png" alt="Bdente">
                        </a>
                        <p class="mb-4 pb-lg-1 fs-xs text-body-secondary" style="max-width: 306px;">Realizando sonhos implantando sorrisos!</p>
                        <div class="d-flex mt-n3 ms-n3">
                            <a class="btn btn-secondary btn-icon btn-sm btn-facebook rounded-circle mt-3 ms-3" href="#" aria-label="Facebook">
                                <i class="ai-facebook"></i>
                            </a>
                            <a class="btn btn-secondary btn-icon btn-sm btn-instagram rounded-circle mt-3 ms-3" href="#" aria-label="Instagram">
                                <i class="ai-instagram"></i>
                            </a>
                            <a class="btn btn-secondary btn-icon btn-sm btn-linkedin rounded-circle mt-3 ms-3" href="#" aria-label="LinkedIn">
                                <i class="ai-linkedin"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 offset-xl-1 col-lg-9">
                        <div class="row row-cols-sm-4 row-cols-1">
                            <div class="col">
                                <ul class="nav flex-column mb-0">
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Tratamentos</a></li>
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Serviços</a></li>
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Nossos clientes</a></li>

                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Caso de sucesso</a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="nav flex-column mb-0">
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Fale conosco</a></li>
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">SAC</a></li>
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Politica Privacidade</a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="nav flex-column mb-0">
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Sobre</a></li>
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Faça parte</a></li>
                                    <li class="nav-item mb-2"><a class="nav-link p-0" href="#">Na midia &amp;</a></li>

                                </ul>
                            </div>
                            <div class="col">
                                <ul class="nav flex-column mb-0">
                                    <li class="nav-item mb-2">
                                        <a class="nav-link p-0" href="mailto:08000030313">
                                            0800 0030 313</a>
                                    </li>

                                    <li class="nav-item mb-2">
                                        <a class="text-primary fw-semibold p-0" href="#">atendimento@bdente.com.br</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav fs-sm text-body-secondary">&copy; All rights reserved.
                    <a href="https://sjrcapital.com.br/" title="Siqueira Jr" style="display: iblock; margin: 0 0 0 5px; top: 10px; position:relative;">SJR Capital</a>
                </div>

            </div>
        </footer>


        <!-- Back to top button -->
        <a class="btn-scroll-top" href="#top" data-scroll aria-label="Scroll back to top">
            <svg viewBox="0 0 40 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="19" fill="none" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></circle>
            </svg>
            <i class="ai-arrow-up"></i>
        </a>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://wa.me/5541985118650?text=Ol%C3%A1,%20estou%20no%20site%20da%20Bdente%20e%20preciso%20de%20ajuda..." target="_blank">
            <div class="btn-whatsapp pulsaDelay"><i class="fa fa-whatsapp"></i></div>
        </a>


        <!-- Vendor scripts: JS libraries and plugins -->
        <script src="/theme/assets/vendor/parallax-js/dist/parallax.min.js"></script>
        <script src="/theme/assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="/theme/assets/vendor/aos/dist/aos.js"></script>

        <!-- Bootstrap + Theme scripts -->
        <script src="/theme/assets/js/theme.min.js"></script>

        <!-- Customizer -->
        <script src="/theme/assets/js/customizer.min.js"></script>
        <script>
            (function(d, t) {
                var BASE_URL = "https://crm.bdente.com.br";
                var g = d.createElement(t),
                    s = d.getElementsByTagName(t)[0];
                g.src = BASE_URL + "/packs/js/sdk.js";
                g.defer = true;
                g.async = true;
                s.parentNode.insertBefore(g, s);
                g.onload = function() {
                    window.chatwootSDK.run({
                        websiteToken: 'uFEdUzk3hm74VcNf8dqaFNQ4',
                        baseUrl: BASE_URL
                    })
                }
            })(document, "script");
        </script> 
    </body>
</html>