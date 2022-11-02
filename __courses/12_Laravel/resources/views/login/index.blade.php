<x-layout title="login">
    <div style="position: absolute; 
    top: 50%; left: 50%; 
    transform: translate(-50%, -50%); 
    border: solid 2px lightgrey;
    border-radius: 20px; 
    padding: 2.5rem;
    box-shadow: 6px 6px 10px rgb(145, 145, 145)">
    
        <form method="post">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">
                    <span>E-mail:</span>
                </label>
                <input type="email" name="email" id="email" class="form-control" autofocus required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">
                    <span>Password:</span>
                </label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                <span>Login</span>
            </button>
            <a href="{{ route('users.create') }}" class="btn btn-secondary mt-3">
                <span>Register</span>
            </a>
        </form>
    
    </div>
</x-layout>
