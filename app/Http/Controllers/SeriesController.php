<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class SeriesController extends APIBaseController
{
    public function __construct()
    {
        $this->model = Serie::class;
    }
}
