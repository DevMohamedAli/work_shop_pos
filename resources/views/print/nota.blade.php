<html moznomarginboxes mozdisallowselectionprint style="direction: rtl" dir="rtl" lang="ar" xml:lang="ar"

<head>
    <title>
        Purchase Note
    </title>
    <style type="text/css">
        html {
            font-family: "Verdana";
        }

        .content {
            width: 80mm;
            font-size: 10px;
            padding: 20px;
        }

        .content .title {
            text-align: center;
        }

        .content .head-desc {
            margin-top: 10px;
            display: table;
            width: 100%;
        }

        .content .head-desc>div {
            display: table-cell;
        }

        .content .head-desc .user {
            text-align: right;
        }

        .content .nota {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .content .separate {
            margin-top: 10px;
            margin-bottom: 15px;
            border-top: 1px dashed #000;
        }

        .content .transaction-table {
            width: 100%;
            font-size: 10px;
        }

        .content .transaction-table .name {
            /*//width: 185px;*/
        }

        .content .transaction-table .qty {
            /*//text-align: center;*/
            /*width: 65px;*/
        }

        .content .transaction-table .sell-price {
            /*//text-align: right;*/
            width: 65px;
            text-align: right;
        }

        .content .transaction-table .final-price {
            text-align: right;
        }

        .content .transaction-table tr td {
            vertical-align: top;
        }

        .content .transaction-table .price-tr td {
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .content .transaction-table .discount-tr td {
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .content .transaction-table .separate-line {
            height: 1px;
            border-top: 1px dashed #000;
        }

        .content .thanks {
            margin-top: 25px;
            text-align: center;
        }

        .content .azost {
            margin-top: 5px;
            text-align: center;
            font-size: 10px;
        }
/*
        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        } */
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
        }
    </style>
    <script>
        window.print();
        window.onafterprint = function() {
            setTimeout(function() {
                window.close();
            }, 1000);
        }
    </script>
</head>

<body>
    <div class="content">
        <div class="title" style="padding-bottom: 13px">
            <div style="text-align: center;text-transform: uppercase;font-size: 15px">
                نظام أبوحصان
            </div>
            <div style="text-align: center">
                Address: محمد علي أبوحصان
            </div>
            <div style="text-align: center">
                Telp: 0912345678
            </div>
        </div>

        <div class="separate-line" style="border-top: 1px dashed #000;height: 1px;margin-bottom: 5px"></div>
        <table class="transaction-table" cellspacing="0" cellpadding="0">
            <tr>
                <td>التاريخ</td>
                <td>:</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
            <tr>
                <td>الفاتورة</td>
                <td>:</td>
                <td>{{ $transaction->invoice }}</td>
            </tr>
            <tr>
                <td>الكاشير</td>
                <td>:</td>
                <td>{{ $transaction->cashier->name ?? '' }}</td>
            </tr>
            <tr>
                <td>العميل</td>
                <td>:</td>
                <td>{{ $transaction->customer->name ?? 'General' }}</td>
            </tr>
        </table>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <tr class="price-tr">
                    <td colspan="3">
                        <div class="separate-line" style="border-top: 1px dashed #000;"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line" style="border-top: 1px dashed #000;"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line" style="border-top: 1px dashed #000;"></div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">المنتج</td>
                    <td style="text-align: center">النوع</td>
                    <td style="text-align: center">الكمية</td>
                    <td style="text-align: right" colspan="5">الفاتورة</td>
                </tr>
                <tr class="price-tr">
                    <td colspan="3">
                        <div class="separate-line" style="border-top: 1px dashed #000;"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line" style="border-top: 1px dashed #000;"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line" style="border-top: 1px dashed #000;"></div>
                    </td>
                </tr>
                @foreach ($transaction->details as $item)
                <tr>
                    <td class='name'>{{ $item->title }}</td>
                    <td class='type' style='text-align: center'>{{ ($item->type == 'product') ? 'قطع غيار' : 'خدمات' }}</td>
                    <td class='qty' style='text-align: center'>{{ $item->qty }}</td>
                    <td class='final-price' style='text-align: right' colspan="5">{{ number_format($item->price) }}</td>
                </tr>
                @endforeach
                <tr class="price-tr">
                    <td colspan="3">
                        <div class="separate-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="final-price">
                        الاجمالي
                    </td>
                    <td colspan="3" class="final-price">
                        :
                    </td>
                    <td class="final-price">
                        {{ number_format($transaction->grand_total) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="final-price">
                        الخصم
                    </td>
                    <td colspan="3" class="final-price">
                        :
                    </td>
                    <td class="final-price">
                        {{ number_format($transaction->discount) }}
                    </td>
                </tr>

                <tr class="discount-tr">
                    <td colspan="3">
                        <div class="separate-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="separate-line"></div>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" class="final-price">
                        كاش
                    </td>
                    <td colspan="3" class="final-price">
                        :
                    </td>
                    <td class="final-price">
                        {{ number_format($transaction->cash) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="final-price">
                        CHANGE
                    </td>
                    <td colspan="3" class="final-price">
                        :
                    </td>
                    <td class="final-price">
                        {{ number_format($transaction->change) }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            =====================================
        </div>
        <div class="azost" style="margin-top: 5px">
            <div style="text-align: center">
                شكرا لزيارتكم
            </div>
            <div style="text-align: center">
                Thank you for your visit
            </div>
        </div>
    </div>
</body>

</html>
