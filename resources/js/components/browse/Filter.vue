<template>
  <aside class="browse-aside">
    <div class="tag-filters" :class="filterOpenClass">
      <button class="close" @click="$emit('filter:close')">Close</button>

      <h5>Filter by Access:</h5>
      <ul>
        <li>
          <a
            href="#"
            @click.prevent="applyFilter('access', 'paid')"
            :class="{'active': selectedFilters['access'] === 'paid'}"
          >paid</a>

          <a
            href="#"
            @click.prevent="applyFilter('access', 'free')"
            :class="{'active': selectedFilters['access'] === 'free'}"
          >free</a>

          <span
            class="clear-filter"
            @click="clearFilter('access')"
            v-if="selectedFilters['access']"
          >&times; clear this filter</span>
        </li>
      </ul>
      <h5>Browse by Category:</h5>
      <ul>
        <li v-for="(map, key) in filters" :key="key">
          <a
            href="#"
            @click.prevent="applyFilter(key, value)"
            v-for="(filter, value) in map"
            :key="value"
            :class="{'active': selectedFilters[key] === value}"
          >{{ filter }}</a>

          <span
            class="clear-filter"
            @click="clearFilter(key)"
            v-if="selectedFilters[key]"
          >&times; clear this filter</span>
        </li>
      </ul>

      <a href="#" @click.prevent="clearFilters" class="clear-filters">Clear all filters</a>
    </div>
  </aside>
</template>

<script>
export default {
  props: {
    endpoint: {
      type: String
    },
    open: {
      type: Boolean
    }
  },
  data() {
    return {
      filters: {},
      selectedFilters: _.omit(this.$route.query, ["page"])
    };
  },
  computed: {
    filterOpenClass() {
      return this.open ? "open" : "";
    }
  },
  mounted() {
    axios.get(this.endpoint).then(({ data }) => {
      this.filters = data.data;
    });
  },
  methods: {
    applyFilter(key, value) {
      this.selectedFilters = Object.assign({}, this.selectedFilters, {
        [key]: value
      });

      this.updateQueryString();

      this.$emit("filter:close");
    },
    clearFilter(key) {
      this.selectedFilters = _.omit(this.selectedFilters, [key]);
      this.updateQueryString();
      this.$emit("filter:close");
    },
    clearFilters() {
      this.selectedFilters = {};
      this.updateQueryString();
    },
    updateQueryString() {
      this.$router.replace({
        query: {
          ...this.selectedFilters
        }
      });
    }
  }
};
</script>

<style lang="scss" scoped>
a {
  text-decoration: underline;
  &:hover {
    color: #f05537;
  }
  &.active {
    background: #f05537;
    color: white;
  }
}
.clear-filter {
  margin-top: 1rem;
  text-decoration: underline;
  cursor: pointer;
  display: block;
  &:hover {
    color: #f05537;
  }
}
</style>
