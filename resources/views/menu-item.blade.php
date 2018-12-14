@if ($item['submenu'] == [])
    <li class="nav-item">
            <a href="{{ URL::asset('') }}{{ $item[url] }}" class="nav-link">
            <!---cabiar por el icono de la bd---->
            <i class="nav-icon fa fa-th"></i>
            <p>
                {{ $item['name'] }}
            </p>
        </a>
    </li>
@else
    <li class="nav-item has-treeview">
        <a href="{{ URL::asset($item['url']) }}" class="nav-link">
            <!---cabiar por el icono de la bd---->
            <i class="nav-icon fa {{ $item['icono'] }}"></i>
            <p>
                {{ $item['name'] }}
                <i class="right fa fa-angle-left"></i>
                <!--<span class="right badge badge-danger">New</span>-->
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach ($item['submenu'] as $submenu)
                @if ($submenu['submenu'] == [])
                <li class="nav-item">
                    <a href="{{ URL::asset($submenu['url']) }}" class="nav-link">
                      <i class="nav-icon fa {{ $submenu['icono'] }}"></i>
                      <p>{{ $submenu['name'] }}</p>
                    </a>
                </li>
                @else
                    @include('menu-item', [ 'item' => $submenu ])
                @endif
            @endforeach      
        </ul>
    </li> 
@endif