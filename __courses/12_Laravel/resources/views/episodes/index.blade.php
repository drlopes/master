<x-layout title="Season {{ $seasonNumber }}" :message-success="$messageSuccess">

    <form method="post">
        @csrf

        <ul class="list-group">

            @foreach($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span>Episode {{ $episode->number }}</span>
                    </div>
                    <div>
                        <input 
                            type="checkbox" 
                            name="episodes[]" 
                            value="{{ $episode->id }}"
                            @if ($episode->watched)
                                checked
                            @endif />
                    </div>
                </li>
            @endforeach

        </ul>

        <button type="submit" class="btn btn-primary mt-2 mb-2">Save</button>

    </form>

</x-layout>
