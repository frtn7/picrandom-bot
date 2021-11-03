<?php
use App\Http\Controllers\BotManController;
use Buchin\GoogleImageGrabber\GoogleImageGrabber;
use Illuminate\Support\Facades\Storage;

$botman = resolve('botman');

//$botman->hears('Hi', function ($bot) {
//    $bot->reply('Hello!');
//});

//$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('/pic {keyword}', function ($bot, $keyword) {
    $images = GoogleImageGrabber::grab($keyword);
    $rand_index = rand(0, count($images));
    $url = $images[$rand_index]['url'];
    $pic_content = file_get_contents($url);
    $name = substr($url, strrpos($url, '/') + 1);
    Storage::put('public/images/' . $name, $pic_content);
    $bot->reply('Your pic is here:');
    $bot->reply(Storage::get($name));
});

//$url = $images[$rand_index]['url'];
//$contents = file_get_contents($url);
//$name = substr($url, strrpos($url, '/') + 1);
//Storage::put($name, $contents);

//$keyword = 'dog';
//$images = GoogleImageGrabber::grab($keyword);
//$rand_index = rand(0, count($images));
//$url = $images[$rand_index]['url'];
//$pic_content = file_get_contents($url);
//$name = substr($url, strrpos($url, '/') + 1);
//Storage::put('public/images/' . $name, $pic_content);

//echo '<pre>';
//print_r($images[$rand_index]['url']);
//print_r($pic_content);
//echo '</pre>';
