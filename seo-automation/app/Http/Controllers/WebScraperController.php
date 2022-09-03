<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class WebScraperController extends Controller
{
    public function home(){
        return view('home');
    }
    public function analyze(UrlRequest $request){
        // request with guzzle
        $siteurl = $request->get('url') ;
        set_time_limit(0);
        $dom = Http::get($request->get('url'));
        $crawler = new Crawler($dom->body()) ;
        $urls = [];
        $crawler->filter('a')
            ->reduce(function (Crawler $node , $i) use ($siteurl) {
                if (!str_contains($node->attr('href') , $siteurl )){
                    return false ;
                }
            })->each(function (Crawler $node , $i) use(&$urls) {
          $urls[] = $node->attr('href') ;
        });
        foreach ($urls as $url){
            $dom2 = Http::get($url) ;
            $crawler2 = new Crawler($dom2->body());
            $crawler2->filter('a')
                ->reduce(function (Crawler $node , $i) use($siteurl) {
                    if (!str_contains($node->attr('href') , $siteurl  )){
                        return false ;
                    }
                })
                ->each(function (Crawler $node , $i) use(&$urls){
                $urls[] = $node->attr('href') ;
            });
        }

        var_dump($urls);
    }
}
