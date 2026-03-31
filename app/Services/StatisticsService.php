<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class StatisticsService
{
    /**
     * Get dashboard main statistics with progress.
     */
    public function getDashboardStats(): array
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 'active')->count();
        $productProgress = $totalProducts > 0 ? round(($activeProducts / $totalProducts) * 100) : 0;

        $totalOrders = Order::count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $orderProgress = $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100) : 0;

        $totalUsers = User::where('role', '!=', 'admin')->count();
        $newUsersThisMonth = User::where('role', '!=', 'admin')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $userProgress = $totalUsers > 0 ? round(($newUsersThisMonth / $totalUsers) * 100) : 0;

        $revenue = Order::where('status', 'delivered')->sum('total_amount');
        $revenueThisMonth = Order::where('status', 'delivered')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');
        $revenueProgress = $revenue > 0 ? round(($revenueThisMonth / $revenue) * 100) : 0;

        return [
            'products' => [
                'total' => $totalProducts,
                'active' => $activeProducts,
                'progress' => $productProgress,
            ],
            'orders' => [
                'total' => $totalOrders,
                'delivered' => $deliveredOrders,
                'progress' => $orderProgress,
            ],
            'users' => [
                'total' => $totalUsers,
                'new_this_month' => $newUsersThisMonth,
                'progress' => $userProgress,
            ],
            'revenue' => [
                'total' => $revenue,
                'this_month' => $revenueThisMonth,
                'progress' => $revenueProgress,
            ],
        ];
    }

    /**
     * Get daily statistics for the last 7 days.
     */
    public function getDailyStats(): array
    {
        $stats = [];
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M');

            $revenue = Order::where('status', 'delivered')
                ->whereDate('created_at', $date)
                ->sum('total_amount');

            $data[] = round($revenue, 2);
        }

        $stats['labels'] = $labels;
        $stats['data'] = $data;

        return $stats;
    }

    /**
     * Get monthly statistics for the current year.
     */
    public function getMonthlyStats(): array
    {
        $stats = [];
        $labels = [];
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->format('M');

            $revenue = Order::where('status', 'delivered')
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total_amount');

            $data[] = round($revenue, 2);
        }

        $stats['labels'] = $labels;
        $stats['data'] = $data;

        return $stats;
    }

    /**
     * Get yearly statistics for the last 5 years.
     */
    public function getYearlyStats(): array
    {
        $stats = [];
        $labels = [];
        $data = [];

        for ($i = 4; $i >= 0; $i--) {
            $year = Carbon::now()->subYears($i)->year;
            $labels[] = (string) $year;

            $revenue = Order::where('status', 'delivered')
                ->whereYear('created_at', $year)
                ->sum('total_amount');

            $data[] = round($revenue, 2);
        }

        $stats['labels'] = $labels;
        $stats['data'] = $data;

        return $stats;
    }

    /**
     * Get recent orders with user info.
     */
    public function getRecentOrders(int $limit = 5): Collection
    {
        return Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent users.
     */
    public function getRecentUsers(int $limit = 5): Collection
    {
        return User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
