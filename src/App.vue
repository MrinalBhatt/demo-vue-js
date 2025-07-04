<script setup>
import { ref } from 'vue'
import axios from 'axios'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
const loading = ref(false)
const users = ref([])
const totalRecords = ref(0)
const rowsPerPage = 5

// fetchPosts supports pagination
const fetchPosts = async (page = 1) => {
  loading.value = true
  const skip = (page - 1) * rowsPerPage
  try {
    const res = await axios.get(`http://localhost:8000/api/fetch-data?limit=${rowsPerPage}&skip=${skip}`)
    users.value = res.data.data.posts
    console.log(res.data.data.posts);
    totalRecords.value = res.data.data.total // total = 150
  } catch (err) {
    console.error('❌ Error fetching posts:', err)
  } finally {
    loading.value = false
  }
}
const onPageChange = (event) => {
  fetchPosts(event.page + 1)
}
// initial load
fetchPosts(1)
</script>
<template>
  <div class="playground">
    <h1>PrimeVue Playground 🎨</h1>
    
    <!-- DataTable Example -->
    <DataTable 
    :value="users"
    :loading="loading"
    :paginator="true"
    :rows="rowsPerPage"
    :totalRecords="totalRecords"
    :lazy="true"
    @page="onPageChange" >
      <Column field="id" header="ID" />
      <Column field="title" header="Title" />
      <Column field="body" header="Description" />
      <Column field="tags" header="Tags">
      <template #body="{ data }">
        {{ (data.tags) ? data.tags.join(', ') : "" }}
      </template>
    </Column>
    <Column header="Likes">
  <template #body="{ data }">
    👍 {{ data.reactions?.likes ?? 0 }}
  </template>
</Column>

<Column header="Dislikes">
  <template #body="{ data }">
    👎 {{ data.reactions?.dislikes ?? 0 }}
  </template>
</Column>
    </DataTable>
    </div>
</template>

<style scoped>
.playground {
  padding: 2rem;
  max-width: 800px;
  margin: 0 auto;
}
</style>
