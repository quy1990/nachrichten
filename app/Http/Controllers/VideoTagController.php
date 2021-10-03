<?php

namespace App\Http\Controllers;

use App\Http\Resources\Video\VideoCollection;
use App\Models\Tag;

class VideoTagController extends Controller
{
    public function __invoke(int $id): VideoCollection
    {
        return new VideoCollection(Tag::find($id)->videos);
    }
}
