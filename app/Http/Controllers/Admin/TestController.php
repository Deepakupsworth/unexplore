<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; // ✅ IMPORTANT (missing tha)

class TestController extends Controller
{
    public function backfillPackageId()
    {
        try {

            DB::beginTransaction(); // 🔥 safer

            $updated = DB::affectingStatement("
                UPDATE package_day_items pdi
                JOIN package_days pd ON pd.id = pdi.package_day_id
                SET pdi.package_id = pd.package_id
                WHERE pdi.package_id IS NULL
            ");

            DB::commit();

            return back()->with(
                'success',
                "Package IDs updated successfully. Rows affected: {$updated}"
            );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Update failed: ' . $e->getMessage()
            );
        }
    }
}
