<?php

namespace App\Jobs;


use DOMDocument;
use DOMXPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApiParserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $url;
    protected $link;
    /**
     * Create a new job instance.
     */
    public function __construct($url,$link)
    {
        $this->url =$url;
        $this->link =$link;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        if ($result) {
            $dom = new DOMDocument;
            @$dom->loadHTML($result);
            // Використовуйте DOMXPath для знаходження елементу title
            $xpath = new DOMXPath($dom);
            $titleNode = $xpath->query('//title')->item(0);

            if ($titleNode) {
                $title = $titleNode->textContent;

                $this->link->title = $title;
                $this->link->status = 1; // 1 - title отримано
                $this->link->save();

            }
        } else {
            // Помилка при завантаженні сторінки
            $this->link->status = 2; // 2 - помилка
            $this->link->save();
        }

    }
}
