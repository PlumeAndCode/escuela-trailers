@props(['user'])

<div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg p-6 text-white shadow-md hover:bg-amber-600 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/50">
    <div class="flex items-center gap-4">
        <img src="{{ $user->profile_photo_url ?? asset('images/default-avatar.png') }}" 
             class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg" 
             alt="avatar">
        <div>
            <div class="font-bold text-lg">{{ $user->nombre_completo ?? ($user->name ?? 'Usuario') }}</div>
            <div class="text-amber-100 text-sm">{{ $user->email ?? '' }}</div>
            <div class="text-xs text-amber-50 mt-1 uppercase tracking-wide">{{ $user->rol ?? 'Usuario' }}</div>
        </div>
    </div>
</div>