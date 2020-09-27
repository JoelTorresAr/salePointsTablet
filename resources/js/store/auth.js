import store from './index'
import axios from 'axios'
export const auth = {
    state: {
        pin: 0,
        token: undefined,
        loginState: false,
        userName: '',
        userId: 0,
        configAxios: undefined
    },
    getters: {
        getPIN: (state) => {
            return state.pin;
        },
        getTOKEN: (state) => {
            return state.token;
        },
        getLOGIN_STATE: (state) => {
            return state.loginState;
        },
        getUSERNAME: (state) => {
            return state.userName;
        },
        getUSERID: (state) => {
            return state.userId;
        },
        getCONFIG_AXIOS: (state) => {
            return state.configAxios;
        },
    },
    actions: {
        BREAK() {
            var ip = store.getters.getIP
            axios
                .get(
                    `/conexion/cd_conectar.php?ip=${this.ip}&pin=${store.getters.getPIN}`
                )
                .then(() => {
                    console.log('libero')
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
    mutations: {
        SET_PIN(state, value) {
            state.pin = value;
        },
        SET_TOKEN(state, value) {
            state.token = value;
        },
        SET_LOGIN_STATE(state, value) {
            state.loginState = value;
        },
        SET_USER_NAME(state, value) {
            state.userName = value;
        },
        SET_USER_ID(state, value) {
            state.userId = value;
        },
        SET_CONFIG_AXIOS(state, value) {
            state.configAxios = value;
        },
    },
    modules: {}
}