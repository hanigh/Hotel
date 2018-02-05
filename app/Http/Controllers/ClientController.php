<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;
use App\Reservation as Reservaiton;


class ClientController extends Controller
{
    //
    public $titles_array = [];

    public function __construct(Title $titles,Client $client,Reservaiton $reservation,Room $room)
    {
        $this->_titles = $titles;
        $this->_client=$client;
        $this->_reservation=$reservation;
        $this->_room=$room;

    }

    public function di(Request $request)
    {

     //   dd( $this->_room->getAvailablerooms("2018-01-01","2018-01-05"));
        $xx=$request->session()->get('key');

    return $xx;
    }
    public function index()
    {

        $data['xxx'] = $this->_client->all();



        return view('client/index', $data);

    }

    public function newClient(Request $request)
    {
        $data = [];

        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');


        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:5',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',

                ]
            );

            $this->_client->insert($data);

            return redirect('clients');
        }


        $data['titles'] = $this->_titles->all();
        $data['modify'] = 0;
        return view('client/form', $data);
    }

    public function create()
    {
        return view('client/create');
    }
    public function export()
    {
        $data=[];
        $data['clients'] = $this->_client->all();
        header('Content-Disposition:attachment;filename=export.pdf');
       // return "xxxxxxx";
        return view('client/export',$data);
    }

    public function show($client_id)
    {
        $data = [];
        $data['titles'] = $this->_titles->all();
        $data['modify'] = 1;
        $data['linkPost'] = route('update_client', ['client_id' => 1]);

        $client_data= $this->_client->find($client_id);
        $data['id']= $client_data->id;
        $data['name'] = $client_data->name;
        $data['last_name'] = $client_data->last_name;
        $data['title'] = $client_data->title;
        $data['address'] = $client_data->address;
        $data['zip_code'] = $client_data->zip_code;
        $data['city'] = $client_data->city;
        $data['state'] = $client_data->state;
        $data['email'] = $client_data->email;


        return view('client/form',$data);
    }


    public function modify(Request $request,$client_id)
    {
        $data = [];


        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');


        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:5',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',

                ]
            );

            $client_data = $this->_client->find($client_id);

            $client_data->title = $request->input('title');
            $client_data->name = $request->input('name');
            $client_data->last_name = $request->input('last_name');
            $client_data->address = $request->input('address');
            $client_data->zip_code = $request->input('zip_code');
            $client_data->city = $request->input('city');
            $client_data->state = $request->input('state');
            $client_data->email = $request->input('email');

            $client_data->save();

            return redirect('clients');
        }


        $data['titles'] = $this->_titles->all();
        $data['modify'] = 0;
        return view('client/form', $data);
    }

}
