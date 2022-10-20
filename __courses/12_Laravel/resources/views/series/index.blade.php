<x-layout title='Series'>
    <a href="series/create" class="btn btn-dark mb-2">Add series</a>
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item" style="display: flex; align-items: center;">
            <span style="margin-right: auto"> {{ $serie }} </span>
            <div style="cursor: pointer">
                <a href="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ $serie }}" target="_blank"> 
                    <img src="https://chart.googleapis.com/chart?chs=60x60&cht=qr&chl={{ $serie }}" alt="QRCode"></img>
                </a>
            </div>
        </li>
        @endforeach
    </ul>
</x-layout>
