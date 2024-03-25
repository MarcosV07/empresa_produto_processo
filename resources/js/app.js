require('./bootstrap');

import { createApp } from "vue";
import LocalizacaoTab from './components/localizacao-tab'
import DashBoardTab from './components/dashboard'

const app = createApp({})
app.component('localizacao-tab', LocalizacaoTab);
app.component('dashboard-pedido', DashBoardTab);
app.mount('#app') 