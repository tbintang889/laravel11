<x-admin.app title="{{ __('Role') }}" module="Setting">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Form Role') }}</h3>

        </div> <!-- /.card-header -->
        <div class="card-body">

            <form action="{{ isset($permission) ? route('permission.update', $permission) : route('permission.store') }}"
                method="POST">
                @csrf
                @if (isset($permission))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Nama Permission</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $permission->name ?? '') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit"
                    class="btn btn-primary">{{ isset($permission) ? 'Simpan Perubahan' : 'Simpan' }}</button>
            </form>
        </div>
    </div>
</x-admin.app>
