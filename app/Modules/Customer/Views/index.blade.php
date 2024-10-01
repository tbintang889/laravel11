<x-admin.app title="{{$title}}" module="{{ $module }}" menu="{{ $menu }}">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">{{$title}}  </h3>
                </div>
                <div class="col-6"> <a href="{{ route('customer.create') }}" target="_blank" rel="noopener noreferrer"
                        class="btn  btn-outline-primary ">+ Tambah</a></div>
            </div>



        </div> <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped tbb">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Email</th></th>
                            <th>Aksi</th>
                         

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                               
                                <td> <a href="{{ route('customer.edit', $customer->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</button>
                                    </form>

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
