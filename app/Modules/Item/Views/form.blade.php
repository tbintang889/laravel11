<x-admin.app title="{{$title }}" module="{{ $module }}" menu={{ $menu }}>
    <div class="card">
        <div class="card-header">

        </div> <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ isset($item) ? route('item.update', $item) : route('item.store') }}" method="POST">
                @csrf
                @if (isset($item))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Nama item</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $item->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Category </label>
                    <select name="category" id="category"  class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ old('name', $item->name ?? '') == $category ? "selected" : "" }} >{{ $category }} </option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group">
                    <label for="name">Harga satuan</label>
                    <input type="text" class="form-control" id="unit_price" name="unit_price"
                        value="{{ old('unit_price', $item->unit_price ?? '') }}">
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
                    <button type="submit" class="btn btn-primary">{{ isset($item) ? 'Update' : 'Simpan' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-admin.app>
