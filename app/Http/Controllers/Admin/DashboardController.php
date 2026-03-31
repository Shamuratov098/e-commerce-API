<?php

namespace App\Http\Controllers\Admin;

use App\Services\StatisticsService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly StatisticsService $statisticsService
    ) {}

    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $stats = $this->statisticsService->getDashboardStats();
        $dailyStats = $this->statisticsService->getDailyStats();
        $monthlyStats = $this->statisticsService->getMonthlyStats();
        $yearlyStats = $this->statisticsService->getYearlyStats();
        $recentOrders = $this->statisticsService->getRecentOrders(5);
        $recentUsers = $this->statisticsService->getRecentUsers(5);

        return $this->view('dashboard.index', compact(
            'stats',
            'dailyStats',
            'monthlyStats',
            'yearlyStats',
            'recentOrders',
            'recentUsers'
        ));
    }
}
