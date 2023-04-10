<x-mail::message>

    <head>
        <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    </head>
    <div class="p-6">
        <div class="rounded h-full">
            <div class="bg-blue-950 rounded-t text-white text-center p-2">
                <p class="">Merci {{$client->name}} pour l'achat, ci-joint vos tickets</p>
            </div>
        </div>
    </div>
</x-mail::message>