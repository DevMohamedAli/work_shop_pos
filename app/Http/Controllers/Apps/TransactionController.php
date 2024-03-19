<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vehicle;
use App\Models\Product;
use App\Models\Service;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\EmployeeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TransactionController extends Controller
{
    public function index()
    {
        // get Vehicle
        $vehicles = Vehicle::where('cashier_id', auth()->user()->id)->latest()->get();

        // get all customers
        $customers = Customer::latest()->get();
        //  get all Products
        $products = Product::latest()->get();
        //  get all services
        $services = Service::latest()->get();
        // get all employees
        $employees = Employee::latest()->get();
        // get all categories
        $categories = Category::latest()->get();

        return Inertia::render('Apps/Transactions/Index', [
            'vehicles' => $vehicles,
            'customers' => $customers,
            'products' => $products,
            'services' => $services,
            'employees' => $employees,
            'categories' => $categories
        ]);
    }
     // Backend controller method to get category products
     public function getCategoryProducts(Request $request)
     {

         $category_id = $request->category_id;
         $products = Product::where('category_id', $category_id)->get();

         if ($products->isNotEmpty()) {
             return response()->json([
                 'success' => true,
                 'data' => $products
             ]);
         } else {
             return response()->json([
                 'success' => false,
                 'data' => null
             ]);
         }
     }

    public function searchProduct(Request $request)
    {
        // find product by barcode
        $product = Product::where('barcode', $request->barcode)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        }

        return response()->json([
            'success' => false,
            'data' => null
        ]);
    }

    public function submit(Request $request)
    {

        dd($request->all());
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|integer',
            'products.*.qty' => 'required|integer',
            'products.*.price' => 'required|numeric'

        ]);
        foreach ($request->products as $product) {
            $product = Product::find($product['id']);
            if ($product->stock < $product['qty']) {
                return redirect()->back()->with('error', 'Product ' . $product->name . ' is out of stock');
            }
        }
        Vehicle::create([
            'cashier_id' => auth()->user()->id,
            'customer_id' => $request->customer_id,
            'products' => $request->products,
            'services' => $request->services,
            'employees' => $request->employees
        ]);


        return redirect()->route('apps.transactions.index')->with('success', 'Product added successfully');

    }

    // public function store(Request $request)
    // {

    //     dd($request->all());
    //     /**
    //      * algorithm for generating invoice number
    //      */
    //     $length = 10;
    //     $random = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $random .= rand(0,1) ? rand(0,9) : chr(rand(ord('a'), ord('z')));
    //     }

    //     // generate invoice number
    //     $invoice = 'TRX-' . Str::upper($random);

    //     // insert transaction
    //     $transaction = Transaction::create([
    //         'cashier_id' => auth()->user()->id,
    //         'customer_id' => $request->customer_id,
    //         'invoice' => $invoice,
    //         'cash' => $request->cash,
    //         'change' => $request->change,
    //         'discount' => $request->discount,
    //         'grand_total' => $request->grand_total
    //     ]);
    //         // Insert product transaction details
    // foreach ($request->car_form['products'] as $product) {
    //     $transaction->details()->create([
    //         'transaction_id' => $transaction->id,
    //         'product_id' => $product['id'],
    //         'qty' => $product['qty'],
    //         'price' => $product['sell_price']
    //     ]);
    // }
    //        // Insert service transaction details and employee-service relationships
    // foreach ($request->car_form['services'] as $service) {
    //     $serviceTransactionDetail = $transaction->serviceTransactionDetails()->create([
    //         'transaction_id' => $transaction->id,
    //         'service_id' => $service['id'],
    //         'qty' => 1, // Update this if your services can have different quantities
    //         'price' => $service['price']
    //     ]);

    //     foreach ($request->car_form['employees'] as $employee) {
    //         EmployeeService::create([
    //             'employee_id' => $employee['id'],
    //             'service_transaction_detail_id' => $serviceTransactionDetail->id
    //         ]);
    //     }
    // }
    //     // get vehicles
    //     $vehicles = Vehicle::where('cashier_id', auth()->user()->id)->get();

    //     // insert transaction detail
    //     foreach ($vehicles as $Vehicle) {
    //         // insert transaction detail
    //         $transaction->details()->create([
    //             'transaction_id' => $transaction->id,
    //             'product_id' => $Vehicle->product_id,
    //             'qty' => $Vehicle->qty,
    //             'price' => $Vehicle->price
    //         ]);

    //         // get price
    //         $total_buy_price = $Vehicle->product->buy_price * $Vehicle->qty;
    //         $total_sell_price = $Vehicle->product->sell_price * $Vehicle->qty;

    //         // get profits
    //         $profits = $total_sell_price - $total_buy_price;

    //         // insert profits
    //         $transaction->profits()->create([
    //             'transaction_id' => $transaction->id,
    //             'total' => $profits
    //         ]);

    //         // update stock products
    //         $product = Product::find($Vehicle->product_id);
    //         $product->stock -= $Vehicle->qty;
    //         $product->save();
    //     }



    //     // delete vehicles
    //     Vehicle::where('cashier_id', auth()->user()->id)->delete();

    //     return response()->json([
    //         'success' => true,
    //         'data' => $transaction
    //     ]);
    // }
    public function store(Request $request)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'cash' => 'required|numeric',
            'change' => 'required|numeric',
            'discount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'car_form.products.*.id' => 'required',
            'car_form.products.*.qty' => 'required|numeric',
            'car_form.products.*.sell_price' => 'required|numeric',
            'car_form.services.*.id' => 'required',
            'car_form.services.*.price' => 'required|numeric',
            'car_form.employees.*.id' => 'required',

        ]);

        // Algorithm for generating invoice number
        $invoiceNumber = 'TRX-' . Str::upper(Str::random(10));

        // Start transaction
        DB::beginTransaction();
        try {
            // Insert transaction
            $transaction = Transaction::create([
                'cashier_id' => auth()->user()->id,
                'customer_id' => $validatedData['customer_id'],
                'invoice' => $invoiceNumber,
                'cash' => $validatedData['cash'],
                'change' => $validatedData['change'],
                'discount' => $validatedData['discount'],
                'grand_total' => $validatedData['grand_total']
            ]);

            // Calculate grand total

            // Insert product transaction details
            foreach ($validatedData['car_form']['products'] as $product) {
                $transaction->product_details()->create([
                    'product_id' => $product['id'],
                    'qty' => $product['qty'],
                    'price' => $product['sell_price']
                ]);
            }

            // Insert service transaction details and employee-service relationships
            foreach ($validatedData['car_form']['services'] as $service) {
                $serviceTransactionDetail = $transaction->service_details()->create([
                    'service_id' => $service['id'],
                    'qty' => 1, // Update this if your services can have different quantities
                    'price' => $service['price']
                ]);

                foreach ($validatedData['car_form']['employees'] as $employee) {
                    EmployeeService::create([
                        'employee_id' => $employee['id'],
                        'service_transaction_detail_id' => $serviceTransactionDetail->id
                    ]);
                }
            }

            $products = $request->car_form['products'];
            $_p_profits = 0;
            $_s_profit = 0;
            $_employee_commission = 0;
            foreach ( $products as $product) {
                $qty = $product['qty'];
                $product = Product::find($product['id']);
                if ($product->stock < $product['qty']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Product ' . $product->name . ' is out of stock'
                    ], 400);
                }
                $product->decrement('stock', $qty);
                $_p_profits += ($product['sell_price'] - $product['buy_price']) * $product['qty'];
            }

            foreach ($request->car_form['services'] as $service) {
                $_s_profit += $service['price'];
            }

            // cut employees commissions from profits commission_rate flot value 20.00 = 20% cut every employee commission from _s_profit

            $employees = $request->car_form['employees'];
            foreach ($employees as $employee) {
                $employee = Employee::find($employee['id']);
                $_employee_commission += $_s_profit * $employee->commission_rate / 100;
                // $employee->increment('commission', $_s_profit * $employee->commission_rate / 100);
            }
            // Insert profits
            $transaction->profits()->create([
                'transaction_id' => $transaction->id,
                'total' => $_p_profits + $_s_profit - $_employee_commission
            ]);

            // Commit transaction
            DB::commit();

            // Delete vehicles
            Vehicle::where('cashier_id', auth()->user()->id)->delete();

            return response()->json([
                'success' => true,
                'data' => $transaction
            ]);
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function print(Request $request)
    {
        // Retrieve the transaction with related product details, service details, cashier, and customer
        $transaction = Transaction::with('product_details.product', 'service_details.service', 'cashier', 'customer')
            ->where('invoice', $request->invoice)
            ->firstOrFail();

        // Merge product_details.product and service_details.service into one array store service_details.service.0.name as 'title'
        // Add a 'type' attribute to each item to differentiate between product and service

        $transaction->details = collect($transaction->product_details)->merge($transaction->service_details)->map(function ($item) {
            if (isset($item->product)) {
                $item->title = $item->product->title;
                $item->type = 'product';
            } else {
                $item->title = $item->service->name;
                $item->type = 'service';
            }
            return $item;
        });






        // dd($transaction);

        // Pass the transaction data to the view
        return view('print.nota', compact('transaction'));
    }

}
