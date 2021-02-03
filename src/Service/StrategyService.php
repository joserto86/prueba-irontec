<?php

namespace App\Service;

use App\Entity\Strategy;
use App\Repository\ShortenedUrlRepository;
use App\Repository\StrategyRepository;

class StrategyService
{
    private const CHARS = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ";
    private const NUMBERS = '0123456789';
    private const HASH_LENGHT = 7;

    protected StrategyRepository $stategyRepository; 
    protected ShortenedUrlRepository $shortenedUrlRepository;
    
    public function __construct(
        StrategyRepository $stategyRepository, 
        ShortenedUrlRepository $shortenedUrlRepository
    ) {
        $this->stategyRepository = $stategyRepository;
        $this->shortenedUrlRepository = $shortenedUrlRepository;
    }

    public function getStrategies() :array
    {
        return $this->stategyRepository->getStrategies();
    }

    public function getStrategiesToStaticsPanel() :array
    {
        $strategies = $this->getStrategies();
        $totalUrls = $this->shortenedUrlRepository->getCountShortenedUrls();

        foreach($strategies as $strategy) {
            
            $usageStrategy = \count($strategy->getShortenedUrls());
            $percentage = $totalUrls != 0 ? $usageStrategy * 100 / $totalUrls : 0;

            $strategy->setPercentUse($percentage)->setViewParams();
        }

        return $strategies;
    }

    public function getHashFromStrategy(int $strategy)
    {
        switch ($strategy)
        {
            case Strategy::ALPHANUMERIC:
                return $this->generateRandomHash(self::CHARS.'|'.self::NUMBERS);
            case Strategy::LETTERS:
                return $this->generateRandomHash(self::CHARS);
            case Strategy::NUMERIC:
                return $this->generateRandomHash(self::NUMBERS);
            case Strategy::CUSTOM:
                return '';
            default:
                return '';
        }
    }

    private function generateRandomHash(string $dictionary) 
    {
        $sets = \explode('|', $dictionary);
        $all = '';
        $randString = '';
        foreach($sets as $set) {
            $randString .= $set[\array_rand(str_split($set))];
            $all .= $set;
        }

        $all = \str_split($all);
        for ($i = 0; $i < self::HASH_LENGHT - \count($sets); $i++) {
            $randString .= $all[\array_rand($all)];
        }

        $randString = \str_shuffle($randString);
        return $randString;
    }

    // protected function verifyUrlExists($url){
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_NOBODY, true);
    //     curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
    //     curl_exec($ch);
    //     $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);

    //     return (!empty($response) && $response != 404);
    // }

}