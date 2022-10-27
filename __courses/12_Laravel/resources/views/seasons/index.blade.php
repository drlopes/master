<x-layout title="{{ $_GET['seriesName'] }}'s Seasons">

    <ul class="list-group">

        @foreach($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span> Season {{ $season->number }} </span>
                <div class="badge bg-secondary">
                    <span>{{ $season->episodes->count() }}</span>
                </div>
            </li>
        @endforeach

    </ul>

</x-layout>
