<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the brand.
     */
    public function index()
    {
        $brands = DB::table('brands')->simplePaginate(5);
        return view('admin.brands')->with('brands',$brands);
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        return view('admin.create_brand');
    }

    /**
     * Store a newly created resource in brand.
     */
    public function store(Request $request)
    {
        $brand = new Brand();  
        $brand->brand_name =  $request->get('brand_name');  
        $brand->save();  
        return redirect('admin/brands')->with(array('message'=> $brand->brand_name.' added successfully !!', 'color'=>'alert-success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit($id)
    {
        //
        $brand = Brand::find($id);
        return view('admin.edit_brand')->with('brand',$brand);
    }

    /**
     * Update the specified resource in brand.
     */
    public function update(Request $request,$id)
    {
        //
        $brand = Brand::find($id);
        $brand->brand_name = $request->get('brand_name');  
        $brand->save();
        return redirect('admin/brands')->with(array('message'=>$brand->brand_name.' updated successfully !!', 'color'=>'alert-warning'));
    }

    /**
     * Remove the specified resource from brand.
     */
    public function destroy($id)
    {
        //
        $brand_detail = Brand::find($id);
        $brand_name = $brand_detail->brand_name;
        Brand::destroy($id);
        return redirect('admin/brands')->with(array('message'=> $brand_name.' Deleted successfully !!', 'color'=>'alert-danger'));
    }
}
