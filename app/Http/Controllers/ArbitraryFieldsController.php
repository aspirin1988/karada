<?php

namespace App\Http\Controllers;

use App\ArbitraryFields;
use Illuminate\Http\Request;

class ArbitraryFieldsController extends Controller
{
    public function getFields($type, $id)
    {

        $fields = [];
        $data = ArbitraryFields::where('object_id', $id)->where('object_type', $type)->first();

        if ($data) {
            $fields = json_decode($data->fields);
        }

        return response()->json($fields);
    }

    public function saveFields($type, $id, Request $request)
    {
        $fields = $request->all();
        $fields = json_encode($fields);

        $data = ArbitraryFields::where('object_id', $id)->where('object_type', $type)->first();
        if ($data) {
            $data->fields = $fields;
            $data->save();
        } else {
            $input = [
                'object_id' => $id,
                'object_type' => $type,
                'fields' => $fields,
            ];
            $data = ArbitraryFields::create($input);
        }

        return response()->json($data);
    }
}
