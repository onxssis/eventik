<template>
  <ul>
    <li
      :class="{'disabled': meta.current_page == 1}"
      @click.prevent="switchPage(meta.current_page - 1)"
    >
      <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
          <path d="M0 12l9-8v6h15v4h-15v6z" />
        </svg>
      </a>
    </li>

    <li
      :class="{'active': meta.current_page == n}"
      v-for="n in meta.last_page"
      :key="n"
      @click.prevent="switchPage(n)"
    >
      <a href="#">{{ n }}</a>
    </li>

    <li
      :class="{'disabled': meta.current_page == meta.last_page}"
      @click.prevent="switchPage(meta.current_page + 1)"
    >
      <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
          <path d="M24 12l-9-8v6h-15v4h15v6z" />
        </svg>
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["meta"],
  methods: {
    switchPage(page) {
      if (this.pageIsOutOfBounds(page)) {
        return;
      }

      this.$emit("pagination:switchedpage", page);

      window.scrollTo(0, 0);

      this.$router.replace({
        query: Object.assign({}, this.$route.query, { page })
      });
    },

    pageIsOutOfBounds(page) {
      return page <= 0 || page > this.meta.last_page;
    }
  }
};
</script>

<style lang="scss" scoped>
ul {
  display: flex;
  justify-content: center;
  margin-bottom: 2rem;
  flex-wrap: wrap;

  li {
    margin: 0 0.3rem;
    margin-top: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
      0 2px 4px -1px rgba(0, 0, 0, 0.06);
    background: #eee;
    font-size: 0.8rem;
    border-radius: 4px;
    padding: 0.5rem 1.4rem;
    transition: all 0.3s;
    cursor: pointer;
    display: flex;
    align-items: center;

    &.active {
      background: #f05537;
      color: white;
    }
    &:hover {
      background: #f05537;
      color: white;
      transform: translateY(-3px);
      svg {
        fill: white;
      }
    }
    &.disabled {
      pointer-events: none;
      opacity: 0.6;
    }

    a {
      display: flex;
      align-items: center;
      &:hover {
        color: white;
        svg {
          fill: white;
        }
      }
    }
  }
}
</style>
