<?php //-*- Mode: php; indent-tabs-mode: nil; -*-

class ImageLnkEngine_instagram {
  const language = NULL;
  const sitename = 'http://instagr.am/';

  public static function handle($url) {
    if (! preg_match('/^http:\/\/instagr\.am\/p\//', $url)) {
      return FALSE;
    }

    // ----------------------------------------
    $data = ImageLnkCache::get($url);
    $html = $data['data'];

    $response = new ImageLnkResponse();
    $response->setReferer($url);

    ImageLnkHelper::setResponseFromOpenGraph($response, $html);

    if (preg_match('/<div class="caption">(.*?)<\/div>/s', $html, $matches)) {
      $response->setTitle($response->getTitle() . ': ' . trim($matches[1]));
    }

    return $response;
  }
}
ImageLnkEngine::push('ImageLnkEngine_instagram');
