<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;

class ScrapperController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function screenshot(): void
    {
        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch();

        $page = $browser->newPage();

        $page->goto('https://nowodev.netlify.app');

        $page->screenshot(['path' => 'nowodev.png']);

        $browser->close();
    }

    public function scrapeAndStore(Request  $request)
    {
        $cred = $request->validate([
            'selector' => 'required',
            'url' => 'required|url',
        ]);

        $url = $cred['url'];

        $selector = $cred['selector'];

        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch();

        $page = $browser->newPage();

        $page->goto($url);

        foreach ($page->querySelectorAll($selector) as $el) {
            echo ($el->getProperty('textContent')->jsonValue());
//            var_dump($el->getProperty('textContent')->jsonValue());
        }

        $browser->close();
    }
}
