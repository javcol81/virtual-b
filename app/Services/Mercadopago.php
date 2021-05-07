<?php

declare(strict_types=1);

namespace App\Services;

use App\Order;
use Exception;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;

final class Mercadopago
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        SDK::setAccessToken(config('mercadopago.access_token'));
    }

    public function generateCheckout(): string
    {
        return $this->preference();
    }

    private function preference(): string
    {
        $preference = new Preference();
        $preference->items = $this->items();
        $preference->payer = $this->payer();
        $preference->back_urls = [
            "success" => route('approval'),
            "pending" => route('pending'),
            "failure" => route('cancelled'),
        ];
        $preference->auto_return = "approved"; // Los pagos se marcaran como aprobados por default. Elimina esta linea si no queres que sea así.
        $preference->external_reference = $this->order->id;

        try {
            $preference->save();
        } catch (Exception $exception) {
            return '';
        }

        return $preference->id;
    }

    private function items(): array
    {
        $items = [];
        foreach ($this->order->lineItems() as $lineItem) {
            $item = new Item();
            $item->title = $lineItem->name;
            $item->description = $lineItem->description; // (opcional)
            $item->quantity = $lineItem->quantity;
            $item->unit_price = $lineItem->price;
            $item->currency_id = "ARS";
            $items[] = $item;
        }

        return $items;
    }

    private function payer(): Payer
    {
        // Estos datos se debería obtener de la orden o del usuario logueado.
        // Hacen que el pago se apruebe más rapido.
        $payer = new Payer();
        $payer->name = "Juan";
        $payer->surname = "Perez";
        $payer->email = "juan@hotmail.com";
        $payer->date_created = now();
        $payer->phone = [
            "area_code" => "011",
            "number" => "1198761234"
        ];

        $payer->identification = [
            "type" => "DNI",
            "number" => "12345678"
        ];

        $payer->address = [
            "street_name" => "Av. Rivadavia",
            "street_number" => 3801,
            "zip_code" => "1406"
        ];

        return $payer;
    }
}
