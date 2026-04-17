<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): Response
    {
        $user = auth()->user();
        $user->load('role');

        $stats = $this->getStatsForRole($user);

        return Inertia::render('Dashboard', [
            'stats' => $stats,
        ]);
    }

    /**
     * Get dashboard statistics based on user role.
     */
    private function getStatsForRole($user): array
    {
        $baseStats = [
            'total_sma' => \App\Models\Organization::sma()->active()->count(),
            'total_smk' => \App\Models\Organization::smk()->active()->count(),
            'total_mata_pelajaran' => \App\Models\MataPelajaran::active()->count(),
        ];

        if ($user->isAdmin()) {
            $baseStats['total_users'] = \App\Models\User::count();
            $baseStats['total_organizations'] = \App\Models\Organization::smaSmk()->active()->count();
        }

        if ($user->isOperatorDikda()) {
            $baseStats['total_organizations'] = \App\Models\Organization::smaSmk()->active()->count();
        }

        return $baseStats;
    }
}
