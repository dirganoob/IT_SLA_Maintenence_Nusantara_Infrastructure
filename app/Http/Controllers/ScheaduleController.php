<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class ScheaduleController extends Controller
{
    public function scheadule(Request $request)
    {
        $title = 'MUN | Schedule';

        return view('pages.scheadule.scheadule',['jadwals' => Jadwal::all()], compact('title'));
    }
}
