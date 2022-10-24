<x-layout title='Series'>
    <a href="{{route('series.create')}}" class="btn btn-dark mb-2">Add series</a>
    @isset($messageSuccess)
    <div class="alert alert-success">
        {{ $messageSuccess }}
    </div>
    @endisset
    <ul class="list-group">
        @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span> {{ $serie->name }} </span>
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
        </li>
        @endforeach
    </ul>
</x-layout>
