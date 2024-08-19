const state = {
    client:null
  };
  const actions = {
    setClient(context, items) {
      context.commit('UPDATE_CLIENT', items);
    },  
  };
  
  const mutations = {
    UPDATE_CLIENT(state, payload) {
      state.client = payload;
    },
  };
  
  const getters = {
    client: state => state.client,
  };
  
  const ClientModule = {
    state,
    mutations,
    actions,
    getters
  }
  
  export default ClientModule;