<x-layout title='Series'>
    <a href="{{route('series.create')}}" class="btn btn-dark mb-2">Add series</a>
    @isset($messageSuccess)
    <div class="alert alert-success">
        {{ $messageSuccess }}
    </div>
    @endisset
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span> {{ $serie->name }} </span>
            <form class="" action="{{ route('series.destroy', $serie) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit" name="button">
                    <span>Delete</span>
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</x-layout>
