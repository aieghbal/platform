<script setup>
import { ref } from 'vue';
import axios from 'axios';

const formData = ref({
    inputPercent: '',
    inputNumber: ''
});
const result = ref(null);
const loading = ref(false);
const error = ref(null);

const submitForm = async () => {
    loading.value = true;
    error.value = null;
    result.value = null;

    try {
        const response = await axios.post('/percentage', formData.value);
        result.value = response.data.result;
    } catch (err) {
        error.value = "خطایی در محاسبه رخ داد.";
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div dir="rtl">
        <h1>محاسبه درصد آنلاین</h1>
        <form @submit.prevent="submitForm">
            <label>

            </label>
            <input type="text" v-model="formData.inputPercent" placeholder="درصد">
            <input type="text" v-model="formData.inputNumber" placeholder="عدد">
            <button type="submit" :disabled="loading">
                {{ loading ? 'در حال محاسبه...' : 'ارسال' }}
            </button>
        </form>
        <div v-if="result !== null">نتیجه: {{ result }}</div>
        <div v-if="error" style="color: red;">{{ error }}</div>
    </div>
</template>
