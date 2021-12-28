<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {

    $name = htmlspecialchars($_POST['name'],ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
    $postcode = htmlspecialchars($_POST['postcode'],ENT_QUOTES);
    $prefectures = htmlspecialchars($_POST['prefectures'],ENT_QUOTES);
    $cityaddress = htmlspecialchars($_POST['cityaddress'],ENT_QUOTES);
    $building = htmlspecialchars($_POST['building'],ENT_QUOTES);
    $type = htmlspecialchars($_POST['type'],ENT_QUOTES);
    $document = htmlspecialchars($_POST['document'],ENT_QUOTES);

    if ($type == 'one') {
        $type = '離婚届・婚姻届 証人代行1名：●,●●●円（税込）';
    }
    if ($type == 'two') {
    $type = '離婚届・婚姻届 証人代行2名：●,●●●円（税込）';
    }
    if ($document == 'copy') {
        $document = 'ご本人確認書類をコピーして離婚届(婚姻届)と一緒に直接郵送で送る';
    }
    if ($document == 'image') {
    $document = 'ご本人確認書類を画像ファイルで送る';
    }


    $dir = "画像保存先の絶対パス--------------------------";
    $tempfile1 = $_FILES['fname1']['tmp_name'];
    $imagename1 = $_FILES['fname1']['name'];
    $filename1 = $dir.$imagename1;
    if (is_uploaded_file($tempfile1)) {
        if ( move_uploaded_file($tempfile1, $filename1 )) {
            echo $filename1 . "をアップロードしました。";
        } else {
            echo "ファイルをアップロードできません。";
        }
    } else {
        echo "ファイルが選択されていません。";
    }

    $tempfile2 = $_FILES['fname2']['tmp_name'];
    $imagename2 = $_FILES['fname2']['name'];
    $filename2 = $dir.$imagename2;
    if (is_uploaded_file($tempfile2)) {
      if ( move_uploaded_file($tempfile2, $filename2 )) {
          echo $filename2 . "をアップロードしました。";
      } else {
          echo "ファイルをアップロードできません。";
      }
  } else {
      echo "ファイルが選択されていません。";
  }

    $mail_header  = "From: " . $email . "\r\n";
    $mail_header .= "MIME-Version: 1.0\r\n";
    $mail_header .= "Content-Type: multipart/mixed; boundary=\"__PHPRECIPE__\"\r\n";
    $mail_header .= "\r\n";

    $mail = "--__PHPRECIPE__\r\n";
    $mail .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\r\n";
    $mail .= "\r\n";
    $mail .= "以下の内容が送信されました。\n\n";
    $mail .= "【お名前】\n";
    $mail .= $name."\n\n";
    $mail .= "【メールアドレス】\n";
    $mail .= $email."\n\n";
    $mail .= "【郵便番号】\n";
    $mail .= $postcode."\n\n";
    $mail .= "【都道府県】\n";
    $mail .= $prefectures."\n\n";
    $mail .= "【市区町村番地】\n";
    $mail .= $cityaddress."\n\n";
    $mail .= "【マンション名/ビル名】\n";
    $mail .= $building."\n\n";
    $mail .= "【お申し込みタイプ】\n";
    $mail .= $type."\n\n";
    $mail .= "【お申し込みタイプ】\n";
    $mail .= $document."\n\n";
    $mail .= "<img src=----------------------------------------/$imagename1>"."\n\n";
    $mail .= "<img src=----------------------------------------/$imagename2>"."\n\n";

    $mail .= "--__PHPRECIPE__\r\n";

    $mail_to = "$email, サイト側メールアドレス@xx.jp";
    $mail_subject = "メールフォームより送信されました";
    $mail_body = $mail;

    $mailsend = mb_send_mail($mail_to, $mail_subject, $mail_body, $mail_header);
    
    if ($mailsend == true) {
      // echo '<p>メールを送信しました。</p>';
      // echo '<form method="post" action="index.html">';
      // echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
      // echo '</form>';
      header('Location: -----------------------------/thanks.html');
    exit;
    } else {
      echo '<p>メール送信でエラーが発生しました。</p>';
      echo '<form method="post" action="index.html">';
      echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
      echo '</form>';
    }
  // }

}
