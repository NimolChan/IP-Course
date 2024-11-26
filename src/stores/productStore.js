import { defineStore } from 'pinia';
import axios from 'axios';

export const useProductStore = defineStore('product', {
  state: () => ({
    groups: [], 
    promotions: [], 
    categories: [], 
    products: [], 
    selectedGroupName: '', 
    selectedGroupNameProduct: '', 
  }),

  getters: {
    getCategoriesByGroup: (state) => (groupName) => {
      return state.categories.filter((category) => category.groupName === groupName);
    },
    getProductsByGroup: (state) => (groupName) => {
      return state.products.filter((product) => product.groupName === groupName);
    },
    getProductsByCategory: (state) => (categoryId) => {
      return state.products.filter((product) => product.categoryId === categoryId);
    },
    getPopularProducts: (state) => {
      return state.products.filter((product) => product.countSold > 10);
    },

    filteredCategories: (state) => {
      if (!state.selectedGroupName) {
        return state.categories; 
      }
      return state.categories.filter((category) => category.group === state.selectedGroupName);
    },

    filteredProduct: (state) => {
      if (!state.selectedGroupNameProduct) {
        return state.products;
      }
      return state.products.filter((product) => product.group === state.selectedGroupNameProduct);
    },
  },

  actions: {
    setSelectedGroup(group) {
      this.selectedGroupName = group;
    },
    setSelectedGroupProduct(group) {
      this.selectedGroupNameProduct = group;
    },

    async fetchGroups() {
      try {
        const response = await axios.get('http://localhost:3000/api/groups');
        this.groups = response.data;
      } catch (error) {
        console.error('Error fetching groups:', error);
      }
    },

    async fetchProducts() {
      try {
        const response = await axios.get('http://localhost:3000/api/products');
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },

    async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:3000/api/categories');
        this.categories = response.data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },

    async fetchPromotions() {
      try {
        const response = await axios.get('http://localhost:3000/api/promotions');
        this.promotions = response.data;
      } catch (error) {
        console.error('Error fetching promotions:', error);
      }
    },
  },
});
