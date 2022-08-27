<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" data-lang="{{ App::getLocale() }}">
    <head>
        @include("Shared::Layouts.Partials.head")
    </head>
    <body>
        <div class="content-wrapper">
            <main>
                <div class="container content_container">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
