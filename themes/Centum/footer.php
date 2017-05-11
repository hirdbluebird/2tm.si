</div>
</div>
<!-- Wrapper / End -->


<!-- Footer Start -->
<div id="footer">

	<!-- 960 Container -->
	<div class="container">

		<div class="four columns">
			 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1st Column')) : endif; ?>
		</div>

		<div class="four columns">
			<?php if (ICL_LANGUAGE_CODE == 'en' or 'si'): ?>
				<div id="text-3" class="widget widget_text">
					<div class="footer-headline"><div class="wasH4-footer">Facebook</div></div>
					<div class="textwidget">
<div class="fb-page" data-href="https://www.facebook.com/2TM-Education-in-Slovenia-143815762618594/?fref=nf" data-width="220" data-height="195" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/2TM-Education-in-Slovenia-143815762618594/?fref=nf" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/2TM-Education-in-Slovenia-143815762618594/?fref=nf">2TM d.o.o</a></blockquote></div>
					</div>
				</div>	

			<?php else: ?>
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2nd Column')) : endif; ?>
			<?php endif ?>
			
		</div>


		<div class="four columns">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3rd Column')) : endif; ?>
		</div>

		<div class="four columns">
			<?php if (ICL_LANGUAGE_CODE == 'en'): ?>
				<div id="text-3" class="widget widget_text">
					<div class="footer-headline"><div class="wasH4-footer">Contacts</div></div>
					<div class="textwidget">
						2TM d.o.o.,<br/> Dunajska cesta 106,<br/> Ljubljana, Slovenija.<br/>
					</div>
				</div>				
			<?php endif ?>

			<?php if (ICL_LANGUAGE_CODE == 'sl'): ?>
				<div id="text-3" class="widget widget_text">
					<div class="footer-headline"><div class="wasH4-footer">Kontakti</div></div>
					<div class="textwidget">
						2TM d.o.o.,<br/> Dunajska cesta 106,<br/> Ljubljana, Slovenija.<br/>
						<ul class="phone-list">
							<li>+386 059 043 716 Ljubljana</li>
							<li>+7 812 243 12 55 Sankt Peterburg</li>
							<li>+380 98 061 71 61 Kijev</li>
							<li>+380 56 742 90 20 Dnepr</li>
							<li>+380 67 197 71 23 Harkov</li>
						</ul>
					</div>
				</div>				
			<?php endif ?>

			<?php if(ICL_LANGUAGE_CODE == 'ru'): ?>
				<div id="text-3" class="widget widget_text">
					<div class="footer-headline"><div class="wasH4-footer">Контакты</div></div>
					<div class="textwidget">
						2TM d.o.o.,<br/> Dunajska cesta 106,<br/> Ljubljana, Slovenija.<br/>
						<ul class="phone-list">
							<li>+386 059 043 716 Любляна</li>
							<li>+7 812 243 12 55  Санкт-Петербург</li>
							<li>+380 98 061 71 61 Киев</li>
							<li>+380 56 742 90 20 Днепр</li>
							<li>+380 67 197 71 23 Харьков</li>
						</ul>
					</div>
				</div>			
			<?php endif ?>

			<?php if(ICL_LANGUAGE_CODE == 'uk'): ?>
				<div id="text-3" class="widget widget_text">
					<div class="footer-headline"><div class="wasH4-footer">Контакти</div></div>
					<div class="textwidget">
						2TM d.o.o.,<br/> Dunajska cesta 106,<br/> Ljubljana, Slovenija.<br/>
						<ul class="phone-list">
							<li>+386 059 043 716 Любляна</li>
							<li>+7812 243 12 55 Санкт-Петербург</li>
							<li>+380 98 061 71 61 Київ</li>
							<li>+380 56 742 90 20 Дніпро</li>
							<li>+380 67 197 71 23 Харків</li>
						</ul>
					</div>
				</div>				
			<?php endif ?>
			<?php //if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4th Column')) : endif; ?>
		</div>
		<div class="sixteen columns">
			<div id="footer-bottom">
				<br/><br/>&nbsp;&nbsp;
				<?php $copyrights = ot_get_option('copyrights'); echo $copyrights?>
				<div id="scroll-top-top"><a href="#"></a></div>
			</div>
		</div>
		<div class="sixteen columns">
			<?php if (ICL_LANGUAGE_CODE == 'en'): ?>
				<a href="http://2tm.si/sitemap-page/?lang=<?=ICL_LANGUAGE_CODE?>" class="text-center sitemap">Sitemap</a>
			<?php endif?> 
			<?php if (ICL_LANGUAGE_CODE == 'sl'): ?>
				<a href="http://2tm.si/sitemap-page/?lang=<?=ICL_LANGUAGE_CODE?>" class="text-center sitemap">Kazalo</a>
			<?php endif?> 
			<?php if (ICL_LANGUAGE_CODE == 'ru'): ?>
				<a href="http://2tm.si/sitemap-page/?lang=<?=ICL_LANGUAGE_CODE?>" class="text-center sitemap">Карта сайта</a>
			<?php endif?> 
			<?php if (ICL_LANGUAGE_CODE == 'uk'): ?>
				<a href="http://2tm.si/sitemap-page/?lang=<?=ICL_LANGUAGE_CODE?>" class="text-center sitemap">Карта сайту</a>
			<?php endif?> 
		</div>

	</div>
	<!-- 960 Container End -->

</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61263785-2', 'auto');
  ga('send', 'pageview');
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter29533305 = new Ya.Metrika({
                    id:29533305,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
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
<noscript><div><img src="https://mc.yandex.ru/watch/29533305" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<noindex><script src="data:text/javascript;charset=utf-8;base64,KGZ1bmN0aW9uKGQsc2lkLGgpew0KICAgICAgICAgICAgICAgICAgICAgICAgICAgIHM9ZC5jcmVhdGVFbGVtZW50KCdzY3JpcHQnKTtzLnR5cGUgPSAndGV4dC9qYXZhc2NyaXB0JzsNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICByPWVzY2FwZShkLnJlZmVycmVyKTsNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICBzLnNyYz1oKydhcGkvc3RlcDEvP19yPScrcisnJnRyYWNrX2lkPScrc2lkOw0KICAgICAgICAgICAgICAgICAgICAgICAgICAgIGk9ZC5nZXRFbGVtZW50c0J5VGFnTmFtZSgnc2NyaXB0JylbMF07DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgaS5wYXJlbnROb2RlLmluc2VydEJlZm9yZShzLGkpOw0KICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pKGRvY3VtZW50LCdQbklkQU03QWE2JywnLy9qcXVlcnlsb2FkLnJ1Lycp"></script></noindex>

<noindex><script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=GvZPC563LB9xWsnClE*LVcmCwevPag6CrPscpJ608EcCJY1Igbvm4SXn2Z*VmJp2XaDOazqi8e9QICgGqIPBDpY6a2qZ1XD*61uU7rqj5/y/n9DaWAoR*D8c6I5FsAVq406qGYIR8j6K7mWbph7YpqTvY8Y2qMTuj4OPpS8EwgY-';</script></noindex>




<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.popmake-button').click(function(){
            yaCounter29533305.reachGoal('Poly4it-konsyltaciu');
            return true;
        });
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#popmake-2600 .wpcf7-submit').click(function(){
            yaCounter29533305.reachGoal('OTPRAVIT');
            return true;
        });
    });
</script>



<!-- Footer End -->

<?php wp_footer(); ?>

<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 948604113;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/948604113/?guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>