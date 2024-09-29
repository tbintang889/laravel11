<x-admin.app title="{{ __('Role') }}" module="Setting">
<div class="container">
    <h2>Edit Permissions untuk Role: {{ $role->name }}</h2>

    <form action="{{ route('role.update_permissions', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]"
                           value="{{ $permission->name }}" id="permission_{{ $permission->id }}"
                           {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
</x-admin.app>
