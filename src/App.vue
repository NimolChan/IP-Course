<template>
  <div class="container">
    <div class="menu">
      <h2 class="section-title">Featured Categories</h2>
      <Menu :menuItems="groups" />
    </div>

    <div class="row1">
      <Category
        v-for="(category, index) in categories"
        :key="index"
        :image="category.image"
        :name="category.name"
        :productCount="category.productCount"
        :color="category.color"
      />
    </div>

    <div class="row2">
      <Promotion
        v-for="(promotion, index) in promotions"
        :key="index"
        :image="promotion.image"
        :color="promotion.color"
        :title="promotion.title"
      />
    </div>

    <div class="menu">
      <h2 class="section-title">Popular Products</h2>
      <Menu :menuItems="groups" />
    </div>
    <div class="row3">
      <Product
        v-for="(product, index) in popularProducts"
        :key="index"
        :image="product.image"
        :name="product.name"
        :rating="product.rating"
        :size="product.size"
        :price="product.price"
        :promotionAsPercentage="product.promotionAsPercentage"
        :categoryId="product.categoryId"
        :instock="product.instock"
        :countSold="product.countSold"
        :group="product.groups"
      />
    </div>
  </div>
</template>

<script>
import { onMounted, computed } from 'vue';
import { useProductStore } from './stores/productStore';
import Category from './components/Category.vue';
import Product from './components/Product.vue';
import Menu from './components/Menu.vue';
import Promotion from './components/Promotion.vue';

export default {
  name: 'App',
  components: {
    Category,
    Promotion,
    Menu,
    Product,
  },
  setup() {
    const productStore = useProductStore();

    onMounted(async () => {
      try {
        await Promise.all([
          productStore.fetchGroups(),
          productStore.fetchProducts(),
          productStore.fetchCategories(),
          productStore.fetchPromotions(),
        ]);


        console.log("Categories:", productStore.categories);
        console.log("Promotions:", productStore.promotions);
        console.log("Groups:", productStore.groups);
        console.log("Products:", productStore.products);
      } catch (error) {
        console.error("Error loading data:", error);
      }
    });

   
        const groups = computed(() => productStore.groups);
        const categories = computed(() => productStore.categories);
        const promotions = computed(() => productStore.promotions);
        const popularProducts = computed(() => productStore.getPopularProducts);

    return {
      groups,
      categories,
      promotions,
      popularProducts,
    };
  },
};
</script>

<style scoped>
.container {
  width: 100%;
  background-color: white;
  padding: 1rem;
  margin: auto;
}

.menu {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.row1,
.row2 {
  width: 100%;
  display: flex;
  justify-content: space-between;
  gap: 1rem;
}

.row3 {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1rem;
  margin-top: 3rem;
}

.section-title {
  color: black;
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
}
</style>
