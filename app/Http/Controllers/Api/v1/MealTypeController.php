<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\MealType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MealTypeController extends Controller
{
    public function index(Request $request) {
        
        try {
            $mealTypes = MealType::where(['status'=>1])->get();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $mealTypes
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }

    public function create(Request $request) {
        $request->validate([
            'name' => ['required'],
            'description' => ['nullable'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = new MealType();
            $model->name = $request->name;
            $model->description = $request->description;
            $model->status = $request->status;
            $model->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => null
            ], 401);
        }
    }
}
