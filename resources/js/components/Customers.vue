<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="card-header col-md-11">
                                Test data Customers
                            </div>
                            <b-button
                                class="col-md-1"
                                variant="outline-primary"
                                @click="$bvModal.show('customer-add')"
                                >&plus;</b-button
                            >
                            <b-modal
                                id="customer-add"
                                hide-footer
                                @close="$bvModal.hide('customer-add')"
                            >
                                <div class="d-block">
                                    <h3>Add customer</h3>
                                    <b-form @submit.prevent="addCustomer">
                                        <b-form-group label="Name:">
                                            <b-form-input
                                                type="text"
                                                v-model="customer.name_customer"
                                                placeholder="Enter Customer's name"
                                                required
                                            ></b-form-input>
                                        </b-form-group>

                                        <b-form-group label="Phone:">
                                            <b-form-input
                                                type="text"
                                                v-model="
                                                    customer.phone_customer
                                                "
                                                placeholder="Customer's phone number"
                                                required
                                            ></b-form-input>
                                        </b-form-group>

                                        <b-form-group label="Address:">
                                            <b-form-input
                                                type="text"
                                                v-model="
                                                    customer.address_customer
                                                "
                                                placeholder="Customer's address"
                                                required
                                            ></b-form-input>
                                        </b-form-group>

                                        <b-form-group label="Email:">
                                            <b-form-input
                                                type="email"
                                                v-model="
                                                    customer.email_customer
                                                "
                                                placeholder="Type Customer's email"
                                                required
                                            ></b-form-input>
                                        </b-form-group>

                                        <b-form-group label="City:">
                                            <b-form-input
                                                type="text"
                                                v-model="customer.city_customer"
                                                placeholder="Type Customer's City"
                                                required
                                            ></b-form-input>
                                        </b-form-group>

                                        <div class="row justify-content-center">
                                            <b-button
                                                class="mr-1"
                                                @click="
                                                    $bvModal.hide(
                                                        'customer-add'
                                                    )
                                                "
                                                >Cancel</b-button
                                            >
                                            <b-button
                                                type="submit"
                                                variant="primary"
                                                >Add</b-button
                                            >
                                        </div>
                                    </b-form>
                                </div>
                            </b-modal>
                        </div>
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li
                                class="page-item"
                                :class="[{ disabled: !pagination.prevPageUrl }]"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="
                                        fetchCustomers(pagination.prevPageUrl)
                                    "
                                    aria-label="Previous"
                                >
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"
                                    >Trang {{ pagination.currentPage }} -
                                    {{ pagination.lastPage }}</a
                                >
                            </li>
                            <li
                                class="page-item"
                                :class="[{ disabled: !pagination.nextPageUrl }]"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="
                                        fetchCustomers(pagination.nextPageUrl)
                                    "
                                    aria-label="Next"
                                >
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div
                        class="card-body"
                        v-for="customerShow in customers"
                        :key="customerShow.id_customer"
                    >
                        <p class="card-text">
                            {{ customerShow.id_customer }}
                        </p>
                        <p class="card-text">
                            {{ customerShow.name_customer }}
                        </p>
                        <p class="card-text">
                            {{ customerShow.phone_customer }}
                        </p>
                        <p class="card-text">
                            {{ customerShow.address_customer }}
                        </p>
                        <p class="card-text">
                            {{ customerShow.email_customer }}
                        </p>
                        <p class="card-text">
                            {{ customerShow.city_customer }}
                        </p>
                        <b-button
                            variant="warning"
                            @click="editCustomer(customerShow)"
                            >Edit</b-button
                        >

                        <button
                            @click="deleteCustomer(customerShow.id_customer)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                    </div>
                    <b-modal
                        id="customer-edit"
                        hide-footer
                        @close="resetCustomerEdit"
                    >
                        <div class="d-block">
                            <h3>Edit customer</h3>
                            <b-form @submit.prevent="saveEdit">
                                <b-form-group label="Name:">
                                    <b-form-input
                                        type="text"
                                        v-model="customer.name_customer"
                                        placeholder="Enter Customer's name"
                                        required
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group label="Phone:">
                                    <b-form-input
                                        type="text"
                                        v-model="customer.phone_customer"
                                        placeholder="Customer's phone number"
                                        required
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group label="Address:">
                                    <b-form-input
                                        type="text"
                                        v-model="customer.address_customer"
                                        placeholder="Customer's address"
                                        required
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group label="Email:">
                                    <b-form-input
                                        type="email"
                                        v-model="customer.email_customer"
                                        placeholder="Type Customer's email"
                                        required
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group label="City:">
                                    <b-form-input
                                        type="text"
                                        v-model="customer.city_customer"
                                        placeholder="Type Customer's City"
                                        required
                                    ></b-form-input>
                                </b-form-group>

                                <div class="row justify-content-center">
                                    <b-button
                                        class="mr-1"
                                        @click="resetCustomerEdit"
                                        >Cancel</b-button
                                    >
                                    <b-button type="submit" variant="primary"
                                        >Save</b-button
                                    >
                                </div>
                            </b-form>
                        </div>
                    </b-modal>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    data() {
        return {
            customers: [],

            customer: {
                id_customer: "",
                name_customer: "",
                phone_customer: "",
                address_customer: "",
                email_customer: "",
                city_customer: ""
            },

            id_customer: "",
            pagination: {}
            // edit: false
        };
    },
    created() {
        this.fetchCustomers();
    },
    methods: {
        fetchCustomers: function(pageUrl) {
            pageUrl = pageUrl || "api/customers";
            fetch(pageUrl)
                .then(Response => Response.json())
                .then(Response => {
                    this.customers = Response.data;
                    this.makePagination(Response.meta, Response.links);
                })
                .catch(Error => "error");
        },
        makePagination: function(meta, links) {
            let pagination = {
                currentPage: meta.current_page,
                lastPage: meta.last_page,
                nextPageUrl: links.next,
                prevPageUrl: links.prev
            };
            this.pagination = pagination;
        },
        deleteCustomer: function(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete("api/customers/" + id)
                        .then(Response => {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            this.fetchCustomers();
                        })
                        .catch(Error => "error");
                }
            });
        },
        resetCustomerEdit: function() {
            this.$bvModal.hide("customer-edit");
            this.customer.name_customer = "";
            this.customer.phone_customer = "";
            this.customer.email_customer = "";
            this.customer.city_customer = "";
            this.customer.address_customer = "";
            this.customer.id_customer = "";
        },
        addCustomer: function() {
            // if (this.edit === false) {
            //add
            let formData = new FormData();

            formData.append("name_customer", this.customer.name_customer);
            formData.append("phone_customer", this.customer.phone_customer);
            formData.append("email_customer", this.customer.email_customer);
            formData.append("city_customer", this.customer.city_customer);
            formData.append("address_customer", this.customer.address_customer);

            axios
                .post("api/customers", formData)
                .then(Response => {
                    this.$bvModal.hide("customer-add");

                    Swal.fire(
                        "Success!",
                        "Data has been added successfully!",
                        "success"
                    );

                    this.customer.name_customer = "";
                    this.customer.phone_customer = "";
                    this.customer.email_customer = "";
                    this.customer.city_customer = "";
                    this.customer.address_customer = "";
                    this.fetchCustomers();
                })
                .catch(Error => console.log(Error));
            // }
        },
        editCustomer: function(showCustomer) {
            // this.edit = true;
            this.customer.id_customer = showCustomer.id_customer;
            this.customer.name_customer = showCustomer.name_customer;
            this.customer.email_customer = showCustomer.email_customer;
            this.customer.phone_customer = showCustomer.phone_customer;
            this.customer.city_customer = showCustomer.city_customer;
            this.customer.address_customer = showCustomer.address_customer;
            this.$bvModal.show("customer-edit");
        },
        saveEdit: function() {
            axios
                .put("api/customers/" + this.customer.id_customer, {
                    // params: {
                        name_customer: this.customer.name_customer,
                        phone_customer: this.customer.phone_customer,
                        email_customer: this.customer.email_customer,
                        city_customer: this.customer.city_customer,
                        address_customer: this.customer.address_customer
                    // }
                })
                .then(Response => {
                    this.$bvModal.hide("customer-edit");

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: toast => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: "Update successfully"
                    });

                    this.customer.name_customer = "";
                    this.customer.id_customer = "";
                    this.customer.phone_customer = "";
                    this.customer.email_customer = "";
                    this.customer.city_customer = "";
                    this.customer.address_customer = "";
                    this.fetchCustomers();
                })
                .catch(Error => console.log(Error));
        }
    }
};
</script>
