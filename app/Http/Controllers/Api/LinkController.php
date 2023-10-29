<?php

namespace App\Http\Controllers\Api;

use App\Contracts\LinkContract;
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
    private LinkContract $linkContract;
    public function __construct(LinkContract $linkContract)
    {
        $this->linkContract=$linkContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::with('user')->get();
        return view('home', ['links' => $links]);
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

        $link=$this->linkContract->create($url);
        return response()->json(['id' => $link->id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

       return $this->linkContract->status($id);
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
