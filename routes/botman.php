<?php
use App\Http\Controllers\BotManController;
use Buchin\GoogleImageGrabber\GoogleImageGrabber;
use Illuminate\Support\Facades\Storage;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

$botman = resolve('botman');

$botman->hears('/pic {keyword}', function ($bot, $keyword) {
    $images = GoogleImageGrabber::grab($keyword);
    $rand_index = rand(0, count($images));
    $url = $images[$rand_index]['url'];
    $pic_content = file_get_contents($url);
    $name = substr($url, strrpos($url, '/') + 1);
    Storage::put('public/images/' . $name, $pic_content);
    $attachment = new Image($url);
    $message = OutgoingMessage::create()
        ->withAttachment($attachment);
    $bot->reply('Your pic is here:');
    $bot->reply($message);
});
