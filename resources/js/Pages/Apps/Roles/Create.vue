<template>
    <Head>
        <title>إضافة دور جديد - Aplikasi Kasir</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> إضافة دور</span>
                            </div>
                            <div class="card-body">

                                <form @submit.prevent="submit">

                                    <div class="mb-3">
                                        <label class="fw-bold">اسم الدور</label>
                                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" type="text" placeholder="اسم الدور">

                                        <div v-if="errors.name" class="alert alert-danger">
                                            {{ errors.name }}
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="mb-3">
                                        <label class="fw-bold">الصلاحيات</label>
                                        <br>
                                        <div class="form-check form-check-inline" v-for="(permission, index) in permissions" :key="index">
                                            <input class="form-check-input" type="checkbox" v-model="form.permissions" :value="permission.name" :id="`check-${permission.id}`">
                                            <label class="form-check-label" :for="`check-${permission.id}`">{{ permission.name }}</label>
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
    import LayoutApp from '../../../Layouts/App.vue';

    // استيراد Head وuseForm من Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';

    // استيراد reactive من vue
    import { reactive } from 'vue';

    // استيراد inerita adapter
    import { Inertia } from '@inertiajs/inertia';

    // استيراد sweet alert2
    import Swal from 'sweetalert2';

    export default {
        // layout
        layout: LayoutApp,

        // تسجيل المكونات
        components: {
            Head,
            Link
        },

        // الخصائص
        props: {
            errors: Object,
            permissions: Array,
        },

        // composition API
        setup() {

            // تعريف الفورم بواسطة reactive
            const form = reactive({
                name: '',
                permissions: [],
            });

            // الطريقة "submit"
            const submit = () => {

                // إرسال البيانات إلى الخادم
                Inertia.post('/apps/roles', {
                    // البيانات
                    name: form.name,
                    permissions: form.permissions,
                }, {
                    onSuccess: () => {
                        // عرض تنبيه النجاح
                        Swal.fire({
                            title: 'نجاح!',
                            text: 'تم حفظ الدور بنجاح.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });

            }

            return {
                form,
                submit,
            };

        }
    }
</script>

<style>

</style>
