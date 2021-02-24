import http from '@/utils/http';
import { ACTION } from '@/store/action-types';

const actions = {
    [ACTION.USER_GET_BY_ID]({commit}, {id, successCb, errorCb}) {
      http.get('users/get-by-id?id=' + id, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    }
};

export default {
  actions
}
