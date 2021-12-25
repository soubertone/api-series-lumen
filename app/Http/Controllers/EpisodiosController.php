<?php

namespace App\Http\Controllers;

use App\Models\Episodio;

class EpisodiosController extends APIBaseController
{
    public function __construct()
    {
        $this->model = Episodio::class;
    }

    public function perSerie($serieId)
    {
        try {

            $object = Episodio::query()
                ->where('serie_id', $serieId)
                ->get();

            if(count((array) $object) < 1) {
                return response()->json([
                    "error" => false,
                    "data" => "Registro não encontrado",
                ], 200);
            }

            return response()->json([
                "error" => false,
                "data" => $object
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "data" => [
                    "message" => $e->getMessage(),
                    "code" => $e->getCode(),
                ]
            ], 400);
        }
    }
}
