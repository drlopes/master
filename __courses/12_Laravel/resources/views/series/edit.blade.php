<x-layout title="Edit Series '{{ $series->name }}'">

	<form class="" action="{{ route('series.update', $series) }}" method="post">
    	@csrf
    	@method('PUT')
    	<div class="mb-3">
        	<label for="name" class="form-label">Name:</label>
        	<input type="text"
            	id="name"
            	name="name"
            	class="form-control"
            	value="{{ $series->name }}">
    	</div>
    	<button type="submit" name="button" class="btn btn-primary">
      		<span>Save</span>
    	</button>
  	</form>

</x-layout>
