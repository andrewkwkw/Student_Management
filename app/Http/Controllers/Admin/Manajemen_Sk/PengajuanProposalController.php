<?php

namespace App\Http\Controllers\Admin\Manajemen_Sk;

use App\Http\Controllers\Controller;
use App\Models\PengajuanProposal;
use Illuminate\Http\Request;

class PengajuanProposalController extends Controller
{
    public function show(Request $request)
    {
        $query = PengajuanProposal::with('user')->latest();

        // 🔍 Jika ada pencarian
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            })
            ->orWhere('nilai_proposal', 'like', "%{$search}%");
        }

        $proposals = $query->get();

        return view('admin.manajemen_sk.pengajuan_proposal.show', compact('proposals'));
    }

    public function edit($id)
    {
        $proposal = PengajuanProposal::findOrFail($id);
        
        return view('admin.manajemen_sk.pengajuan_proposal.edit', compact('proposal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_proposal' => 'nullable|string|max:255',
        ]);
        
        $proposal = PengajuanProposal::findOrFail($id);

        $proposal->nilai_proposal = $request->input('nilai_proposal');
        $proposal->save();

        return redirect()->route('admin.manajemen_sk.pengajuan_proposal.show', $proposal->id)
                         ->with('success', 'Nilai proposal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $proposal = PengajuanProposal::findOrFail($id);

        $proposal->delete();

        return redirect()->route('admin.manajemen_sk.pengajuan_proposal.show')
                         ->with('success', 'Data proposal berhasil dihapus.');
    }
}
