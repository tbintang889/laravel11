<x-admin.app title="{{ __('Permission') }}" module="Setting">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">{{ __('Permission') }}</h3>
                </div>
                <div class="col-6"> <a href="{{ route('permission.create') }}" target="_blank" rel="noopener noreferrer"
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permission.edit', $permission) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('permission.destroy', $permission) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus permission ini?')">Hapus</button>
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
