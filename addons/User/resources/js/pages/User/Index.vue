<template>
    <div>
        <portal to="title">
            <page-title icon="users">Users</page-title>
        </portal>

        <!-- <portal to="actions">
            <router-link :to="{ name: 'users.create' }" class="button">Create User</router-link>
        </portal> -->

        <div class="row">
            <!-- <div class="side-container">
                <div class="card">
                    <div class="card__body">
                        <div class="list">
                            <router-link :to="{ name: 'users' }" class="list--item" exact>All Users</router-link>

                            <span class="list--separator">Roles</span>

                            <router-link v-for="role in filteredRoles" :key="role.id" :to="{ name: 'users.role', params: { role: role.name } }" class="list--item" exact>
                                {{ role.label }}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="content-container">
                <ui-table id="users" :endpoint="endpoint" sort-by="created_at" sort-in="desc" key="users_table">
                    <template slot="name" slot-scope="table">
                        <router-link :to="{ name: 'user-list.show', params: {id: table.record.id} }">{{ table.record.name }}</router-link>
                        <div>{{ table.record.identityCardNumber }}</div>
                    </template>

                    <template slot="username" slot-scope="table">
                        <router-link :to="{ name: 'user-list.show', params: {id: table.record.id} }">{{ table.record.username }}</router-link>
                    </template>

                    <template slot="email" slot-scope="table">
                        <div>{{ table.record.email }}</div>
                        <div>{{ table.record.contactNumber }}</div>
                    </template>

                    <template slot="membership" slot-scope="table">
                        <div v-if="table.record.isMember">
                            <span class="badge badge-success">Member</span>
                            <p>Expire at {{ table.record.formattedMembershipExpireAt }}</p>
                        </div>
                        <div v-else >
                            <span class="badge">Non Member</span>
                        </div>
                    </template>

                    <template slot="role" slot-scope="table">
                        <span class="badge">{{ table.record.role.name }}</span>
                    </template>

                    <template slot="actions" slot-scope="table">
                        <ui-actions :id="'user_' + table.record.id + '_actions'" :key="'user_' + table.record.id + '_actions'">
                            <ui-dropdown-link @click.prevent :to="{ name: 'users.edit', params: {user: table.record.id} }">Edit</ui-dropdown-link>
							<ui-dropdown-link @click.prevent :to="{ name: 'user-list.sub', params: {id: table.record.id} }">Subscription</ui-dropdown-link>
                            <!-- <ui-dropdown-link
                                v-if="table.record.id != user.id"
                                @click.prevent
                                v-modal:delete-user="table.record"
                                classes="link--danger"
                            >
                                Delete
                            </ui-dropdown-link> -->
                        </ui-actions>
                    </template>
                </ui-table>
            </div>
        </div>

        <portal to="modals">
            <ui-modal name="delete-user" title="Delete User">
                <p>Are you sure you want to permenantly delete this user?</p>

                <template slot="footer" slot-scope="user">
                    <ui-button v-modal:delete-user @click="destroy(user.data.id)" theme="danger" class="ml-3">Delete</ui-button>
                    <ui-button v-modal:delete-user>Cancel</ui-button>
                </template>
            </ui-modal>
        </portal>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        head: {
            title() {
                return {
                    inner: 'Users'
                }
            }
        },

        data() {
            return {
                roles: [],
                role: this.$route.params.role || null,
            }
        },

        computed: {
            ...mapGetters({
                user: 'auth/getUser',
            }),

            filteredRoles() {
                return _.filter(this.roles, (role) => role.name !== 'Guest')
            },

            endpoint() {
                if (this.role) {
                    return '/datatable/users/' + this.role
                }

                return '/datatable/users-list'
            }
        },

        watch: {
            '$route' (to, from) {
                this.role = to.params.role || null
            }
        },

        beforeRouteEnter(to, from, next) {
            axios.get('/api/roles').then((response) => {
                next(vm => vm.roles = response.data.data)
            }).catch((err) => {
                next(vm => console.log(error))
            })
        },

        methods: {
            destroy(id) {
                axios.delete('/api/users/' + id).then((response) => {
                    toast('User successfully deleted.', 'success')

                    bus().$emit('refresh-datatable-users')
                })
            }
        }
    }
</script>

<style>
.badge-success {
    background-color: #aaba52;
    color: white;
}
</style>