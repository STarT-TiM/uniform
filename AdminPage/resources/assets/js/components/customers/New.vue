<template>
    <div class="customer-new">
        <form @submit.prevent="add">
            <table class="table">
                <tr>
                    <th>Full Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.fullname" placeholder="Customer Full Name"/>
                    </td>
                </tr>
                <tr>
                    <th>Short Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.shortname" placeholder="Customer Short Name"/>
                    </td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.username" placeholder="Customer UserName"/>
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.password" placeholder="Password"/>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" class="form-control" v-model="customer.email" placeholder="Customer Email"/>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.phone" placeholder="Customer Phone"/>
                    </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.address" placeholder="Customer Address"/>
                    </td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.age" placeholder="Customer Address"/>
                    </td>
                </tr>
                <tr>
                    <th>Sex</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.gender" placeholder="Customer Sex"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/customers" class="btn">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';

    export default {
        name: 'new',
        data() {
            return {
                customer: {
                    fullname: '',
                    shortname: '',
                    username: '',
                    password: '',
                    email: '',
                    address: '',
                    phone: '',
                    gender: ''
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.customer, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/customers/new', this.$data.customer)
                    .then((response) => {
                        this.$router.push('/customers');
                    });
            },
            getConstraints() {
                return {
                    email: {
                        presence: true,
                        email: true
                    },
                    phone: {
                        presence: true,
                        numericality: true,
                        length: {
                            minimum: 10,
                            message: 'Must be at least 10 digits long'
                        }
                    }
                    // website: {
                    //     presence: true,
                    //     url: true
                    // }
                };
            }
        }
    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>

