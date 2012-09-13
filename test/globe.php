

<!DOCTYPE HTML>
<html lang="en">
  <head><script type='text/javascript'>window.mod_pagespeed_start = Number(new Date());</script>
    <title>WebGL Globe</title>
    <meta charset="utf-8">
    <style type="text/css">html{height:100%}body{margin:0;padding:0;color:#fff;font-family:sans-serif;font-size:13px;line-height:20px;height:100%}#info{font-size:11px;position:absolute;bottom:5px;background-color:rgba(0,0,0,0.8);border-radius:3px;right:10px;padding:10px}#container{position:absolute;background:#e0e0e0;top:0px;left:0px;width:100%;height:100%;overflow:hidden}#currentInfo{width:270px;position:absolute;left:20px;top:63px;background-color:rgba(0,0,0,0.2);border-top:1px solid rgba(255,255,255,0.4);padding:10px}a{color:#aaa;text-decoration:none}a:hover{text-decoration:underline}.bull{padding:0 5px;color:#555}#title{position:absolute;top:20px;width:270px;left:20px;background-color:rgba(0,0,0,0.2);border-radius:3px;font:20px Georgia;padding:10px}.year{font:16px Georgia;line-height:26px;height:30px;text-align:center;float:left;width:90px;color:rgba(255,255,255,0.4);cursor:pointer;-webkit-transition:all 0.1s ease-out}.year:hover,.year.active{font-size:23px;color:#fff}#ce span{display:none}#ce{width:107px;height:55px;display:block;position:absolute;bottom:15px;left:20px;background:url(http://www.html5rocks.com/en/tutorials/webgl/globe/ce.png)}#currentInfo,#info,#title,#ce{display:none}</style>
  </head>
  <body><noscript><meta HTTP-EQUIV="refresh" content="0;url=http://www.html5rocks.com/en/tutorials/webgl/globe/white_globe.html?ModPagespeed=off"><style><!--table,div,span,font,p{display:none} --></style><div style="display:block">Please click <a href="http://www.html5rocks.com/en/tutorials/webgl/globe/white_globe.html?ModPagespeed=off">here</a> if you are not redirected within a few seconds.</div></noscript>

  <div id="container"></div>

  <div id="info">
    <strong><a href="http://www.chromeexperiments.com/globe">WebGL Globe</a></strong> <span class="bull">&bull;</span> Created by the Google Data Arts Team <span class="bull">&bull;</span> Data acquired from <a href="http://sedac.ciesin.columbia.edu/gpw/">SEDAC</a>
  </div>

  <div id="currentInfo">
    <span id="year1990" class="year">1990</span>
    <span id="year1995" class="year">1995</span>
    <span id="year2000" class="year">2000</span>
  </div>

  <div id="title">
    World Population
  </div>

  <a id="ce" href="http://www.chromeexperiments.com/globe">
    <span>This is a Chrome Experiment</span>
  </a>

  <script src="http://1-ps.googleusercontent.com/x/s.html5rocks-hrd.appspot.com/www.html5rocks.com/en/tutorials/webgl/globe/third-party,_Three,_ThreeWebGL.js,Mjm.-4tk8_fTMi.js+third-party,_Three,_ThreeExtras.js,Mjm.Awo8Dx7q3N.js+third-party,_Three,_RequestAnimationFrame.js,Mjm.DDMsZLiYit.js+third-party,_Three,_Detector.js,Mjm.rvXuMYRuNN.js+third-party,_Tween.js,Mjm.CssaERlKb6.js+coast.js,Mjm.i6J1_gxn9i.js+country.js,Mjm.tr5k0b2E_f.js+world.js,Mjm.xJcEN_6N1M.js+white_globe.js,Mjm.6PR74Or_d5.js.pagespeed.jc.pGI9xrrgUQ.js"></script><script>eval(mod_pagespeed_PveUoPBePG);</script>
  <script>eval(mod_pagespeed_wfqK1rB4te);</script>
  <script>eval(mod_pagespeed_DcTGJT$4SC);</script>
  <script>eval(mod_pagespeed_Q0WlGWFMLf);</script>
  <script>eval(mod_pagespeed_cWSDz45qow);</script>
  <script>eval(mod_pagespeed_aQ0A7uyY6F);</script>
  <script>eval(mod_pagespeed_XallefMNv6);</script>
  <script>eval(mod_pagespeed_09laYbSk2$);</script>
  <script>eval(mod_pagespeed_lIEkO1jIc2);</script>
  <script type="text/javascript">if(!Detector.webgl){Detector.addGetWebGLMessage();}else{var years=['1990','1995','2000'];var container=document.getElementById('container');var globe=new DAT.Globe(container);console.log(globe);var i,tweens=[];var settime=function(globe,t){return function(){return;new TWEEN.Tween(globe).to({time:t/years.length},500).easing(TWEEN.Easing.Cubic.EaseOut).start();var y=document.getElementById('year'+years[t]);if(y.getAttribute('class')==='year active'){return;}
var yy=document.getElementsByClassName('year');for(i=0;i<yy.length;i++){yy[i].setAttribute('class','year');}
y.setAttribute('class','year active');};};for(var i=0;i<years.length;i++){var y=document.getElementById('year'+years[i]);y.addEventListener('mouseover',settime(globe,i),false);}
TWEEN.start();globe.animate();}</script>

  <script type='text/javascript'>(function(){function g(){var ifr=0;if(window.parent != window){ifr=1}new Image().src='http://ps.googleusercontent.com/beacon?org=47_3_jt&ets=load:'+(Number(new Date())-window.mod_pagespeed_start)+'&ifr='+ifr+'&url='+encodeURIComponent('http://www.html5rocks.com/en/tutorials/webgl/globe/white_globe.html');window.mod_pagespeed_loaded=true;};var f=window.addEventListener;if(f){f('load',g,false);}else{f=window.attachEvent;if(f){f('onload',g);}}})();</script></body>

</html>
