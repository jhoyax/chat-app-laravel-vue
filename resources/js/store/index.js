import Vue from 'vue';
import Vuex from 'vuex';

import auth from '@/store/modules/auth';
import chat from '@/store/modules/chat';
import user from '@/store/modules/user';

Vue.use(Vuex)

const modules = {
  auth,
  chat,
  user,
}

export default new Vuex.Store({
  modules
})
