<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = DB::table('services')->simplePaginate(5);
        return view('admin/services')->with('services',$services);
    }

    /**
     * Show the form for creating a new services.
     */
    public function create()
    {
        return view('admin.create_service');
    }

    /**
     * Store a newly created resource in service.
     */
    public function store(Request $request)
    {
        $service = new Service;  
        $service->service_name =  $request->get('service_name');  
        $service->price = $request->get('price');  
        $service->save();  
        return redirect('admin/services')->with(array('message'=>$service->service_name.' added successfully !!', 'color'=>'alert-success'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($id)
    {
        //
        $service = Service::find($id);
        return view('admin.edit_service')->with('service',$service);
    }

    /**
     * Update the specified resource in service.
     */
    public function update(Request $request,$id)
    {
        //
        $service = Service::find($id);
        $service->service_name = $request->get('service_name');  
        $service->price = $request->get('price');  
        $service->save();
        return redirect('admin/services')->with(array('message'=>$service->service_name.' updated successfully !!', 'color'=>'alert-warning'));
    }

    /**
     * Remove the specified resource from service.
     */
    public function destroy($id)
    {
        $service_detail = Service::find($id);
        $service_name = $service_detail->service_name;
        Service::destroy($id);
        return redirect('admin/services/')->with(array('message'=> $service_name.' Deleted successfully !!', 'color'=>'alert-danger'));
    }
    // displaying list of services for users
    public function showService()
    {
        $services = DB::table('services')->simplePaginate(5);
        return view('display_services')->with('services',$services);
    }
}
