<div class="card-item">
    <div class="card-item-body">
        <div class="card-item-desc">{{ $g->name }} <span class="vert-stick">|</span>{{ $g->description }}
        </div>
        <div class="card-item-info">
            <i class="material-icons right to-cart" data-id="{{ $g->id }}" title="В корзину">shopping_cart</i>
            <div class="goods-count">{{ $g->count }}</div>
            <div class="new-goods-price">{{ $g->price }}</div>                                    
        </div>
        <div class="card-more-info">
            Подбродное описание товара {{ $g->name }}
        </div>
    </div>
    <div class="card-item-bottom">
        <i class="material-icons" title="Подробнее">arrow_drop_down</i>
    </div>
</div>