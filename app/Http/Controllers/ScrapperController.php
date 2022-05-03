<?php

namespace App\Http\Controllers;

use App\Models\Scrapper;
use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;

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

        $page->goto('https://example.com');

        $page->screenshot(['path' => 'example.png']);

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
            Scrapper::query()->create([
                'content' => $el->getProperty('textContent')->jsonValue()
            ]);
//            echo ($el->getProperty('textContent')->jsonValue());
//            var_dump($el->getProperty('textContent')->jsonValue());
        }

        $browser->close();

        return redirect()->route('index');
    }
}
