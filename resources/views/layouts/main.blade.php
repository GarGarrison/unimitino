@extends('layouts.app')

@section('content')
<!-- Menu -->
<div class="col s12 m5 l3">
    <div class="row">
        <div class="col s12">
            @section('important')

            @show
            <div class="card menu">
                @section('menu')
                    @if ( isset($rubrics) && isset($rubric_relations))
                        <?php $curlevel = 1; ?>
                        @foreach ($rubric_relations as $rubrel)
                            <?php $level = count(explode('#', $rubrel->rubric_parents)); 
                                  $icon = "";
                                  $class = "";
                                  if ($rubrel->has_child) {
                                    $icon="<i class='material-icons'>chevron_right</i>";
                                    $class = "menu-header";
                                  }
                            ?>
                            @if ($level > $curlevel)
                                <?php $curlevel = $level; ?>
                                <ul>
                            @elseif ( $level < $curlevel)
                                <?php
                                    echo str_repeat("</ul>", $curlevel-$level); 
                                    $curlevel = $level;
                                ?>
                            @endif
                            <li class="menu-item {{ $class }}"><a href="{{url('/show/'.$rubrel->rubric_id)}}">{{ $rubrics[$rubrel->rubric_id]}}</a>
                                {!! $icon !!}
                            </li>
                            
                        @endforeach
                    @endif
                @show
            </div>
        </div>    
    </div>
    
</div>
<!-- Content -->
<div class="col s12 m7 l9">
    <div class="row">
        <div class="col s12">
            <div class="main-container">
                @yield('main')
            </div>
        </div>
    </div>
</div>
@endsection
