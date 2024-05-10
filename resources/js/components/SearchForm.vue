<template>
    <el-form :model="form" label-width="auto" ref="formRef" :inline="true">
        <el-form-item prop="name" label="Name">
            <el-input v-model="form.name" style="width: 300px;" />
        </el-form-item>
        <el-form-item prop="minPrice" label="Min Price">
            <el-input autocomplete="off" v-model.number="form.minPrice" style="width: 300px;" type="number" min="0" />
        </el-form-item>
        <el-form-item prop="maxPrice" label="Max Price">
            <el-input autocomplete="off" v-model.number="form.maxPrice" style="width: 300px;" type="number" min="0" />
        </el-form-item>
        <el-form-item prop="bathrooms" label="Bathrooms"
            :rules="[{ type: 'number', message: 'Bathrooms must be a number' }]">
            <el-input v-model.number="form.bathrooms" style="width: 300px;" />
        </el-form-item>
        <el-form-item prop="bedrooms" label="Bedrooms"
            :rules="[{ type: 'number', message: 'Bedrooms must be a number' }]">
            <el-input v-model.number="form.bedrooms" style="width: 300px;" />
        </el-form-item>
        <el-form-item prop="garages" label="Garages" :rules="[{ type: 'number', message: 'Garages must be a number' }]">
            <el-input v-model.number="form.garages" style="width: 300px;" />
        </el-form-item>
        <el-form-item prop="storeys" label="Storeys" :rules="[{ type: 'number', message: 'Storeys must be a number' }]">
            <el-input v-model.number="form.storeys" style="width: 300px;" />
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm(formRef)" :disabled="isEmpty">Search</el-button>
            <el-button @click="resetForm(formRef)">Reset</el-button>
        </el-form-item>
    </el-form>
</template>

<script setup>
import { reactive, ref, watch } from 'vue'
const emit = defineEmits(['submit', 'reset']);
const formRef = ref();

const form = reactive({
    name: '',
    minPrice: '',
    maxPrice: '',
    bathrooms: '',
    bedrooms: '',
    garages: '',
    storeys: '',
});

const isEmpty = ref(true);

const submitForm = (formEl) => {
    if (!formEl) return
    formEl.validate((valid) => {
        if (valid) {
            emit('submit', form)
        } else {
            console.log('error submit!')
            return false
        }
    })
}

const resetForm = (formEl) => {
    if (!formEl) return
    formEl.resetFields()
    emit('reset')
}


watch(form, (newValue) => {
    isEmpty.value = Object.values(newValue).every(value => !value);
}, { deep: true });

</script>
