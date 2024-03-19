<template>

    <Head>
        <title>نقطة البيع - نظام أبوحصان</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 rounded-3 shadow">
                            <div class="card-body">
                                <!-- <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                                    <input type="text" class="form-control" v-model="barcode" @keyup="searchProduct"
                                        placeholder="مسح او ادخل رقم البار كود" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">اسم المنتج</label>
                                    <input type="text" :value="product.title" class="form-control"
                                        placeholder="Product Name" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">الكمية</label>
                                    <input type="number" v-model="qty" class="form-control text-center"
                                        placeholder="Qty" min="1" />
                                </div> -->
                                <!-- multi select for employees -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">الموظفين</label>
                                    <VueMultiselect v-model="car_form.employees" label="name" track-by="name"
                                        :options="employees" placeholder="اختر الموظفين" multiple>
                                    </VueMultiselect>
                                </div>
                                <!-- multi select for services -->
                                <!-- <div class="mb-3">
                                    <label class="form-label fw-bold">الخدمات</label>
                                    <VueMultiselect v-model="car_form.services" label="name" track-by="name"
                                        :options="services" placeholder="اختر الخدمات" multiple>

                                    </VueMultiselect>
                                </div> -->
                                <div v-if="services_total > 0" class="m-3 text-start services-total">
                                    <h5 class="text-red-600">الخدمات</h5>
                                    <ul class="list-group">
                                        <li class="list-group
                                        " v-for="service in car_form.services" :key="service.id">
                                            <span class="list-group
                                            ">{{ service.name }} - .دل {{ service.price }}</span>
                                        </li>
                                        <li class="list-group">الاجمالي: .دل {{ services_total }}</li>


                                    </ul>

                                </div>

                                <div class="text-start">
                                    <!-- <button @click.prevent="clearSearch"
                                        class="btn btn-warning btn-md border-0 shadow text-uppercase mt-3 me-2">
                                        مسح
                                    </button>
                                    <button @click.prevent="addToCart"
                                        class="btn btn-success btn-md border-0 shadow text-uppercase mt-3"
                                        :disabled="!product.id">
                                        إضافة
                                    </button> -->


                                </div>
                                <hr class="mt-4 mb-4" />
                                <div class="category-list">
                                    <div class="category-item p-4" v-for="category in categories" :key="category.id"
                                        :disabled="!category.id" @click.prevent="
                                        getCategoryitems(category.id)
                                        ">
                                        <img :src="category.image" alt="Category Image" class="category-image" />
                                        <span class="category-name">{{
                                        category.name
                                    }}</span>
                                    </div>
                                </div>
                                <div class="item-list-container">
                                    <div class="item-list" ref="itemsList">
                                        <template v-for="item in items" :key="item.id">
                                        <button :disabled="!item.id" @click.prevent="addToCarForm(item.id, item.type)" class="btn btn-link" style="text-decoration: none">
                                                <div class="item_card border-0 rounded-3 shadow">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img :src="item.image || '/images/servicesP.png'
                                        " class="img-fluid" alt="product image" />
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h5 class="fw-bold" style="font-size: 1rem;">
                                                                    {{
                                        item.title || item.name
                                    }}
                                                                </h5>
                                                                <p class="text-muted">
                                                                    {{
                                            item.description
                                        }}
                                                                </p>
                                                                <h5 class="fw-bold">
                                                                    د.ل.
                                                                    {{
                                            formatPrice(
                                                item.sell_price || item.price
                                            )
                                        }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div v-if="session.error" class="alert alert-danger">
                            {{ session.error }}
                        </div>

                        <div v-if="session.success" class="alert alert-success">
                            {{ session.success }}
                        </div>

                        <div class="card border-0 rounded-3 shadow">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-bold">كاشير</label>
                                        <input type="text" :value="auth.user.name" class="form-control" readonly />
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <label class="fw-bold">زبون</label>
                                        <VueMultiselect v-model="customer_id" label="name" track-by="name"
                                            :options="customers" placeholder="اختر الزبون">
                                        </VueMultiselect>
                                    </div>
                                </div>
                                <hr />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #e6e6e7">
                                            <th scope="col">#</th>
                                            <th scope="col">المنتج</th>
                                            <th scope="col">السعر</th>
                                            <th scope="col">الكمية</th>
                                            <th scope="col">الاجمالي</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in car_form.products && car_form.services" :key="item.id">
                                            <td class="text-center">
                                                <button @click.prevent="
                                        decrease_product(
                                            item.id, item.type
                                        )
                                        " class="btn btn-danger btn-sm rounded-pill">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                            <td>{{ item.title || item.name }}</td>
                                            <td class="text-end">
                                                .دل
                                                {{ formatPrice(item.sell_price || item.price) }}
                                            </td>

                                            <td class="text-center">
                                                {{ item.qty || 1 }}
                                            </td>

                                            <td class="text-end fw-bold" style="
                                                    background-color: #e6e6e7;
                                                ">
                                                .دل
                                                {{ formatPrice(item.total_price || item.price) }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <hr />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-4 bd-highlight">
                                            <label>قيمة الخصم (.دل)</label>
                                            <input type="number" v-model="discount" @keyup="setDiscount"
                                                class="form-control" placeholder="قيمة الخصم" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bd-highlight mt-4">
                                            <label>المدفوع (.دل)</label>
                                            <input type="number" v-model="cash" @keyup="setChange" class="form-control"
                                                placeholder="المدفوع" />
                                        </div>
                                    </div>
                                </div>
                                <div class="text-start mt-4">
                                    <button class="btn btn-warning btn-md border-0 shadow text-uppercase me-2">
                                        إلغاء
                                    </button>
                                    <button @click.prevent="storeTransaction"
                                        class="btn btn-purple btn-md border-0 shadow text-uppercase" :disabled="cash < grandTotal || grandTotal == 0
                                        ">
                                        الدفع و الطباعة
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 rounded-3 shadow border-top-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        <h4 class="fw-bold">الاجمالي العام</h4>
                                    </div>
                                    <div class="col-md-8 col-8 text-start">
                                        <h4 class="fw-bold">
                                            .دل {{ grandTotal }}
                                        </h4>
                                        <div v-if="change > 0">
                                            <hr />
                                            <h5 class="text-success">
                                                Change:
                                                <strong>.دل
                                                    {{
                                                    formatPrice(change)
                                                    }}</strong>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
// import layout
import LayoutApp from '../../../Layouts/App.vue';
// import Head from Inertia
import { Head } from '@inertiajs/inertia-vue3';
// import ref from vue
import { ref, onMounted, reactive, watch, computed } from 'vue';
// import axios
import axios from 'axios';
// import Inertia adapter
import { Inertia } from '@inertiajs/inertia';
// import sweetalert2
import Swal from 'sweetalert2';
// import VueMultiselect
import VueMultiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.css'

export default {
    // layout
    layout: LayoutApp,

    // register components
    components: {
        Head,
        VueMultiselect,
    },

    // props
    props: {
        auth: Object,
        customers: Array,
        session: Object,
        vehicles: Array,
        'products': Array,
        'services': Array,
        'employees': Array,
        'categories': Array,

    },

    setup(props) {
        // define state
        const spare_total = ref(0);
        const services_total = ref(0);
        const employees_commission = ref({});
        const barcode = ref('');
        const product = ref({});
        const items = ref({});
        const qty = ref(1);
        const cash = ref(0);
        const change = ref(0);
        const discount = ref(0);

        const grandTotal = computed(() => {
            let total = 0;
            // Sum up the sell price of all products
            car_form.products.forEach(product => {
                total += product.qty * product.sell_price;
            });
            // Sum up the price of all services
            car_form.services.forEach(service => {
                total += service.price; // Assuming service quantity is always 1
            });
            // Apply discount if needed
            total -= discount.value;
            return total;
        });

        const car_form = reactive({
            customer_id: '',
            products: [],
            employees: [],
            services: [],
        });


        onMounted(() => {
            //add category to props.categories array called "services"
            props.categories.push({
                id: 100,
                name: "خدمات",
                image: "/images/servicesP.png"
            });
            const itemList = document.querySelector('.item-list-container');
            if (itemList) {
                // Add event listener for mouse wheel to enable horizontal scrolling
                itemList.addEventListener('wheel', (e) => {
                    e.preventDefault();
                    itemList.scrollLeft += e.deltaY;
                });
            }
        });


        // method searchProduct
        const searchProduct = () => {
            // fetch with axios
            axios.post('/apps/transactions/searchProduct', {
                // send data barcode
                barcode: barcode.value
            }).then(response => {
                if (response.data.success) {
                    // assign response to state product
                    product.value = response.data.data;
                } else {
                    // set state product to empty object
                    product.value = {};
                }
            });
        }

        const getCategoryitems = (id) => {
            // if id = 100 then it's services
            if (id === 100) {
                items.value = props.services;
            } else {
                // Check if props.products is not null or undefined
                if (!props.products) {
                    console.error("props.products is not defined");
                    return [];
                }
                // Filter the products by category id
                items.value = props.products.filter(product => product.category_id === id);
            }
        }
        const initializeItemsList = () => {
            // Get the product list container element
            const itemsList = this.$refs.itemsList;
            if (itemsList) {
                // Add event listener for mouse wheel to enable horizontal scrolling
                itemsList.addEventListener('wheel', (e) => {
                    e.preventDefault();
                    itemsList.scrollLeft += e.deltaY;
                });
            }
        };


        // method clearSearch
        const clearSearch = () => {
            // set state product to empty object
            product.value = {};

            // set state barcode to empty string
            barcode.value = '';
        }

        // define state grandTotal

        // method addToCart
        // method addToCart
        const addToCarForm = (id, type) => {
    console.log(id, type);

    if (type === 'Service') {
        const serviceToAdd = props.services.find(service => service.id === id);

        if (serviceToAdd) {
            const index = car_form.services.findIndex(service => service.id === id);

            if (index === -1) {
                car_form.services.push({
                    id: serviceToAdd.id,
                    name: serviceToAdd.name,
                    price: serviceToAdd.price,
                    type: serviceToAdd.type,
                });
            }
        } else {
            console.error(`Service with ID ${id} not found.`);
        }
    } else if (type === 'product') {
        const productToAdd = props.products.find(product => product.id === id);

        if (productToAdd) {
            const index = car_form.products.findIndex(product => product.id === id);

            if (index !== -1) {
                car_form.products[index].qty++;
                car_form.products[index].total_price = car_form.products[index].qty * car_form.products[index].sell_price;
            } else {
                car_form.products.push({
                    id: productToAdd.id,
                    title: productToAdd.title,
                    qty: 1,
                    sell_price: productToAdd.sell_price,
                    total_price: productToAdd.sell_price,
                    type: 'product',
                });
            }
        } else {
            console.error(`Product with ID ${id} not found.`);
        }
    } else {
        console.error(`Invalid type: ${type}`);
    }
};




        // method decrease_product
        const decrease_product = (id , type) => {

            if (type === 'Service') {
                const index = car_form.services.findIndex(service => service.id === id);
                if (index !== -1) {
                    car_form.services.splice(index, 1);
                }
            } else if (type === 'product') {
            const index = car_form.products.findIndex(product => product.id === id);
            if (index !== -1) {
                if (car_form.products[index].qty > 1) {
                    car_form.products[index].qty--;
                    // decrease total_price
                    car_form.products[index].total_price = car_form.products[index].qty * car_form.products[index].sell_price;
                } else {
                    car_form.products.splice(index, 1);
                }
                // Calculate grandTotal
                // grandTotal.value = car_form.products.reduce((total, product) => total + product.total_price, 0);
            }
        } else {
            console.error(`Invalid type: ${type}`);
        }
        }


        // method setDiscount
        const setDiscount = () => {
            // set discount
            discount.value = discount.value;
        }
        // method setChange
        const setChange = () => {
            // set change
            change.value = cash.value - grandTotal.value;
        }
        // define state customer_id
        const customer_id = ref('');
        // method storeTransaction
        const storeTransaction = () => {

            //HTTP request
            axios.post('/apps/transactions/store', {
                car_form: car_form,
                //send data to server
                customer_id: customer_id.value ? customer_id.value.id : '',
                discount: discount.value,
                grand_total: grandTotal.value,
                cash: cash.value,
                change: change.value
            }).then((response) => {
                //call method "clearSaerch"
                clearSearch();

                //set qty to "1"
                qty.value = 1;

                //set grandTotal
                grandTotal.value = 0;

                //set cash to "0"
                cash.value = 0;

                //set change to "0"
                change.value = 0;

                //set customer_id to ""
                customer_id.value = "";

                //show success alert
                Swal.fire({
                    title: "نجاح!",
                    text: "تمت المعاملة بنجاح.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(() => {
                    setTimeout(() => {
                        //print
                        window.open(
                            `/apps/transactions/print?invoice=${response.data.data.invoice}`,
                            "_blank"
                        );

                        //reload page
                        location.reload();
                    }, 50);
                });
            });
        };


        return {
            barcode,
            product,
            qty,
            searchProduct,
            clearSearch,
            qty,
            grandTotal,
            decrease_product,
            items,
            cash,
            change,
            discount,
            setDiscount,
            car_form,
            setChange,
            customer_id,
            storeTransaction,
            getCategoryitems,
            initializeItemsList,
            addToCarForm,
            employees_commission,
            services_total,
            spare_total,
        }
    }
}

</script>
<style>
.category-list {
    display: flex;
    overflow-x: auto;
    /* Allow horizontal scrolling */
}

.category-item {
    flex: 0 0 auto;
    /* Prevent items from growing */
    margin-right: 10px;
    /* Adjust spacing between items */
    cursor: pointer;
    /* Show pointer cursor on hover */
}

.category-image {
    width: 100px;
    /* Set the width of the category image */
    height: 100px;
    /* Set the height of the category image */
}

.category-name {
    display: block;
    text-align: center;
    margin-top: 5px;
    /* Adjust spacing between image and name */
}

.item-list-container {
    overflow-x: auto;
    white-space: nowrap;
}

.item-list {
    display: inline-flex;
    gap: 15px;
    padding: 15px;
}

.item_card {
    width: 300px;
    /* Adjust the card width as needed */
}
</style>
