export default {
    methods: {
        getAvatarStyle(avatar) {
            if (avatar == 'unset') {
                return `background-image: unset`;
            } else if (avatar) {
                return `background-image: url(${avatar})`;
            } else {
                return '';
            }
        },
    }
};
