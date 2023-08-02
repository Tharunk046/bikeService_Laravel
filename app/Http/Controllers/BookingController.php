<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceMail;

class BookingController extends Controller
{
    /**
     * Display a listing of the Booking.
     */
    public function index()
    {
        $bookings = DB::table('bookings')->simplePaginate(5);
        return view('admin.bookings')->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new Booking.
     */
    public function create()
    {
        return view('booking');
    }

    /**
     * Store a newly created resource in Booking.
     */
    public function store(Request $request)
    {
        //
        $booking = new Booking();
        $booking->client_id = $request->get('client_id');
        $booking->name = $request->get('client_name');
        $booking->phone = $request->get('phone');
        $booking->email = $request->get('email');
        $booking->address = $request->get('address');
        $booking->brand = $request->get('brand');
        $booking->model = $request->get('model');
        $booking->reg_num = $request->get('reg_num');
        $booking->booking_date = $request->get('date');
        $services = implode(",", $request->get('services'));
        $booking->services = $services;
        $booking->save();
        $mailData = [
            'title' => 'Bike Service has been Booked !',
            'body' => 'service is booked on ' . $booking->booking_date . ' vechile number is ' . $booking->reg_num
        ];
        Mail::to('kstharun22@gmail.com')->send(new ServiceMail($mailData));
        return redirect('home')->with('status', 'service booked succesfully !!!');
    }

    /**
     * Display the specified Booking.
     */
    public function show($id)
    {
        $bookings = Booking::find($id);
        return view('admin/view_booking')->with('bookings', $bookings);
    }

    /**
     * Show the form for editing the specified Booking.
     */
    public function edit($id)
    {
        $booking = Booking::find($id);
        return view('admin/edit_bookings')->with('booking', $booking);
    }

    /**
     * Update the specified resource in Booking.
     */
    public function update(Request $request, $id)
    {
        //
        $bookings = Booking::find($id);
        $bookings->status = $request->get('status');
        if ($request->get('status') == 1 && $bookings->is_completed == 0) {
            $mailData = [
                'title' => 'Bike Service completed !',
                'body' => 'service of vechile number '.$bookings->reg_num.' is completed and ready for delivery'
            ];
            Mail::to($bookings->email)->send(new ServiceMail($mailData));
            $bookings->is_completed = 1;
        }
        $bookings->save();
        return redirect('admin/bookings/')->with(array("message" => "ID " . $id . " Status updated successfully !!", "color" => "alert-success"));
    }

    /**
     * Remove the specified resource from Booking.
     */
    public function destroy($id)
    {
        //
        Booking::destroy($id);
        return redirect('admin/bookings/')->with(array("message" => "ID " . $id . " Deleted successfully !!", "color" => "alert-danger"));
    }
    // to select the models based on brand id 
    public function getModels($id)
    {
        $models = Models::where('brand_id', $id)->pluck('id', 'model_name');
        return json_encode($models);
    }
    // to display the booking history of the user
    public function viewUserBookings()
    {
        $user_bookings = DB::table('bookings')->where('client_id', Auth::user()->id)->simplePaginate();
        return view('view_user_bookings')->with('user_bookings', $user_bookings);
    }
    // to view the particular booking detail of the booking
    public function viewBookingDetail($booking_id)
    {
        $booking_details = DB::table('bookings')->where('id', $booking_id)->get();
        return view('view_booking_detail')->with('booking_details', $booking_details);
    }
}
