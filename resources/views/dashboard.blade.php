<div id="wpwrap">
    <div class="my-3 p-4">
        <h2>{{ __('STORE SEARCH PAINEL', STORE_SEARCH_TEXTDOMAIN) }}</h2>
        <hr>
        <button class="btn btn-primary" id="open-model-new-store" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">{{ __('Cadastrar Nova Loja', STORE_SEARCH_TEXTDOMAIN) }} <i class="fas fa-plus"></i></button>
        @include('partials.modal-new-store')
        @include('partials.modal-edit-store')

        <h4 class="mt-5">{{ __('Todas as Lojas', STORE_SEARCH_TEXTDOMAIN) }}</h4>

        <table class="table table-bordered align-middle">
            <thead class="table-primary">
                <th class="text-center">{{ __('ID', STORE_SEARCH_TEXTDOMAIN) }}</th>
                <th>{{ __('Loja', STORE_SEARCH_TEXTDOMAIN) }}</th>
                <th>{{ __('Cidade', STORE_SEARCH_TEXTDOMAIN) }}</th>
                <th>{{ __('Endereço', STORE_SEARCH_TEXTDOMAIN) }}</th>
                <th>{{ __('Latitude', STORE_SEARCH_TEXTDOMAIN) }}</th>
                <th>{{ __('Longitude', STORE_SEARCH_TEXTDOMAIN) }}</th>
                <th>{{ __('Cadastrada em', STORE_SEARCH_TEXTDOMAIN) }}</th>
                <th class="text-center">{{ __('Ações', STORE_SEARCH_TEXTDOMAIN) }}</th>
            </thead>

            <tbody>
                @if (!empty($stores))
                    @foreach ($stores as $key => $value)
                    <tr id="store-{{$value->store_id}}">
                        <td class="text-center">{{ $value->store_id }}</td>
                        <td>{{ $value->store_name }}</td>
                        <td>{{ $value->store_city }}</td>
                        <td>{{ $value->store_address }}</td>
                        <td>{{ $value->store_lat }}</td>
                        <td>{{ $value->store_long }}</td>
                        <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                            <button data-id="{{ $value->store_id }}" class="btn btn-sm btn-danger text-sm delete-store">{{ __('Excluir', STORE_SEARCH_TEXTDOMAIN) }} <i class="fas fa-trash"></i></button>
                            <button data-id="{{ $value->store_id }}" class="btn btn-sm btn-success text-sm edit-store">{{ __('Editar', STORE_SEARCH_TEXTDOMAIN) }} <i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>