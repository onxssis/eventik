<template>
  <div class="home">
    <section class="section top">
      <div class="container">
        <div class="top-container">
          <Avatar name="Jimmy Woo" class="avat" />
          <h1 class="title is-2 has-text-weight-normal">Jimmy Woo</h1>
        </div>
      </div>
    </section>

    <section class="bottom">
      <div class="container is-fluid">
        <Tabs>
          <Tab name="My Events" :selected="true">My Events Content</Tab>
          <Tab name="Saved Events">Saved Events Content</Tab>
          <Tab name="Attending Events">Attending Events Content</Tab>
        </Tabs>
      </div>
    </section>
  </div>
</template>

<script>
import Avatar from "./Avatar";
import Tabs from "./Tabs";
import Tab from "./Tab";

export default {
  components: {
    Avatar,
    Tabs,
    Tab
  }
};
</script>

<style lang="scss" scoped>
.section.top {
  .top-container {
    display: flex;
    align-items: center;

    .avat {
      margin-right: 2rem;
    }
  }
}
</style>