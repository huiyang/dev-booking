<template>
  <div>
    <!-- <h2>Profile</h2> -->
    <div class="table__wrapper">
        <table class="table">
            <tbody>
                <tr><td>Name</td><td>{{ user.name }}</td></tr>
                <tr><td>Email</td><td>{{ user.email }}</td></tr>
                <tr><td>Registered Date</td><td>{{ user.created_at }}</td></tr>
                
                <tr v-for="(profile_label, handle) in parent.profile_label">
                    <td>{{ profile_label }}</td>
                    <td>{{ profile[handle] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</template>

<script>
import flattern from 'flat'

export default {
    props: {
        parent: {

        }
    },
    computed: {
        profile() {
            return flattern(this.user.profile)
        },
        user() {
            return this.parent.user
        }
    }
}
</script>

<style>

</style>