window.Attendance = {
    Fields: {
        id: null,
        user_id: null,
        start_work: null,
        end_work: null,
        start_rest: null,
        end_rest: null,
        note: null,
        location: null,
    },
    Condition: {

    },
    Model: {
        create: async ( data ) => {
            return $.ajax({
                url: `${BASE_URL}api/attendances/store`,
                method: 'POST',
                data: data,
            })
        },
        uppdate: async ( id, data ) => {
            return $.ajax({
                url: `${BASE_URL}api/attendances/update/${id}`,
                method: 'POST',
                data: data,
            })
        },
        edit: async( id ) => {
            return $.ajax({
                url: `${BASE_URL}api/attendances/edit/${id}`,
                method: 'GET',
            })
        },
        delete: async( id ) => {
            return $.ajax({
                url: `${BASE_URL}api/attendances/delete/${id}`,
                method: 'GET',
            })
        }
    },
    Helpers: {
        init: () => {

        }
    },
    Views: {

    }
}