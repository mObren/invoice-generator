<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class UserController extends Controller
{

    public function home() {
        $user = User::getCurrentUser();
        $invoices = Invoice::whereRelation('client', 'user_id', "=", $user->id);
        // dd($invoices);
        $totalIncome = 0;
        $totalDues = 0;

        $paidInvoices = $invoices->filter(request(['paid_from', 'paid_to']))->get();
        foreach ($paidInvoices as $paid) {
            // foreach ($paid->items as $item) {
            //     $totalIncome += $item->price * $item->quantity;
            // }
            $totalIncome += $paid->getTotalNumeric();
        }
        $notPaidInvoices = $invoices->where('status', 0)->with('items')->filter(request(['search_date_from', 'search_date_to']))->get();
        foreach ($notPaidInvoices as $notPaid) {
            // foreach ($notPaid->items as $item) {
            //     $totalDues += $item->price * $item->quantity;
            // }
            $totalDues += $notPaid->getTotalNumeric();

        }

        return view('home', [
            'income' => number_format($totalIncome, 2, ',', '.'),
            'dues' => number_format($totalDues, 2, ',', '.'),
        ]);
    }
    



    public function profile() {

    $user = User::getCurrentUser();
    $profile = User::with(['clients'])->where('id', $user->id)->get();

    return view('user.profile', [
        'user' => $profile[0]
    ]);
      
    }
}
