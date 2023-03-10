@extends('layouts.app')

@section('content')

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        {{--        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">--}}
{{--        <svg class="mx-auto h-12 w-auto xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400.4 87.1"><path d="M450.6,383.8H440.3V339.3H452l10.3,9.4v14l-11.7-10.6Zm24.7-23.3L487,371V339.3h10.2v44.5H485.7l-10.4-9.3Z" transform="translate(-440.3 -339.3)" style="fill:#1b1464"/><path d="M509.7,381.1a10.6,10.6,0,0,1-3.9-6.9V349.3a9.1,9.1,0,0,1,1.5-3.7,13.5,13.5,0,0,1,2.7-3.2,15.7,15.7,0,0,1,3.8-2.2,11.8,11.8,0,0,1,4.6-.9h38.2V349H522.2c-4,0-6.1,1.6-6.1,4.7v2.8H541v9.8H516.1a18.8,18.8,0,0,0,.1,2.9v.6c0,2.9,2,4.3,5.8,4.3h34.8v9.7H518.4q-5.5,0-8.7-2.7" transform="translate(-440.3 -339.3)" style="fill:#1b1464"/><polygon points="161.5 0.2 187.7 34.7 187.7 0 198.1 0 198.1 44.4 182 44.4 161.5 17.3 141.1 44.4 125 44.4 125 0 135.3 0 135.3 34.7 161.5 0.2" style="fill:#1b1464"/><path d="M661.3,373.9a4.3,4.3,0,0,1-2.3-.9,3.4,3.4,0,0,1-1.3-1.9,9.6,9.6,0,0,1-.4-3.2V339.3H646.9v32.4a11.8,11.8,0,0,0,3.4,8.9,12.8,12.8,0,0,0,8.9,3.2h37.9v-9.7H664.5l-3.2-.2" transform="translate(-440.3 -339.3)"/><rect x="265.4" width="10.4" height="14.39"/><path d="M734.9,353.7v-4.6h29.5c3.9,0,6.1,1.5,6.6,4.4v.2h10.1v-1.5a15.5,15.5,0,0,0-1.5-5.3,15,15,0,0,0-3-4,12.3,12.3,0,0,0-4-2.7,12,12,0,0,0-4.5-.9H724.7v14.4Z" transform="translate(-440.3 -339.3)"/><path d="M800,353.7h0c0-3.1,2-4.7,6.1-4.7h34.4v-9.7H802.3a11.8,11.8,0,0,0-4.6.9,15.7,15.7,0,0,0-3.8,2.2,16.9,16.9,0,0,0-2.8,3.2,10.5,10.5,0,0,0-1.4,3.7v4.4Z" transform="translate(-440.3 -339.3)"/><path d="M805.9,374.1c-3.8,0-5.7-1.4-5.8-4.2H789.7v4.3a10.6,10.6,0,0,0,3.9,6.9q3.1,2.7,8.7,2.7h38.3v-9.7Z" transform="translate(-440.3 -339.3)"/><rect x="330.7" y="30.6" width="10.2" height="13.87"/><rect x="284.4" y="30.6" width="10.3" height="13.87"/><rect x="265.4" y="30.6" width="10.4" height="13.87"/><rect x="265.4" y="17.2" width="119.2" height="10.58" style="fill:#c1272d"/><polygon points="84.5 56.5 89.4 56.5 105.5 77.3 105.5 56.5 110.7 56.5 110.7 86.6 106.3 86.6 89.7 65.2 89.7 86.6 84.5 86.6 84.5 56.5"/><polygon points="118.4 56.5 140.8 56.5 140.8 61.2 123.7 61.2 123.7 69 138.8 69 138.8 73.8 123.7 73.8 123.7 81.9 141 81.9 141 86.6 118.4 86.6 118.4 56.5"/><polygon points="154.7 61.4 145.1 61.4 145.1 56.5 169.6 56.5 169.6 61.4 160 61.4 160 86.6 154.7 86.6 154.7 61.4"/><polygon points="172.8 56.5 178.6 56.5 185.7 78.8 193.1 56.4 197.6 56.4 205 78.8 212.2 56.5 217.8 56.5 207.3 86.8 202.7 86.8 195.3 65.2 187.9 86.8 183.3 86.8 172.8 56.5"/><path d="M660.5,411h0a15.8,15.8,0,0,1,31.5-.1h0a15.8,15.8,0,0,1-31.5.1m25.9,0h0c0-5.9-4.2-10.7-10.2-10.7S666,405,666,410.8h0c0,5.8,4.3,10.7,10.3,10.7s10.1-4.8,10.1-10.6" transform="translate(-440.3 -339.3)"/><path d="M698.4,395.8h13.4c3.8,0,6.8,1.1,8.7,3a9.2,9.2,0,0,1,2.5,6.5h0c0,5-3,7.9-7.2,9.1l8.2,11.4h-6.3l-7.4-10.5h-6.6v10.5h-5.3Zm13,15c3.8,0,6.2-2,6.2-5.1h0c0-3.2-2.3-5-6.2-5h-7.7v10.2Z" transform="translate(-440.3 -339.3)"/><polygon points="289.2 56.5 294.5 56.5 294.5 71.6 308.8 56.5 315.3 56.5 302.8 69.4 315.9 86.6 309.5 86.6 299.2 73 294.5 77.9 294.5 86.6 289.2 86.6 289.2 56.5"/></svg>--}}
        <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900">Por favor espera mientras conectamos tu dispositivo.</h2>
        <div class="flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-40 h-40 text-green-200 ">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    @include('layouts.notifications')

@endsection


@section('script')

    <script type="text/javascript">
        setTimeout(function(){
            window.location.reload(1);
        }, 5000);
    </script>

@endsection
