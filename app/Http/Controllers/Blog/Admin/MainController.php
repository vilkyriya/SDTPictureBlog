<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\Images;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends AdminBaseController
{
    public function index()
    {
        $data = Images::latest()->paginate(5);
        return view('blog.admin.index', compact('data'))
            ->with('i', (request()->input('page',1) - 1) * 5);
    }

    public function create()
    {
        return view('blog.admin.create');
    }
}
