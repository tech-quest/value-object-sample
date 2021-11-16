<?php
require_once(__DIR__ . '/../dao/UserDao.php');
require_once(__DIR__ . '/../utils/redirect.php');

session_start();
$mail = filter_input(INPUT_POST, 'mail');
$password = filter_input(INPUT_POST, 'password');

if (empty($mail) || empty($password)) {
    $_SESSION['errors'][] = "パスワードとメールアドレスを入力してください";
    redirect("./user/signin.php");
}

$userDao = new UserDao();
$member = $userDao->findByMail($mail);

if (!password_verify($password, $member["password"])) {
    $_SESSION['errors'][] = "メールアドレスまたは<br />パスワードが違います";
    redirect("./signin.php");
}

$_SESSION['formInputs']['userId'] = $member['id'];
$_SESSION['formInputs']['userName'] = $member['user_name'];
redirect("../index.php");
