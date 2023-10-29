<?php

namespace App\Jobs;


use App\Models\Link;
use DOMDocument;
use DOMXPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatcurrentHandlerable;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApiParserJob implements ShouldQueue
{
    use  InteractsWithQueue, Queueable, SerializesModels;

    protected Link $link;
    /**
     * Create a new job instance.
     */
    public function __construct($link)
    {

        $this->link =$link;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        echo  $this->link->url;
        $currentHandler = curl_init($this->link->url);
        curl_setopt($currentHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($currentHandler, CURLOPT_HEADER, false);
        $result = curl_exec($currentHandler);
        if ($result) {
            $dom = new DOMDocument;
            @$dom->loadHTML($result);
            $xpath = new DOMXPath($dom);
            $titleNode = $xpath->query('//title')->item(0);

            if ($titleNode) {
                $title = $titleNode->textContent;

                $this->link->title = $title;
                $this->link->status = 1; // 1 - title отримано
                $this->link->save();

            }
        } else {
            $this->link->status = 2; // 2 - помилка
            $this->link->save();
        }

    }
}
