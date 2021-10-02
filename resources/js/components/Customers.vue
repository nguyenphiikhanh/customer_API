<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test data Customers</div>

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
                            {{ customerShow.email_customer }}
                        </p>
                        <p class="card-text">
                            {{ customerShow.city_customer }}
                        </p>
                        <b-button
                            variant="warning"
                            @click="$bvModal.show('bv-modal-example')"
                            >Edit</b-button
                        >
                        <b-modal id="bv-modal-example" hide-footer @close="$bvModal.hide('bv-modal-example')">
                            <div class="d-block">
                                <h3>Edit Info</h3>
                                <b-form>
                                    <b-form-group
                                        id="input-group-1"
                                        label="Email address:"
                                        label-for="input-1"
                                    >
                                        <b-form-input
                                            id="input-1"
                                            type="email"
                                            placeholder="Enter email"
                                            required
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group
                                        id="input-group-2"
                                        label="Your Name:"
                                        label-for="input-2"
                                    >
                                        <b-form-input
                                            id="input-2"
                                            placeholder="Enter name"
                                            required
                                        ></b-form-input>
                                    </b-form-group>


                                    <div class="row justify-content-center">
                                        <b-button type="submit" class="mr-1" @click="$bvModal.hide('bv-modal-example')"
                                        >Close</b-button
                                    >
                                    <b-button type="reset" variant="primary"
                                        >Save</b-button
                                    >
                                    </div>
                                </b-form>
                            </div>
                        </b-modal>

                        <button
                            @click="deleteCustomer(customerShow.id_customer)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                    </div>
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
    methods: {
        fetchCustomers: function(pageUrl) {
            pageUrl = pageUrl || "api/customers";
            fetch(pageUrl)
                .then(Response => Response.json())
                .then(Response => {
                    this.customers = Response.data;
                    // console.log(Response.data)
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
        }
    }
};
</script>
