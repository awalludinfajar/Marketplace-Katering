import axios from "axios";

const store = new Vuex.Store({
    state: {
      roles: [],
      permissions: [],
    },
    mutations: {
      setRoles(state, roles) {
        state.roles = roles;
      },
      setPermissions(state, permissions) {
        state.permissions = permissions;
      },
    },
    actions: {
      async fetchUserRolesPermissions({ commit }) {
        try {
          const response = await axios.get('/api/user-permissions');
          commit('setRoles', response.data.roles);
          commit('setPermissions', response.data.permissions);
        } catch (error) {
          console.error('Error fetching roles and permissions:', error);
        }
      },
    },
    getters: {
      hasRole: (state) => (role) => state.roles.includes(role),
      hasPermission: (state) => (permission) => state.permissions.includes(permission),
    },
  });
  
  export default store;