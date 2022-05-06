$(function(){

    
    let CardItemFields = {
        id: null,
        description: null,
        status: null
    }

    let Project  = {
        Models: {
            getDetail: () => {

            },
            getTaks: () => {

            }
        },
        View: {
        
        }
    }

    let User = {
        Models: {
            list: async(data) => {
                return $.ajax({
                    url: `${BASE_URL}api/users`,
                    data: data,
                })
            },
        }
    }

    let Card = {
        Models: {
            list: async(data) => {
                return $.ajax({
                    url: `${BASE_URL}api/cards`,
                    data: data,
                })
            },
            create: async ( data ) => {
                return $.ajax({
                    url: `${BASE_URL}api/cards/store`,
                    method: 'POST',
                    data: data,
                })
            },
            delete: async( id ) => {
                return $.ajax({
                    url: `${BASE_URL}api/cards/delete/${id}`,
                    method: 'GET',
                })
            },
            listItems: async(data) => {
                return $.ajax({
                    url: `${BASE_URL}api/carditems`,
                    data: data,
                })
            },
            createItem: async ( data ) => {
                return $.ajax({
                    url: `${BASE_URL}api/carditems/store`,
                    method: 'POST',
                    data: data,
                })
            },
            updateItem: async ( id, data ) => {
                return $.ajax({
                    url: `${BASE_URL}api/carditems/update/${id}`,
                    method: 'POST',
                    data: data,
                })
            },
            getItem: async( id ) => {
                return $.ajax({
                    url: `${BASE_URL}api/carditems/edit/${id}`,
                    method: 'GET',
                })
            },
            deleteItem: async( id ) => {
                return $.ajax({
                    url: `${BASE_URL}api/carditems/delete/${id}`,
                    method: 'GET',
                })
            }
        },
        Views: {
            addList: (list) => {
                return `
                <div class="col-card card-item mb-3">
                    <div class="card-wrapper">
                        <div class="card shadow" data-list_id="${list.id}">
                            <div class="card-header d-flex justify-content-between"  aria-expanded="false" data-target="#card-collapse-${list.id}">
                                <p class="mb-0">${list.title}</p>
                                <div class="dropdown" style="z-index: 5">
                                    <a href="" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="javascript:void(0)" class="dropdown-item delete-list" data-id="${list.id}">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="card-collapse-${list.id}">
                                <div class="card-items" data-list_id="${list.id}"></div>
                            </div>
                            <div class="px-3 py-2">
                                <a href="#" class="btn btn-sm btn-add-new-card" data-list_id="${list.id}"><span class="fas fa-plus pr-2"></span>Tambah task</a>
                            </div>
                        </div>
                    </div>
                </div>
                `
            },
            addCardItemInput: () => {
                return `
                    <div class="px-3 py-2">
                        <textarea class="mb-0 form-control card-item-input" placeholder="Masukan nama item"></textarea>
                    </div>
                `
            },
            addCarditem: (item) => {
                return`
                <div class="px-2 pt-2">
                   
                    <a href="javascript:void(0)" class="mb-0 card-item shadow border mb-2 d-block px-3 py-2" data-item_id="${item.id}">
                        <div class="card-item-status">${Card.Views.cardItemStatus(item.status)}</div>
                        <p class="mb-0">${item.name}</p>
                    </a>
                </div>
                `
            },
            cardItemStatus: (status = null) => {

                if( ! status  ) return '';

                if( status == "To Do") {
                    return `
                        <span class="badge badge-info" style="min-width: 50px; height: 3px; border-radius: 50px">&nbsp;</span>
                    `
                }

                if( status == "In Progress") {
                    return `
                        <span class="badge badge-warning" style="min-width: 50px; height: 3px; border-radius: 50px">&nbsp;</span>
                    `
                }

                if( status == "Done") {
                    return `
                        <span class="badge badge-primary" style="min-width: 50px; height: 3px; border-radius: 50px">&nbsp;</span>
                    `
                }

                if( status == "Completed") {
                    return `
                        <span class="badge badge-success" style="min-width: 50px; height: 3px; border-radius: 50px">&nbsp;</span>
                    `
                }

                return ''
            }
        },
        Helpers: {
            loadList: async () => {
                let cards = await Card.Models.list({
                    project_id: $('#i-project_id').val()
                })
                cards.map( async(card,i) => {
                    $('#project-wrapper').prepend(Card.Views.addList(card));
                    let cardItems = await Card.Models.listItems({
                        'card_id':  card.id
                    })
                    
                    let container = $(`.card-items[data-list_id=${card.id}]`);
                   
                    cardItems.map((cardItem,i) => {
                        container.append(Card.Views.addCarditem(cardItem))
                    })
                });
            }
        }
    }

    


    Card.Helpers.loadList();

    $('#create-new-card-form').submit(async function(e){
        e.preventDefault()
        let data = $(this).serialize();

        // create card
        let card = await Card.Models.create(data);
        $(this).find('input[name=title]').val('');
        // add list to view
        $('#project-wrapper').prepend(Card.Views.addList(card));
    })

    $(document).on('click', '.btn-add-new-card', function(e){
        e.preventDefault();
        $(this).parent().prev().find('.card-items').append(Card.Views.addCardItemInput());
    })

    $(document).on('keypress', '.card-item-input', async function(e){
        if(e.which == 13 ) {
            let cardItem = await Card.Models.createItem({
                card_id: $(this).parent().parent().data('list_id'),
                name: $(this).val()
            })
            $(this).parent().parent().append(Card.Views.addCarditem(cardItem));
            $(this).parent().remove();        
        }
    })


    $(document).on('click', '.card-item', async function(e){
        e.preventDefault();
        
        CardItemFields = await Card.Models.getItem($(this).data('item_id'));
        let cardItemDetailModal = $('#card-item-detail');
        cardItemDetailModal.find('.modal-title').find('input').val(CardItemFields.name);
        cardItemDetailModal.find('#i-description').val(CardItemFields.description);
        cardItemDetailModal.find('#i-status').val(CardItemFields.status);
        cardItemDetailModal.modal('show');

    })

    //$('#card-item-detail').modal('show');
    
    $('.member-search').keypress( async function(e){
        if(e.which == 13) {
            
            let memberSearchResultContainer = $('.member-search-result');
            memberSearchResultContainer.html('');

            if( $(this).val() ) {

                let users = await User.Models.list({
                    s: $(this).val()
                })
                
                users.map((user, i) => {
                    memberSearchResultContainer.append(`
                        <a href='javascript:void(0)' class='d-block my-2' data-user_id='${user.id}'>
                            <span class='font-weight-bold'>${user.name}</span>
                            <span>${user.email}</span>
                        </a>
                    `)
                })

            }

        }

    })

    $(document).on('click', '.member-search-result a', function(){
        let user_id = $(this).data('user_id');
        let clone = $(this).clone();
    })

    $('#card-item-modal-form').submit(async function(e){
        e.preventDefault();

        let btn = $(this).find('button');btn.html('loading....');

        CardItemFields = await Card.Models.updateItem(CardItemFields.id, {
            name: $('#i-name').val(),
            description: $('#i-description').val(),
            status: $('#i-status').val()
        })

        console.log(CardItemFields);

        let CardItem = $(`.card-item[data-item_id=${CardItemFields.id}]`);
        
        CardItem
            .find('.card-item-status')
            .html(Card.Views.cardItemStatus(CardItemFields.status))

        CardItem.find('p').text(CardItemFields.name)
    
        btn.html('save');
    })

    $(document).on('click', '#delete-card-item', async function(e){
        e.preventDefault();
        let btn = $(this).find('button');btn.html('loading....');
        await Card.Models.deleteItem(CardItemFields.id);

        let cardItemDetailModal = $('#card-item-detail');
        let CardItem = $(`.card-item[data-item_id=${CardItemFields.id}]`);

        CardItem.remove();

        cardItemDetailModal.find('.modal-title').find('input').val('');
        cardItemDetailModal.find('#i-description').val('')
        cardItemDetailModal.modal('hide');

        btn.html('delete');
    })

    $(document).on('click', '.delete-list', async function(e){
        e.preventDefault();
        await Card.Models.delete($(this).data('id'));
        $(this).closest('.card-wrapper').parent().remove();
    })
})