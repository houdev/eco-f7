import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'

const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'laravel-jwt-auth',
    tokenStore: ['localStorage'],
    rolesKey: 'role',

    // API endpoints used in Vue Auth.
    registerData: {
        url: 'api/register',
        method: 'POST',
        redirect: '/login'
    },
    loginData: {
        url: 'api/auth/adminLogin',
        method: 'POST',
        redirect: '/admin',
        fetchUser: true
    },
    logoutData: {
        url: 'api/auth/logout',
        method: 'GET',
        redirect: '/login',
        makeRequest: true
    },
    fetchData: {
        url: 'api/auth/me',
        method: 'POST',
        enabled: true
    },
    refreshData: {
        url: 'api/auth/refresh',
        method: 'GET',
        enabled: false,
        interval: 30
    }
}

export default config
