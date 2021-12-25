<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class APIBaseController
{
    public $model;

    public function index (): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "error" => false,
            "data" => $this->model::paginate()
        ], 200);
    }

    public function store (Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $object = $this->model::create($request->all());

            return response()->json([
                "error" => false,
                "data" => $object,
            ], 201);

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

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        try {

            $object = $this->model::find($id);

            if(count((array) $object) < 1) {
                return response()->json([
                    "error" => false,
                    "data" => ""
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

    public function update(int $id, Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $object = $this->model::find($id);

            if(count((array) $object) < 1) {
                return response()->json([
                    "error" => false,
                    "data" => "Registro não encontrado"
                ], 404);
            }

            $run = $object->update($request->all());

            return response()->json([
                "error" => false,
                "data" => $object
            ], 200);

        }  catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "data" => [
                    "message" => $e->getMessage(),
                    "code" => $e->getCode(),
                ]
            ], 400);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {

            $object = $this->model::find($id);

            if(count((array) $object) < 1) {
                return response()->json([
                    "error" => false,
                    "data" => "Registro não encontrado"
                ], 404);
            }

            $run = $object->delete();

            return response()->json([
                "error" => false,
            ], 200);

        }  catch (\Exception $e) {
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
