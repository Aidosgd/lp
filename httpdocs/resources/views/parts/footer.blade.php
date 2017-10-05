<footer>
	
	<!-- RedHelper -->
<script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
	src="https://web.redhelper.ru/service/main.js?c=perspectivalombard">
</script> 
<!--/Redhelper -->
	
	<meta name="yandex-verification" content="b2f1ba88b877010c" />

	<script data-skip-moving="true">
        (function(w,d,u,b){
                s=d.createElement('script');r=(Date.now()/1000|0);s.async=1;s.src=u+'?'+r;
                h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.kz/b5152925/crm/site_button/loader_2_6zuteu.js');
</script>
	
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter46120422 = new Ya.Metrika({
                    id:46120422,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/46120422" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107318212-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-107318212-1');
</script>

	
    <div class="container">
        <div class="footer-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-xs-6">
                        <a href="/">
                            <img src="/images/logo.png" style="width: 90%;padding-top: 20px;" alt="">
                        </a>
                    </div>
                    <div class="col-md-5 hidden-xs">
                        <h4>Страницы</h4>
                        <ul>
                            <li><a href="/catalog/clocks">Каталог</a></li>
                            <li><a href="/pages/pledge">Залог</a></li>
                            <li><a href="/pages/purchase">Скупка</a></li>
                            <li><a href="/pages/valuation">Оценка</a></li>
                            <li><a href="/pages/about-lombard">О ломбарде</a></li>
                            <li><a href="/pages/sale-clocks">Продать часы</a></li>
                            <li><a href="/contacts">Контакты</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-6 soc">
                        <h4>Мы в соц. сетях</h4>
                        <a target="_blank" href="https://www.facebook.com/lombard.perspectiva "><i class="fa fa-facebook-square"></i></a>
                        <a target="_blank" href="https://www.instagram.com/almaty_perspectiva/"><i class="fa fa-instagram"></i></a>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <h4>Подписка на рассылку</h4>
                        <form action="/subscribers" method="post">
                            <input class="subs" name="email" type="email" placeholder="Ваш e-mail">
                            <br>
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>