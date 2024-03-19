<div class="title" style="padding-bottom: 13px">
    <div style="text-align: center;text-transform: uppercase;font-size: 15px">
        نظام أبوحصان
    </div>
    <div style="text-align: center">
        Address: جنزور
    </div>
    <div style="text-align: center">
        Telp: 0912345678
    </div>
</div>
<table style="width: 100%">
    <thead>
        <tr style="background-color: #e6e6e7;">
            <th scope="col">التاريخ</th>
            <th scope="col">الفاتورة</th>
            <th scope="col">كاشير</th>
            <th scope="col">العميل</th>
            <th scope="col">الاجمالي</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->created_at }}</td>
            <td>{{ $sale->invoice }}</td>
            <td>{{ $sale->cashier->name ?? '' }}</td>
            <td>{{ $sale->customer->name ?? 'Umum' }}</td>
            <td class="text-end">{{ number_format($sale->grand_total) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-end fw-bold" style="background-color: #e6e6e7;">الاجمالي</td>
            <td class="text-end fw-bold" style="background-color: #e6e6e7;">{{ number_format($total) }}</td>
        </tr>
    </tbody>
</table>
