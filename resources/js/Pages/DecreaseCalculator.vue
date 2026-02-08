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
        const response = await axios.post('/percentage-decrease-calculator', formData.value);

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
        <h1>محاسبه کاهش درصد</h1>
        <form @submit.prevent="submitForm">
            <label>درصد کاهش</label>
            <input type="text" v-model="formData.inputPercent" placeholder="درصد کاهش">

            <label>عدد</label>
            <input type="text" v-model="formData.inputNumber" placeholder="عدد">

            <label>نتیجه</label>
            <input type="text" v-model="formData.inputResult" placeholder="نتیجه">

            <label>میزان کاهش</label>
            <input type="text" v-model="formData.inputDiff" placeholder="میزان کاهش">

            <button type="submit" :disabled="loading">
                {{ loading ? 'در حال محاسبه...' : 'ارسال' }}
            </button>
        </form>

        <div v-if="error" style="color: red; margin-top: 10px;">{{ error }}</div>
    </div>
</template>
