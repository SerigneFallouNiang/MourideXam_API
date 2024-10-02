<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    protected $client;
    protected $apiUrl;
    protected $supportedLanguages = ['fr', 'en', 'ar', 'wo'];

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = env('LIBRETRANSLATE_API_URL');
    }

    public function translate($text, $targetLang, $sourceLang = 'auto')
    {
        if (!in_array($targetLang, $this->supportedLanguages)) {
            throw new \InvalidArgumentException("La langue cible '$targetLang' n'est pas prise en charge.");
        }

        try {
            $response = $this->client->post($this->apiUrl, [
                'json' => [
                    'q' => $text,
                    'source' => $sourceLang,
                    'target' => $targetLang,
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            return $result['translatedText'] ?? $text;
        } catch (\Exception $e) {
            Log::error('Erreur de traduction: ' . $e->getMessage());
            return $text; // Retourne le texte original en cas d'erreur
        }
    }

    public function getSupportedLanguages()
    {
        return $this->supportedLanguages;
    }
}