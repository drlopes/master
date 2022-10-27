<x-layout title='New Series'>

    <form class="" action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-6">
                <label for="name" class="form-label">Name:</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       autofocus>
            </div>

            <div class="col-3">
                <label for="seasons" class="form-label">Number of seasons:</label>
                <input type="text"
                       id="seasons"
                       name="seasons"
                       class="form-control"
                       value="{{ old('seasons') }}">
            </div>

            <div class="col-3">
                <label for="episodes" class="form-label">Number of episodes per season:</label>
                <input type="text"
                       id="episodes"
                       name="episodes"
                       class="form-control"
                       value="{{ old('episodes') }}">
            </div>
        </div>
        <button type="submit" name="button" class="btn btn-primary">
            <span>Save</span>
        </button>
    </form>

</x-layout>
