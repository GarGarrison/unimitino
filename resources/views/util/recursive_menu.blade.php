@php($children = array_keys($relations_dict, $parentID))
@if(count($children) > 0)
    <ul>
        @foreach($children as $i => $id)
            @if($relations_by_id[$id]["has_child"])
                <li class="menu-item menu-header">
                    {{ $rubrics_dict[$id]["name"] }}
                    <i class='material-icons'>chevron_right</i>
                </li>
            @else
                <a href="{{url('/rubric/'.$id.'/'.$rubrics_dict[$id]['url']) }}">
                    <li class="menu-item">{{ $rubrics_dict[$id]["name"] }}</li>
                </a>
            @endif
            @include('util/recursive_menu', ["parentID" => $id])
        @endforeach
    </ul>
@endif
