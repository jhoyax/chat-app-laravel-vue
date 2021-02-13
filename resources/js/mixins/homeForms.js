export default {
    data() {
        return {
            showForm: false,
        }
    },
    methods: {
        toggleForm(name) {
            this.showForm = !this.showForm;
            this.form.reset();
            this.$emit('close', !this.showForm ? 'all' : name);
        },
    }
};
