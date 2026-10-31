<div class="form-grid">
    <div class="form-group form-group--full">
        <label for="category_id" class="form-label">Kategori</label>
        <select id="category_id" name="category_id"
                class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
            <option value="">-- Pilih kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $product?->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <small class="form-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" id="sku" name="sku" value="{{ old('sku', $product?->sku) }}"
               class="form-control{{ $errors->has('sku') ? ' is-invalid' : '' }}">
        @error('sku')
            <small class="form-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="name" class="form-label">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product?->name) }}"
               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
        @error('name')
            <small class="form-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="unit" class="form-label">Satuan</label>
        <input type="text" id="unit" name="unit" value="{{ old('unit', $product?->unit ?? 'pcs') }}"
               class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}">
        @error('unit')
            <small class="form-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="min_stock" class="form-label">Batas stok minimum</label>
        <input type="number" id="min_stock" name="min_stock" min="0"
               value="{{ old('min_stock', $product?->min_stock ?? 0) }}"
               class="form-control{{ $errors->has('min_stock') ? ' is-invalid' : '' }}">
        @error('min_stock')
            <small class="form-error">{{ $message }}</small>
        @enderror
    </div>
</div>
