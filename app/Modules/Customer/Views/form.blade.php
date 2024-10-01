<x-admin.app title="{{$title }}" module="{{ $module }}" menu={{ $menu }}>
    <div class="card">
        <div class="card-header">

        </div> <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ isset($customer) ? route('customer.update', $customer) : route('customer.store') }}" method="POST">
                @csrf
                @if (isset($customer))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Nama </label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $customer->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                 <div class="form-group">
                    <label for="name">Alamat </label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', $customer->address ?? '') }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">No Telpon </label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $customer->phone ?? '') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label for="name">email </label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $customer->email ?? '') }}">
                    @error('email')
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
                    <button type="submit" class="btn btn-primary">{{ isset($customer) ? 'Update' : 'Simpan' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-admin.app>
