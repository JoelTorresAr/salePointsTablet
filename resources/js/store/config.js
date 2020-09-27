export const config = {
    state: {
        store_id: '1',
        cash_box_id: undefined,
        server: 0,
    },
    getters: {
        getSTORE_ID: (state) => {
            return state.store_id;
        },
        getCASH_BOX_ID: (state) => {
            return state.cash_box_id;
        },
        getSERVER: (state) => {
            return state.server;
        },
    },
    actions: {},
    mutations: {
        SET_STORE_ID(state, value) {
            state.store_id = value;
        },
        SET_CASH_BOX_ID(state, value) {
            state.cash_box_id = value;
        },
        SET_SERVER(state, value) {
            state.server = value;
        },
    },
    modules: {}
}