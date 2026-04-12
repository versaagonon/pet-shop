<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h2>
            <p class="vethub-breadcrumb">Products / {{ isset($product) ? 'Edit' : 'Add New' }}</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST">
                @csrf
                @if(isset($product)) @method('PUT') @endif
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Product Name</label>
                        <input type="text" name="name" value="{{ $product->name ?? old('name') }}" placeholder="e.g. Obat Cacing Cat" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Category</label>
                            <select name="category" required>
                                <option value="Antiparasit" {{ (isset($product) && $product->category == 'Antiparasit') ? 'selected' : '' }}>Antiparasit</option>
                                <option value="Antibiotik" {{ (isset($product) && $product->category == 'Antibiotik') ? 'selected' : '' }}>Antibiotik</option>
                                <option value="Vitamin" {{ (isset($product) && $product->category == 'Vitamin') ? 'selected' : '' }}>Vitamin</option>
                                <option value="Suplemen" {{ (isset($product) && $product->category == 'Suplemen') ? 'selected' : '' }}>Suplemen</option>
                                <option value="Grooming" {{ (isset($product) && $product->category == 'Grooming') ? 'selected' : '' }}>Grooming</option>
                                <option value="Makanan" {{ (isset($product) && $product->category == 'Makanan') ? 'selected' : '' }}>Makanan</option>
                                <option value="Lainnya" {{ (isset($product) && $product->category == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label>Unit</label>
                            <select name="unit" required>
                                <option value="unit" {{ (isset($product) && $product->unit == 'unit') ? 'selected' : '' }}>unit</option>
                                <option value="tablet" {{ (isset($product) && $product->unit == 'tablet') ? 'selected' : '' }}>tablet</option>
                                <option value="tube" {{ (isset($product) && $product->unit == 'tube') ? 'selected' : '' }}>tube</option>
                                <option value="botol" {{ (isset($product) && $product->unit == 'botol') ? 'selected' : '' }}>botol</option>
                                <option value="sachet" {{ (isset($product) && $product->unit == 'sachet') ? 'selected' : '' }}>sachet</option>
                                <option value="kg" {{ (isset($product) && $product->unit == 'kg') ? 'selected' : '' }}>kg</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
                        <div>
                            <label>Selling Price (IDR)</label>
                            <input type="number" name="price" value="{{ $product->price ?? old('price') }}" placeholder="0" min="0" required>
                        </div>
                        <div>
                            <label>Bought Price (IDR)</label>
                            <input type="number" name="bought_price" value="{{ $product->bought_price ?? old('bought_price') }}" placeholder="0" min="0" required>
                        </div>
                        <div>
                            <label>Stock</label>
                            <input type="number" name="stock" value="{{ $product->stock ?? old('stock', 0) }}" placeholder="0" min="0" required>
                        </div>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.products.index') }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">{{ isset($product) ? 'Save Changes' : 'Add Product' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
