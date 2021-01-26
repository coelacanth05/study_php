<?php
// file取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$uplaod_dir = '/shinkairoom.com/public_html/study-php/happiness_php/upload/imeges';
$save_filename = date('YmdHis') . $filename;
// キャプション取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);
// キャプションのバリデーション
// 未入力のバリデーション
if (empty($caption)) {
  echo 'キャプションを入力してください';
  echo '<br>';
}
// 140文字
if (strlen($caption) > 140) {
  echo 'キャプションは140文字以内で入力してください';
  echo '<br>';
}
//ファイルのバリデーション
// ファイルサイズが1MB未満か
if ($filesize > 1048576 || $file_err == 2) {
  echo 'ファイルサイズは1MB未満にしてください';
  echo '<br>';
}
// 拡張は画像形式か
$arrow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
if (!in_array(strtolower($file_ext), $arrow_ext)) {
  echo '画像ファイルを添付してください';
  echo '<br>';
}
// ファイルはあるかどうか？
if (is_uploaded_file($tmp_path)) {
  if (move_uploaded_file($tmp_path, $uplaod_dir . $save_filename)) {
    echo $filename . 'を' . $uplaod_dir . 'アップしました。';
  } else {
    echo 'ファイルが保存できませんでした';
  }
} else {
  echo 'ファイルが選択されてません。';
  echo '<br>';
}
?>
<a href="./upload_from.php">戻る</a>
