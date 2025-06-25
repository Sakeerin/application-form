<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request){
        $educations = json_decode($request->input('educations'), true);
        $programs = json_decode($request->input('programs'), true);
        $langs = json_decode($request->input('langs'), true);
        $trainings = json_decode($request->input('trainings'), true);
        $works = json_decode($request->input('works'), true);
        dd($works);
    }
}
