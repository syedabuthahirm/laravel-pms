<template>
    <div class="field">
        <div class="control">
            <div class="select">
                <select v-model="selected" @change="updateStatus" name="status_id">
                    <option v-for="(status,index) in statuses" :key="index" :value="status.id">{{ status.title }}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: ["statuses", "selectedStatus", "projectId", "endPoint"],
  data: function() {
    return {
      selected: null,
      oldValue: null
    };
  },
  mounted() {
    this.selected = this.selectedStatus.id;
    this.oldValue = this.selected;
  },
  methods: {
    updateStatus(event) {
      axios
        .patch(this.endPoint, {
          status_id: this.selected
        })
        .then(({ data }) => {
          flash(data);
          this.oldValue = this.selected;
        })
        .catch(({ data }) => {
          console.log(data);
          flash("Something wrong, Please try again later.", "danger");
          this.selected = this.oldValue;
        });
    }
  }
};
</script>
