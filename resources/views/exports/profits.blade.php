<div class="title" style="padding-bottom: 13px">
    <div style="text-align: center;;font-size: 15px">
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
            <th scope="col">الاجمالي</th>
        </tr>
    </thead>
    <tbody>
        @foreach($profits as $profit)
        <tr>
            <td>{{ $profit->created_at }}</td>
            <td>{{ $profit->transaction->invoice }}</td>
            <td class="text-end">{{ number_format($profit->total) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-end fw-bold" style="background-color: #e6e6e7;">الاجمالي</td>
            <td class="text-end fw-bold" style="background-color: #e6e6e7;">{{ number_format($total) }}</td>
        </tr>
    </tbody>
</table>
