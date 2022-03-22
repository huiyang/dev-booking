
console.log('user app.js');
window.Fusion.booting(function(Vue, router, store) {
    Vue.component('user-list-profile', () => import('./pages/User/Profile'))
    console.log('router', router)
	router.addRoutes([
		{
			path: '/user-list',
            component: () => import('./pages/User/Index'),
            name: 'user-list.index',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
		{
			path: '/user-list/:id/show',
            component: () => import('./pages/User/Show'),
            name: 'user-list.show',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
	])
})

window.addEventListener('DOMContentLoaded', function () {
})
