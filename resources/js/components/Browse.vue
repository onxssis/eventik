<script>
export default {
  props: {
    events: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      filterOpen: false
    };
  },
  computed: {
    filterOpenClass() {
      return this.filterOpen ? "open" : "";
    }
  }
};
</script>



<style lang="scss" scoped>
@media (min-width: 50em) {
  .browse {
    display: grid;
    grid-template-columns: 33% 1fr;
    // grid-gap: 20px;
  }
}

.browse-main {
  grid-column: 2 / 3;
}
.browse-aside {
  grid-column: 1 / 2;
}

.tag-filters {
  padding: 60px 20px;
}

.tag-filters ul {
  display: flex;
  flex-wrap: wrap;
  margin: 0px 0px 2rem;
  padding: 0px;
  list-style: none;
}
.tag-filters ul a {
  margin-right: 5px;
  margin-bottom: 5px;
  text-decoration: none;
  padding: 5px 10px;
  background: #d5d5d5;
  color: #343434;
  display: inline-block;
  font-size: 0.8em;
  font-weight: 600;
  cursor: pointer;
  text-transform: uppercase;
  border-radius: 3px;
}

.tag-filters ul a:hover {
  background: #f05537;
  color: white;
}

.tag-filters h5 {
  margin: 0 0 1rem;
  text-transform: uppercase;
  font-size: 1.2rem;
  font-weight: 900;
}

@media (min-width: 50em) {
  .mobile-filter {
    display: none;
  }
}

@media (max-width: 50em) {
  .tag-filters {
    position: fixed;
    top: 0px;
    left: 0px;
    height: 100vh;
    width: 100vw;
    z-index: 31;
    background: white;
    transform: translate3d(0px, -110%, 0px);
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px,
      rgba(0, 0, 0, 0.22) 0px 15px 12px;
    padding: 60px 20px;
    transition: all 0.5s ease 0s;
  }

  .tag-filters.open {
    transform: translate3d(0px, 0px, 0px);
    opacity: 1;
    transition: all 0.5s ease 0s;
  }
}

@media (max-width: 50em) {
  .mobile-filter {
    height: 60px;
    background: #f05537;
    color: white;
    font-size: 0.9rem;
    display: flex;
    justify-content: center;
    align-items: center;
    text-transform: uppercase;
    font-weight: 700;
  }
}

.tag-filters button.close {
  position: absolute;
  top: 20px;
  right: 20px;
  border: 0;
  background: #f05537;
  padding: 5px 15px;
  color: #fff;
  cursor: pointer;
  border-radius: 4px;
  text-transform: uppercase;
  font-weight: 700;
}

.browse-main .filter-input {
  margin: 60px 20px 20px;
  border-bottom: 2px solid #f05537;
  display: flex;
  position: relative;
}

.browse-main .filter-input > svg {
  margin-right: 5px;
}

.browse-main .filter-input input {
  margin-bottom: 8px;
  padding: 5px;
  width: 100%;
  border: none;
  font-weight: 800;
  outline: none;
}

.browse-main .filter-input .focus-line {
  position: absolute;
  background: #fbbc05;
  content: "";
  height: 4px;
  bottom: -2px;
  transition: all 0.3s;
  display: block;
  width: 100%;
  transform: scale(0);
}

.browse-main .filter-input input:focus + .focus-line {
  transform: scale(1);
}

.browse-main .events-grid {
  display: grid;
}

/* single event */

a {
  color: inherit;
}

article {
  margin: 15px;
  border-radius: 6px;
}

article:hover {
  box-shadow: 0 0 5px #888;
}

.cont > .img-hold {
  /* max-width: 220px; */
  position: relative;
}

.free {
  padding: 3px 20px;
  background: white;
  border-radius: 4px;
  box-shadow: 0 0 5px #888;
  position: absolute;
  box-shadow: 0 0 5px #888;
  top: 10px;
  right: -10px;
  z-index: 5;
  display: flex;
  justify-content: center;
  align-items: center;
}

img {
  width: 100%;
  border-radius: 6px;
}

.cont {
  display: grid;
  grid-template-columns: 220px 1fr;
  grid-gap: 20px;
  padding: 10px;
  width: 100%;
}

.aside {
  display: grid;
  grid-template-rows: auto 1fr auto;
  /*   border: 1px solid; */
}

.aside h4 {
  margin-bottom: 5px;
}

.aside p {
  color: grey;
  margin-bottom: 4px;
  font-size: 0.8rem;
}

.buttons {
  justify-self: end;
  display: flex;
  align-items: center;
  padding: 10px 0;
}

.buttons div {
  margin-left: 16px;
  padding: 8px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  cursor: pointer;
  transition: all 0.3s;
}

.buttons div:hover {
  background: #f9f9f9;
  transform: translateY(-4px);
}

@media (max-width: 50em) {
  .cont {
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: 20px;
    padding: 10px;
    width: 100%;
  }

  /* article {
  box-shadow: 0 0 5px #888;
} */
}
</style>
