<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Distributor;
use Illuminate\Database\QueryException;

class DistributorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $distributors = DB::table('distributor')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nama_distributor', 'like', "%{$search}%")
                      ->orWhere('telepon', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('be.pages.distributor', compact('distributors'));
    }

    public function destroy($id)
    {
        try {
            Distributor::destroy($id);
            $user = auth('web')->user();
            $route = ($user && $user->jabatan === 'apotekar') ? 'be.apotekar.distributor' : 'be.admin.distributor';
            return redirect()->route($route)->with('success', 'Distributor berhasil dihapus');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                $user = auth('web')->user();
                $route = ($user && $user->jabatan === 'apotekar') ? 'be.apotekar.distributor' : 'be.admin.distributor';
                return redirect()->route($route)->with('error', 'Kamu tidak bisa menghapus data ini dikarenakan data ini tersambung ke data lain. Silahkan hapus data yang tersambung terlebih dahulu.');
            }
            throw $e;
        }
    }
}
