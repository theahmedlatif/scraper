<?php

namespace App\Http\Controllers;

use App\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $websites = Website::all();
        return view('website.list')->with('websites',$websites);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('website.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //
        Website::create($this->validate($request,[
            'websiteName' => ['required', 'unique:websites','max:50'],
            'url' => ['required', 'unique:websites','max:2000','url'],
            'titleDOM' => ['required','max:200'],
            'excerptDOM' => ['required','max:200'],
            'urlDOM' => ['required','max:200'],
        ]));

        return redirect('/websites');
    }
}
