<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تعديل الخدمة</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label class="fw-bold">الاسم</label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" type="text" placeholder="الاسم">
                    </div>
                    <div v-if="errors.name" class="alert alert-danger">
                        {{ errors.name }}
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">الوصف</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': errors.description }" rows="4" placeholder="الوصف"></textarea>
                    </div>
                    <div v-if="errors.description" class="alert alert-danger">
                        {{ errors.description }}
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">السعر</label>
                        <input class="form-control" v-model="form.price" :class="{ 'is-invalid': errors.price }" type="number" placeholder="السعر">
                    </div>
                    <div v-if="errors.price" class="alert alert-danger">
                        {{ errors.price }}
                    </div>
                    <button class="btn btn-primary shadow-sm rounded-sm" type="submit">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    props: {
        service: Object,
        errors: Object
    },
    data() {
        return {
            form: {
                name: this.service.name,
                description: this.service.description,
                price: this.service.price
            }
        };
    },
    methods: {
        submit() {
            axios.put(`/services/${this.service.id}`, this.form)
                .then(response => {
                    Swal.fire({
                        title: 'نجاح!',
                        text: 'تم تحديث الخدمة بنجاح.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    // يمكنك اختياريًا توجيه المستخدم إلى صفحة أخرى بعد الإرسال الناجح
                    // this.$router.push('/services');
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    } else {
                        console.error('خطأ في تحديث الخدمة: ', error);
                    }
                });
        }
    }
};
</script>

<style>

</style>
