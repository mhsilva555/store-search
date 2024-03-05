jQuery(function ($) {
    const modalNewStore = new bootstrap.Modal(document.getElementById('exampleModal'))
    //const modalEditStore = new bootstrap.Modal(document.getElementById('editStore'))
    const list_cities = jQuery('.modal-new-store .list-cities, .modal-edit-store .list-cities')
    const input_search = jQuery('.store_city')

    input_search.keyup(function () {
        let inputValue = jQuery(this).val().trim().toLowerCase()
        const items = list_cities.find('li')

        items.map((index, item) => {
            if (!jQuery(item).text().toLowerCase().includes(inputValue)) {
                jQuery(item).css('display', 'none')
            } else {
                jQuery(item).css('display', 'block')
            }
        })
    })

    input_search.on('focus',function () {
        const input = jQuery(this)
        list_cities.show()

        jQuery('.list-cities li').click(function () {
            input_search.val(jQuery(this).text())
        })

        input_search.focusout(function() {
            setTimeout(() => {
                list_cities.hide()
            }, 150)
        })
    })

    jQuery(document).on('submit', '#form-new-store', function (event) {
        event.preventDefault()

        let inputs = jQuery(this).find('input')
        let values = []
        inputs.map((index, element) => {
            values.push(jQuery(element).val() ?? null)
        })

        if (values.includes('') || values.includes(null)) {
            Swal.fire('Alguns campos estão vazios!', 'Por favor, preencha todos os campos.', 'warning')
            return false
        }

        jQuery.ajax({
            url: obj.ajaxurl,
            type: 'POST',
            data: {
                dados: jQuery(this).serialize(),
                nonce: obj.ajax_nonce,
                action: 'new-store'
            }
        }).done((response) => {
            Swal.fire({
                title: 'Loja Cadastrada com Sucesso',
                html: '',
                icon: 'success',
                didClose: () => {
                    document.location.reload()
                }
            })
            modalNewStore.hide()
        })
    })

    jQuery(document).on('click', '.delete-store', function () {
        let store_id = jQuery(this).data('id')

        Swal.fire({
            title: "Deseja prosseguir?",
            text: "A loja será excluída permanentemente!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sim, deletar loja!"
        }).then((result) => {
            if (result.isConfirmed) {
                jQuery.ajax({
                    url: obj.ajaxurl,
                    type: 'POST',
                    data: {
                        store_id: store_id,
                        action: 'delete-store',
                        nonce: obj.ajax_nonce
                    }
                }).done((response) => {
                    Swal.fire({
                        title: "Loja Excluída!",
                        icon: "success"
                    })

                    document.location.reload()
                })
            }
        });
    })

    jQuery(document).on('click', '.edit-store', function () {
        let store_id = $(this).data('id')

        jQuery.ajax({
            url: obj.ajaxurl,
            type: 'POST',
            data: {
                store_id: store_id,
                nonce: obj.ajax_nonce,
                action: 'edit-store'
            }
        }).done((response) => {
            if (response.status === 400) {
                Swal.fire('Erro ao buscar dados desta loja', '', 'error')
                return false
            }

            let editStore = new bootstrap.Modal(document.getElementById('editStore'))
            editStore.show()

            jQuery('#form-edit-store').attr('data-store-id', response.store_data.store_id)
            jQuery('input[name=store_name_edit]').val(response.store_data.store_name)
            jQuery('input[name=store_city_edit]').val(response.store_data.store_city)
            jQuery('input[name=store_address_edit]').val(response.store_data.store_address)
            jQuery('input[name=store_lat_edit]').val(response.store_data.store_lat)
            jQuery('input[name=store_long_edit]').val(response.store_data.store_long)
        })
    })

    jQuery(document).on('submit', '#form-edit-store', function (event) {
        event.preventDefault()

        let store_id = jQuery(this).data('store-id')
        let inputs = jQuery(this).find('input')
        let values = []
        inputs.map((index, element) => {
            values.push(jQuery(element).val() ?? null)
        })

        if (values.includes('') || values.includes(null)) {
            Swal.fire('Alguns campos estão vazios!', 'Por favor, preencha todos os campos.', 'warning')
            return false
        }

        jQuery.ajax({
            url: obj.ajaxurl,
            type: 'POST',
            data: {
                store_id: store_id,
                dados: jQuery(this).serialize(),
                nonce: obj.ajax_nonce,
                action: 'edit-store'
            }
        }).done((response) => {
            if (response.status !== 200) {
                Swal.fire('Erro ao atualizar Dados!', 'Verifique os dados informados, ou tente novamente em alguns instantes.', 'error')

                return false
            }

            Swal.fire({
                title: 'Loja Atualizada com Sucesso',
                html: '',
                icon: 'success',
                didClose: () => {
                    document.location.reload()
                }
            })

            let editStore = new bootstrap.Modal(document.getElementById('editStore'))
            editStore.hide()
        })
    })
});