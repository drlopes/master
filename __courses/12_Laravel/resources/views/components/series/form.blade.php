<form class="" action="{{ $action }}" method="post">
    @csrf
    @if($update)
    @method('PUT')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text"
               id="name"
               name="name"
               class="form-control"
               @isset($name) value="{{ $name }}" @endisset>
  </div>
  <button type="submit" name="button" class="btn btn-primary">
      <span>Save</span>
  </button>
</form>
