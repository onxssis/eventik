<template>
  <div class="home">
    <section class="section top">
      <div class="container">
        <div class="top-container">
          <Avatar :name="owner" class="avat" />
          <h1 class="title is-2 has-text-weight-normal">{{ owner }}</h1>
        </div>
      </div>
    </section>

    <section class="bottom">
      <div class="container is-fluid">
        <Tabs is-centered>
          <Tab name="My Events" :selected="true">
            <EventData :events="data.myEvents" />
          </Tab>
          <Tab name="Saved Events">
            <EventData :events="data.savedEvents" />
          </Tab>
          <Tab name="Attending Events">
            <EventData :events="data.myTickets" />
          </Tab>
        </Tabs>
      </div>
    </section>
  </div>
</template>

<script>
import Avatar from "./Avatar";
import Tabs from "./Tabs";
import Tab from "./Tab";
import EventData from "./EventData";

export default {
  props: {
    data: {
      type: Object,
      required: true
    },
    owner: {
      type: String,
      required: true
    }
  },
  components: {
    Avatar,
    Tabs,
    Tab,
    EventData
  },
  computed: {
    noEntriesFound() {
      return data => data.length < 1;
    }
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