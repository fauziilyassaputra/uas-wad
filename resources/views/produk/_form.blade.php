<div>
    <label for="category_id">Kategori</label>
    <select id="category_id" name="category_id">
        <option value="">-- Pilih kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $product?->category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <small style="color:red">{{ $message }}</small>
    @enderror
</div>

<div>
    <label for="sku">SKU</label>
    <input type="text" id="sku" name="sku" value="{{ old('sku', $product?->sku) }}">
    @error('sku')
        <small style="color:red">{{ $message }}</small>
    @enderror
</div>

<div>
    <label for="name">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name', $product?->name) }}">
    @error('name')
        <small style="color:red">{{ $message }}</small>
    @enderror
</div>

<div>
    <label for="unit">Satuan</label>
    <input type="text" id="unit" name="unit" value="{{ old('unit', $product?->unit ?? 'pcs') }}">
    @error('unit')
        <small style="color:red">{{ $message }}</small>
    @enderror
</div>

<div>
    <label for="min_stock">Batas stok minimum</label>
    <input type="number" id="min_stock" name="min_stock" min="0"
           value="{{ old('min_stock', $product?->min_stock ?? 0) }}">
    @error('min_stock')
        <small style="color:red">{{ $message }}</small>
    @enderror
</div>