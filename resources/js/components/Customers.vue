<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test data Component</div>

                    <div class="card-body" v-for="customerShow in customers" :key="customerShow.id_customer">
                        <p class="card-text">{{customerShow.name_customer}}</p>
                        <p class="card-text">{{customerShow.phone_customer}}</p>
                        <p class="card-text">{{customerShow.email_customer}}</p>
                        <p class="card-text">{{customerShow.city_customer}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            customers: [],

            customer: {
                id_customer: "",
                name_customer: "",
                phone_customer: "",
                // address_customer:'',
                email_customer: "",
                city_customer: ""
            },

            id_customer: "",
            pagination: {},
            edit: false
        };
    },
    created() {
        this.fetchCustomers();
    },
    methods:{
        fetchCustomers:function(){
            fetch('api/customers')
            .then(Response=>Response.json())
            .then(Response =>{
                this.customers = Response.data;
                console.log(Response.data)
            })
            .catch(Error=>"error")
        }
    }
};
</script>
