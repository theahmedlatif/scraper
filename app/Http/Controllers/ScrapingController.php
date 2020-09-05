<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Website;
use App\Article;
use Illuminate\Support\Facades\Redirect;

class ScrapingController extends Controller
{
    //

    private $client;
    private $articleTitle = [];
    private $articleExcerpt= [];
    private $articleURL = [];
    private $collective = [];

    public function __construct(){
        $this->client = new Client;
    }

    /** get status code of URL to check if Valid or not
     *  use website $id to update foreign key
     *
     */
    public function getStatusCodeNumber($url){
        $this->client->request('GET',$url);
        return $this->client->getInternalResponse()->getStatusCode();
    }

    /** initiate scraping action button
     *  use website $id to update foreign key
     *
     */
    public function fireAction($id){
        $target = Website::findOrfail($id);
        $result = [];

        //check if URL has multiple pages
        $statusCode = $this->getStatusCodeNumber($target->url.'page/2');
        // 200 https://www.php.net/manual/en/function.curl-getinfo.php

        //loop on valid urls
        if($statusCode == 200 ) {
            for ($i = 1; $statusCode == 200; $i++) {

                //keep track on each page status to break the loop in case of invalid page
                $statusCode = $this->getStatusCodeNumber($target->url . 'page/' . $i);

                //goutte client to get page HTML
                $lead = $this->client->request('GET', $target->url . 'page/' . $i);

                //pass HTML data "$lead" && targeted URL "$target"
                $result = $this->fireActionMediator($lead, $target);
            }
            //store result array into article table
            return $this->fireActionStore($result,$id);
        }
        //if website doesn't have multiple pages
        else if($statusCode != 200 ){

            //check status of provided url
            $statusCode = $this->getStatusCodeNumber($target->url);

            //if valid url
            if($statusCode == 200 ){

                //goutte client to get page HTML
                $lead = $this->client->request('GET', $target->url);

                //pass HTML data "$lead" && targeted URL "$target"
                $result = $this->fireActionMediator($lead, $target);

                //store result array into article table
                return $this->fireActionStore($result,$id);
            }
            else //in case of invalid url
                return "Check Site Configuration URL!";
        }
    }

    /** Scraping procedures based on goutte client
     *  push data into global arrays $this->articleTitle, $this->articleExcerpt, $this->articleURL
     *
     */
    public function fireActionMediator($lead,$destination){
        //appending array with contents of title
        $lead->filter('.'.$destination->titleDOM)
            ->each(function($item){
                array_push($this->articleTitle,$item->text());
            });

        //appending array with contents of excerpt
        $lead->filter('.'.$destination->excerptDOM)
            ->each(function($item){
                array_push($this->articleExcerpt,$item->text());
            });

        //appending array with contents of url
        $lead->filter('.'.$destination->urlDOM)
            ->each(function($item){
                array_push($this->articleURL,$item->attr('href'));
            });

        return $this->collective = [$this->articleTitle, $this->articleExcerpt, $this->articleURL];

    }

    /** Storing outputs into database
     *  create Article
     *
     */
    public function fireActionStore($result,$id){

        for ($x = 0; $x < count($this->articleTitle); $x++) {
            if($this->checkExistingArticleTitle($result[0][$x],$id) == 0) //check article title
                return Redirect::route('show.articles',$id); //terminate if we reached existing items
            Article::create([
                'website_id' => $id,
                'articleTitle' => $result[0][$x],
                'articleExcerpt' => $result[1][$x],
                'articleURL' => $result[2][$x],
            ]);
            //update last scraped timestamp
            $touch = Website::findOrfail($id);
            $touch->lastScrap = now();
            $touch->save();
        }
        return redirect()->route('show.articles',$id); //terminate after updating items
    }

    /** check if scraped item exist in database
     *
     *
     */
    public function checkExistingArticleTitle($articleTitle){
        if(Article::where('articleTitle',$articleTitle)->first())
            return 0;
        return 1;
    }
}
