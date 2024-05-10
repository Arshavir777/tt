<template>
  <el-container>
    <el-main>
      <SearchForm @submit="applyFilters" @reset="resetFilters" />
      <DataTable :data="properties" :loading="loading" />
    </el-main>
  </el-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { ElNotification } from 'element-plus'
import apiService from './services/api.service';
import DataTable from './components/DataTable.vue';
import SearchForm from './components/SearchForm.vue';

const loading = ref(false);
const properties = ref([]);

const loadProperties = async (filters = {}) => {
  loading.value = true
  try {
    const { data } = await apiService.getProperties(filters);
    properties.value = data
  } catch (e) {
    ElNotification({
      title: 'Error',
      type: 'error',
      message: e.message || 'Something went wrong',
    })
  }
  loading.value = false
}

const applyFilters = (filters) => {
  loadProperties(filters)
}

const resetFilters = () => {
  loadProperties()
}

onMounted(() => {
  loadProperties()
})

</script>
