<template>

    <Head>
        <title>إضافة خدمة جديدة - نضام ابوحصان</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-user-circle"></i>إضافة خدمة جديد</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">اسم</label>
                                                <input type="text" v-model="form.name" class="form-control"
                                                    :class="{ 'is-invalid': errors.name }" placeholder="الاسم">
                                            </div>
                                            <div v-if="errors.name" class="alert alert-danger">
                                                {{ errors.name }}
                                            </div>
                                        </div>
                                        <!-- discrption -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">الوصف</label>
                                                <input type="text" v-model="form.description" class="form-control"
                                                    :class="{ 'is-invalid': errors.description }"
                                                    placeholder="الوصف">
                                            </div>
                                            <div v-if="errors.description" class="alert alert-danger">
                                                {{ errors.description }}
                                            </div>
                                        </div>
                                        <!-- price -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">السعر</label>
                                                <input type="text" v-model="form.price" class="form-control"
                                                    :class="{ 'is-invalid': errors.price }" placeholder="السعر">
                                            </div>
                                            <div v-if="errors.price" class="alert alert-danger">
                                                {{ errors.price }}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 text-start">
                                            <button class="btn btn-primary shadow-sm rounded-sm"
                                                type="submit">حفظ</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm ms-3"
                                                type="reset">مسح</button>
                                        </div>
                                    </div>
                                </form>
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

// import Head and Link from Inertia
import { Head, Link } from '@inertiajs/inertia-vue3';

// import reactive from vue
import { reactive } from 'vue';

// import Inertia adapter
import { Inertia } from '@inertiajs/inertia';

// import sweetalert2
import Swal from 'sweetalert2';

export default {
    // layout
    layout: LayoutApp,

    // register components
    components: {
        Head,
        Link
    },

    // props
    props: {
        errors: Object
    },

    // composition API
    setup() {
        // define form with reactive
        const form = reactive({
            name: '',
            description: '',
            price: ''
        });

        // method submit
        const submit = () => {
            // send data to server
            Inertia.post('/apps/services', {
                // data
                name: form.name,
                description: form.description,
                price: form.price

            }, {
                onSuccess: () => {
                    // show success alert
                    Swal.fire({
                        title: 'نجاح!',
                        text: 'تم أضافة الخدمة بنجاح!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }

        return {
            form,
            submit
        }
    }
}
</script>
