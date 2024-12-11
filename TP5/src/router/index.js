import { createRouter, createWebHistory } from 'vue-router'
import Page1 from '@/view/PageOne.vue'
import Page2 from '@/view/PageTwo.vue'
import Page3 from '@/view/PageThree.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/page1',
      name: 'page1',
      component: Page1,
    },
    {
        path: '/page2',
        name: 'page2',
        component: Page2,
      },
      {
        path: '/page3',
        name: 'page3',
        component: Page3,
      }

  ],
})

export default router
