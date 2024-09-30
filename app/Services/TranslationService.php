<?php
// app/Services/TranslationService.php
namespace App\Services;

use GuzzleHttp\Client;

class TranslationService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://libretranslate.com'
        ]);
    }

    public function translateText($text, $targetLanguage = 'fr')
    {
        $response = $this->client->post('/translate', [
            'json' => [
                'q' => $text,
                'source' => 'auto', // Détection automatique de la langue d'origine
                'target' => $targetLanguage,
                'format' => 'text'
            ]
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['translatedText'];
    }
}
