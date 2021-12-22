<form action="submit.php" method="post"><!-- //送信ボタンが押されたら「」 -->
<input type="hidden" name="name" value="<?php echo $name; ?>">
<input type="hidden" name="fpost-code" value="<?php echo $fpostCode; ?>">
<input type="hidden" name="prefecture" value="<?php echo $prefecture; ?>">
<input type="hidden" name="city-addresse" value="<?php echo $cityAddresse; ?>">
<input type="hidden" name="building-name" value="<?php echo $buildingName; ?>">
>
<input type="hidden" name="email-address" value="<?php echo $emailAddress; ?>">
<input type="hidden" name="type" value="<?php echo $type; ?>">
<input type="hidden" name="agreement1" value="<?php echo $agreement1; ?>">
<input type="hidden" name="agreement2" value="<?php echo $agreement2; ?>">
<input type="hidden" name="agreement3" value="<?php echo $agreement3; ?>">
<input type="hidden" name="document" value="<?php echo $document; ?>">
<input type="hidden" name="up-image-btn1" value="<?php echo $upImageBtn1; ?>">
<input type="hidden" name="up-image-btn2" value="<?php echo $upImageBtn2; ?>">
<input type="hidden" name="remarks" value="<?php echo $remarks; ?>">
<input type="hidden" name="privacy" value="<?php echo $privacy; ?>">

<h2 class="contact-title">お問い合わせ 内容確認</h2>
<p>お問い合わせ内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
<div>
<label>お名前</label>
<p><?php echo $name; ?></p>
</div>
<div>
<label>ご住所</label>
<p><?php echo $postCode; ?></p>
<p><?php echo $prefecture; ?></p>
<p><?php echo $cityAdress; ?></p>
<p><?php echo $buildingName; ?></p>
</div>
<div>
<label>メールアドレス</label>
<p><?php echo $emailAddress; ?></p>
</div>
<div>
<label>電話番号</label>
<p><?php echo $tel; ?></p>
</div>
<div>
<label>お申し込みタイプ</label>
<p><?php echo $type; ?></p>
</div>
<div>
<label>離婚・婚姻の合意について</label>
<p><?php echo $agreement1; ?></p>
<p><?php echo $agreement2; ?></p>
<p><?php echo $agreement3; ?></p>
</div>
<div>
<label>ご本人確認書類について</label>
<p><?php echo $document; ?></p>
</div>
<div>
<label>【ご本人確認書類を画像ファイルで送る】にチェックをされた方はファイルを選択してください。</label>
<p><?php echo $pImageBtn1; ?></p>
<p><?php echo $pImageBtn2; ?></p>
</div>
<div>
<label>備考</label>
<p><?php echo $remarks; ?></p>
</div>
<div>
<label>プライバシーポリシ</label>
<p><?php echo $content; ?></p>
</div>
<input class="btn" type="button" value="内容を修正する" onclick="history.back(-1)">
<button class="btn" type="submit" name="submit">送 信</button>
</form>

<!-- //confirm.php（確認画面）の送信ボタンが押されたら以下を実行する -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// フォームから送信されたデータを各変数に格納
$name = $_POST["name"];
$postCode = $_POST["postCode"];
$prefeture = $_POST["prefecture"];
$cityAddresse = $_POST["cityAddresse"];
$cbuildingName = $_POST["cbuildingName"];
$emailAddress = $_POST["emailAddress"];
$type = $_POST["type"];
$agreement1 = $_POST["agreement1"];
$agreement2 = $_POST["agreement2"];
$agreement3 = $_POST["agreement3"];
$document = $_POST["document"];
$upImageBtn1 = $_POST["upImageBtn1"];
$upImageBtn2 = $_POST["upImageBtn2"];
$remarks = $_POST["remarks"];
$privacy= $_POST["privacy"];

if (isset($_POST["submit"])) { // 送信ボタンが押された時に動作する処理
mb_language("ja");// 日本語をメールで送る場合
mb_internal_encoding("UTF-8");
$subject = "［自動送信］お問い合わせ内容の確認";
$body = <<< EOM;// メール本文を変数bodyに格納
{$name}　様お問い合わせありがとうございます。
以下のお問い合わせ内容を、メールにて確認させていただきました。===================================================
【 お名前 】
{$name}
【ご住所】
{$postCode}
{$prefecture}
{$cityAdress}
{$buildingName}
【メールアドレス】
{$emailAddress}
【電話番号】
{$tel}
【お申し込みタイプ】
{$type}
<div>
【離婚・婚姻の合意について】
{$agreement1}
{$agreement2}
{$agreement3}
【ご本人確認書類について】
{$document}
【【ご本人確認書類を画像ファイルで送る】にチェックをされた方はファイルを選択してください。】
{$pImageBtn1}
{$pImageBtn2}
【備考】
{$remarks}
【プライバシーポリシ】
{$content}
===================================================
内容を確認のうえ、回答させて頂きます。
しばらくお待ちください。
EOM;

$fromEmail = "contact@dream-php-seminar.com"; // 送信元のメールアドレスを変数fromEmailに格納
$fromName = "お問い合わせテスト";// 送信元の名前を変数fromNameに格納
$header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";// ヘッダ情報を変数headerに格納する
mb_send_mail($email, $subject, $body, $header);// メール送信を行う//mb_send_mail("送信先メールアドレス", "件名", "メール本文","メール送信後の画面遷移");
header(Location: http://sample.com/.php");//送信完了画面（mailto.php）へのURLを入る
exit;
}
?>