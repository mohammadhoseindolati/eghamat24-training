<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use function Symfony\Component\DomCrawler\eq;

class WebScraperController extends Controller
{
    public function home(){
        return view('home');
    }
    public function analyze(UrlRequest $request){
        // request with guzzle
       set_time_limit(0);

       $middleDomain = $this->getMiddleDomain($request->input('url')) ;
       $pattern = "/$middleDomain/i" ;

       $baseurl = $request->input('url') ;

       $dom = Http::get($request->input('url'));
       $crawler = new Crawler($dom->body()) ;
       $urls = [];
       $allLinks =[] ;
       $crawler->filter('body a')->each(function (Crawler $node , $i) use (&$allLinks) {

            $allLinks[] = $node->attr('href');
            });

        $absoluteLinks = $this->convert_to_absolute($baseurl , $allLinks ,$middleDomain);

        $site_id = Site::create([
            'url' => $baseurl
        ]);

        $infos = [] ;
        $i = 0 ;
        while($i++<1){
            $info = [] ;
            $info['page'] = $absoluteLinks[$i] ;

            $dom2 = Http::get($absoluteLinks[$i]) ;

            $info['status'] = $dom2->status();

            $crawler2 = new Crawler($dom2->body());
            $subLinks = [];
            $crawler2->filter('a')
                ->each(function (Crawler $node , $i)use(&$subLinks){
                    $subLinks[] = $node->attr('href') ;
            });

            $info['title'] = $crawler2->filter('head > title')->eq(0)->text() ;

            $info['meta-desc'] = $crawler2->filter('head > meta[name="description"]')->extract(['content'])[0] ?? "Not Have";

            $info['canonical'] = $crawler2->filter('head link[rel="canonical"]')->extract(['href'])[0] ?? "Not Have";

            $info['images'] = [];

            $crawler2->filter('body img')->each(function (Crawler $node , $i)use(&$info){

                $info['images'][] = $node->attr('src') ;
            });

            $info['videos'] = [] ;
            $crawler2->filter('body video')->each(function (Crawler $node , $i)use(&$info){
                $info['videos'][] = $node->attr('src') ;
            });


            $subAbsolutelinks = $this->convert_to_absolute($baseurl , $subLinks , $middleDomain) ;

            foreach ($subAbsolutelinks as $sal){
                if (preg_match($pattern , $sal ) === 1){
                    $info['internal-urls'][] = $sal ;
                }else{
                    $info['foreign-urls'][] = $sal;
                }
            }

            Page::insertInfo($info , $site_id->id) ;

            $infos[] = $info ;
        }




        return view('analyze', ['infos' => $infos]);
    }


    public function convert_to_absolute($baseUrl , $relatives , $middleDomain){

        $absolute_links = [] ;

        foreach ($relatives as $relative){

            if (preg_match('/^https?:\/\//' , $relative) === 1) {

                $absolute_links[] = $relative ;

            }
            if (preg_match('/www\./' , $relative) === 0 && preg_match('/^https?:\/\//' , $relative) === 0 ) {

                $absolute_links[] = $baseUrl.$relative ;
            }
        }
        return $absolute_links ;
    }



    public function getMiddleDomain($siteurl){

        $domain =  preg_replace('/^https?:\/\/(www\.)?/' , "" , $siteurl) ;

        $middleDomain = preg_replace('/\/.*$/' , "" , $domain) ;

        return $middleDomain ;
    }
}
