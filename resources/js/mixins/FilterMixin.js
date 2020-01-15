const FilterMixin = {
    methods: {
        applyFilter(key, value) {
            this.selectedFilters = Object.assign({}, this.selectedFilters, {
                [key]: value
            });

            this.updateQueryString();
            this.closeFilter();
        },

        updateQueryString() {
            this.$router.replace({
                query: {
                    ...this.selectedFilters
                }
            });
        },

        closeFilter() {
            this.$emit("filter:close");
        }
    }
};

export default FilterMixin;
