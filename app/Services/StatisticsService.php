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
     * Calculate growth percentage between two values.
     */
    private function calcGrowth(float $current, float $previous): array
    {
        if ($previous <= 0) {
            return ['value' => 0, 'is_positive' => true];
        }

        $growth = round((($current - $previous) / $previous) * 100, 2);

        return [
            'value' => abs($growth),
            'is_positive' => $growth >= 0,
        ];
    }

    /**
     * Get dashboard main statistics with growth percentages.
     */
    public function getDashboardStats(): array
    {
        $now = Carbon::now();
        $thisMonth = $now->month;
        $thisYear = $now->year;
        $lastMonth = $now->copy()->subMonth()->month;
        $lastMonthYear = $now->copy()->subMonth()->year;

        // Products
        $totalProducts = Product::count();
        $productsThisMonth = Product::whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)->count();
        $productsLastMonth = Product::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)->count();

        // Orders
        $totalOrders = Order::count();
        $ordersThisMonth = Order::whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)->count();
        $ordersLastMonth = Order::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)->count();

        // Users
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $usersThisMonth = User::where('role', '!=', 'admin')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)->count();
        $usersLastMonth = User::where('role', '!=', 'admin')
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)->count();

        // Revenue (only delivered)
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');
        $revenueThisMonth = Order::where('status', 'delivered')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)->sum('total_amount');
        $revenueLastMonth = Order::where('status', 'delivered')
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)->sum('total_amount');

        return [
            'products' => [
                'total' => $totalProducts,
                'this_month' => $productsThisMonth,
                'growth' => $this->calcGrowth($productsThisMonth, $productsLastMonth),
            ],
            'orders' => [
                'total' => $totalOrders,
                'this_month' => $ordersThisMonth,
                'growth' => $this->calcGrowth($ordersThisMonth, $ordersLastMonth),
            ],
            'users' => [
                'total' => $totalUsers,
                'this_month' => $usersThisMonth,
                'growth' => $this->calcGrowth($usersThisMonth, $usersLastMonth),
            ],
            'revenue' => [
                'total' => $totalRevenue,
                'this_month' => $revenueThisMonth,
                'growth' => $this->calcGrowth((float) $revenueThisMonth, (float) $revenueLastMonth),
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
