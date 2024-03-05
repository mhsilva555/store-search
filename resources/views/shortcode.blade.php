<div class="store-search-container">
    <h2 class="store-search-container-title">{{ __('ONDE COMPRAR', STORE_SEARCH_TEXTDOMAIN) }}</h2>

    <hr class="store-search-line">

    <div class="store-search-row">
        <div class="store-search-filter">
            <p>{{ __('Encontrar lojas próximas', STORE_SEARCH_TEXTDOMAIN) }}</p>
            <span class="first">{{ __('Coloque seu CEP, que indicaremos as lojas mais próximas de você!', STORE_SEARCH_TEXTDOMAIN) }}</span>

            <form class="store-search-inputs" id="form-store-search" method="POST">
                <input type="text" name="zipcode" id="zipcode" placeholder="00000-000">
                <button type="submit" id="button-store-search">Encontrar</button>
            </form>

            <span class="last">{{ __('Não encontrou o que procura?', STORE_SEARCH_TEXTDOMAIN) }} <a href="#">{{ __('Clique aqui!', STORE_SEARCH_TEXTDOMAIN) }}</a></span>

            <!-- Lista de Lojas -->
            <ul id="store-search-filter-results"></ul>
        </div>

        <div class="store-search-map">
            <div id="map" style="height: 489px; width: 100%;"></div>
        </div>
    </div>
</div>