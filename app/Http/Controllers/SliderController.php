<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $query = Slider::query();
        $query->where('status', 1);
        if ($request->allData) return $query->get();
        $data = $query->paginate($request->pagination ?? 10);
        return new SliderResource($data);
    }

    public function store(SliderRequest $request)
    {
//        dd(123);
        try {
            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                if (Storage::put("upload/slider/{$fileName}", file_get_contents($request->image))) {

                    $request->merge(['url' => "upload/slider/{$fileName}"]);
                }
            }
            Slider::create($request->all());
            return response()->json(["message" => "Successfully created!"]);
        } catch (Exception $e) {

        }

    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return response()->json($slider);
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            return response()->json(['message' => 'Slider not found'], 404);
        }

        try {
            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                if (Storage::put("upload/slider/{$fileName}", file_get_contents($request->image))) {

                    $request->merge(['url' => "upload/slider/{$fileName}"]);
                }
            }
            $slider->update($request->all());
            return response()->json(["message" => "Successfully updated!"]);
        } catch (Exception $e) {

        }
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return response()->json('successfully deleted');
    }

    public function getAllData(Request $request)
    {
        return Slider::get();
    }
}
