<body dir="rtl">
<div id="app">
    <h1>محاسبه درصد آنلاین</h1>
    <p>برای محاسبه درصد تست، تخفیف و... اطلاعات کادر زیر را وارد کنید.</p>

    <form @submit.prevent="submitForm">
        <input type="text" v-model="formData.inputPercent" placeholder="درصد">
        <input type="text" v-model="formData.inputNumber" placeholder="عدد اصلی">
        <button type="submit" :disabled="loading">
            @{{ loading ? 'در حال محاسبه...' : 'ارسال' }}
        </button>
    </form>

    <hr>

    <div v-if="result !== null">
        <h3>@نتیجه: {{ result }}</h3>
    </div>

    <div v-if="error" style="color: red;">
        @{{ error }}
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
