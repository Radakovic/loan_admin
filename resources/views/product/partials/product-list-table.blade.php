<table class="border-collapse border border-slate-500 w-full">
    <thead>
    <tr>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Client name</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Product type</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Product value</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Created</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr class="text-center">
            <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                {{ $product->client->first_name }} {{ $product->client->last_name }}
            </td>
            <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $product->type }}</td>
            <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $product->productValue }}</td>
            <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $product->created_at->format('Y-m-d') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
