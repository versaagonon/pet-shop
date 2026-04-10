<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                 <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('doctor.dashboard') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Beranda</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Daftar Hewan</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-2xl font-bold text-slate-800">Direktori Pasien</h2>
            </div>
            <a href="{{ route('doctor.pets.create') }}" class="btn-mewah">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Pasien
            </a>
        </div>
    </x-slot>

    <div class="flex flex-col gap-6">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl font-bold text-sm flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="enterprise-table-container">
            <table class="table-enterprise">
                <thead>
                    <tr>
                        <th>Nama Hewan</th>
                        <th>Jenis</th>
                        <th>Pemilik</th>
                        <th>Umur / Jenis Kelamin</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pets as $pet)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center font-bold text-slate-400 text-sm">
                                        {{ substr($pet->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-700 leading-tight">{{ $pet->name }}</span>
                                        <span class="text-[10px] font-bold text-slate-400">ID: {{ $pet->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="px-2.5 py-1 bg-slate-100 rounded-md text-[10px] font-bold text-slate-500 uppercase tracking-widest border border-slate-200">
                                    {{ $pet->type }}
                                </span>
                            </td>
                            <td class="text-slate-600 font-medium">{{ $pet->owner->name }}</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-slate-500">{{ $pet->age ?? '-' }}</span>
                                    <span class="w-2 h-2 rounded-full {{ $pet->gender === 'male' ? 'bg-blue-400' : 'bg-rose-400' }}"></span>
                                    <span class="text-[10px] font-bold uppercase text-slate-400">{{ $pet->gender === 'male' ? 'Jantan' : 'Betina' }}</span>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('doctor.pets.edit', $pet) }}" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit Profil">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <a href="{{ route('doctor.medical-records.create', ['pet_id' => $pet->id]) }}" class="p-2 text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 rounded-lg transition-all" title="Catatan Medis Baru">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center text-slate-300">
                                <p class="font-bold text-sm uppercase tracking-widest">Tidak Ada Pasien Tercatat</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
