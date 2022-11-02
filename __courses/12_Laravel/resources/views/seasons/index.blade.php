<x-layout title="{{ $_GET['name'] }}">

    <ul class="list-group">

        @foreach($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodes.index', ['season' => $season, 'name' => $_GET['name']]) }}">
                    <span> Season {{ $season->number }} </span>
                </a>
                <div class="badge bg-primary">
                    <span>{{ $season->numberOfWhatchedEpisodes() }} / {{ $season->episodes->count() }}</span>
                </div>
            </li>
        @endforeach

    </ul>

</x-layout>
