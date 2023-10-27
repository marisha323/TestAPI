<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use DOMDocument;
use DOMXPath;
use http\Client;
use Illuminate\Http\Request;

use Symfony\Component\Panther\PantherTestCase;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LinkResource::collection(Link::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'url'=>'required|url',
//        ]);
//
//        $url=$request->input('url');
//        $link=new Link();
//        $link->url=$url;
//        $link->status=0;// статус в процесі
//        $link->save();
//        try {
//            $client = PantherTestCase::createPantherClient();
//            $client->request('GET', $url);
//            $title = $client->getTitle();
//            $link->title = $title;
//            $link->status = 1; // 1 - title отримано
//            $link->save();
//
//            return response()->json(['status' => 1, 'title' => $title]);
//        } catch (\Exception $e){
//            $link->status = 2; // 2 - помилка
//            $link->error_message = $e->getMessage();
//            $link->save();
//
//            return response()->json(['status' => 2, 'message' => $e->getMessage()]);
//        }


        $request->validate([
            'url' => 'required|url',
        ]);

//        $ch = curl_init();
//
//// Укажите URL веб-страницы для загрузки
     $url = $request->input('url'); // Замените URL на нужный
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//// Выполните запрос и получите HTML-код
//        $html = curl_exec($ch);
//
//// Закройте cURL сеанс
//        curl_close($ch);
//
//// Создайте экземпляр DOMDocument
//        $dom = new DOMDocument();
//
//// Загрузите HTML-код в DOMDocument
//        @$dom->loadHTML($html);
//
//// Найдите элемент title
//        $titleNode = $dom->getElementsByTagName('title')->item(0);
//
//// Проверка на доступность страницы (HTTP-код 200 - успех, інакше помилка)
//        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER,false);
        $result=curl_exec($ch);
        if ($result) {
            $dom = new DOMDocument;
            @$dom->loadHTML($result);

            // Використовуйте DOMXPath для знаходження елементу title
            $xpath = new DOMXPath($dom);
            $titleNode = $xpath->query('//title')->item(0);

            if ($titleNode) {
                $title = $titleNode->textContent;
                // Отримано текст заголовка
                echo "Заголовок сторінки: " . $title;
            } else {
                // Заголовок не знайдено
                echo "Заголовок не знайдено";
            }
        } else {
            // Помилка при завантаженні сторінки
            echo "Помилка при завантаженні сторінки";
        }
//        if ($httpCode !== 200) {
//            // Якщо сторінка недоступна, створіть запис зі статусом 2 та повідомленням про помилку
//            $link = new Link();
//            $link->url = $url;
//            $link->status = 2; // 2 - помилка
//            $link->error_message = "HTTP Error: " . $httpCode;
//            $link->save();
//
//            echo "Страница недоступна. Помилка: HTTP " . $httpCode;
//        } else {
//            // Отримайте текст заголовка
//            $title = $titleNode->nodeValue;
//
//            // Збереження отриманого заголовку та статусу 1 (title отримано) в базі даних
//            $link = new Link();
//            $link->url = $url;
//            $link->title = $title;
//            $link->status = 1; // 1 - title отримано
//            $link->save();
//
//            echo "Заголовок страницы: " . $title;
//        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new LinkResource(Link::with("user")->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
