<template>
    <Head>
        <title>إضافة مستخدم جديد - نظام أبوحصان</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-user"></i> إضافة مستخدم جديد</span>
                            </div>
                            <div class="card-body">

                                <form @submit.prevent="submit">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">الاسم الكامل</label>
                                                <input class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" type="text" placeholder="الاسم الكامل">
                                            </div>
                                            <div v-if="errors.name" class="alert alert-danger">
                                                {{ errors.name }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">عنوان البريد الإلكتروني</label>
                                                <input class="form-control" v-model="form.email" :class="{ 'is-invalid': errors.email }" type="email" placeholder="عنوان البريد الإلكتروني">
                                            </div>
                                            <div v-if="errors.email" class="alert alert-danger">
                                                {{ errors.email }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">كلمة المرور</label>
                                                <input class="form-control" v-model="form.password" :class="{ 'is-invalid': errors.password }" type="password" placeholder="كلمة المرور">
                                            </div>
                                            <div v-if="errors.password" class="alert alert-danger">
                                                {{ errors.password }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">تأكيد كلمة المرور</label>
                                                <input class="form-control" v-model="form.password_confirmation" type="password" placeholder="تأكيد كلمة المرور">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="fw-bold">الأدوار</label>
                                                <br>
                                                <div class="form-check form-check-inline" v-for="(role, index) in roles" :key="index">
                                                    <input class="form-check-input" type="checkbox" v-model="form.roles" :value="role.name" :id="`check-${role.id}`">
                                                    <label class="form-check-label" :for="`check-${role.id}`">{{ role.name }}</label>
                                                </div>
                                            </div>
                                            <div v-if="errors.roles" class="alert alert-danger">
                                                {{ errors.roles }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">حفظ</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">إعادة تعيين</button>
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

        // register component
        components: {
            Head,
            Link
        },

        // props
        props: {
            errors: Object,
            roles: Array,
        },

        // composition API
        setup() {
            // define form with reactive
            const form = reactive({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                roles: []
            });

            // method submit
            const submit = () => {
                // send data to server
                Inertia.post('/apps/users', {
                    // data
                    name: form.name,
                    email: form.email,
                    password: form.password,
                    password_confirmation: form.password_confirmation,
                    roles: form.roles
                }, {
                    onSuccess: () => {
                        // show success alert
                        Swal.fire({
                            title: 'نجاح!',
                            text: 'تم حفظ المستخدم بنجاح.',
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
