<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if ($checkout)
                        <div class="checkout-container"></div>
                    @else
                        <p class="alert alert-danger">No se pudo cargar el proveedor de pagos.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('{{ config('mercadopago.public_key') }}', {
        locale: 'es-AR'
    });

    // Inicializa el checkout
    mp.checkout({
        preference: {
            id: '{{ $checkout }}'
        },
        render: {
            container: '.checkout-container', // Indica dónde se mostrará el botón de pago
            label: 'Pagar', // Cambia el texto del botón de pago (opcional)
        }
    });
</script>

