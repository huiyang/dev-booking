<template>
  <div>
    <portal to="title">
        <page-title icon="users" v-if="user">User - {{ user.username }}</page-title>
    </portal>

    <portal to="actions">
        <router-link :to="{ name: 'user-list.index' }" class="button">Go back</router-link>
    </portal>

    <ui-tabs>
        <ui-tab v-for="(tab, key) in tabs" :key="tab.label" :name="tab.label" :url="tab.url">
            <component
                :key="key"
                :parent="response"
                :is="tab.component">
            </component>
        </ui-tab>
    </ui-tabs>
  </div>
</template>

<script>
export default {
    data() {
        return {
            tabs: null,
            user: null,
            response: null
        }
    },
    beforeRouteEnter(to, from, next) {
        axios.get('/api/admin/user-list/' + to.params.id).then((response) => {
            next(vm => {
                vm.tabs = response.data.tabs
                vm.user = response.data.user
                vm.response = response.data
            })
        }).catch((err) => {
            next(vm => console.log(error))
        })
    },
}
</script>

<style>

</style>