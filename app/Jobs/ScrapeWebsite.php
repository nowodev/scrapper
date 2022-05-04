<?php

namespace App\Jobs;

use App\Models\Scrapper;
use Illuminate\Bus\Queueable;
use Nesk\Puphpeteer\Puppeteer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeWebsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $credentials;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = $this->credentials['url'];

        $selector = $this->credentials['selector'];

        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch([
//            'args' => ['--no-sandbox', '--disable-setuid-sandbox'],
        ]);

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
    }
}
