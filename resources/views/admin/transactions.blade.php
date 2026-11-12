@extends('admin.layout')
@section('title', 'Transactions')
@section('heading', 'Transactions')
@section('content')
<section class="admin-panel"><div class="panel-heading"><div><span class="eyebrow">POINT OF SALE</span><h2>Record a sale</h2></div></div><form method="post" action="{{ route('admin.transactions.store') }}" class="sale-entry-form" id="sale-entry-form">@csrf<div id="sale-line-items"><div class="sale-line"><label>Product<select required name="items[0][product_id]"><option value="">Choose a product</option>@foreach($products as $product)<option value="{{ $product->id }}" data-stock="{{ $product->stock_quantity }}">{{ $product->name }} · {{ $product->brand }} · LKR {{ number_format($product->price_lkr) }} · {{ $product->stock_quantity }} in stock</option>@endforeach</select></label><label>Quantity<input required type="number" min="1" name="items[0][quantity]" value="1"></label></div></div><div class="sale-form-actions"><button type="button" class="filter-pill" id="add-sale-line">+ Add another item</button><button class="admin-primary">Complete sale and update stock</button></div></form></section>
<section class="admin-panel"><div class="panel-heading"><div><span class="eyebrow">SALES HISTORY</span><h2>Recent transactions</h2></div></div><div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Reference</th><th>Date</th><th>Items</th><th>Status</th><th>Total</th></tr></thead><tbody>@forelse($sales as $sale)<tr><td><strong>{{ $sale->reference }}</strong></td><td>{{ $sale->created_at->format('M j, Y · g:i a') }}</td><td>{{ $sale->items_count }}</td><td><span class="status-pill status-active">{{ ucfirst($sale->status) }}</span></td><td>LKR {{ number_format($sale->total_lkr) }}</td></tr>@empty<tr><td colspan="5" class="muted-copy">No transactions recorded yet. Completed POS sales will appear here.</td></tr>@endforelse</tbody></table></div><div class="admin-pagination">{{ $sales->links() }}</div></section>
<script>
    const lineItems = document.querySelector('#sale-line-items');
    document.querySelector('#add-sale-line')?.addEventListener('click', () => {
        const index = lineItems.children.length;
        const row = lineItems.firstElementChild.cloneNode(true);
        row.querySelectorAll('select, input').forEach((field) => {
            field.name = field.name.replace(/items\[\d+\]/, `items[${index}]`);
            if (field.tagName === 'SELECT') field.selectedIndex = 0;
            else field.value = 1;
        });
        lineItems.append(row);
    });
</script>
@endsection
