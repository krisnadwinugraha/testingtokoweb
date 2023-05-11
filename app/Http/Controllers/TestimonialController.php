<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Testimonial;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        try {
            $testimonials = Testimonial::latest()->paginate(5);
            return response()->json($testimonials);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $imageName = time().'.'.$request->file('foto')->getClientOriginalExtension();
            $request->foto->move(public_path('/images'), $imageName);
            $request['foto'] = $imageName;
            $testimonial = Testimonial::create($request->post());
            return response()->json([
                'message'=>'Testimonial Created Successfully!!',
                'testimonial'=>$testimonial
            ]);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            return response()->json($testimonial);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Data Tidak Ada.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            if ($request->file('foto')) {
                $imageName = time().'.'.$request->file('foto')->getClientOriginalExtension();
                $request->foto->move(public_path('/images'), $imageName);
                $request['foto'] = $imageName;
            }
            
            $testimonial->fill($request->post())->save();
            return response()->json([
                'message'=>'Testimonial Updated Successfully!!',
                'testimonial'=>$testimonial
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Data Tidak Ada.'], Response::HTTP_NOT_FOUND);  
        } catch (\Exception $exception) {
            // Handle other exceptions if necessary
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();
            return response()->json([
                'message' => 'Testimonial Deleted Successfully!!'
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Data Tidak Ada'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
