

@extends('layouts.app4')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Mis ordenes</div>

				<div class="card-body">
					@if(session('message'))
					<div class="alert alert-success">
						{{ session('message') }}
					</div>
					@endif

					@if($orders->count() == 0)
					<p>Sin orden todavia.</p>
					<a href="{{route('home')}}" class="btn btn-success">Pedir ahora</a>
					@else

				<Order-Alert user_id="{{ auth()->user()->id }}"></Order-Alert>

					<div class="table table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Dirección</th>
									
									<th>Instrucciones del pedido</th>
									
									
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
									<tr>
										<td> {{$order->id}} </td>
										<td> {{$order->address}} </td>
										
										<td> {{$order->instructions}} </td>
										
										
										<td><a href="{{route('user.order.show', $order)}}">{{$order->status->name}}</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection