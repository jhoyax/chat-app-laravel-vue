import { mapGetters, mapActions, mapMutations } from 'vuex';

import { GET_USER_BY_ID } from '@/store/action-types';
import { SET_CURRENT_USER } from '@/store/mutation-types';

export default {
    data() {
        return {
            user: {},
            profileId: this.$route.params.profileId,
        }
    },
    computed: {
        ...mapGetters([
            'currentUser'
        ]),
    },
    mounted() {
        if (Object.keys(this.currentUser).length && ! this.profileId) {
            this.user = this.currentUser;
        } else {
            this.getUserById();
        }
    },
    methods: {
        ...mapActions( [
            GET_USER_BY_ID,
        ]),
        ...mapMutations( [
            SET_CURRENT_USER,
        ]),
        getUserById() {
            let params = {
                id: this.profileId,
                successCb: res => {
                    this.user = res.data.data;

                    if (this.user.isCurrentUser) {
                        this.SET_CURRENT_USER({user: res.data.data});
                    }
                },
                errorCb: error => {}
            }
            this.GET_USER_BY_ID(params);
        },
    }
};
