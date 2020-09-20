
export default {
    state: {
        data: window.data,
        token: window._token,
        formDialog: false,
    },
    getters:{
        userData: function(state) {
            return state.data.user;
        }
    },
    mutations: {
        openModal(state, newVal){
            state.formDialog = newVal;
        },
        newUserData(state, data) {
            state.data.user = data;
        },
    },
    actions: {

    },
}
