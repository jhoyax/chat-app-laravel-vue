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
    },
    [ACTION.STORE_CHAT]({commit}, {to, to_name, message, successCb, errorCb}) {
        let data = {
            to: to,
            to_name: to_name,
            message: message,
        };

        http.post('chats', data, res => {
            successCb(res);
        }, error => {
            errorCb(error);
        });
    },
    [ACTION.DELETE_CHAT_SINGLE]({commit}, {from, to, successCb, errorCb}) {
        let data = {
            from: from,
            to: to,
        };

        http.delete('chats/chat-single', data, res => {
            successCb(res);
        }, error => {
            errorCb(error);
        });
    }
};

export default {
  actions
}
