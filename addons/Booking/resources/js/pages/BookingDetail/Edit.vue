<template>
    <div>
        <div v-if="!loading">
            <component
                v-for="field in fields"
                :key="field.handle"
                :field="field"
                :errors="form.errors"
                :is="field.type.id + '-fieldtype'"
                v-model="form[field.handle]"
            />
        </div>

        <shared-form
            v-if="form"
            :booking="booking"
            :loading="loading"
            :form="form"
            :collection="collection">
        </shared-form>
    </div>
</template>

<script>
import fields from '../../mixins/fields.js'
import Form from '@/services/Form'
import SharedForm from './SharedForm.vue'

export default {
    mixins: [fields],

    data() {
        return {
            collection: {},
            form: null,
            booking: {},
            detail: {},
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
            this.gotoBookingList(this)
        },
        submit() {
            this.loading = true
            this.form.patch('/api/booking/' + this.$route.params.booking + '/detail').then((response) => {
                toast('Succesfully updated booking.', 'success')
                this.gotoBookingList(this)
            }).catch((error) => {
                this.loading = false
                toast(error.message, 'error')
            })
        },
        gotoBookingList(vm) {
            let matrix = this.booking.bookable.matrix
            vm.$router.push('/collection/' + matrix.slug + '/' + matrix.id + '/booking')
        },
        populateBookingField(fields, booking) {
            _.forEach(this.fields, function(field) {
                fields[field.handle] = booking[field.handle]
            })
            return fields
        },
    },

    beforeRouteEnter(to, from, next) {
        getEntry(to.params.booking, (error, entry, booking, matrix, fields) => {
            if (error) {
                next((vm) => {
                    vm.gotoBookingList(vm)

                    toast(error.toString(), 'danger')
                })
            } else {
                next((vm) => {
                    vm.collection = matrix
                    vm.detail = entry
                    vm.booking = booking
                    vm.populateBookingField(fields, booking)
                    vm.form = new Form(fields, true)

                    vm.$emit('updateHead')
                })
            }
        })
    },

    beforeRouteUpdate(to, from, next) {
        getEntry(to.params.booking, (error, entry, booking, matrix, fields) => {
            if (error) {
                this.gotoBookingList(this)

                toast(error.toString(), 'danger')
            } else {
                this.collection = matrix
                this.detail = entry
                this.booking = booking
                this.populateBookingField(fields, booking)
                this.form = new Form(fields, true)

                this.$emit('updateHead')
            }
        })

        next()
    }
}

export function getEntry(id, callback) {
        axios.get('/api/booking/' + id).then((response) => {
            let matrix = response.data.data.detail.matrix
            let entry = response.data.data.detail.entry
            let booking = response.data.data
            
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

            callback(null, entry, booking, matrix, fields)
        }).catch(function(error) {
            callback(new Error('The requested booking could not be found'))
        })
    }
</script>

<style>

</style>