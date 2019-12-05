<template id="k-retrotree-section">
<section class="k-retrotree">
  <header class="k-section-header">
    <h2 class="k-headline">{{ headline }}</h2>
  </header>
  <div class="k-container">
    <template v-if="pages.length<=0">
      <k-list-item :text="treeEndMessage" :icon="{ emoji: false ,type: this.treeDefaultIcon, back: 'black' }" />
    </template>
    <template v-else>
      <table-view-cell
      :data="pages"
      :title="pages.title"
      :showSlug="showSlug"
      :showStatus="showStatus"
      :showPageIcon="showPageIcon"
      :treeMaxDepth="treeMaxDepth"
      :treeDefaultIcon="treeDefaultIcon"
      >
      </table-view-cell>
    </template>
  </div>
 </section>
</template>
 <k-page-create-dialog ref="create" />
<script>
import TableViewCell from "./TableViewCell.vue";

export default {
  name: 'k-retrotree-section',
  components: {
    TableViewCell
  },
  data: function() {
    return {
      headline: null,
      treeMaxDepth: null,
      pages: Array,
      showStatus: null,
      showSlug: null,
      treeEndMessage: null,
      showPageIcon: null,
      treeDefaultIcon: null
    }
  },
  created: function() {
    this.load().then(response => {
      this.headline = response.headline;
      this.treeMaxDepth = response.treeMaxDepth;
      this.pages = response.tree[0].data;
      this.showStatus = response.showStatus;
      this.showSlug = response.showSlug;
      this.treeEndMessage = response.treeEndMessage;
      this.showPageIcon = response.showPageIcon;
      this.treeDefaultIcon = response.treeDefaultIcon;
    });
  }

};
</script>
<style lang="scss">
@import './src/scss/index.scss'
</style>
