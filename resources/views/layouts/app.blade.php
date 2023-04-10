<html>

    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>

        @vite('resources/js/app.js')

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body id=@yield('body_id')>

        <main class="container papper" style="display: none">

            <x-row>

                <div class="col-sm-3 pb-5 px-0 align-items-center justify-content-start border-end rounded-start d-flex flex-column">
                    <x-row class="mt-5">
                        <x-col class="text-center">

                            <x-circle-photo>
                                <img width="100px"
                                    src="data:image/png;base64,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"
                                    alt="" class="t">
                            </x-circle-photo>
                        </x-col>
                    </x-row>
                    <x-row>
                        <x-col>
                            <h4 class="mt-3">Convidado</h4>
                        </x-col>
                    </x-row>
                    <x-row class="w-100 mt-5">
                        <x-col class="px-0">
                            <ul class="nav flex-column text-center">
                                <li class="nav-item mx-3  my-1">
                                    <a class="nav-link link-dark btn btn-outline-primary {{ Route::is('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="nav-item mx-3  my-1">
                                    <a class="nav-link link-dark btn btn-outline-primary {{ Route::is('income.index') ? 'active' : '' }}" href="{{ route('income.index') }}">Proventos</a>
                                </li>
                                <li class="nav-item mx-3  my-1">
                                    <a class="nav-link link-dark btn btn-outline-primary {{ Route::is('expense.index') ? 'active' : '' }}" href="{{ route('expense.index') }}">Despesas</a>
                                </li>
                            </ul>
                        </x-col>
                    </x-row>
                </div>

                @yield('content')

            </x-row>
        <main>

    </body>
</html>
