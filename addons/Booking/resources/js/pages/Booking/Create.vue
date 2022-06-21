<template>
    <div>
        <portal to="title">
            <page-title icon="collection.icon || 'pencil-alt'" :subtitle="collection.name" v-if="collection">Booking</page-title>
        </portal>

        <portal to="actions">
            <div>
                <router-link :to="{ name: 'collection.index' }" class="button">Go back</router-link>
                <button class="button button--primary" @click="submit">Book</button>
            </div>
        </portal>
        
        <component
            v-for="field in fields"
            :key="field.handle"
            :field="field"
            :errors="form.errors"
            :is="field.type.id + '-fieldtype'"
            v-model="form[field.handle]"
        />
    </div>
</template>

<script>
import fields from '../../mixins/fields.js'
import Form from '@/services/Form'

export default {
    mixins: [fields],
    data() {
        return {
            entry: null,
            collection: null,
            form: null
        }
    },
    methods: {
        submit() {
            this.form.post('/api/collection/' + this.collection.slug + '/' + this.entry.id + '/book').then((response) => {
                
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        getEntry(to.params.collection, to.params.id, (error, entry, matrix, fields) => {
            if (error) {
                next((vm) => {
                    // vm.$router.push('/collection/' + vm.$router.currentRoute.params.collection)

                    toast(error.toString(), 'danger')
                })
            } else {
                next((vm) => {
                    vm.collection = matrix
                    vm.entry = entry
                    vm.form = new Form(fields, true)

                    vm.$emit('updateHead')
                })
            }
        })
    },

    beforeRouteUpdate(to, from, next) {
        getEntry(to.params.collection, to.params.id, (error, entry, matrix, fields) => {
            if (error) {
                // this.$router.push('/collection/' + this.$router.currentRoute.params.collection)

                toast(error.toString(), 'danger')
            } else {
                this.collection = matrix
                this.entry = entry
                this.form = new Form(fields, true)

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
            starts_at: null,
            ends_at: null,
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