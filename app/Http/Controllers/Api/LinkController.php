<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;
use App\Jobs\ApiParserJob;
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
        $links = Link::with('user')->get();
        return view('your.view.name', ['links' => $links]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);
        $url = $request->input('url');
        $link = new Link();
        $link->url = $url;
        $link->status = 0; // Позначаємо URL як "в процесі"
        $link->save();

        dispatch(new ApiParserJob($url,$link));
        return response()->json(['id' => $link->id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
