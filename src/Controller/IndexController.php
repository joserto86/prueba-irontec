<?php

namespace App\Controller;

use App\Form\ShortenerType;
use App\Model\Shortener;
use App\Service\ShortenedUrlService;
use App\Service\StrategyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    protected StrategyService $strategyService; 
    protected ShortenedUrlService $shortenedUrlService;

    public function __construct(StrategyService $strategyService, ShortenedUrlService $shortenedUrlService)
    {
        $this->strategyService = $strategyService;
        $this->shortenedUrlService = $shortenedUrlService;
    }
    
    /**
     * @Route("/", name="index")
     */
    public function index() :Response
    {
        return $this->redirectToRoute('shortener');
    }

    /**
     * @Route("/{hash}", name="hash")
     */
    public function hash(string $hash): Response
    {
        $url = $this->shortenedUrlService->getShortenedUrlByHashAndAddVisit($hash);
        
        if(isset($url)) {
           return $this->redirect($url->getLongUrl());
        }
        else {
            return new JsonResponse('Not found');
        }
    }

    /**
     * @Route("admin/shortener", name="shortener")
     */
    public function urlShortener(Request $request): Response
    {
        $form = $this->createForm(ShortenerType::class, new Shortener());
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $shortener = $form->getData();
                $shortener->setHash(
                    \substr(
                        $shortener->getHash(),
                        \strlen($this->getHttpHost($request))
                    )
                );

                $result = $this->shortenedUrlService->saveShortenedUrl($shortener);
                if ($result)
                    $form = $this->createForm(ShortenerType::class, new Shortener());
            }
        } 

        return $this->render('index/shortener.html.twig', [
            'form' => $form->createView(),
            'result' => isset($result) ? $result : null,
        ]);
    }

    /**
     * Undocumented function
     *
     * @Route("admin/shortener/generate/{strategy}", name="generate")
     * @param Request $request
     * @return Response
     */
    public function urlShortenerGenerate(Request $request, int $strategy): Response
    {
        $hash = $this->strategyService->getHashFromStrategy($strategy);
        if (!empty($hash))
            return new JsonResponse(['success' => true, 'hash' => $this->getHttpHost($request).$hash]);
        else
            return new JsonResponse(['success' => false]);
    }

    /**
     * @Route("admin/statistics", name="statistics")
     */
    public function statisticsPanel(Request $request)
    {
        $urls = $this->shortenedUrlService->getTopMostVisitUrls();
        $strategies = $this->strategyService->getStrategiesToStaticsPanel();

        foreach($urls as $url)
        {
            $url->setHash($this->getHttpHost($request).$url->getHash());
        }

        return $this->render('index/statistics.html.twig', [
            'strategies' => $strategies,
            'urls' => $urls
        ]);
    }

    private function getHttpHost(Request $request)
    {
        return $request->getSchemeAndHttpHost().'/';
    }
}
