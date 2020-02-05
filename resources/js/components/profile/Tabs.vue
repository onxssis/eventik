<template>
  <div>
    <div :class="{ tabs: true, 'is-centered': isCentered }">
      <ul>
        <li v-for="(tab, i) in tabs" :key="i" :class="{ 'is-active': tab.isActive }">
          <a @click.prevent="selectTab(tab)">{{ tab.name }}</a>
        </li>
      </ul>
    </div>

    <div class="tab-details">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isCentered: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      tabs: []
    };
  },
  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(function(tab) {
        tab.isActive = selectedTab.name == tab.name;
      });
    }
  },
  created() {
    this.tabs = this.$children;
  }
};
</script>

<style lang="scss" scoped>
.tabs {
  li {
    &.is-active {
      a {
        border-bottom-color: #f05537;
        color: #f05537;
      }
    }
  }
}
</style>