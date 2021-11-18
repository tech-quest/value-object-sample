<?php
require_once(__DIR__ . '/../dao/UserDao.php');
require_once(__DIR__ . '../UseCase/UseCaseInput/SignInUseCaseInput.php');
require_once(__DIR__ . '../UseCase/UseCaseInteractor/SignInInteractor.php');
require_once(__DIR__ . '/../utils/redirect.php');

session_start();
$mail = filter_input(INPUT_POST, 'mail');
$password = filter_input(INPUT_POST, 'password');

if (empty($mail) || empty($password)) {
    $_SESSION['errors'][] = "パスワードとメールアドレスを入力してください";
    redirect("./user/signin.php");
}

$useCaseInput = new SignInUseCaseInput($mail, $password);
$useCase = new SignInInteractor($useCaseInput);
$useCaseOutput = $useCase->handler();
redirect($useCaseOutput->redirectUrl());