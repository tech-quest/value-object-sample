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

$useCaseInput = new SignUpInput($userName, $mail, $password);
$useCase = new SignUpInteractor($useCaseInput);
$useCaseOutput = $useCase->handler();

if ($useCaseOutput->isSuccess()) {
  $_SESSION['message'] = $useCaseOutput->message();
  redirect('/dao-sample/user/signin.php');
}  else {
  $_SESSION['errors'][] = $useCaseOutput->message();
  redirect('/dao-sample/user/signup.php');
}