<template>
    <shared-form
        v-if="form"
        :booking="booking"
        :loading="loading"
        :form="form"
        :collection="collection">
    </shared-form>
</template>

<script>
import Form from '@/services/Form'
import SharedForm from './SharedForm.vue'

export default {

    data() {
        return {
            collection: {},
            form: null,
            booking: {},
            loading: false
        }
    },

    components: {
        'shared-form': SharedForm
    },

    methods: {
        back() {
            // @TODO: Delete booking record

            // Go back to the time selection page
            this.$router.push('/collection/' + this.$route.params.collection + '/' + this.$route.params.id + '/book')
        },
        submit() {
            this.loading = true
            this.form.post('/api/booking/' + this.$route.params.booking + '/detail').then((response) => {
                toast('Succesfully booked.', 'success')
                this.gotoBookingList(this)
            }).catch((error) => {
                this.loading = false
                toast(error.message, 'error')
            })
        },
        gotoBookingList(vm) {
            vm.$router.push('/collection/' + vm.$route.params.collection + '/' + vm.$route.params.id + '/booking')
        },
    },

    beforeRouteEnter(to, from, next) {
        let booking = axios.get('/api/booking/' + to.params.booking)
        let matrix = axios.get('/api/matrices/slug/booking-detail')

        axios.all([booking, matrix]).then(
            axios.spread((bookingResponse, response) => {
                next(vm => {
                    // Matrix response
                    let collection = response.data.data
                    let form     = {
                        name: '',
                        slug: '',
                        publish_at: null,
                        expire_at: null,
                        status: 1,
                    }

                    _.each(collection.blueprint.sections, (section) => {
                        _.each(section.fields, (field) => {
                            form[field.handle] = field.default
                        })
                    })

                    vm.collection = collection
                    vm.form = new Form(form, true)

                    vm.$emit('updateHead')

                    // Booking response
                    // console.log('booking', bookingResponse)
                    // console.log(vm.$routers.params)
                    // console.log('route.params')
                    // console.log(vm.$route.params)

                    vm.booking = bookingResponse.data.data

                    // Booking detail is already stored, go to booking list instead
                    if (vm.booking.detail && vm.booking.detail.entry.id) {
                        vm.gotoBookingList(vm)
                    }
                })
            })
        )
        .catch((error) => {
            // vm.$router.push(`/collection/${vm.$router.currentRoute.params.collection}`)
            console.log(error)
            toast(error.response.data.message, 'danger')
        })
    }
}
</script>

<style>

</style>