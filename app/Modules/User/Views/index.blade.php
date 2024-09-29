<x-admin.app title="{{ __('User') }}" module="Setting">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">{{ __('User') }}</h3>
                </div>
                <div class="col-6"> <a href="{{ route('user.create') }}" target="_blank" rel="noopener noreferrer"
                        class="btn"> Tambah</a></div>
            </div>



        </div> <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table tbb">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</x-admin.app>
