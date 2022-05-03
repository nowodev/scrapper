<?php

namespace App\Http\Controllers;

use App\Models\Scrapper;
use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;

class ScrapperController extends Controller
{
    public function index()
    {
        $scrappedData = Scrapper::query()->get();

        return view('index', compact('scrappedData'));
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

    public function scrapeAndStore(Request $request)
    {
        $cred = $request->validate([
            'selector' => 'required',
            'url' => 'required|url',
        ]);

        ScrapeWebsite::dispatch($cred);

        return redirect()->route('index');
    }
}
