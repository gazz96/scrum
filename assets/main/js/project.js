$(function(){
    console.log(BASE_URL)

    let Project  = {
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
            getItem: async( id ) => {
                return $.ajax({
                    url: `${BASE_URL}api/carditems/edit/${id}`,
                    method: 'GETT',
                })
            }
        },
        Views: {
            addList: (list) => {
                return `
                <div class="col-md-3 mb-3">
                    <div class="card-wrapper">
                        <div class="card" data-list_id="${list.id}">
                            <div class="card-header"  aria-expanded="false" data-target="#card-collapse-${list.id}">
                                <p class="mb-0">${list.title}</p>
                            </div>
                            <div class="" id="card-collapse-${list.id}">
                                <div class="card-items" data-list_id="${list.id}"></div>
                            </div>
                            <div class="px-3 py-2">
                                <a href="#" class="btn btn-sm btn-add-new-card" data-list_id="${list.id}"><span class="fas fa-plus pr-2"></span>Tambah card</a>
                            </div>
                        </div>
                    </div>
                </div>
                `
            },
            addCardItemInput: () => {
                return `
                    <div class="px-3 py-2">
                        <textarea class="mb-0 form-control card-item-input" placeholder="Enter title for this card"></textarea>
                    </div>
                `
            },
            addCarditem: (item) => {
                return`
                <div class="px-2 pt-2">
                   
                    <a href="javascript:void(0)" class="mb-0 card-item border mb-2 d-block px-3 py-2" data-item_id="${item.id}">
                        ${Card.Views.cardItemStatus(item.status)}
                        <p class="mb-0">${item.name}</p>
                    </a>
                </div>
                `
            },
            cardItemStatus: (status = null) => {

                if( ! status ) return status;

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
                    $('#project-wrapper').append(Card.Views.addList(card));
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

        // add list to view
        $('#project-wrapper').append(Card.Views.addList(card));
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
        let id = $(this).data('item_id');
        let cardItem = await Card.Models.getItem(id);
        let cardItemDetailModal = $('#card-item-detail');
        cardItemDetailModal.find('.modal-title').html(cardItem.name);
        cardItemDetailModal.modal('show');

    })

    $('#card-item-detail').modal('show');
    
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
})