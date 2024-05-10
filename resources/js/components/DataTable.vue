<template>
    <el-table :data="props.data.map(data => ({ ...data, price: formatPrice(data?.price) }))" style="width: 100%"
        v-loading="loading">
        <el-table-column prop="name" label="Name" width="180" />
        <el-table-column prop="price" label="Price" />
        <el-table-column prop="bathrooms" label="Bathrooms" />
        <el-table-column prop="bedrooms" label="Bedrooms" />
        <el-table-column prop="garages" label="Garages" />
        <el-table-column prop="storeys" label="Storeys" />
    </el-table>
</template>

<script setup>
const props = defineProps({
    data: Array,
    loading: { default: false, type: Boolean }
})

const formatPrice = (value) => {
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });
    return formatter.format(value);
}

</script>
