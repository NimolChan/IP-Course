import { defineStore } from 'pinia';
import axios from 'axios';

export const useProductStore = defineStore('product', {
  state: () => ({
    groups: [],
    promotions: [],
    categories: [],
    products: []
  }),
  getters: {
    getCategoriesByGroup: (state) => (groupName) => {
      return state.categories.filter(category => category.groupName === groupName);
    },
    getProductsByGroup: (state) => (groupName) => {
      return state.products.filter(product => product.groupName === groupName);
    },
    getProductsByCategory: (state) => (categoryId) => {
      return state.products.filter(product => product.categoryId === categoryId);
    },
    getPopularProducts: (state) => {
      return state.products.filter(product => product.countSold > 10);
    }
  },
  actions: {
    async fetchGroups() {
      const response = await axios.get('http://localhost:3000/api/groups');
      this.groups = response.data;
    },
    async fetchProducts() {
      const response = await axios.get('http://localhost:3000/api/products');
      this.products = response.data;
    },
    async fetchCategories() {
      const response = await axios.get('http://localhost:3000/api/categories');
      this.categories = response.data;
    },
    async fetchPromotions() {
      const response = await axios.get('http://localhost:3000/api/promotions');
      this.promotions = response.data;
    }
  }
});
