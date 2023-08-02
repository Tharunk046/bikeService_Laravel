<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Models;
use Illuminate\Http\Request;
// based on the brand id models are managed
class ModelsController extends Controller
{
    /**
     * Display a listing of the models.
     */
    public function index($brand_id)
    {
        $models = DB::table('models')->where('brand_id',$brand_id)->simplePaginate(5);
        return view('admin.models')->with(array('models'=> $models,'brand_id'=>$brand_id));
    }

    /**
     * Show the form for creating a new models.
     */
    public function create($id)
    {
        //
        return view('admin.create_model')->with('id',$id);
    }

    /**
     * Store a newly created resource in models.
     */
    public function store(Request $request,$brand_id)
    {
        $model = new Models();  
        $model->brand_id = $brand_id;
        $model->model_name =  $request->get('model_name');  
        $model->save();  
        return redirect('admin/models/'.$brand_id)->with(array('message'=> $model->model_name.' added successfully !!', 'color'=>'alert-success'));
    }

    /**
     * Display the specified models.
     */
    public function show(Models $models)
    {
        //
    }

    /**
     * Show the form for editing the specified model.
     */
    public function edit($brand_id,$id)
    {
        $model = Models::find($id);
        return view('admin.edit_model')->with(array('brand_id'=>$brand_id,'models'=>$model));
    }

    /**
     * Update the specified resource in model.
     */
    public function update(Request $request,$brand_id,$id)
    {
        //
        $models = Models::find($id);
        $models->brand_id = $brand_id;
        $models->model_name = $request->get('model_name');
        $models->save();
        return redirect('admin/models/'.$brand_id)->with(array('message'=> $models->model_name.' added successfully !!', 'color'=>'alert-warning'));
    }

    /**
     * Remove the specified resource from model.
     */
    public function destroy($id,$brand_id)
    {
        //
        $model_detail = Models::find($id);
        $model_name = $model_detail->model_name;
        Models::destroy($id);
        return redirect('admin/models/'.$brand_id)->with(array('message'=> $model_name.' Deleted successfully !!', 'color'=>'alert-danger'));
    }
}
