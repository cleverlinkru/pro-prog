<script>
export default {
    data() {
        return {
            loading: false,
        };
    },
    created() {
        this.$inertia.on('start', () => this.loading = true);
        this.$inertia.on('finish', () => this.loading = false);
    },
}
</script>
