<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function approval(Request $request)
    {
        // Si queres podes guardar estos datos en la BD
        $respuesta = [
            'payment' => $request->input('payment_id'), // ID del pago de Mercado Pago.
            'status' => $request->input('status'), // status de Mercado Pago
            'order_id' => $request->input('external_reference'), // Order ID de tu sistema
            'merchant_order' => $request->input('merchant_order_id'), // ID de la orden de pago generada en Mercado Pago.
            'payment_type' => $request->input('payment_type'), // Medio de pago (ej. "credit_card")
        ];

        return "Pago procesado correctamen!";
    }

    public function pending()
    {
        //
    }

    public function cancelled()
    {
        //
    }
}
