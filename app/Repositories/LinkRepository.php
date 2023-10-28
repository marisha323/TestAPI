<?php
namespace App\Repositories;

use App\Contracts\DeskContract;
use App\Contracts\LinkContract;
use App\Jobs\ApiParserJob;
use  App\Models\Desk;
use App\Models\DesksUsers;
use App\Models\Link;
use App\Models\User;
use App\Presenters\DeskAsArrayPresenter;
use http\Env\Request;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class LinkRepository implements LinkContract
{
    protected $linkModel;

    public function __construct(Link $link)
    {
        $this->linkModel = $link;
    }

    public function store($link)
    {


    }

}



