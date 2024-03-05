@php
$json = file_get_contents(STORE_SEARCH_PLUGIN_PATH . "/storage/json/cidades.json");
$cities = json_decode($json);
@endphp

<div class="modal fade modal-new-store" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="form-new-store">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Nova Loja', STORE_SEARCH_TEXTDOMAIN) }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="text" class="form-control p-1 mb-2" name="store_name" placeholder="{{ __('Nome da Loja', STORE_SEARCH_TEXTDOMAIN) }}">
                    <div class="search-cities">
                        <input type="text" class="form-control p-1 mb-2 store_city" name="store_city" placeholder="{{ __('Cidade', STORE_SEARCH_TEXTDOMAIN) }}">
                        <ul class="list-cities">
                            @foreach($cities as $city)
                                <li>{{$city->Nome}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <input type="text" class="form-control p-1 mb-2" name="store_address" placeholder="{{ __('Endereço da Loja', STORE_SEARCH_TEXTDOMAIN) }}">
                    <input type="text" class="form-control p-1 mb-2" name="store_lat" placeholder="{{ __('Latitude', STORE_SEARCH_TEXTDOMAIN) }}">
                    <input type="text" class="form-control p-1" name="store_long" placeholder="{{ __('Longitude', STORE_SEARCH_TEXTDOMAIN) }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Fechar', STORE_SEARCH_TEXTDOMAIN) }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Salvar', STORE_SEARCH_TEXTDOMAIN) }}</button>
                </div>
            </form>
        </div>
    </div>
</div>