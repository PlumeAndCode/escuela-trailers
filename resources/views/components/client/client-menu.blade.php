@props(['user'])

<nav class="flex flex-col h-[calc(100vh-200px)]">
    <ul class="space-y-2 flex-1">
        <!-- Botón PÁGINA PRINCIPAL -->
        <li>
            <a href="{{ route('home') }}" 
               class="menu-btn flex items-center justify-center px-3 py-2 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 text-sm"
               style="background-color: transparent; color: white; box-shadow: none;"
               onmouseover="this.style.backgroundColor='#374151'; this.style.boxShadow='0 0 25px rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(-2px)';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                <span>PÁGINA PRINCIPAL</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('client.dashboard') }}" 
               class="menu-btn flex items-center justify-center px-3 py-2 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 text-sm"
               style="@if(request()->routeIs('client.dashboard')) background-color: #1F2937; color: white; box-shadow: 0 0 20px rgba(255, 255, 255, 0.6); @else background-color: transparent; color: white; box-shadow: none; @endif"
               onmouseover="@if(!request()->routeIs('client.dashboard')) this.style.backgroundColor='#374151'; this.style.boxShadow='0 0 25px rgba(255, 255, 255, 0.8)'; @endif this.style.transform='translateY(-2px)';"
               onmouseout="@if(!request()->routeIs('client.dashboard')) this.style.backgroundColor='transparent'; this.style.boxShadow='none'; @endif this.style.transform='translateY(0)';">
                <span>INICIO</span>
            </a>
        </li>
        <li>
            <a href="{{ route('client.payment-history') }}" 
               class="menu-btn flex items-center justify-center px-3 py-2 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 text-sm"
               style="@if(request()->routeIs('client.payment-history')) background-color: #1F2937; color: white; box-shadow: 0 0 20px rgba(255, 255, 255, 0.6); @else background-color: transparent; color: white; box-shadow: none; @endif"
               onmouseover="@if(!request()->routeIs('client.payment-history')) this.style.backgroundColor='#374151'; this.style.boxShadow='0 0 25px rgba(255, 255, 255, 0.8)'; @endif this.style.transform='translateY(-2px)';"
               onmouseout="@if(!request()->routeIs('client.payment-history')) this.style.backgroundColor='transparent'; this.style.boxShadow='none'; @endif this.style.transform='translateY(0)';">
                <span>PAGOS</span>
            </a>
        </li>
        <li>
            <a href="{{ route('client.services') }}" 
               class="menu-btn flex items-center justify-center px-3 py-2 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 text-sm"
               style="@if(request()->routeIs('client.services')) background-color: #1F2937; color: white; box-shadow: 0 0 20px rgba(255, 255, 255, 0.6); @else background-color: transparent; color: white; box-shadow: none; @endif"
               onmouseover="@if(!request()->routeIs('client.services')) this.style.backgroundColor='#374151'; this.style.boxShadow='0 0 25px rgba(255, 255, 255, 0.8)'; @endif this.style.transform='translateY(-2px)';"
               onmouseout="@if(!request()->routeIs('client.services')) this.style.backgroundColor='transparent'; this.style.boxShadow='none'; @endif this.style.transform='translateY(0)';">
                <span>SERVICIOS</span>
            </a>
        </li>
        <li>
            <a href="{{ route('client.progress') }}" 
               class="menu-btn flex items-center justify-center px-3 py-2 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 text-sm"
               style="@if(request()->routeIs('client.progress')) background-color: #1F2937; color: white; box-shadow: 0 0 20px rgba(255, 255, 255, 0.6); @else background-color: transparent; color: white; box-shadow: none; @endif"
               onmouseover="@if(!request()->routeIs('client.progress')) this.style.backgroundColor='#374151'; this.style.boxShadow='0 0 25px rgba(255, 255, 255, 0.8)'; @endif this.style.transform='translateY(-2px)';"
               onmouseout="@if(!request()->routeIs('client.progress')) this.style.backgroundColor='transparent'; this.style.boxShadow='none'; @endif this.style.transform='translateY(0)';">
                <span>AVANCES</span>
            </a>
        </li>
    </ul>

    <div class="mt-auto pt-4 pb-2">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center px-3 py-2 rounded-lg font-bold uppercase tracking-wider transition-all duration-300 text-sm"
                    style="background-color: transparent; color: white; box-shadow: none;"
                    onmouseover="this.style.backgroundColor='#ef4444'; this.style.color='#ffffff'; this.style.boxShadow='0 0 25px rgba(239, 68, 68, 0.8)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#ffffff'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                <span>SALIR</span>
            </button>
        </form>
    </div>
</nav>