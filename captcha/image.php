<?php
include_once 'common.php';
include_once 'class.captcha.php';

$captcha = new Captcha();

$captcha->chars_number = 6;
$captcha->font_size = 17;
$captcha->tt_font = 'verdana.ttf';

$captcha->show_image(132, 30);
?>