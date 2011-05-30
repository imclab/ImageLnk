<?php //-*- Mode: php; indent-tabs-mode: nil; -*-

class ImageLnkEngine_twipple {
  const language = 'Japanese';
  const sitename = 'http://twipple.jp/';

  public static function handle($url) {
    if (! preg_match('/^http:\/\/p\.twipple\.jp\//', $url)) {
      return FALSE;
    }

    // ----------------------------------------
    $data = ImageLnkCache::get($url);
    $html = $data['data'];

    $response = new ImageLnkResponse();
    $response->setReferer($url);

    $response->setTitle(ImageLnkHelper::getTitle($html));
    if (preg_match('/<a href="(http:\/\/p\.twipple\.jp\/data\/.+?)">/', $html, $matches)) {
      $response->addImageURL($matches[1]);
    }

    return $response;
  }
}
ImageLnkEngine::push('ImageLnkEngine_twipple');
