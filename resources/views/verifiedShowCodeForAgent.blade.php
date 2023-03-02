@extends('layouts.app')

@section('content')

    @include('layouts.notifications')

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
{{--        do we want to show the logo?--}}
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Por favor muestre este codigo en el punto de venta</h2>
        <h3 class="mt-6 text-center text-8xl text-gray-600">
            {{ session('sessionCode') }}
        </h3>

        <p class="mt-6 text-center text-lg text-gray-600">
            Cuando le indiquen en el punto de compra presione el siguiente boton.
        </p>

        <form action="{{ route('access.connect') }}" method="post">
            @csrf
            @method('post')
            <p class="text-center mt-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('access.show_code') }}">
                    Revisar conexion
                </button>
            </p>
        </form>

    </div>

@endsection
