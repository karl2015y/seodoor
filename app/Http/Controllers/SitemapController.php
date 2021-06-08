<?php

namespace App\Http\Controllers;

use App\Models\Door;
use Illuminate\Support\Facades\App;



class SitemapController extends Controller
{
    public function getSiteMap()
    {
        // create new sitemap object
        $sitemap = App::make('sitemap');

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            $doors = Door::all();
            foreach ($doors as $value) {
                $sitemap->add(url($value['URL']));
            }
            // add item to the sitemap (url, date, priority, freq)
            
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}
