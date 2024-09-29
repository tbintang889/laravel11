<x-admin.app title="{{ __('Role') }}" module="Setting">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Form Role') }}</h3>

        </div> <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ isset($role) ? route('role.update', $role->id) : route('role.store') }}" method="POST">
                @csrf
                @if (isset($role))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Nama Role</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $role->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tambahkan field lain sesuai kebutuhan -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">{{ isset($role) ? 'Update' : 'Simpan' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-admin.app>
