<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Jobs\SendOrderMailJob;
use App\Models\Client;
use App\Models\OrderDetails;
use App\Models\Ticket;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Nette\Utils\Random;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $tickets = [];
        $client = null;

        DB::transaction(function () use ($request, &$client, &$tickets) {

            $client = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
            ]);

            $order = Order::create([
                'total_amount' => $request->total_amount,
                'client_id' => $client->id,
            ]);

            OrderDetails::create([
                'quantity' => $request->quantity,
                'unit_price' => $request->pass['price'],
                'pass_id' => $request->pass['id'],
                'order_id' => $order->id,
            ]);

            for ($i = 0; $i < $request->quantity; $i++) {
                $ticket = Ticket::create([
                    'code' => 'pass' . Random::generate(28),
                    'event_id' => $request->event_id,
                    'order_id' => $order->id,
                ]);

                array_push($tickets, $ticket);
            }
        });

        SendOrderMailJob::dispatch($client, $tickets);

        return Inertia::render('Qrcode/Index', [
            'tickets' => $tickets,
            'client' => $client
        ])->with('success', 'Ticket(s) acheter avec succes !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
