<?php

namespace App\Service;

use App\Model\Shortener;
use App\Repository\ShortenedUrlRepository;
use App\Entity\ShortenedUrl;
use App\Model\ResultResponse;

class ShortenedUrlService
{
    private const TOP_RESULTS = 5;
    
    private ShortenedUrlRepository $shortenedUrlRepository;
    
    public function __construct(ShortenedUrlRepository $shortenedUrlRepository) 
    {
        $this->shortenedUrlRepository = $shortenedUrlRepository;
    }

    public function saveShortenedUrl(Shortener $shortener) :ResultResponse
    {
        $result = new ResultResponse();
        if ($this->isValidUrl($shortener->getUrl())) {
            $exist = $this->getShortenedUrlByHash($shortener->getHash());
            if (!isset($exist)) {
                $shortenedUrl = new ShortenedUrl();
                $shortenedUrl->setHash($shortener->getHash());
                $shortenedUrl->setStrategy($shortener->getStrategy());
                $shortenedUrl->setLongUrl($shortener->getUrl());
                $shortenedUrl->setVisits(0);

                $result->setSuccess($this->shortenedUrlRepository->saveShortenedUrl($shortenedUrl));
            } else {
                $result->setSuccess(false)->addMessage('La url acortada ya existe, pruebe a generar otra nueva');
            }
        } else {
            $result->setSuccess(false)->addMessage('La url no es válida');
        }

        return $result;
    }

    public function getShortenedUrlByHash(string $hash) :?ShortenedUrl
    {
        return $this->shortenedUrlRepository->getShortenedUrlByHash($hash);
    }

    public function getShortenedUrlByHashAndAddVisit(string $hash) :?ShortenedUrl
    {
        $shortenedUrl = $this->getShortenedUrlByHash($hash);
        if (isset($shortenedUrl))
        {
            $this->addVisit($shortenedUrl);
            return $shortenedUrl;
        }
        return null;
    }

    public function getTopMostVisitUrls() :array
    {
        $numVisits = $this->shortenedUrlRepository->getTotalVisitsShortenedUrls();
        $urls = $this->shortenedUrlRepository->getTopMostVisitUrls(self::TOP_RESULTS);

        foreach($urls as $url)
        {
            $percentage = $numVisits != 0 ? $url->getVisits() * 100 / $numVisits : 0;
            $url->setPercentUse($percentage);
        }

        return $urls;
    }

    private function addVisit(ShortenedUrl $shortenedUrl)
    {
        $shortenedUrl->addVisit();
        $shortenedUrl->setLastVisit(new \DateTime('now'));
        
        $result = $this->shortenedUrlRepository->saveShortenedUrl($shortenedUrl);
    }

    private function isValidUrl($url) :bool
    {
        return \filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
    }
}