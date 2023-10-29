<?php

namespace App\Repositories;

use App\Contracts\LinkContract;
use App\Jobs\ApiParserJob;
use App\Models\Link;


class LinkRepository implements LinkContract
{


    public function __construct()
    {

    }

    public function create($url)
    {
        $link = new Link();

        $link->url = 'https://'.$url;
        $link->status = 0; // Позначаємо URL як "в процесі"
        $link->save();

        dispatch(new ApiParserJob($link));
        return $link;
    }

    public function status($id)
    {
        $link = Link::findOrFail($id);

        if ($link->status == 0) {
            return response()->json(['status' => $link->status, 'message' => 'in progress'], 200);
        } elseif ($link->status == 1) {
            return response()->json(['status' => $link->status, 'title' => $link->title], 200);
        } else {
            return response()->json(['status' => $link->status, 'message' => 'Помилка'], 200);
        }
    }

}



