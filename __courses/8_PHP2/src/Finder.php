<?php

namespace Alura\CourseFinder;

use GuzzleHttp\{ClientInterface};
use Symfony\Component\DomCrawler\{Crawler};

class Finder
{
    private readonly ClientInterface $httpClient;
    private readonly Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function search(string $url, $class):array
    {
        $response = $this->httpClient->request('GET', $url);
        $html = $response->getBody();
        $this->crawler->addHtmlcontent($html);
        $elementList = $this->crawler->filter($class);
        $list = [];

        foreach ($elementList as $element) {
            $list[] = $element->textContent;
        }

        return $list;
    }
}
