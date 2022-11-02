<x-layout title="Register new user">
    
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">
                <span>Name:</span>
            </label>
            <input type="text" name="name" id="name" class="form-control" autofocus required>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">
                <span>E-mail:</span>
            </label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">
                <span>Password:</span>
            </label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="form-label">
                <span>Confirm your password:</span>
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            <span>Register</span>
        </button>
    </form>

</x-layout>