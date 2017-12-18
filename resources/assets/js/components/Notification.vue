<template>
    <div :class="classes" v-if="isActive">
        <button @click="isActive = false" class="delete"></button>
        {{ message }}
    </div>
</template>

<script>
export default {
  props: ["notification"],
  data: function() {
    return {
      isActive: false,
      type: "success",
      message: ""
    };
  },
  methods: {
    flash(data) {
      if (data) {
        if (data.message) {
          this.message = data.message;
        }
        if (data.type) {
          this.type = data.type;
        }
        this.isActive = true;

        this.hide();
      }
    },
    hide() {
      setTimeout(() => {
        this.isActive = false;
      }, 5000);
    }
  },
  created() {
    this.flash(this.notification);
    window.events.$on("flash", data => {
      this.flash(data);
    });
  },
  computed: {
    classes() {
      return ["notification", "is-flash", "is-" + this.type];
    }
  }
};
</script>

<style>

</style>
