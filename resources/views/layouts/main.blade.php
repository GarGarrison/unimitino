@extends('layouts.app')

@section('content')
<!-- Menu -->
<div class="col s12 m4 l3">
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
                                  if ($rubrel->has_child) $icon="<i class='material-icons'>chevron_right</i>";
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
                            @if ($level == 1)
                                <div class="menu-item menu-header" name="{{$rubrel->rubric_id}}">{{ $rubrics[$rubrel->rubric_id]}}
                                {!! $icon !!}
                                </div>
                            @else
                                <li class="menu-item"><a href="{{url('/show/'.$rubrel->rubric_id)}}">{{ $rubrics[$rubrel->rubric_id]}}</a>
                                {!! $icon !!}
                                </li>
                            @endif
                        @endforeach
                    @endif
                @show
            </div>
        </div>    
    </div>
    
</div>
<!-- Content -->
<div class="col s12 m8 l9">
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="main-container">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
