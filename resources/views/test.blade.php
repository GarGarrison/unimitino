<?php $level = 0; ?>
<ul>
@foreach ($rubric_relations as $rubrel)
    <?php $buflevel = count(explode('#', $rubrel['rubric_parents'])); ?>
    @if ($buflevel > $level)
        <?php $level = $buflevel; ?>
        <ul>
    @elseif ( $buflevel < $level)
        <?php $level = $buflevel;?>
        </ul>
    @endif
    <li> {{ $rubrel['rubric_parents'] }} </li>
@endforeach
</ul>