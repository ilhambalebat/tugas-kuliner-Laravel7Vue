import axios from 'axios'
export default
{
    namespaced: true,
    state: {
        authenticated: false,
        user: []
    },
    getters: {
        check(state)
        {
            return state.authenticated
        },
        user(state)
        {
            return state.user
            }
    },
    mutations: {
        SET_AUTHENTICATED(state, value)
        {
            state.authenticated = value
        },
        SET_USER(state,value)
        {
            state.user = value
        }
    },
    actions: {
        async login({dispatch},credentials)
        {
            await axios.get('sanctum/csrf-cookie')
            await axios.post('login', credentials)
        
            dispatch('me')
        },
        
        async me({commit})
        {
            try
            {
                let {data} = await axios.get('api/me')
                commit('SET_AUTHENTICATED',true)
                commit('SET_USER',data.data)
            }
            catch(e)
            {
                commit('SET_AUTHENTICATED',false)
                commit('SET_USER',[])                
            }
        },
        async signout({dispatch})
        {
            await axios.post('logout')
            dispatch('me')  
        }
    }
}