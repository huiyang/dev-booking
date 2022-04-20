
window.Fusion.booting(function(Vue, router, store) {
    Vue.component('user-subscriptions', () => import('./pages/UserSubscription.vue'))
    
	router.addRoutes([
		{
			path: '/user-list/:id/sub',
            component: () => import('./pages/Sub'),
            name: 'user-list.sub',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
	])
})

window.addEventListener('DOMContentLoaded', function () {
})
