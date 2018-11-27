<!DOCTYPE html>

<?php 
if(!$_POST){
header('Location: /');
}
session_start();
if(isset($_POST['name'],$_POST['email'],$_POST['comment'])){
$_SESSION['name'] = $_POST['name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['comment'] = $_POST['comment'];
}
?>
<html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <!-- /*<body>内に記述*/ -->
<?php
$action = $_POST['action'];
$name = htmlspecialchars($_SESSION['name']);
$email = htmlspecialchars($_SESSION['email']);
$comment = htmlspecialchars($_SESSION['comment']);
$to = 'shusei0131@gmail.com';
$subject = 'form-mail-sample-2';
$message = '[お名前]'."\n".$name."\n";
$message .= '[email]'."\n".$email."\n";
$message .= '[コメント]'."\n".$comment."\n\n\n";
$header = 'From: '.$email."\r\n";
$header .= 'Reply-To: '.$email."\r\n";
if($action == "post"){
echo '<div class="tb-cell mail-form">';
echo '<form id="form" action="mail.php" method="post">';
echo '<div class="row">';
echo '<div class="cell">';
echo '<label>name</label>';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo $_SESSION['name'];
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '<div class="row">';
echo '<div class="cell">';
echo '<label>email</label>';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo $_SESSION['email'];
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '<div class="row">';
echo '<div class="cell">';
echo '<label>comment</label>';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo $_SESSION['comment'];
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '<div class="row">';
echo '<div class="cell">';
echo '&nbsp;';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo '<p>入力内容が正しければ送信してください</p><br>';
echo '<button type="submit" id="sbtn" name="action" value="send">送　信</button>';
echo '<button type="button" onclick="history.go(-1)">入力フォームに戻る</button>';
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '</form>';
echo '<!--tb-cell--></div>';
}elseif($action == "send"){
$status = mb_send_mail($to, $subject, $message, $header);
if ($status) {
echo '<p class="msg">メッセージは正常に送信されました</p>';
echo '<button type="button" onclick="history.go(-2)">入力フォームに戻る</button>';
} else {
echo '<p class="msg">メッセージの送信に失敗しました</p>';
echo '<button type="button" onclick="history.go(-2)">入力フォームに戻る</button>';
}
$_SESSION = array();
session_destroy();
}
?>

  </body>
</html>