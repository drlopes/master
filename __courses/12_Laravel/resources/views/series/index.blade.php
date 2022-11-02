<x-layout title='Series' :message-success="$messageSuccess">

    @auth
        <a href="{{route('series.create')}}" class="btn btn-dark mb-2">Add new series</a>
    @endauth
    <ul class="list-group">
        @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            @auth <a href="{{ route('seasons.index', ['series' => $serie, 'name' => $serie->name]) }}"> @endauth 
                {{ $serie->name }} 
            @auth </a> @endauth
            @auth
                <div class="d-flex gap-1">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                  <span>Edit</span>
                </a>

                <form action="{{ route('series.destroy', $serie) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="name" value="{{ $serie->name }}">
                    <button class="btn btn-danger btn-sm" type="submit" name="button">
                        <span>Delete</span>
                    </button>
                </form>
            </div>
            @endauth
        </li>
        @endforeach
    </ul>

</x-layout>
