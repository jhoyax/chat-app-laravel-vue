import axios from 'axios';
import http from '@/utils/http';
import { ACTION } from '@/store/action-types';
import { MUTATION } from '@/store/mutation-types';

const state = {
    currentUser: {},
};

const getters = {
    currentUser: (state) => {
        return state.currentUser;
    }
};

const actions = {
    [ACTION.GET_USER_LIST]({commit}, {name, successCb, errorCb}) {
      http.get('users?name=' + name, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.GET_USER_BY_ID]({commit}, {id, successCb, errorCb}) {
      http.get('users/get-by-id?id=' + id, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.UPDATE_USER]({commit}, {id, name, email, password, password_confirmation, successCb, errorCb}) {
        let data = {name: name, email: email};
        if (password) {
            data.password = password;
            data.password_confirmation = password_confirmation;
        }
        http.put('users/' + id, data, res => {
          successCb(res);
        }, error => {
          errorCb(error);
        });
    },
    [ACTION.UPDATE_USER_AVATAR]({commit}, {id, avatar, successCb, errorCb}) {
        let config = {
            headers: {
                'content-type': 'multipart/form-data',
                'X-HTTP-Method-Override': 'PUT'
            }
        };
        let formData = new FormData();
        formData.append('avatar', avatar);

        axios.post(`users/${id}/update-avatar`, formData, config)
        .then((res) => {
          successCb(res);
        }).catch((error) => {
          errorCb(error);
        });
    }
};

const mutations = {
    [MUTATION.SET_CURRENT_USER](state, {user}) {
      state.currentUser = user;
    },
};

export default {
    state,
    getters,
    actions,
    mutations
}
