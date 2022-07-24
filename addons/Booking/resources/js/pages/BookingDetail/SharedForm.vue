<template>
    <div>
        <portal to="actions">
            <div class="buttons">
                <ui-button v-if="collection.slug && $mq != 'sm'" @click.prevent="$parent.back" variant="secondary">Go Back</ui-button>
                <ui-button type="submit" @click.prevent="$parent.submit" variant="primary" :disabled="!form.hasChanges || loading">Save</ui-button>
            </div>
        </portal>

        <section-card title="Loading..." v-show="loading"></section-card>
        <portal to="sidebar-right">
            <div v-show="! loading">
                <sidebar v-if="collection" id="collection-sidebar">
                    <sidebar-section id="collection_panel_status" tabindex="-1">
                        <h4>{{ booking.bookable.name }}</h4>
                        <div>From {{ booking.display_starts_at }}</div>
                        <div>To {{ booking.display_ends_at }}</div>
                    </sidebar-section>

                    <sidebar-section
                        v-for="section in sections.sidebar"
                        v-if="section.fields.length > 0"
                        :key="section.handle"
                        :id="'collection_panel_' + section.handle"
                        :title="section.name"
                        :description="section.description"
                        tabindex="-1">

                        <component
                            v-for="field in section.fields"
                            :key="field.handle"
                            :is="field.type.id + '-fieldtype'"
                            :field="field"
                            :has-error="form.errors.has(field.handle)"
                            :error-message="form.errors.get(field.handle)"
                            v-model="form[field.handle]">
                        </component>
                    </sidebar-section>

                    <status-card v-if="entry" id="collection_panel_status_card" :entry="entry" tabindex="-1"></status-card>
                </sidebar>
            </div>
        </portal>

        <div v-show="! loading">

            <section-card
                v-for="section in sections.body"
                v-if="section.fields.length > 0"
                :key="section.handle"
                :id="'collection_panel_' + section.handle"
                :title="section.name"
                :description="section.description"
                tabindex="-1">

                <component v-for="field in section.fields"
                           :key="field.handle"
                           :is="field.type.id + '-fieldtype'"
                           :field="field"
                           :errors="form.errors"
                           v-model="form[field.handle]">
                </component>
            </section-card>
        </div>
    </div>
</template>

<script>
import Flatpickr from '@/ui/Flatpickr/Flatpickr.vue'
    export default {
        props: {
            booking: {
                type: Object,
                required: true,
            },
            entry: {
                required: false
            },

            collection: {
                required: true,
            },

            form: {
                type: Object,
                required: true,
            },

            loading: {
                type: Boolean,
                required: false,
            }
        },

        data() {
            return {
                editSlug: false,
                slugValue: '',
            }
        },

        computed: {
            sections() {
                let body = []
                let sidebar = []

                body = _.filter(this.collection.blueprint.sections, (section) =>
                    section.placement == 'body')

                sidebar = _.filter(this.collection.blueprint.sections, (section) =>
                    section.placement == 'sidebar')

                return { body, sidebar }
            }
        },

        methods: {
            openEdit() {
                this.slugValue = this.form.slug
                this.editSlug = true
                this.slugFocus()
            },

            closeEdit() {
                this.slugValue = ''
                this.editSlug = false
                this.editBtnFocus()
            },

            saveSlug() {
                if (this.slugValue === '') {
                    this.slugValue = this.form.slug
                } else {
                    this.form.slug = this.slugValue
                }

                this.closeEdit()
            },

            slugFocus() {
                this.$nextTick(() => {
                    this.$refs.slug.$el.focus()
                })
            },

            editBtnFocus() {
                this.$nextTick(() => {
                    this.$refs.edit.$el.focus()
                })
            }
        },
    }
</script>