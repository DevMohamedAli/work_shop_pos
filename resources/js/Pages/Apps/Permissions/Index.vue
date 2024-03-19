<template>
    <Head>
        <title>الصلاحيات - نظام أبوحصان</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-key"></i> الصلاحيات</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="search" placeholder="البحث بواسطة اسم الصلاحية...">
                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> بحث</button>
                                    </div>
                                </form>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">اسم الصلاحية</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(permission, index) in permissions.data" :key="index">
                                            <td>{{ permission.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="permissions.links" align="end"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    // استيراد layout
    import LayoutApp from '../../../Layouts/App.vue';

    // استيراد component pagination
    import Pagination from '../../../Components/Pagination.vue';

    // استيراد Head و Link من Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';

    // استيراد ref من vue
    import { ref } from 'vue';

    // استيراد inerita adapter
    import { Inertia } from '@inertiajs/inertia';

    export default {
        // تعيين layout
        layout: LayoutApp,

        // تسجيل المكونات
        components: {
            Head,
            Link,
            Pagination
        },

        // الخصائص
        props: {
            permissions: Object,
        },

        setup() {
            // تعريف حالة البحث
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            // تعريف طريقة البحث
            const handleSearch = () => {
                Inertia.get('/apps/permissions', {
                    // إرسال قيمة حالة "search" كمعلمة "q"
                    q: search.value
                });
            }

            // العودة بالقيم
            return {
                search,
                handleSearch
            }
        }
    }
</script>

<style>

</style>
