<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\KepuasanPublik;
use Illuminate\Http\Request;

class SurveyAdminController extends Controller
{
    public function kepuasanPublikAdmin()
    {
        $dataKepuasan = KepuasanPublik::latest()->paginate(20);
        return view('admin.mod_kepuasanPublik.kepuasanPublik', compact('dataKepuasan'));
    }
}
