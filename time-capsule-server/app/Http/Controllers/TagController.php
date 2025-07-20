<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    function getTags(){
        return $this->response(Tag::all());
    }
}
