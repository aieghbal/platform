<script setup>
import { ref } from 'vue';
import axios from 'axios';

const formData = ref({
    inputPercent: '',
    inputNumber: '',
    inputResult: '',
    inputDiff: ''
});

const loading = ref(false);
const error = ref(null);

const submitForm = async () => {
    loading.value = true;
    error.value = null;

    try {
        const response = await axios.post('/percentage-change-calculator', formData.value);

        formData.value.inputResult = response.data.inputResult;
        formData.value.inputDiff = response.data.inputDiff;


    } catch (err) {
        error.value = "خطایی در محاسبه رخ داد.";
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div dir="rtl">
        <h1>محاسبه تغییر درصد</h1>
        <form @submit.prevent="submitForm">
            <label>عدد اول</label>
            <input type="text" v-model="formData.inputPercent" placeholder="عدد اول">

            <label>عدد دوم</label>
            <input type="text" v-model="formData.inputNumber" placeholder="عدد دوم">

            <label>درصد تغییر</label>
            <input type="text" v-model="formData.inputResult" placeholder="درصد تغییر">

            <label>میزان تغییر</label>
            <input type="text" v-model="formData.inputDiff" placeholder="میزان تغییر">

            <button type="submit" :disabled="loading">
                {{ loading ? 'در حال محاسبه...' : 'ارسال' }}
            </button>
        </form>

        <div v-if="error" style="color: red; margin-top: 10px;">{{ error }}</div>
    </div>
</template>
