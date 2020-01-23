<?php namespace App\Repositories\Concrete\Eloquent;


use App\Repositories\Interfaces\SaleInterface;
use App\Role;
use App\Sale;
use App\User;
use Illuminate\Support\Facades\DB;

class ElSaleDal implements SaleInterface
{

    public function getAllSales()
    {
        return Sale::with('user.roles')->get();
    }

    public function getSalesByUserRole($userId, $roleId)
    {
        if ($roleId === Role::ROLE_SALES_MANAGER)
            return $this->getAllSales();
        elseif ($roleId === Role::ROLE_SALES_DIRECTOR)
            return $this->getSalesBySaleDirectorUserId($userId);
        elseif ($roleId === Role::ROLE_SALES_REPRESENTATIVE)
            return $this->getSalesBySaleRepresentativeUserId($userId);
        return null;
    }

    public function getSalesBySaleDirectorUserId($saleDirectorUserId)
    {
        return Sale::with(['user.roles', 'user.parentUser'])->whereHas('user', function ($query) use ($saleDirectorUserId) {
            $query->where(['parent' => $saleDirectorUserId])->orWhere('id', $saleDirectorUserId);
        })->get();
    }

    public function getSalesBySaleRepresentativeUserId($saleRepresentativeUserId, $subRepresentativeCount = 10)
    {
        $user = User::where('id', $saleRepresentativeUserId)->first();
        if ($user) {
            $lastSecondUsers = User::select('id')->whereDate('started_at', '>=', $user->started_at)->where('parent', $user->parent)->whereHas('roles', function ($qq) use ($saleRepresentativeUserId) {
                $qq->where(['type' => Role::ROLE_SALES_REPRESENTATIVE]);
            })->orderBy('started_at')->take(3)->pluck('id');
            return Sale::with('user.roles')->whereHas('user', function ($query) use ($lastSecondUsers, $saleRepresentativeUserId) {
                $query->whereIn('id', $lastSecondUsers);
            })->take($subRepresentativeCount)->get();
        }
        return null;
    }

    public function getUserSalePay($userId, $roleId)
    {
        if ($roleId === Role::ROLE_SALES_MANAGER)
            return $this->getManagerPay($userId);
        elseif ($roleId === Role::ROLE_SALES_DIRECTOR)
            return $this->getDirectorPay($userId);
        elseif ($roleId === Role::ROLE_SALES_REPRESENTATIVE)
            return $this->getRepresentativePay($userId);
        return null;
    }

    public function getManagerPay($managerUserId)
    {
        $managerUser = User::with('directors')->where('id', $managerUserId)->first();
        $directorsIdList = $managerUser->directors->pluck('id');
        if (!is_null($managerUser)) {
            $totalPrice = Sale::with(['user.roles', 'user.parentUser'])->whereHas('user', function ($query) use ($directorsIdList) {
                if (!is_null($directorsIdList))
                    $query->whereIn('parent', $directorsIdList);
            })->sum('price');
            return ((($totalPrice / 100) * 10) / 100) * 25;
        }
        return null;
    }

    public function getDirectorPay($directorUserId)
    {
        $directorUser = User::where('id', $directorUserId)->first();
        if (!is_null($directorUser)) {
            $totalPrice = Sale::with(['user.roles', 'user.parentUser'])->whereHas('user', function ($query) use ($directorUserId) {
                $query->where(['parent' => $directorUserId]);
            })->sum('price');
            return ($totalPrice / 100) * 10;
        }
        return null;
    }

    public function getRepresentativePay($repUserId)
    {
        $user = User::where('id', $repUserId)->first();
        if ($user) {
            $lastSecondUsers = Sale::select('user_id', DB::raw('sum(price) as totalPrice'))->groupBy('user_id')->with(['user.roles'])->whereHas('user', function ($query) use ($repUserId, $user) {
                $query->whereDate('started_at', '>', $user->started_at)->where(function ($qq) use ($user) {
                    $qq->where('parent', $user->parent);
                })->whereHas('roles', function ($qq) {
                    $qq->where(['type' => Role::ROLE_SALES_REPRESENTATIVE]);
                });
            })->get()->sortBy(function ($item, $key) {
                return $item->user->started_at;
            })->values()->take(2)->all();
            $pay = 0;
            foreach ($lastSecondUsers as $index => $user) {
                $pay += $index == 0 ? ($user->totalPrice / 100) * 10 : ($user->totalPrice / 100) * 5;
            }
            return $pay;
        }
        return null;
    }
}
