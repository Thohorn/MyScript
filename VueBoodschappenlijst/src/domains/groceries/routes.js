import CreateView from './pages/GroceryCreate.vue'
import EditView from './pages/GroceryEdit.vue'
import OverviewView from './pages/GroceryOverview.vue'

export const routes = [
  { path: '/create', component: CreateView },
  { path: '/edit/:id', component: EditView },
  { path: '/overview', component: OverviewView },
]
