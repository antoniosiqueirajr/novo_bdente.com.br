<!-- section start -->
<section data-anim-wrap class="layout-mt-headerBar h-md md:h-70vh">
    <div data-anim-child="img-right cover-white delay-2" class="bg-fill-image">
        <div data-parallax="0.7" class="h-full overlay-black-sm">
            <div data-parallax-target class="bg-image js-lazy" data-bg="/img/backgrounds/6.jpg"></div>
        </div>
    </div>
</section>
<!-- section end -->


<!-- section start -->
<section class="layout-pt-lg layout-pb-lg">
    <!-- container start -->
    <div class="container">
        <div class="clinicas" id="clinicas">
            <div class="conteudo">
                <div class="row">
                    <div class="col-sm-12 col-lg-4">
                        <h2>
                            <span class="escuro">NOSSAS</span>
                            <span class="azul">CLÍNICAS</span>
                        </h2>
                        <p>
                            Encontre a unidade mais próxima de você!
                        </p>
                        <div class="lista-estados">
                            <div class="owl-carousel owl-theme estados">
                                <?php $x = 0; foreach($estados as $uf=>$nome): $x++; ?>
                                <div class="item item-mapa-clinicas" data-estado="<?php echo strtolower($uf); ?>" data-index-mapa="<?php echo $x; ?>">
                                    <span class="titulo">
                                        <span class="estado"><?php echo $nome; ?></span>
                                        <div class="navegador">
                                            <a class="gotoprev" onclick="$('#clinicas .owl-prev').click();"><img src="/img/mapa/seta-dir.png" class="prev"></a>
                                            <a class="gotonext" onclick="$('#clinicas .owl-next').click();"><img src="/img/mapa/seta-dir.png" class="next"></a>
                                        </div>
                                    </span>
                                    <ul class="cidades">
                                        <?php foreach($unidades[$uf] ?? array() as $clinica): ?>
                                        <li><a href="<?php echo base_url($clinica->link) ?>"><?php output($clinica->nome); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <div id="mapa-clicavel">
                            <img src="/img/mapa/todos-sem-letras.png" id="mapa-tracos">
                            <img src="/img/mapa/bordas.png" alt="mapa" id="mapa-clinicas" usemap="#image-map">
                            <img src="/img/mapa/ac.png" alt="mapa" id="mapa-ac" class="mapa-estado">
                            <img src="/img/mapa/al.png" alt="mapa" id="mapa-al" class="mapa-estado">
                            <img src="/img/mapa/am.png" alt="mapa" id="mapa-am" class="mapa-estado">
                            <img src="/img/mapa/ap.png" alt="mapa" id="mapa-ap" class="mapa-estado">
                            <img src="/img/mapa/ba.png" alt="mapa" id="mapa-ba" class="mapa-estado">
                            <img src="/img/mapa/ce.png" alt="mapa" id="mapa-ce" class="mapa-estado">
                            <img src="/img/mapa/df.png" alt="mapa" id="mapa-df" class="mapa-estado">
                            <img src="/img/mapa/es.png" alt="mapa" id="mapa-es" class="mapa-estado">
                            <img src="/img/mapa/go.png" alt="mapa" id="mapa-go" class="mapa-estado">
                            <img src="/img/mapa/ma.png" alt="mapa" id="mapa-ma" class="mapa-estado">
                            <img src="/img/mapa/mg.png" alt="mapa" id="mapa-mg" class="mapa-estado">
                            <img src="/img/mapa/ms.png" alt="mapa" id="mapa-ms" class="mapa-estado">
                            <img src="/img/mapa/mt.png" alt="mapa" id="mapa-mt" class="mapa-estado">
                            <img src="/img/mapa/pa.png" alt="mapa" id="mapa-pa" class="mapa-estado">
                            <img src="/img/mapa/pb.png" alt="mapa" id="mapa-pb" class="mapa-estado">
                            <img src="/img/mapa/pe.png" alt="mapa" id="mapa-pe" class="mapa-estado">
                            <img src="/img/mapa/pi.png" alt="mapa" id="mapa-pi" class="mapa-estado">
                            <img src="/img/mapa/pr.png" alt="mapa" id="mapa-pr" class="mapa-estado">
                            <img src="/img/mapa/rj.png" alt="mapa" id="mapa-rj" class="mapa-estado">
                            <img src="/img/mapa/rn.png" alt="mapa" id="mapa-rn" class="mapa-estado">
                            <img src="/img/mapa/ro.png" alt="mapa" id="mapa-ro" class="mapa-estado">
                            <img src="/img/mapa/rr.png" alt="mapa" id="mapa-rr" class="mapa-estado">
                            <img src="/img/mapa/rs.png" alt="mapa" id="mapa-rs" class="mapa-estado">
                            <img src="/img/mapa/sc.png" alt="mapa" id="mapa-sc" class="mapa-estado">
                            <img src="/img/mapa/se.png" alt="mapa" id="mapa-se" class="mapa-estado">
                            <img src="/img/mapa/sp.png" alt="mapa" id="mapa-sp" class="mapa-estado">
                            <img src="/img/mapa/to.png" alt="mapa" id="mapa-to" class="mapa-estado">
                            <map name="image-map" id="image-map">
                                <area target="" alt="AM" title="AM" onclick="selecionar_clinica('AM');" coords="91,123,95,133,98,144,105,156,100,171,96,187,91,206,94,220,87,222,77,220,60,221,43,226,28,240,25,262,24,275,13,286,34,292,67,302,91,310,119,327,142,338,156,341,164,332,179,334,190,332,199,326,211,322,217,309,233,298,246,300,263,317,273,317,335,317,341,307,335,299,342,288,336,275,383,174,377,174,331,137,327,119,308,119,303,136,297,144,281,137,276,142,269,158,252,143,251,133,251,100,242,79,232,75,221,79,210,92,196,98,156,98,144,75,94,84,90,110" shape="poly">
                                <area target="" alt="RR" title="RR" onclick="selecionar_clinica('RR');" coords="267,148,257,142,259,131,253,116,254,92,249,84,251,74,224,63,205,27,256,27,303,0,316,29,327,91,329,114,306,113,297,136,281,130" shape="poly">
                                <area target="" alt="PA" title="PA" onclick="selecionar_clinica('PA');" coords="342,276,360,309,361,322,380,334,515,343,541,304,535,298,540,277,551,271,559,248,551,244,569,226,588,201,608,152,568,138,543,169,497,144,482,154,462,129,455,116,453,105,447,95,436,89,428,84,420,84,418,68,396,69,395,82,365,76,333,95,333,113,334,130,337,137,377,169,391,168" shape="poly">
                                <area target="" alt="AP" title="AP" onclick="selecionar_clinica('AP');" coords="423,71,426,79,442,88,452,92,458,103,459,114,482,145,528,91,494,24,485,30,463,68" shape="poly">
                                <area target="" alt="MA" title="MA" onclick="selecionar_clinica('MA');" coords="560,239,582,249,579,287,592,301,603,301,603,312,592,327,609,351,615,338,610,325,620,296,655,273,675,273,672,257,670,249,679,240,675,219,681,207,689,197,700,189,667,174,642,193,642,159,612,146,607,167,598,193,588,210,578,223" shape="poly">
                                <area target="" alt="PI" title="PI" onclick="selecionar_clinica('PI');" coords="712,191,704,188,695,201,688,203,680,218,682,238,676,249,681,265,677,276,657,276,625,298,614,324,619,339,616,354,631,368,652,361,661,350,658,336,664,332,676,334,686,339,702,328,728,305,727,291,732,278,721,256,718,241,713,229,716,217,712,203" shape="poly">
                                <area target="" alt="CE" title="CE" onclick="selecionar_clinica('CE');" coords="718,189,717,208,720,218,717,228,725,254,732,269,732,286,748,287,762,297,772,288,768,283,771,264,775,258,798,230,777,207,739,187" shape="poly">
                                <area target="" alt="AC" title="AC" onclick="selecionar_clinica('AC');" coords="11,287,5,293,26,327,24,333,39,337,43,349,56,348,78,334,76,369,84,373,92,369,119,373,158,350,120,330,81,308" shape="poly">
                                <area target="" alt="RO" title="RO" onclick="selecionar_clinica('RO');" coords="162,346,170,338,179,340,190,335,204,329,215,326,219,314,230,306,243,305,264,322,272,323,273,373,303,379,302,388,310,402,292,430,280,428,266,429,202,408,187,383,188,345" shape="poly">
                                <area target="" alt="MT" title="MT" onclick="selecionar_clinica('MT');" coords="276,371,306,376,308,388,316,403,296,432,297,466,304,495,343,493,342,515,362,530,374,519,390,515,414,525,423,519,432,523,442,514,440,531,454,530,451,516,473,486,483,480,487,465,497,460,509,425,507,384,515,346,380,338,358,323,348,292,341,321,277,321" shape="poly">
                                <area target="" alt="TO" title="TO" onclick="selecionar_clinica('TO');" coords="557,242,577,249,578,281,573,287,588,303,600,305,598,310,589,326,608,356,599,380,607,385,604,392,607,399,607,409,581,422,575,418,574,428,566,418,556,421,546,407,539,419,512,416,510,384,518,342,546,305,541,296,543,277,553,272,563,247" shape="poly">
                                <area target="" alt="BA" title="BA" onclick="selecionar_clinica('BA');" coords="604,376,610,387,608,395,613,403,608,414,611,424,607,438,614,450,614,466,646,445,660,446,660,456,667,458,675,454,699,468,704,464,714,477,718,483,725,477,747,490,738,508,731,511,733,518,751,540,762,527,767,485,764,432,798,390,780,370,788,364,788,353,780,328,755,316,733,338,715,320,687,341,668,334,661,337,665,351,656,363,635,371,616,358,608,366" shape="poly">
                                <area target="" alt="GO" title="GO" onclick="selecionar_clinica('GO');" coords="455,516,460,540,466,545,501,563,516,547,535,540,539,547,548,536,572,541,581,533,582,524,576,518,586,507,579,498,583,491,560,488,561,471,583,474,583,483,590,483,587,466,598,455,612,460,611,450,604,436,609,423,603,413,579,424,577,432,565,422,555,422,547,413,541,424,514,419,501,461,492,467,488,479,476,487" shape="poly">
                                <area target="" alt="DF" title="DF" onclick="selecionar_clinica('DF');" coords="563,486,563,474,581,476,582,488" shape="poly">
                                <area target="" alt="MG" title="MG" onclick="selecionar_clinica('MG');" coords="611,470,608,463,600,457,592,467,593,483,585,485,586,492,583,498,590,506,581,516,585,525,584,534,573,543,550,541,542,548,534,543,518,549,504,565,504,577,515,574,526,579,534,575,547,588,550,582,565,583,579,579,587,595,594,607,600,611,597,620,607,643,690,620,702,594,702,584,712,582,721,562,721,549,718,539,722,531,737,528,730,520,727,508,733,502,744,491,726,482,719,485,706,468,700,471,675,457,669,464,669,464,658,457,657,449,647,449" shape="poly">
                                <area target="" alt="ES" title="ES" onclick="selecionar_clinica('ES');" coords="749,543,736,531,726,533,721,539,724,548,725,561,714,582,705,586,704,597,710,603,721,604,749,565" shape="poly">
                                <area target="" alt="RJ" title="RJ" onclick="selecionar_clinica('RJ');" coords="643,637,649,641,646,648,700,648,701,638,722,625,723,607,709,605,703,598,692,621,657,631" shape="poly">
                                <area target="" alt="MS" title="MS" onclick="selecionar_clinica('MS');" coords="358,531,345,575,346,589,350,627,400,635,407,670,433,670,435,659,442,652,444,643,455,637,477,620,487,593,502,578,500,566,465,546,458,540,454,532,438,534,439,522,433,527,424,521,415,526,392,517,379,521,366,530" shape="poly">
                                <area target="" alt="SP" title="SP" onclick="selecionar_clinica('SP');" coords="456,639,475,637,489,640,509,645,522,645,528,651,534,668,542,678,543,684,553,685,564,699,607,666,623,666,641,647,645,639,640,636,606,646,595,623,595,613,577,583,568,584,552,585,551,591,535,578,528,581,517,576,504,579,488,595,479,622" shape="poly">
                                <area target="" alt="PR" title="PR" onclick="selecionar_clinica('PR');" coords="424,704,435,705,444,722,451,721,458,725,464,724,470,725,484,729,491,730,497,720,507,724,513,717,527,717,533,723,544,716,551,718,563,701,553,687,542,686,540,680,533,670,527,652,522,647,508,647,479,639,460,642,448,643,446,652,438,658,437,669,427,673,424,685" shape="poly">
                                <area target="" alt="SC" title="SC" onclick="selecionar_clinica('SC');" coords="444,723,442,742,451,743,474,746,481,745,486,752,495,754,510,769,530,773,525,784,530,790,555,769,552,720,545,718,534,725,527,719,514,718,509,724,499,721,494,731,468,725,459,727,452,722" shape="poly">
                                <area target="" alt="RS" title="RS" onclick="selecionar_clinica('RS');" coords="440,744,422,750,417,758,404,765,366,801,359,811,365,815,377,810,393,825,393,832,403,827,410,835,443,864,457,871,445,880,447,893,466,884,480,857,477,849,488,839,503,841,532,794,523,785,527,774,511,772,495,756,487,754,479,748" shape="poly">
                                <area target="" alt="RN" title="RN" onclick="selecionar_clinica('RN');" coords="799,234,807,232,816,241,837,236,853,267,841,268,831,268,823,263,818,266,815,278,811,273,803,275,798,270,801,262,795,258,783,270,775,264" shape="poly">
                                <area target="" alt="PB" title="PB" onclick="selecionar_clinica('PB');" coords="853,273,855,293,847,289,839,294,820,298,809,311,801,303,808,292,801,287,785,300,772,296,776,287,771,282,775,267,782,273,795,261,799,266,797,273,802,277,810,275,817,279,820,272,824,266,831,270" shape="poly">
                                <area target="" alt="PE" title="PE" onclick="selecionar_clinica('PE');" coords="718,317,733,334,752,313,781,325,785,331,791,321,807,334,817,331,826,323,848,324,855,302,847,292,841,295,822,299,811,313,798,303,806,293,801,289,788,300,773,297,768,296,764,302,750,290,730,289,732,306" shape="poly">
                                <area target="" alt="AL" title="AL" onclick="selecionar_clinica('AL');" coords="846,327,827,324,818,333,808,337,792,325,786,335,790,341,798,342,821,360" shape="poly">
                                <area target="" alt="SE" title="SE" onclick="selecionar_clinica('SE');" coords="800,390,819,364,799,344,792,344,786,340,791,351,790,365,783,370" shape="poly">
                            </map>
                        </div>
                    </div>
                </div>
                <div class="large reveal" id="modal-clinicas" data-reveal>
                    <h3 id="modal-clinicas-cidade"></h3>
                    <div class="row" id="modal-clinicas-unidades">

                    </div>
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>>
<section class="layout-pt-lg layout-pb-lg">
    <!-- container start -->
    <div class="container">

        <!-- row start -->
        <div class="row justify-content-center text-center">
            <div class="col-lg-7">
                <div class="sectionHeading -lg">
                    <p class="sectionHeading__subtitle">
                        Partners
                    </p>
                    <h2 class="sectionHeading__title">
                        Our Clients
                    </h2>
                </div>
            </div>
        </div>
        <!-- row end -->

        <!-- row start -->
        <div class="row x-gap-32 y-gap-32 layout-pt-md">

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/1.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/2.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/3.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/4.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/5.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/6.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/7.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-1:1 border-dark rounded-4">
                    <div class="clientsItem__img">
                        <img class="col-9" src="/img/clients/dark/8.png" alt="Client">
                    </div>

                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-2xl text-white">
                            Acme Inc.
                        </h5>
                    </div>
                </div>
            </div>

        </div>
        <!-- row end -->

    </div>
    <!-- container end -->
</section>
<!-- section end -->


<!-- section start -->
<section data-parallax="0.7" class="layout-pt-lg layout-pb-lg">
    <div data-parallax-target class="overlay-black-md bg-image js-lazy" data-bg="/img/backgrounds/2.jpg"></div>

    <!-- container start -->
    <div class="container z-5">
        <!-- row start -->
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <p class="text-sm uppercase tracking-lg text-white mb-20">
                    Contact us
                </p>

                <h2 class="text-5xl sm:text-5xl xs:text-4xl leading-sm fw-700 text-white">
                    Have a project of your own?
                </h2>

                <p class="text-xl md:text-lg text-white mt-16">
                    Small or big, we've got you covered!
                </p>

                <a href="#" class="button -md -white text-black mt-32">
                    Get in Touch
                </a>
            </div>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
<!-- section end -->