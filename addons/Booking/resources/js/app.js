
window.Fusion.booting(function(Vue, router, store) {
    // Vue.component('user-subscriptions', () => import('./pages/UserSubscription.vue'))
    
	router.addRoutes([
		{
			path: '/collection/:collection/:id/book',
            component: () => import('./pages/Booking/Create'),
            name: 'bookable_collection.booking.create',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
		{
			path: '/collection/:collection/:id/:booking/detail',
            component: () => import('./pages/BookingDetail/Create'),
            name: 'bookable_collection.booking.detail.create',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
		{
			path: '/collection/:collection/:id/booking',
            component: () => import('./pages/Booking/Index'),
            name: 'bookable_collection.booking.index',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
		{
			path: '/bookable-collection/:collection',
            component: () => import('./pages/Collections/Index'),
            name: 'bookable_collection.index',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
        {
            path: '/bookable-collection/:collection/create',
            component: () => import('./pages/Collections/Create'),
            name: 'bookable_collection.create',
            meta: {
                requiresAuth: true,
                layout: 'admin',
            },
        },
        {
            path: '/bookable-collection/:collection/:id/edit',
            component: () => import('./pages/Collections/Edit'),
            name: 'bookable_collection.edit',
            meta: {
                requiresAuth: true,
                layout: 'admin',
            },
        },
	])
})

window.addEventListener('DOMContentLoaded', function () {
})
