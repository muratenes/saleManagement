<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\SaleInterface;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    private $_saleService;

    public function __construct(SaleInterface $saleService)
    {
        $this->_saleService = $saleService;
    }

    public function list()
    {
        $user = auth()->user();
        if (!isset($user->roles[0]))
            return back()->withErrors('Kullanıcının rolü bulunamadığı için satışlar getirelemedi');
        $sales = $this->_saleService->getSalesByUserRole($user->id, $user->roles[0]->id);
        $pay = $this->_saleService->getUserSalePay($user->id, $user->roles[0]->id);
        $users = User::with('roles')->get();
        return view('admin.sales.listSales', compact('sales', 'pay', 'users'));
    }

    public function loginAsUser($id)
    {
        Auth::loginUsingId($id, true);
        return redirect()->route('sales');
    }
}
