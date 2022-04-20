<template>
  <div>
    <portal to="title">
        <page-title icon="users" v-if="user">User - {{ user.name }}</page-title>
    </portal>

    <portal to="actions">
        <router-link :to="{ name: 'user-list.index' }" class="button">Go back</router-link>
    </portal>

    <!--<ui-tabs>
        <ui-tab v-for="(tab, key) in tabs" :key="tab.label" :name="tab.label" :url="tab.url">
            <component
                :key="key"
                :parent="response"
                :is="tab.component">
            </component>
        </ui-tab>
    </ui-tabs>-->
	
	<table class="table">
		<tbody>
			<tr>
				<td>Email</td>
				<td>{{ user.email }}</td>
			</tr>
			<tr>
				<td>Membership Expire At</td>
				<td>{{ user.memberExpiryDate }}</td>
			</tr>
			<tr>
				<td>Is Member</td>
				<td v-if="user.isMember"><span class="badge badge-success">Active Member</span></td>
				<td v-else><span class="badge">Non Member</span></td>
			</tr>
		</tbody>
	</table>
	
	<table class="table subtable" style="margin-top:20px">
		<thead>
			<tr style="height:30px">
				<th style="width: 5%;">#</th>
				<th style="width: 25%;">Name</th>
				<th style="width: 25%;">Subscription Days</th>
				<th style="width: 25%;">Price</th>
				<th style="width: 20%"></th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(sub, index) in subs">
				<td>{{ index + 1 }}</td>
				<td>{{ sub.name }}</td>
				<td>{{ sub.subscription_items[0]['valid_period'] }}</td>
				<td>{{ sub.price }}</td>
				<td style="text-align:right;">
					<input type="radio" v-model="rdExtend" name="rdExtend" :value="sub.subscription_items[0]['package_id']"/>
				</td>
			</tr>
		</tbody>
	</table>
	<button id="btnExtend" style="margin-top: 16px;width: 10%;background-color: #343c4b;color: white;" @click="extend()">Extend</button>
  </div>
</template>

<script>
export default {
    data() {
        return {
            uid: null,
            tabs: null,
            subs: null,
            user: null,
            response: null,
			rdExtend: null
        }
    },
    beforeRouteEnter(to, from, next) {
        axios.get('/api/admin/user-list/' + to.params.id + '/sub').then((response) => {
            next(vm => {
                vm.uid = to.params.id
                vm.subs = response.data.subs
                vm.tabs = response.data.tabs
                vm.user = response.data.user
                vm.response = response.data
            })
        }).catch((err) => {
            next(vm => console.log(error))
        })
    },
	methods: {
		extend() {
			var packageid = this.rdExtend;
			var uid = this.uid;
			
			axios.put('/api/admin/user-list/' + uid, null, { params: {
				packageid,
				uid
      }}).then((response) => {
				
				/*bus().$emit('refresh-datatable-users')*/
				this.$router.back()
			})
      
			/*axios.delete('/api/users/' + id).then((response) => {
				toast('User successfully deleted.', 'success')

				bus().$emit('refresh-datatable-users')
			})*/
		}
	}
}
</script>

<style>
.subtable thead th
{
	padding-left:16px;
}

.badge-success
{
	background-color : #28a745;
	color: white;
}
</style>