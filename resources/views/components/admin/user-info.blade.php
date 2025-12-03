@props(['user'])

<div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg p-3 text-white shadow-md hover:bg-amber-600 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/50">
    <div class="flex items-center gap-2">
        <img src="{{ $user->profile_photo_url ?? asset('images/default-avatar.png') }}" 
             class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-lg flex-shrink-0" 
             alt="avatar">
        <div class="min-w-0 flex-1">
            <div class="font-bold text-sm truncate">{{ $user->nombre_completo ?? ($user->name ?? 'Usuario') }}</div>
            <div class="text-amber-100 text-xs truncate" title="{{ $user->email ?? '' }}">{{ $user->email ?? '' }}</div>
            <div class="text-xs text-amber-50 uppercase tracking-wide">
                @if($user->rol ?? null)
                    {{ $user->rol }}
                @elseif($user->roles ?? null)
                    @foreach($user->roles as $role)
                        {{ $role->name }}@if(!$loop->last), @endif
                    @endforeach
                @else
                    Usuario
                @endif
            </div>
        </div>
    </div>
</div>