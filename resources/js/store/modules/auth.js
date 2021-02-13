import http from '@/utils/http';
import { ACTION } from '@/store/action-types';

const actions = {
    [ACTION.LOGOUT]({commit}, {successCb, errorCb}) {
      http.post('logout', {}, res => {
        $cookies.remove('token');
        successCb(res);
      }, error => {
        errorCb(error);
      });
    }
};

export default {
  actions
}
