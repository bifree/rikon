'use strict';

$(".openbtn").click(function () {//ボタンがクリックされたら
	$(this).toggleClass('active');//ボタン自身に activeクラスを付与し
  $(".sp-nav").toggleClass('panelactive');//ナビゲーションにpanelactiveクラスを付与
});

$(".sp-nav a").click(function () {//ナビゲーションのリンクがクリックされたら
    $(".openbtn").removeClass('active');//ボタンの activeクラスを除去し
    $(".sp-nav").removeClass('panelactive');//ナビゲーションのpanelactiveクラスも除去
});