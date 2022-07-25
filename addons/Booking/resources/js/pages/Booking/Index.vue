<template>
    <div>
        <portal to="title">
            <page-title :icon="collection.icon || 'pencil-alt'" :subtitle="entry.name">Manage Bookings</page-title>
        </portal>

        <portal to="actions">
            <div class="buttons">
                <ui-button v-if="collection.slug && $mq != 'sm'" :to="{ name: 'bookable_collection.index', params: {collection: collection.slug} }" variant="secondary">Go Back</ui-button>
                <ui-button v-if="collection.slug && $mq != 'sm'" :to="{ name: 'bookable_collection.booking.create', params: {collection: collection.slug} }" variant="primary">New Booking</ui-button>
            </div>
        </portal>
        
        <ui-table id="bookings" :endpoint="endpoint" sort-by="created_at" sort-in="desc" key="bookings_table">
            <template slot="bookable_name" slot-scope="table">
                {{ table.record.bookable.name }}
            </template>
            
            <template slot="starts_at" slot-scope="table">
                <ui-datetime :timestamp="table.record.starts_at"></ui-datetime>
            </template>

            <template slot="ends_at" slot-scope="table">
                <ui-datetime :timestamp="table.record.ends_at"></ui-datetime>
            </template>

            <template slot="created_at" slot-scope="table">
                <ui-datetime :timestamp="table.record.created_at"></ui-datetime>
            </template>
            
            <template slot="actions" slot-scope="table">
                <ui-actions :id="'entry_' + table.record.id + '_actions'" :key="'entry_' + table.record.id + '_actions'">
                
                    <ui-dropdown-link
                        @click.prevent="loadBookingDetail(table.record.id)"
                        v-modal:view-booking="table.record"
                        >
                        View Detail
                    </ui-dropdown-link>

                    <ui-dropdown-link :to="{ name: 'bookable_collection.booking.edit', params: {booking: table.record.id} }">Edit</ui-dropdown-link>
                    
                    <ui-dropdown-divider></ui-dropdown-divider>

                    <ui-dropdown-link
                        @click.prevent
                        v-modal:delete-entry="table.record"
                        class="danger">
                        Delete
                    </ui-dropdown-link>
                </ui-actions>
            </template>
        </ui-table>
        
        <portal to="modals">
            <ui-modal name="delete-entry" title="Delete Entry" key="delete_entry">
                <p>Are you sure you want to permenantly delete this booking?</p>

                <template slot="footer" slot-scope="entry">
                    <ui-button v-modal:delete-entry @click="destroy(entry.data.id)" variant="danger" class="ml-3">Delete</ui-button>
                    <ui-button v-modal:delete-entry variant="secondary">Cancel</ui-button>
                </template>
            </ui-modal>

            <ui-modal name="view-booking" title="Booking Detail" key="view_booking">
                <template slot-scope="entry" :loadingBooking="loadingBooking" :booking="booking">
                    <div v-if="loadingBooking">
                        Loading...
                    </div>
                    <div v-else-if="booking && booking.detail && booking.detail.entry && booking.detail.matrix">
                        <div>
                            <h3>{{ booking.bookable.name}}</h3>
                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="md:w-1/2 w-full">
                                <ui-label>From</ui-label>
                                <ui-datetime :timestamp="booking.starts_at"></ui-datetime>
                            </div>
                            <div class="md:w-1/2 w-full">
                                <ui-label>To</ui-label>
                                <ui-datetime :timestamp="booking.ends_at"></ui-datetime>
                            </div>
                        </div>
                        <div v-for="section in booking.detail.matrix.blueprint.sections" :key="section.id">
                            <div v-for="field in section.fields" :key="field.id">
                                <ui-label>{{ field.name }}</ui-label>
                                <div>{{ booking.detail.entry[field.handle] }}</div>
                            </div>
                        </div>
                    </div>
                </template>

                <template slot="footer" slot-scope="entry">
                    <ui-button v-modal:view-booking variant="secondary">Close</ui-button>
                </template>
            </ui-modal>
        </portal>
    </div>
</template>

<script>
export default {

    data() {
        return {
            collection: {},
            entry: {},
            booking: null,
            loadingBooking: false,
        }
    },

    methods: {
        loadBookingDetail(id) {
            this.loadingBooking = true
            this.booking = null

            axios.get('/api/booking/' + id).then((response) => {
                this.loadingBooking = false
                this.booking = response.data.data
            }).catch((error) => {
                this.loadingBooking = false
                toast(error.response.data.message, 'error')
            })
        },
        destroy(id) {
            axios.delete('/api/booking/' + id).then((response) => {
                toast('Booking successfully deleted.', 'success')

                bus().$emit('refresh-datatable-bookings')
            })
        }
    },

    computed: {
        endpoint() {
            return '/datatable/collection/' + this.$route.params.collection + '/' + this.$route.params.id + '/bookings'
        }
    },

    beforeRouteEnter(to, from, next) {
        getEntry(to.params.collection, to.params.id, (error, entry, matrix, fields) => {
            if (error) {
                next((vm) => {
                    vm.$router.push('/collection/' + vm.$router.currentRoute.params.collection)

                    toast(error.toString(), 'danger')
                })
            } else {
                next((vm) => {
                    vm.collection = matrix
                    vm.entry = entry

                    vm.$emit('updateHead')
                })
            }
        })
    },

    beforeRouteUpdate(to, from, next) {
        getEntry(to.params.collection, to.params.id, (error, entry, matrix, fields) => {
            if (error) {
                this.$router.push('/bookable-collection/' + this.$router.currentRoute.params.collection)

                toast(error.toString(), 'danger')
            } else {
                this.collection = matrix
                this.entry = entry

                this.$emit('updateHead')
            }
        })

        next()
    }
}
export function getEntry(collection, id, callback) {
    axios.get('/api/collections/' + collection + '/' + id).then((response) => {
        let matrix = response.data.data.matrix
        let entry = response.data.data.entry
        let fields = {
            name: entry.name,
            slug: entry.slug,
            status: entry.status,
            publish_at: entry.publish_at,
            expire_at: entry.expire_at,
        }

        _.forEach(matrix.blueprint.sections, function(section) {
            _.forEach(section.fields, function(field) {
                fields[field.handle] = entry[field.handle]
            })
        })

        callback(null, entry, matrix, fields)
    }).catch(function(error) {
        callback(new Error('The requested entry could not be found'))
    })
}
</script>

<style>

</style>