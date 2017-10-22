<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
		@if (isset($slug))
			<div id="SOHUCS"></div> 
			<script type="text/javascript"> 
			(function(){ 
			var appid = '{{ \Canvas\Models\Settings::changyanAppid() }}'; 
			var conf = '{{ \Canvas\Models\Settings::changyanConf() }}'; 
			var width = window.innerWidth || document.documentElement.clientWidth; 
			if (width < 960) { 
			window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); } else { var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("https://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); } })(); </script>
		@endif
	</div>
</div>