<?php

namespace App\Http\Controllers\API\V1;

use App\Models\KepuasanCs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KepuasanCsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of customer satisfaction ratings per day and per user.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = DB::table('kepuasan_cs')
            ->join('users', 'kepuasan_cs.user_id', '=', 'users.id')
            ->join('kode_kantors', 'kepuasan_cs.kantor_id', '=', 'kode_kantors.id')
            ->select(
                'kepuasan_cs.id',
                'kepuasan_cs.tanggal',
                'kepuasan_cs.puas',
                'kepuasan_cs.tidak_puas',
                DB::raw('(kepuasan_cs.puas + kepuasan_cs.tidak_puas) as total_respon'),
                'users.name as nama_cs',
                'users.type as role',
                'users.id as user_id',
                'kode_kantors.nama_kantor',
                'kode_kantors.kode_kantor_slik as kode_kantor'
            );

        if ($request->has('fromtgl') && $request->fromtgl != '' && $request->has('totgl') && $request->totgl != '') {
            $query->whereBetween('kepuasan_cs.tanggal', [$request->fromtgl, $request->totgl]);
        }

        if ($request->has('kantor_id') && $request->kantor_id != '') {
            $query->where('kepuasan_cs.kantor_id', $request->kantor_id);
        }

        if ($request->has('role') && $request->role != '') {
            $query->where('users.type', $request->role);
        }

        if (!in_array($user->type, ['admin', 'pelayanan', 'akunting'])) {
            $query->where('kepuasan_cs.user_id', $user->id);
        }

        $data = $query->orderBy('kepuasan_cs.tanggal', 'desc')
            ->orderBy('kepuasan_cs.id', 'desc')
            ->get();

        return $this->sendResponse($data, 'Daftar Kepuasan CS & Teller');
    }

    /**
     * Increment vote PUAS or TIDAK PUAS for today for the logged-in user.
     */
    public function vote(Request $request)
    {
        $request->validate([
            'vote' => 'required|in:puas,tidak_puas',
        ]);

        $user = Auth::user();
        $today = date('Y-m-d');

        $record = KepuasanCs::firstOrCreate(
            [
                'user_id' => $user->id,
                'tanggal' => $today,
            ],
            [
                'kantor_id' => $user->kantor_id ?: 1,
                'puas' => 0,
                'tidak_puas' => 0,
            ]
        );

        if ($request->vote === 'puas') {
            $record->increment('puas');
            $message = 'Terima kasih! Suara PUAS berhasil ditambahkan.';
        } else {
            $record->increment('tidak_puas');
            $message = 'Suara TIDAK PUAS berhasil ditambahkan.';
        }

        $record->refresh();

        return $this->sendResponse([
            'record' => $record,
            'today' => $this->getTodayData($user->id),
        ], $message);
    }

    /**
     * Get today's stats for current user and overall.
     */
    public function todayStats()
    {
        $user = Auth::user();
        $todayData = $this->getTodayData($user->id);

        $totalAllToday = DB::table('kepuasan_cs')
            ->where('tanggal', date('Y-m-d'))
            ->selectRaw('SUM(puas) as total_puas, SUM(tidak_puas) as total_tidak_puas')
            ->first();

        return $this->sendResponse([
            'user_today' => $todayData,
            'all_today' => [
                'total_puas' => (int) ($totalAllToday->total_puas ?? 0),
                'total_tidak_puas' => (int) ($totalAllToday->total_tidak_puas ?? 0),
                'total' => (int) (($totalAllToday->total_puas ?? 0) + ($totalAllToday->total_tidak_puas ?? 0)),
            ],
        ], 'Statistik Hari Ini');
    }

    /**
     * Dashboard Summary endpoint with filter for Role, Month, and Year.
     */
    public function dashboardSummary(Request $request)
    {
        $currentMonth = $request->input('month', date('m'));
        $currentYear = $request->input('year', date('Y'));
        $roleFilter = $request->input('role', '');
        $kantorFilter = $request->input('kantor_id', '');

        // 1. Today summary
        $todayQuery = DB::table('kepuasan_cs')
            ->join('users', 'kepuasan_cs.user_id', '=', 'users.id')
            ->where('kepuasan_cs.tanggal', date('Y-m-d'));

        if ($roleFilter != '') {
            $todayQuery->where('users.type', $roleFilter);
        }
        if ($kantorFilter != '') {
            $todayQuery->where('kepuasan_cs.kantor_id', $kantorFilter);
        }

        $todayData = $todayQuery->selectRaw('SUM(kepuasan_cs.puas) as total_puas, SUM(kepuasan_cs.tidak_puas) as total_tidak_puas')
            ->first();

        $todayPuas = (int) ($todayData->total_puas ?? 0);
        $todayTidakPuas = (int) ($todayData->total_tidak_puas ?? 0);
        $todayTotal = $todayPuas + $todayTidakPuas;
        $todayPercentage = $todayTotal > 0 ? round(($todayPuas / $todayTotal) * 100, 1) : 0;

        // 2. Summary per User (CS / Teller) for the specified month & year & role & kantor
        $perUserQuery = DB::table('kepuasan_cs')
            ->join('users', 'kepuasan_cs.user_id', '=', 'users.id')
            ->join('kode_kantors', 'kepuasan_cs.kantor_id', '=', 'kode_kantors.id')
            ->whereMonth('kepuasan_cs.tanggal', $currentMonth)
            ->whereYear('kepuasan_cs.tanggal', $currentYear);

        if ($roleFilter != '') {
            $perUserQuery->where('users.type', $roleFilter);
        }
        if ($kantorFilter != '') {
            $perUserQuery->where('kepuasan_cs.kantor_id', $kantorFilter);
        }

        $perUser = $perUserQuery->select(
                'users.id as user_id',
                'users.name as nama_cs',
                'users.type as role',
                'kode_kantors.nama_kantor',
                'kode_kantors.kode_kantor_slik as kode_kantor',
                DB::raw('SUM(kepuasan_cs.puas) as total_puas'),
                DB::raw('SUM(kepuasan_cs.tidak_puas) as total_tidak_puas'),
                DB::raw('SUM(kepuasan_cs.puas + kepuasan_cs.tidak_puas) as total_respon')
            )
            ->groupBy('users.id', 'users.name', 'users.type', 'kode_kantors.nama_kantor', 'kode_kantors.kode_kantor_slik')
            ->orderBy('total_puas', 'desc')
            ->get()
            ->map(function ($item) {
                $total = (int) $item->total_respon;
                $puas = (int) $item->total_puas;
                $item->persentase_puas = $total > 0 ? round(($puas / $total) * 100, 1) : 0;
                return $item;
            });

        // 3. Summary per Day in the specified month & year & role & kantor
        $perDayQuery = DB::table('kepuasan_cs')
            ->join('users', 'kepuasan_cs.user_id', '=', 'users.id')
            ->whereMonth('kepuasan_cs.tanggal', $currentMonth)
            ->whereYear('kepuasan_cs.tanggal', $currentYear);

        if ($roleFilter != '') {
            $perDayQuery->where('users.type', $roleFilter);
        }
        if ($kantorFilter != '') {
            $perDayQuery->where('kepuasan_cs.kantor_id', $kantorFilter);
        }

        $perDay = $perDayQuery->select(
                'kepuasan_cs.tanggal',
                DB::raw('SUM(kepuasan_cs.puas) as total_puas'),
                DB::raw('SUM(kepuasan_cs.tidak_puas) as total_tidak_puas'),
                DB::raw('SUM(kepuasan_cs.puas + kepuasan_cs.tidak_puas) as total_respon')
            )
            ->groupBy('kepuasan_cs.tanggal')
            ->orderBy('kepuasan_cs.tanggal', 'desc')
            ->get()
            ->map(function ($item) {
                $total = (int) $item->total_respon;
                $puas = (int) $item->total_puas;
                $item->persentase_puas = $total > 0 ? round(($puas / $total) * 100, 1) : 0;
                return $item;
            });

        // 4. Overall Month Total
        $monthPuas = $perUser->sum('total_puas');
        $monthTidakPuas = $perUser->sum('total_tidak_puas');
        $monthTotal = $monthPuas + $monthTidakPuas;
        $monthPercentage = $monthTotal > 0 ? round(($monthPuas / $monthTotal) * 100, 1) : 0;

        return $this->sendResponse([
            'today' => [
                'puas' => $todayPuas,
                'tidak_puas' => $todayTidakPuas,
                'total' => $todayTotal,
                'persentase' => $todayPercentage,
            ],
            'month' => [
                'month_name' => date('F Y', mktime(0, 0, 0, (int)$currentMonth, 1, (int)$currentYear)),
                'puas' => $monthPuas,
                'tidak_puas' => $monthTidakPuas,
                'total' => $monthTotal,
                'persentase' => $monthPercentage,
            ],
            'per_cs' => $perUser,
            'per_day' => $perDay,
        ], 'Dashboard Summary Kepuasan');
    }

    /**
     * Helper to retrieve today's record for a specific user.
     */
    private function getTodayData($userId)
    {
        $today = date('Y-m-d');
        $record = KepuasanCs::where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        $puas = $record ? (int) $record->puas : 0;
        $tidakPuas = $record ? (int) $record->tidak_puas : 0;
        $total = $puas + $tidakPuas;

        return [
            'puas' => $puas,
            'tidak_puas' => $tidakPuas,
            'total' => $total,
        ];
    }

    /**
     * Update a kepuasan record (for Admin).
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->type !== 'admin') {
            return $this->sendError('Unauthorized access', [], 403);
        }

        $request->validate([
            'puas' => 'required|integer|min:0',
            'tidak_puas' => 'required|integer|min:0',
        ]);

        $record = KepuasanCs::findOrFail($id);
        $record->puas = (int) $request->puas;
        $record->tidak_puas = (int) $request->tidak_puas;
        $record->save();

        return $this->sendResponse($record, 'Data kepuasan berhasil diperbarui');
    }

    /**
     * Delete a kepuasan record (for Admin).
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->type !== 'admin') {
            return $this->sendError('Unauthorized access', [], 403);
        }

        $record = KepuasanCs::findOrFail($id);
        $record->delete();

        return $this->sendResponse(null, 'Data kepuasan berhasil dihapus');
    }
}
