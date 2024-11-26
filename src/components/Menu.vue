<template>
  <nav class="menu">
    
    <ul>
      <li v-for="item in menuItems" :key="item" class="menu-item">
        {{ item }}
      </li>
    </ul>
  </nav>
</template>

<script>
import { mapState } from 'pinia'
import { useProductStore } from '@/stores/productStore' 

export default {
  name: 'Menu',
  props: {
    menuItems: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  computed: {
    ...mapState(useProductStore, {
      popularProducts: 'groups'
    })
  }
}
</script>

<style scoped>
.menu {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
}
.menu ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
  display: flex;
  gap: 1.5rem;
}

.menu-item {
  font-size: 1rem;
  color: #333;
  font-weight: 500;
  cursor: pointer;
  transition: color 0.3s ease;
}

.menu-item:hover {
  color: #4392f4;
}

.menu-item.active {
  font-weight: 700; 
  color: #000;
}


</style>
