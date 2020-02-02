<template>
  <div class="field">
    <input
      id="switchRoundedDefault"
      type="checkbox"
      name="switchRoundedDefault"
      class="switch is-rounded"
      :checked="isChecked"
      @change="handleChange"
    />
    <label for="switchRoundedDefault" class="switch-label">
      <slot></slot>
    </label>
  </div>
</template>

<script>
export default {
  props: {
    checked: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      isChecked: this.checked
    };
  },
  watch: {
    checked: {
      handler: function(val) {
        this.isChecked = val;
      },
      immediate: true
    }
  },
  methods: {
    handleChange(e) {
      this.isChecked = e.target.checked;
      this.$emit("switchToggle", e.target.checked);
    }
  }
};
</script>

<style lang="scss" scoped>
.field {
  margin-bottom: 0.75rem;
}
.switch[type="checkbox"] {
  outline: 0;
  user-select: none;
  display: inline-block;
  position: absolute;
  opacity: 0;
  vertical-align: baseline;
  transition: all 0.3s;
}

.switch[type="checkbox"]:checked + label::after {
  right: 2.45rem;
  border-radius: 50%;
}

.switch[type="checkbox"]:checked + label::before {
  background-image: url("../../svg/moon.svg"), linear-gradient(#091236, #1e215d);
  background-repeat: no-repeat;
  background-color: #1e215d;
  background-position: right;
  background-size: contain;
  border-radius: 24px;
}

label {
  position: relative;
  display: initial;
  font-size: 1rem;
  line-height: initial;
  padding-right: 4.5rem;
  padding-top: 0.5rem;
  cursor: pointer;
  transition: all 0.3s;

  &::before {
    border-radius: 24px;
    position: absolute;
    display: block;
    top: 0;
    right: 0;
    width: 4rem;
    height: 1.8rem;
    border: 0.1rem solid transparent;
    background-image: url("../../svg/sun.svg");
    background-repeat: no-repeat;
    background-position: left;
    background-color: #79d7ed;
    background-size: contain;
    content: "";
  }

  &::after {
    display: block;
    position: absolute;
    top: 0.31rem;
    right: 0.41rem;
    width: 1.2rem;
    height: 1.2rem;
    transform: translate3d(0, 0, 0);
    border-radius: 24px;
    background: #fff;
    transition: all 0.3s ease-out;
    content: "";
  }
}
</style>