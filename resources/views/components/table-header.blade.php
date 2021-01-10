@props(['name', 'sortable' => false])
<th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
    {{-- sortable --}}
    @if($sortable)
        @php
            $sortdirection = request()->get('sort_direction');
        @endphp
        <a href="{{ route(Route::currentRouteName(), ['sort' => $name, 'sort_direction' => ($sortdirection ?? 'desc') == 'asc' ? 'desc' : 'asc', 'page' => request()->get('page') ]) }}" class="flex">
            <span class="mr-2">{{ $slot }}</span>
            @if($name == request()->get('sort'))
                @switch($sortdirection)
                @case('asc')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-3 h-3 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" />
                      </svg>
                @break
                @case('desc')
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-3 h-3 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                  </svg>
                @break
                @endswitch
            @endif
        </a>
    @else
    {{-- no sorting --}}
        {{ $slot }}
    @endif
</th>