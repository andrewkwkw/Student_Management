@props(['user'])
@php
    use App\Models\PrakLap;
    use App\Models\PengajuanPembimbing;

    // --- SYARAT PRAKTIK LAPANG ---
    $syaratPLTerpenuhi = (strtolower($user->status_aktif) === 'aktif' && $user->jumlah_sks >= 128);

    $sudahDaftarPL = PrakLap::where('user_id_mhs_1', $user->id)
                            ->orWhere('user_id_mhs_2', $user->id)
                            ->orWhere('user_id_mhs_3', $user->id)
                            ->first();

    $prakLapSelesai = $sudahDaftarPL && $sudahDaftarPL->status_pelaksanaan === 'Selesai';

    // --- SYARAT SKRIPSI ---
    $syaratSkripsiTerpenuhi = ($prakLapSelesai && strtolower($user->status_aktif) === 'aktif' && $user->jumlah_sks >= 128);

    // --- SYARAT SK PEMBIMBING ---
    $pengajuanPembimbing = PengajuanPembimbing::where('user_id', $user->id)->first();
    $pengajuanPembimbingDiterima = $pengajuanPembimbing && $pengajuanPembimbing->status_pengajuan === 'Diterima';

    $syaratSkPembimbingTerpenuhi = ($pengajuanPembimbingDiterima && $prakLapSelesai && strtolower($user->status_aktif) === 'aktif');
@endphp

<div class="bg-white rounded-2xl shadow-md mt-6 border border-gray-200 p-6">
    <h3 class="text-2xl font-semibold mb-6">Notifikasi</h3>

    {{-- Error / Sukses umum --}}
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@elseif($syaratSkripsiTerpenuhi)
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">Anda memenuhi syarat untuk melakukan Pengajuan Pembimbing.</span>
    </div>
@elseif($sudahMengajukan ?? false)
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">Anda sudah melakukan Pengajuan Pembimbing.</span>
    </div>
@else
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">Anda belum memenuhi syarat untuk mengajukan Sidang Skripsi.</span>
    </div>
@endif

    {{-- Status Praktik Lapang --}}
    <div class="mt-4">
        @if($sudahDaftarPL)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">Anda sudah mendaftar Praktik Lapang. Status Pelaksanaan: {{ $sudahDaftarPL->status_pelaksanaan }}</span>
            </div>
        @elseif($syaratPLTerpenuhi)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <span class="block sm:inline">Anda memenuhi syarat untuk mengambil Praktik Lapang.</span>
            </div>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <span class="block sm:inline">Anda belum memenuhi syarat untuk mengambil Praktik Lapang.</span>
            </div>
        @endif
    </div>

    {{-- Status Pengajuan SK Pembimbing --}}
    <div class="mt-4">
        @if($syaratSkPembimbingTerpenuhi)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <span class="block sm:inline">Anda memenuhi syarat untuk mengajukan SK Pembimbing.</span>
            </div>
        @elseif($pengajuanPembimbing && $pengajuanPembimbing->status_pengajuan !== 'Diterima')
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative">
                <span class="block sm:inline">Pengajuan pembimbing Anda saat ini berstatus: {{ $pengajuanPembimbing->status_pengajuan }}.</span>
            </div>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <span class="block sm:inline">Anda belum memenuhi syarat untuk mengajukan SK Pembimbing.</span>
            </div>
        @endif
    </div>

    {{-- Catatan Admin --}}
    @if($user->admin_note)
        <div class="mt-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            <p><strong>Catatan dari Admin:</strong> {{ $user->admin_note }}</p>
        </div>
    @endif
</div>