import http from '@/utils/http';
import { ACTION } from '@/store/action-types';

const actions = {
    [ACTION.GET_CHAT_LIST]({commit}, {from, name, successCb, errorCb}) {
        http.get(`chats/chat-list?from=${from}&name=${name}`, res => {
            successCb(res);
        }, error => {
            errorCb(error);
        });
    },
    [ACTION.GET_CHAT_SINGLE]({commit}, {from, to, successCb, errorCb}) {
        http.get(`chats/chat-single?from=${from}&to=${to}`, res => {
            successCb(res);
        }, error => {
            errorCb(error);
        });
    }
};

export default {
  actions
}
