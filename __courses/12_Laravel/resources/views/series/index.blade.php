<x-layout title='Series'>
    <a href="series/create" class="btn btn-dark mb-2">Add series</a>
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between">
            <span> {{ $serie->name }} </span>
            <span>
                <a href="/series/update?id={{ $serie->id }}"class="btn btn-info btn-sm">Update</a>
                <a href="/series/destroy?id={{ $serie->id }}" class="btn btn-danger btn-sm">Delete</a>
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>
