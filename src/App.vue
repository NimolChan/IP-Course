<template>
  <div class="container">
    <div class="menu">
      <Menu :menuItems="productStore.groups" />
    </div>

    <div class="row1">
      <Category
        v-for="(category, index) in productStore.categories"
        :key="index"
        :image="category.image"
        :name="category.name"
        :productCount="category.productCount"
        :color="category.color"
      />
    </div>

    <div class="row2">
      <Promotion
        v-for="(promotion, index) in productStore.promotions"
        :key="index"
        :image="promotion.image"
        :color="promotion.color"
        :title="promotion.title"
      />
    </div>

    <div>
      <Product />
    </div>
  </div>
</template>

<script>
import Category from './components/Category.vue';
import Product from './components/Product.vue';
import Menu from './components/Menu.vue';
import Promotion from './components/Promotion.vue';
import { useProductStore } from './stores/productStore';
import { onMounted } from 'vue';

export default {
  name: 'App',
  components: {
    Category,
    Promotion,
    Menu,
    Product
  },
  setup() {
    const productStore = useProductStore();

   
    onMounted(async () => {
    await productStore.fetchGroups();
    console.log("Groups:", productStore.groups);

    await productStore.fetchProducts();
    console.log("Products:", productStore.products);

    await productStore.fetchCategories();
    console.log("Categories:", productStore.categories);

    await productStore.fetchPromotions();
    console.log("Promotions:", productStore.promotions);
});

    
    return {
      productStore, 
    };
  },
};
</script>

<style>
.container {
  width: 75rem;
  background-color: white;
  padding: 1rem;
  margin: auto;
}

.menu {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin-bottom: 1rem;
  font-size: 1rem;
  font-weight: 500;
  color: #333;
}

.row1{
  width: 100%;
  height: 30%;
  padding: 7px;
  display: flex;
  justify-content: space-between;
}
.row2{
  width: 100%;
  height: 70%;
  display: flex;
  justify-content: space-between;
}
.row1 .cat, .row2 .promotion {
  transition: transform 0.2s ease;
}

.row1 .cat:hover, .row2 .promotion:hover {
  transform: translateY(-5px);
}

</style>
