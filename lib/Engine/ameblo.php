<?php //-*- Mode: php; indent-tabs-mode: nil; -*-

class ImageLnkEngine_ameblo {
  const sitename = 'http://ameblo.jp/';

  public static function handle($url) {
    if (! preg_match('/^http:\/\/([^\/]*\.)?ameblo\.jp\/.+\/image-/', $url)) {
      return FALSE;
    }

    // ----------------------------------------
    $data = ImageLnkCache::get($url);
    $html = $data['data'];

    $response = new ImageLnkResponse();
    $response->setReferer($url);

    $response->setTitle(ImageLnkHelper::getTitle($html));
    if (preg_match('/<div id="imageMain">.*?<img .*?src="(.+?)"/s', $html, $matches)) {
      $response->addImageURL($matches[1]);
    } elseif (preg_match('/<img id="imageMain".*?src="(.+?)"/s', $html, $matches)) {
      $response->addImageURL($matches[1]);
    }

    return $response;
  }
}
ImageLnkEngine::push('ImageLnkEngine_ameblo');
