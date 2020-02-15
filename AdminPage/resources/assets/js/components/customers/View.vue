<template>
    <div class="customer-view" v-if="customer">
        <div class="user-img">
            <img src="https://www.scottsdaleazestateplanning.com/wp-content/uploads/2018/01/user.png" alt="">
        </div>
        <div class="user-info">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ customer.id }}</td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td>{{ customer.fullname }}</td>
                </tr>
                <tr>
                    <th>Short Name</th>
                    <td>{{ customer.shortname }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ customer.email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ customer.phone }}</td>
                </tr>
                <tr>
                    <th>Sex</th>
                    <td>{{ customer.gender }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ customer.address }}</td>
                </tr>
            </table>
            <router-link to="/customers">Back to all customers</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'view',
        created() {
            if (this.customers.length) {
                this.customer = this.customers.find((customer) => customer.id == this.$route.params.id);
            } else {
                axios.get(`/api/customers/${this.$route.params.id}`)
                    .then((response) => {
                        this.customer = response.data.customer
                    });
            }
        },
        data() {
            return {
                customer: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            customers() {
                return this.$store.getters.customers;
            }
        }
    }
</script>

<style scoped>
.customer-view {
    display: flex;
    align-items: center;
}
.user-img {
    flex: 1;
}
.user-img img {
    max-width: 160px;
}
.user-info {
    flex: 3;
    overflow-x: scroll;
}
</style>
