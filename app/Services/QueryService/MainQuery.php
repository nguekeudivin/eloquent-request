<?php
namespace App\Services\QueryService;

class MainQuery extends Query
{
    protected $models = [
        "capital_provider" => \App\Models\CapitalProvider::class,
        "category" => \App\Models\Category::class,
        "customer" => \App\Models\Customer::class,
        "customer_complain" => \App\Models\CustomerComplain::class,
        "discount" => \App\Models\Discount::class,
        "financial_account" => \App\Models\FinancialAccount::class,
        "future" => \App\Models\Future::class,
        "inventory" => \App\Models\Inventory::class,
        "loan" => \App\Models\Loan::class,
        "order" => \App\Models\Order::class,
        "orderItem" => \App\Models\OrderItem::class,
        "payment" => \App\Models\Payment::class,
        "permission" => \App\Models\Permission::class,
        "product" => \App\Models\Product::class,
        "product_return" => \App\Models\ProductReturn::class,
        "rebate" => \App\Models\Rebate::class,
        "sale" => \App\Models\Sale::class,
        "sale_item" => \App\Models\SaleItem::class,
        "supplier_credit" => \App\Models\SupplierCredit::class,
        "task" => \App\Models\Task::class,
        "task_attribution" => \App\Models\TaskAttribution::class,
        "supplier" => \App\Models\Supplier::class,
        "user" => \App\Models\User::class,
        "warehouse" => \App\Models\Warehouse::class,
        'car' => \App\Models\Car::class,
        'delivery' => \App\Models\Delivery::class,
        'driver'=> \App\Models\Driver::class,
        'driving' => \App\Models\Driving::class,
        'localisation'=> \App\Models\Localisation::class,
        'position' => \App\Models\Position::class,
        'user_position' => \App\Models\UserPosition::class,
        'customer_deposit' => \App\Models\CustomerDeposit::class,
        'loan_payment' => \App\Models\LoanPayment::class,
        'van_load' => \App\Models\VanLoad::class,
        'load_item' => \App\Models\LoadItem::class,
        'van_return' => \App\Models\VanReturn::Class,
        'reception' => \App\Models\Reception::class,
        'reception_item' => \App\Models\ReceptionItem::class
    ];
}
