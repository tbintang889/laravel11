<x-admin.app title="{{ __('Role') }}" module="Setting">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">{{ __('Role') }}</h3>
                </div>
                <div class="col-6"> <a href="{{ route('role.create') }}" target="_blank" rel="noopener noreferrer"
                        class="btn"> Tambah</a></div>
            </div>



        </div> <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped tbb">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Role</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $role->name }}</td>
                                <td> <a href="{{ route('role.edit', $role->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">Hapus</button>
                                    </form>
                                    <a href="{{ route('role.edit_permissions', $role) }}" class="btn btn-sm btn-info">Edit Permissions</a>
                                </td>

                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin.app>
