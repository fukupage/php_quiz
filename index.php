<?php
ini_set('display_errors', 1);

//セッション開始
session_start();

//モデル部分
//------------------------------------------------------------------//
//質問のid
$quiz = '';

//回答ボタンの入力チェック
$mode = !empty($_POST['mode']) ? $_POST['mode']:

  //回答の正誤チェック
  $answer = '';

//回答の正解データ
$ans_data = '1';

//回答の入力データ
$ans_input = '1';

//コントローラー部分
//------------------------------------------------------------------//
if ($mode) {
  if (empty($_SESSION['token'] || $_SESSION['token'] != $_POST['token'])) {
    die('不正とは太ぇ野郎だ！　おめえ、ぶっころすぞ！！');
  } else {
    $mode = htmlspecialchars($_POST['mode']);
  }
  if ($mode === 'answer') {
    if ($ans_data === $ans_input) {
      $answer = 'true';
    } else {
      $answer = 'false';
    }
  }
} else {
  $mode = 'question';
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<?php print '<!--'; ?>
<?php print 'ほげほげふがふがばーばーばー'; ?>
<?php print '-->'; ?>
<body>
  <header>
    <h1>Quiz</h1>
  </header>
  <main>
    <section>
      <?php if ($mode == 'question') : ?>
        <article id="question">
          <?php if ($ans_input == '') : ?><h2>ちゃんとこたえて</h2><?php endif; ?>
          しつもんです？
          <form action="index.php" method="POST">
            <input type="hidden" name="mode" value="answer">
            <button type="submit">回答する</button>

          </form>

        </article>
      <?php endif; ?>
      <?php if ($mode == 'answer') : ?>
        <?php if ($answer == 'true') : ?>
          <article id="answer_true">
            <h2>正解です</h2>

          </article>
        <?php endif; ?>
        <?php if ($answer != 'true') : ?>
          <article id="answer_false">
            <h2>残念！不正解です</h2>

          </article>
        <?php endif; ?>
      <?php endif; ?>
      <p>$mode:<?php print $mode; ?></p>
      <p>$answer:<?php print $answer; ?></p>
      <p>$ans_data:<?php print $ans_data; ?></p>
      <p>$ans_input:<?php print $ans_input; ?></p>
    </section>
  </main>
  <footer>
    <p>&copy; BowWorks</p>
  </footer>
  <script src="jquery.js"></script>
  <script src="script.js"></script>
</body>

</html>
