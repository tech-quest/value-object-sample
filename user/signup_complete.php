<?php
require_once(__DIR__ . '/../dao/UserDao.php');
require_once(__DIR__ . '/../utils/redirect.php');

$mail = filter_input(INPUT_POST, 'mail');
$userName = filter_input(INPUT_POST, 'userName');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

session_start();
if (empty($password) || empty($confirmPassword)) $_SESSION['errors'][] = "パスワードを入力してください";
if ($password !== $confirmPassword) $_SESSION['errors'][] = "パスワードが一致しません";

if (!empty($_SESSION['errors'])) {
  $_SESSION['formInputs']['userName'] = $userName;
  $_SESSION['formInputs']['mail'] = $mail;
  redirect('/dao-sample/user/signup.php');
}

$userDao = new UserDao();
// メールアドレスに一致するユーザーの取得
$user = $userDao->findByMail($mail);

if (!is_null($user)) $_SESSION['errors'][] = "すでに登録済みのメールアドレスです";
if (!empty($_SESSION['errors'])) redirect('/dao-sample/user/signup.php');

// ユーザーの保存
$userDao->create($userName, $mail, $password);

$_SESSION['message'] = "登録できました。";
redirect('/dao-sample/user/signin.php');
