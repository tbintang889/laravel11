<x-admin.app title="{{ __('User') }}" module="Setting">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Form User') }}</h3>

        </div> <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ isset($user) ? route('user.update', $user) : route('user.store') }}" method="POST">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $user->name ?? '') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $user->email ?? '') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" {{ isset($user) ? '' : 'required' }}>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        {{ isset($user) ? '' : 'required' }}>
                </div>
                <div class="form-group">
                    <label>Roles</label>
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                                id="role_{{ $role->id }}"
                                {{ isset($user) && $user->hasRole($role) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <button type="submit"
                    class="btn btn-primary">{{ isset($user) ? 'Simpan Perubahan' : 'Simpan' }}</button>
            </form>
        </div>
    </div>
</x-admin.app>
