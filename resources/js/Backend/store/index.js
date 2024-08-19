import { createStore } from 'vuex';
import clients from "./modules/clients";

export default createStore({
    modules: {
        clients
    }
});