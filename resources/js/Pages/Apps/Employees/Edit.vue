
<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تعديل الموظف</h3>
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
                                <label class="fw-bold">رقم الهاتف</label>
                                <input class="form-control" v-model="form.phone" :class="{ 'is-invalid': errors.phone }" type="number" placeholder="رقم الهاتف">
                            </div>
                            <div v-if="errors.phone" class="alert alert-danger">
                                {{ errors.phone }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">تخصص</label>
                                <input class="form-control" v-model="form.specialization" :class="{ 'is-invalid': errors.specialization }" type="text" placeholder="تخصص">
                            </div>
                            <div v-if="errors.specialization" class="alert alert-danger">
                                {{ errors.specialization }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">هاتف الأقارب</label>
                                <input class="form-control" v-model="form.relatives_phone" :class="{ 'is-invalid': errors.relatives_phone }" type="number" placeholder="هاتف الأقارب">
                            </div>
                            <div v-if="errors.relatives_phone" class="alert alert-danger">
                                {{ errors.relatives_phone }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">فصيلة الدم</label>
                        <input class="form-control" v-model="form.blood_type" :class="{ 'is-invalid': errors.blood_type }" type="text" placeholder="فصيلة الدم">
                    </div>
                    <div v-if="errors.blood_type" class="alert alert-danger">
                        {{ errors.blood_type }}
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">العنوان</label>
                        <textarea class="form-control" v-model="form.address" :class="{ 'is-invalid': errors.address }" rows="4" placeholder="العنوان"></textarea>
                    </div>
                    <div v-if="errors.address" class="alert alert-danger">
                        {{ errors.address }}
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
        employee: Object,
        errors: Object
    },
    data() {
        return {
            form: {
                name: this.employee.name,
                phone: this.employee.phone,
                specialization: this.employee.specialization,
                relatives_phone: this.employee.relatives_phone,
                blood_type: this.employee.blood_type,
                address: this.employee.address
            }
        };
    },
    methods: {
        submit() {
            axios.put(`/employees/${this.employee.id}`, this.form)
                .then(response => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Employee updated successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    // Optionally, you can redirect the user to another page after successful submission
                    // this.$inertia.visit('/employees');
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    } else {
                        console.error('Error updating employee: ', error);
                    }
                });
        }
    }
};
</script>

<style>

</style>
