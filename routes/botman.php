<?php
use App\Http\Controllers\BotManController;
use Buchin\GoogleImageGrabber\GoogleImageGrabber;

$botman = resolve('botman');

//$botman->hears('Hi', function ($bot) {
//    $bot->reply('Hello!');
//});

//$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('/pic {keyword}', function ($bot, $keyword) {
    $images = GoogleImageGrabber::grab($keyword);
    $rand_index = rand(0, count($images));
    $pic_content = file_get_contents($images[$rand_index]['url']);
    $bot->reply('Your pic is here:');
    $bot->reply(imagecreatefromstring($pic_content));
});

//$keyword = 'dog';
//$images = GoogleImageGrabber::grab($keyword);
//$rand_index = rand(0, count($images));
//$pic_content = file_get_contents($images[$rand_index]['url']);
//
//echo '<pre>';
//print_r($images[$rand_index]['url']);
//print_r($pic_content);
//echo '</pre>';
