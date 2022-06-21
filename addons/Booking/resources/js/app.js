
window.Fusion.booting(function(Vue, router, store) {
    // Vue.component('user-subscriptions', () => import('./pages/UserSubscription.vue'))
    
	router.addRoutes([
		{
			path: '/collection/:collection/:id/book',
            component: () => import('./pages/Booking/Create'),
            name: 'collection.booking.create',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
	])
})

window.addEventListener('DOMContentLoaded', function () {
})
